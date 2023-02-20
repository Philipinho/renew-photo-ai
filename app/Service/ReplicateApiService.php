<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ReplicateApiService
{
    /**
     * @throws \Exception
     */
    public function startImageRenewal(string $imageUrl)
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

        // Save to database

        return $response['urls']['get'];
    }


    public function checkImageRenewalStatus(string $endpointUrl)
    {
        $renewedImage = null;
        $retryCount = 0;
        $maxRetries = 8;
        $input_url = null;

        while (!$renewedImage && $retryCount < $maxRetries) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Token ' . config('replicate.api_key')
                ])->get($endpointUrl);
            } catch (\Exception $e) {
                // Handle exception
                // log errors to admin
                // $response['error']
                return $this->errorResponse($e->getCode());
            }

            // Check for HTTP errors
            if ($response->failed()) {
                return $this->errorResponse($response->status());
            }

            $input_url = $response['input']['img'];

            if ($response['status'] === 'succeeded') {
                $renewedImage = $response['output'];

            } else if ($response['status'] === 'failed') {
                return $this->errorResponse(500);

            } else {
                $retryCount++;
            }
        }

        // Check if the maximum number of retries has been reached
        if (!$renewedImage) {
            return response()->json(['error' => 'Failed to restore image: maximum number of retries reached', 'code' => 500]);
        }

        // Upload $renewedImage to B2.
        // Use output URL from B2 instead of Replicate CDN.
        // Update database record once completed.

        return response()
            ->json(['success' => true, 'input_image_url' => $input_url,
                'output_image_url' => $renewedImage, 'code' => 200]);
    }

    private function errorResponse($code): \Illuminate\Http\JsonResponse
    {
        $message = "There was an error processing this image, please try again or contact support.";
        return response()->json(['success' => false, 'error' => $message, 'code' => $code]);
    }


}
