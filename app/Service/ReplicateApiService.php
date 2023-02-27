<?php

namespace App\Service;

use App\Enums\PredictionType;
use App\Models\PredictionResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReplicateApiService
{
    /**
     * @throws \Exception
     */
    public function startImageRestoration(string $imageUrl): PredictionResult
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

        $predictionResult = PredictionResult::create([
            'user_id' => auth()->user()->id ?? NULL,
            'uuid' => Str::orderedUuid(),
            'replicate_id' => $response['id'],
            'url' => $response['urls']['get'],
            'input_image_url' => $response['input']['img'],
            'error' => $response['error'],
            'version' => config('replicate.version'),
            'type' => PredictionType::RESTORE,
            'status' => $response['status'],
        ]);

        return $predictionResult;
    }


    public function checkImageRestorationStatus(string $replicateId): PredictionResult
    {
        $predictionResult = PredictionResult::where('replicate_id', $replicateId)->firstOrFail();

        $tempStatuses = ['starting', 'processing'];

        if (!in_array($predictionResult->status, $tempStatuses)) {
            return $predictionResult;
        }

        $restoredImage = null;
        $retryCount = 0;
        $maxRetries = 8;
        $input_url = $predictionResult->input_image_url;

        while (!$restoredImage && $retryCount < $maxRetries) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Token ' . config('replicate.api_key')
                ])->get($predictionResult->url);
            } catch (\Exception $e) {
                Log::error("Failed to restore image: ". $replicateId . " - " . $e->getMessage());
                // log error
               // break;
            }

            // Check for HTTP errors
            if ($response->failed()) {
                // log error
                break;
            }
            if ($response['status'] === 'succeeded') {
                $restoredImage = $response['output'];
                break;

            } else if ($response['status'] === 'failed') {
                break;
            } else {
                $retryCount++;
                sleep(1);
            }
        }

        if (empty($response)) {
            //update status to failed
            $predictionResult->update([
                'status' => 'failed',
            ]);

            return $predictionResult;
        }

        $extension = pathinfo($restoredImage, PATHINFO_EXTENSION);

        $filename = time() ."-" . uniqid() . '-output' . "." . $extension;
        $filePath = 'output/' . $filename;

        Log::INFO("RI: " . $restoredImage);

        Storage::disk('s3')->put($filePath, file_get_contents($restoredImage));

        $imageURL = config('filesystems.disks.s3.url') . "/" . $filePath;

        Log::INFO("OUTPUT: " . $imageURL);

        $predictionResult->update([
            'output_image_url' => $imageURL,
            'status' => $response['status'],
            'started_at' => $response['started_at'],
            'completed_at' => $response['completed_at'],
            'predict_time' => $response['metrics']['predict_time'],
            'logs' => $response['logs'],
            'error' => $response['error'],
        ]);

        return $predictionResult;
    }

    private function errorResponse(): JsonResponse
    {
        $message = "There was an error processing this image, please try again or contact support.";
        return response()->json(['success' => false, 'message' => $message, 'code' => 500]);
    }


}
