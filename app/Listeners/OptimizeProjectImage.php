<?php

namespace App\Listeners;

use App\Events\ProjectSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OptimizeProjectImage implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectSaved $event): void
    {
        // throw new \Exception("Error optimizing image", 1);
        
        $project = $event->project;
        
        $image = Image::make(Storage::get($project->image))
            ->widen(600)
            ->limitColors(255)
            ->encode();

        Storage::put($project->image, (string)$image);
    }
}
