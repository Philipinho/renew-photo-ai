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

        $jsonStartResponse = $startResponse->json();
        return $jsonStartResponse['urls']['get'];
    }

    public function checkImageRenewalStatus(string $endpointUrl)
    {
        $renewedImage = null;
        while (!$renewedImage) {
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

        return $renewedImage;
    }
}
