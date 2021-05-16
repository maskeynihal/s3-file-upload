<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        $files = Storage::disk('s3')->files('tmp');

       return view('files.index', compact('files'));
    }

    public function upload(Request $request, FileUploadService $fileUploadService)
    {

        $fileName = $fileUploadService->getFullFileName($request->file('file'), Str::random(8));

        $fileUploadService->upload($request->file('file'), 'tmp', $fileName);

        return redirect()->back();
    }

    public function create()
    {
        return view('files.create');
    }

    public function download(Request $request)
    {
        return Storage::disk('s3')->response($request->file);
    }
}
