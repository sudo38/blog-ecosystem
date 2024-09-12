<?php
function authMiddleware($request, $next) {
    if ($request['url'] !== '/login') {
        echo "Authentication required.\n";
    }
    return $next($request);
}

function finalHandler($request) {
    return ['status' => 200, 'body' => 'Default response'];
}

function createDispatcher($middleware, $finalHandler) {
    return function ($request) use ($middleware, $finalHandler) {
        return $middleware($request, $finalHandler);
    };
}

$request = ['url' => '/login', 'method' => 'GET', 'headers' => []];
$dispatcher = createDispatcher('authMiddleware', 'finalHandler');
$response = $dispatcher($request);

print_r($response);
?>
