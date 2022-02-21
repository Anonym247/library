<?php
declare(strict_types=1);

namespace App\Exceptions;

use App\Traits\ApiResponder;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponder;

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
    ];

    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse
     * @throws Throwable
     */
    public function render($request, Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->response($e->getMessage(), $e->errors(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        } else if ($e instanceof AuthenticationException) {
            return $this->response($e->getMessage(), [], ResponseAlias::HTTP_BAD_REQUEST);
        }

        if (!env('APP_DEBUG')) {
            return $this->response('Try later', [], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return $this->response($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
