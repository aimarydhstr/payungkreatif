<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Penamaan rapi (pakai slug + timestamp)
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('uploads/ckeditor', $filename, 'public');

            $url = asset('storage/' . $path);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'Tidak ada file yang diupload']]);
    }

}
