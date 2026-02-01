<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Livewire\Exceptions\LivewireReleaseTokenMismatchException;
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
        
        // TEMPORARY FIX: Suppress Livewire release token mismatch exceptions
        // This is causing 419 errors on Filament login
        $this->renderable(function (LivewireReleaseTokenMismatchException $e, $request) {
            if ($request->is('livewire/*')) {
                // Allow the request to proceed without throwing 419
                return response()->json([
                    'effects' => [
                        'html' => null,
                        'xhrStatus' => 200
                    ],
                    'serverMemo' => [
                        'errors' => [],
                    ]
                ], 200);
            }
        });
    }
}
