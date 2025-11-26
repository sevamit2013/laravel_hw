<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession as BaseStartSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogStartSession extends BaseStartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        Log::info('StartSession middleware handling request.', [
            'session_id_from_request' => $request->session()->getId(),
            'request_path' => $request->path(),
            'request_method' => $request->method(),
        ]);

        $response = parent::handle($request, $next);

        Log::info('StartSession middleware finished handling request.', [
            'session_id_after_handling' => $request->session()->getId(),
            'request_path' => $request->path(),
            'request_method' => $request->method(),
        ]);

        return $response;
    }
}
