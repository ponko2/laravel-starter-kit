<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     *
     * @return \Illuminate\Http\Response
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            return $this->renderExceptionWithWhoops($e);
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * Render an exception using Whoops.
     *
     * @param  \Exception $e
     *
     * @return \Illuminate\Http\Response
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        return response()->make(
            $whoops->handleException($e),
            method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
            method_exists($e, 'getHeaders') ? $e->getHeaders() : []
        );
    }
}
