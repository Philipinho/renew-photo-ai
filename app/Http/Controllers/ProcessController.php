<?php

namespace App\Http\Controllers;

use App\Models\PredictionResult;
use App\Service\ReplicateApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessController extends Controller
{
    public function show(Request $request)
    {
        return view('process');
    }

    public function uploadImage(Request $request)
    {
        // TODO: upload image to B2

        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:5048',
        ]);

        $image = $request->file('file');

        $imageExtension = $image->getClientOriginalExtension();
        $imageName = time() . "-" . uniqid() . '-input' . "." . $imageExtension;

        $filePath = 'input/' . $imageName;

        Storage::disk('s3')->put($filePath, file_get_contents($image));

        $imageURL = config('filesystems.disks.s3.url') . "/" . $filePath;
        Log::info($imageURL);

        return response()->json(['success' => true, 'image' => $imageName, 'image_url' => $imageURL]);
    }

    public function result(Request $request)
    {
        $predictionResult = PredictionResult::where('uuid', $request->uuid)->firstOrFail();

        // TODO: this should be a dispatch job
       // if (!($predictionResult->status === 'succeeded' || $predictionResult->status === 'failed')) {
         //   $replicateApiService = new ReplicateApiService();
           // $predictionResult = $replicateApiService->checkImageRestorationStatus($predictionResult->replicate_id);
        //}

        return view('result', ['result' => $predictionResult]);
    }

    public function getStatus(Request $request)
    {
        $status = PredictionResult::where('uuid', $request->uuid)->value('status');

        if (!$status){
            // return json response with error code with http status code 404
            return response()->json([
                'status' => 'result not found',
            ], 404);
        }

        return response()->json([
            'status' => $status,
        ]);
    }
}
