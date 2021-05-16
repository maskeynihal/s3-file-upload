<?php

namespace App\Jobs;

use Illuminate\Http\File;
use Illuminate\Bus\Queueable;
use App\Events\FileUploadedToS3;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UploadFileToS3Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $filePath;
    public string $fileName;
    public array $options;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filePath, string $fileName, array $options  = [])
    {
        $this->filePath = $filePath;

        $this->fileName = $fileName;

        $this->options = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = Storage::path("{$this->filePath}/{$this->fileName}");

        Log::info("Uploading {$file} to S3");

        $response = Storage::disk('s3')->putFileAs($this->filePath, $file, $this->fileName);

        Log::info("File {$file} uploaded to S3");

        FileUploadedToS3::dispatchIf($response, $this->filePath, $this->fileName);
    }
}
