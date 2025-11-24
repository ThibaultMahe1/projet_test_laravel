<?php

use App\Http\Middleware\admin as AdminMiddleware;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

it('allows admin users to pass middleware', function () {
    $user = User::factory()->create(['admin' => 1]);

    $middleware = new AdminMiddleware;

    $request = Request::create('/some', 'GET');
    auth()->login($user);

    $next = function ($req) {
        return response('ok');
    };

    $res = $middleware->handle($request, $next);

    expect($res->getStatusCode())->toBe(Response::HTTP_OK);
});

it('aborts with 403 for non-admin users', function () {
    $user = User::factory()->create(['admin' => 0]);

    $middleware = new AdminMiddleware;

    $this->expectException(Symfony\Component\HttpKernel\Exception\HttpException::class);

    auth()->login($user);

    $request = Request::create('/some', 'GET');

    $next = function ($req) {
        return response('ok');
    };

    $middleware->handle($request, $next);
});
