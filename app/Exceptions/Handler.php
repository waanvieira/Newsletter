<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
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

    public function report(Throwable $e)
    {
        if ($e instanceof NotFoundException) {
            throw new NotFoundException($e->getMessage() ?? 'Registro não encontrado');
        }

        if ($e instanceof BadRequestException) {
            return response()->json(['message' => $e->getMessage(), 404]);
            // throw new BadRequestException($e->getMessage() ?? 'Erro na requisição');
        }

        parent::report($e);
    }

}
