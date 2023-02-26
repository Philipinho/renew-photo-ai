<?php

namespace App\Http\Controllers;

use App\Models\ImageResult;
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
        $imageResult = ImageResult::where('uuid', $request->uuid)->firstOrFail();

      //  if ($imageResult->status === 'starting' || $imageResult->status === 'processing') {

           // return redirect()->route('process')->with('error', $imageResult->error);
      //  }

        return view('result', ['result' => $imageResult]);
    }

}
