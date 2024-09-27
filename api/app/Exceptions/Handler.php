<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Verifica se a solicitação espera uma resposta JSON
        if ($request->expectsJson()) {
            // Tratamento de exceções de validação
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'mensagem' => 'Campos inválidos',
                    'erros' => $exception->errors()
                ], 422);
            }

            // Tratamento de exceções de rota não encontrada
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'mensagem' => 'Esta rota não foi encontrada'
                ], 404);
            }

            // Tratamento de exceções de método não permitido
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'mensagem' => 'Método HTTP não permitido'
                ], 405);
            }

            // Tratamento de exceções de falha de comunicação com o banco de dados
            if ($exception instanceof QueryException) {
                return response()->json([
                    'mensagem' => 'Erro ao tentar se comunicar com o banco de dados',
                    'erro' => $exception->getMessage()
                ], 500);
            }

            // Tratamento de outras exceções
            return response()->json([
                'mensagem' => $exception->getMessage(),
                'codigo' => $exception->getCode() ?: 500,
                'arquivo' => $exception->getFile(),
                'linha' => $exception->getLine()
            ], $exception->getCode() ?: 500);
        }

        return parent::render($request, $exception);
    }
}