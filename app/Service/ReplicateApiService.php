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
            $startResponse = Http::withHeaders([
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

        // Check for API errors
        $jsonStartResponse = $startResponse->json();

        if (isset($jsonStartResponse['error'])) {
            throw new \Exception("Failed to start image renewal: " . $jsonStartResponse['error']);
        }

        // Save to database

        return $jsonStartResponse['urls']['get'];
    }


    public function checkImageRenewalStatus(string $endpointUrl)
    {
        $renewedImage = null;
        $retryCount = 0;
        $maxRetries = 8;

        while (!$renewedImage && $retryCount < $maxRetries) {
            try {
                $finalResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Token ' . config('replicate.api_key')
                ])->get($endpointUrl);
            } catch (\Exception $e) {
                // Handle exception
                // log errors to admin
                // $jsonFinalResponse['error']
                return $this->errorResponse($e->getCode());
            }

            // Check for HTTP errors
            if ($finalResponse->failed()) {
                return $this->errorResponse($finalResponse->status());
            }

            $jsonFinalResponse = $finalResponse->json();

            if ($jsonFinalResponse['status'] === 'succeeded') {
                $renewedImage = $jsonFinalResponse['output'];

            } else if ($jsonFinalResponse['status'] === 'failed') {
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
        // Use URL from B2 instead of Replicate CDN.
        // Update database record once completed.

        return response()->json(['' => '', 'renewedImage' => $renewedImage, 'code' => 200]);
    }

    private function errorResponse($code): \Illuminate\Http\JsonResponse
    {
        $message = "There was an error processing this image, please try again or contact support.";
        return response()->json(['success' => false, 'error' => $message, 'code' => $code]);
    }


}
