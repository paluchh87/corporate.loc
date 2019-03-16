<?php

namespace Corp\Exceptions;

use Corp\Services\ContactServices;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @throws
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();

            if ($statusCode == 404) {
                $obj = new ContactServices();
                $navigation = view(config('settings.theme') . '.navigation')->with('menu', $obj->getMenu())->render();
                \Log::alert('Страница не найдена - ' . $request->url());

                return response()->view(config('settings.theme') . '.404',
                    ['bar' => 'no', 'title' => 'Страница не найдена', 'navigation' => $navigation]);
            }
        }

        return parent::render($request, $exception);
    }


}
