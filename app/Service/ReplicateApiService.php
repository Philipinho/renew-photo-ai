<?php

namespace App\Service;

use App\Models\ImageResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function Pest\Laravel\json;

class ReplicateApiService
{
    /**
     * @throws \Exception
     */
    public function startImageRenewal(string $imageUrl): ImageResult
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . config('replicate.api_key')
            ])->post('https://api.replicate.com/v1/predictions', [
                'version' => config('replicate.version'),
                'input' => [
                    'img' => $imageUrl,
                    'version' => 'v1.4',
                    'scale' => 2
                ]
            ]);
        } catch (\Exception $e) {
            // Handle exception
            throw new \Exception("Failed to start image renewal: " . $e->getMessage());
        }
        // handle 429 ratelimit status code
        if ($response->status() === 429) {
            throw new \Exception("Failed to start image renewal: " . $response->json()['error']);
        }

        $imageResult = ImageResult::create([
            'user_id' => auth()->user()->id ?? NULL,
            'uuid' => Str::orderedUuid(),
            'replicate_id' => $response['id'],
            'url' => $response['urls']['get'],
            'input_image_url' => $response['input']['img'],
            'error' => $response['error'],
            'version' => config('replicate.version'),
            'status' => $response['status'],
        ]);

        return $imageResult;
    }


    public function checkImageRenewalStatus(string $replicateId)
    {
        $imageResult = ImageResult::where('replicate_id', $replicateId)->firstOrFail();

        $tempStatuses = ['starting', 'processing'];

        if (!in_array($imageResult->status, $tempStatuses)) {
            //return response()
               // ->json(['success' => true, 'input_image_url' => $imageResult->input_image_url,
               //     'output_image_url' => $imageResult->output_image_url, 'code' => 200]);
            return response()->json($imageResult);
        }

        $renewedImage = null;
        $retryCount = 0;
        $maxRetries = 10;
        $input_url = $imageResult->input_image_url;

        while (!$renewedImage && $retryCount < $maxRetries) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Token ' . config('replicate.api_key')
                ])->get($imageResult->url);
            } catch (\Exception $e) {
                // log errors to admin
                // $response['error']
                //return $this->errorResponse($e->getCode());
                break;
            }

            // Check for HTTP errors
            if ($response->failed()) {
                break;
            }

            if ($response['status'] === 'succeeded') {
                $renewedImage = $response['output'];
                break;

            } else if ($response['status'] === 'failed') {
                break;
                //return $this->errorResponse(500);
            } else {
                sleep(1);
                $retryCount++;
            }
        }

        // Upload $renewedImage to B2.
        // Use output URL from B2 instead of Replicate CDN.
        // Update database record once completed.

        if (empty($response)) {
            //update status to failed
            $imageResult->update([
                'status' => 'failed',
            ]);
            return $this->errorResponse();
        }

        $imageResult->update([
            'output_image_url' => $renewedImage,
            'status' => $response['status'],
            'started_at' => $response['started_at'],
            'completed_at' => $response['completed_at'],
            'predict_time' => $response['metric']['predict_time'],
            'error' => $response['error'],
        ]);

        return response()->json($imageResult);

        //return response()
          //  ->json(['success' => true, 'input_image_url' => $input_url,
            //    'output_image_url' => $renewedImage, 'code' => 200]);
    }

    private function errorResponse(): JsonResponse
    {
        $message = "There was an error processing this image, please try again or contact support.";
        return response()->json(['success' => false, 'message' => $message, 'code' => 500]);
    }


}
