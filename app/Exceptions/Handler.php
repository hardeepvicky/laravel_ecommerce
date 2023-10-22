<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request as HttpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (HttpException $e, HttpRequest $request) {

            $status_code = $e->getStatusCode();

            $data = [
                'exception' => $e,
                'status_code' => $status_code,
                'layout' => 'backend.layouts.error',
            ];

            if ($status_code == 404)
            {
                $data['layout'] = 'backend.layouts.default';
            }

            if ($request->ajax())
            {
                return response()->view("errors.ajax.$status_code", $data, $e->getStatusCode());
            }

            return response()->view("errors.$status_code", $data, $e->getStatusCode());
        });
    }
}