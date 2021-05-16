<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Jobs\UploadFileToS3Job;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function upload($file, $filePath, $fileName, $options = [], $uploadToS3 = true)
    {
        if(!Storage::disk('local')->exists($filePath)){
            Storage::makeDirectory($filePath);
        }

        Storage::disk('local')->putFileAs($filePath, $file, $fileName, $options);

        UploadFileToS3Job::dispatchIf($uploadToS3, $filePath, $fileName, $options);

        return $file;
    }

    public function getFullFileName(UploadedFile $file, $fileName = ''): string
    {
        $extension = ".{$file->extension()}";

        $fileName = $fileName ?? Str::random(36);

        return "{$fileName}{$extension}";
    }
}
