<?php

namespace App\Http\Controllers;

use App\Models\PredictionResult;
use App\Service\ReplicateApiService;
use Illuminate\Http\Request;

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
            'file' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $url = "https://i.ibb.co/QNqWjyZ/E-NQc-Jc-XEAch-Po-G.jpg";
        //'http:/images/'.$imageName
        return response()->json(['success'=> true, 'image' => $imageName, 'url' => $url]);
    }

    public function result(Request $request)
    {
        $predictionResult = PredictionResult::where('uuid', $request->uuid)->firstOrFail();

      if (!($predictionResult->status === 'succeeded' || $predictionResult->status === 'failed')) {
          $replicateApiService = new ReplicateApiService();
          $predictionResult = $replicateApiService->checkImageRestorationStatus($predictionResult->replicate_id);
      }

        return view('result', ['result' => $predictionResult]);
    }

}
