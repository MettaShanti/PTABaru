<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ...middleware lain...

    protected $routeMiddleware = [
        // ...middleware lain...
        'Ceklevel' => \App\Http\Middleware\Ceklevel::class,
    ];
}