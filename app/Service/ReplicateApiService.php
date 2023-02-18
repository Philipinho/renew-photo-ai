<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ReplicateApiService
{
    public function startImageRenewal(string $imageUrl)
    {
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
        // save to database

        $jsonStartResponse = $startResponse->json();
        return $jsonStartResponse['urls']['get'];
    }

    public function checkImageRenewalStatus(string $endpointUrl)
    {
        $renewedImage = null;
        $retryCount = 0;
        $maxRetries = 10;

        while (!$renewedImage && $retryCount < $maxRetries) {
            $finalResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . config('replicate.api_key')
            ])->get($endpointUrl);

            $jsonFinalResponse = $finalResponse->json();

            if ($jsonFinalResponse['status'] === 'succeeded') {
                $renewedImage = $jsonFinalResponse['output'];

            } else if ($jsonFinalResponse['status'] === 'failed') {
                break;
            } else {
                usleep(1);
            }
        }

        // upload $renewedImage to B2.
        // use url from b2 instead of replicate CDN
        // update database record once completed

        return $renewedImage;
    }
}
