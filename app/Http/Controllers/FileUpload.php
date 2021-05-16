<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function upload(Request $request)
    {
        $storage = Storage::disk('s3')->put('/', $request->file('file'));

        return redirect()->back();
    }

    public function download(Request $request)
    {
        $file = Storage::disk('s3')->files('/', true);

        return $file;
    }
}
