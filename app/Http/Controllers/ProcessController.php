<?php

namespace App\Http\Controllers;

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
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $url = "https://ucbc530c708189a330c10434d5a5.previews.dropboxusercontent.com/p/thumb/AB2zJEYDjnncQ2LI9ZeOKjlIJxfNOBO69ep12I6x50zhSaTVd4uzK441NHTC4Rnvhryb11jSkmukwIvdd2va6PnQ7hFHJNVp0Rf-6t_j7hOU7pFbVZvWx9wSK8plG9PSSkRJpfYPM2Wv45-57GY8IbJJbYlA2gln4YqL9WG2veYupLeDIobohE_IjFnUDve6SNaQsRpBWEE9P5Zi6S0VFYqrw3x0_zW_PL7D79C_3u6G1wE5nTEIZUhrulhy-yKbh7Ra97xpWmazG7NqtyvNcUHKXeelKDk4umiPa7DnHv8jW5X-78BoL2ouDtk3ga3nRH6DJ_OqMIy_FHmLg3gvLUxz1YmmHguYpOeT6A7KrP70EkpbIIuMyTAygxQHkSwnM8BbqYpVTZjMzHwOOrnT5iu0YyDFPG1Nw0m93BqhHXmlhw/p.jpeg";
        //'http:/images/'.$imageName
        return response()->json(['success'=> true, 'image' => $imageName, 'url' => $url]);
    }
}
