<?php

declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        $allowedOrigins = ['http://localhost:8080','http://localhost:63343'];
        $origin = $request->getHeader('Origin');

        if (in_array($origin, $allowedOrigins)) {
            $response = $response->withHeader('Access-Control-Allow-Origin', $origin);
        }

//        if (preg_match('/^http:\/\/localhost(:[0-9]+)?$/', $origin)) {
//            $response = $response->withHeader('Access-Control-Allow-Origin', $origin);
//        }

        return $response;
    });
};
