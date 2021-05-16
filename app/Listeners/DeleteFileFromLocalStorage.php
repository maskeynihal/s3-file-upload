<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteFileFromLocalStorage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $file = "{$event->filePath}/{$event->fileName}";
        $deleted = Storage::disk('local')->delete($file);

        if($deleted)
        {
            Log::info("{$file} is deleted.");
        }
    }
}
