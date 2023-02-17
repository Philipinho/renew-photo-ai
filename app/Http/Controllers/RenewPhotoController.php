<?php

namespace App\Http\Controllers;

use App\Service\ReplicateApiService;
use Illuminate\Http\Request;

class RenewPhotoController extends Controller
{

    private $replicateApiService;

    public function __construct(ReplicateApiService $replicateApiService)
    {
        $this->replicateApiService = $replicateApiService;
    }

    public function renewImage(Request $request)
    {
        $imageUrl = $request->input('url');

        $endpointUrl = $this->replicateApiService->startImageRenewal($imageUrl);

        $renewedImage = $this->replicateApiService->checkImageRenewalStatus($endpointUrl);

        return response()->json($renewedImage ?? 'Unable to process this image', 200);
    }


}
