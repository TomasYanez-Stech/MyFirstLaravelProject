<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable   $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        /**
         * If the error class is `Intervention\Image\Exception\NotReadableException`, 
         * redirect the image URL to the original instead to avoid 500 errors on
         * the frontend. In particular, it has trouble with SVG images as the GD 
         * Library doesn't support anything other than JPG, PNG, GIF, BMP or WebP files.
         * 
         * This RegEx handles all Intervention Image filters defined ('/small/',
         * '/medium/', '/large/', for example) by isolating the URL path after
         * the configured Intervention URL Manipulation route (`imagecache` in 
         * this case) and replaces it with `/original/` which is a built in 
         * Intervention route that sends am HTTP response with the original image file.
         * 
         * @see https://image.intervention.io/v2/usage/url-manipulation
         */
        if ( get_class($exception) == "Intervention\Image\Exception\NotReadableException" ) {
            header('Location: '. preg_replace('/(imagecache\/[^\/]*\/)+/i', 'imagecache/original/', $request->getUri()) );
            exit();
        }

        return parent::render($request, $exception);
    }
}
