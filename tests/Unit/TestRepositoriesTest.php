<?php

use App\Models\Univers;
use App\Repositories\testRepositories;

afterEach(function () {
    Mockery::close();
});

test('store fills and saves and returns the new model', function () {
    $inputs = ['nom' => 'Mon Univers'];

    // Mock the instance that will be returned by newInstance()
    $newModel = Mockery::mock(Univers::class);
    $newModel->shouldReceive('fill')->once()->with($inputs)->andReturnSelf();
    $newModel->shouldReceive('save')->once()->andReturnTrue();

    // Mock the dependency injected into the repository
    $dependency = Mockery::mock(Univers::class);
    $dependency->shouldReceive('newInstance')->once()->andReturn($newModel);

    $repo = new testRepositories($dependency);

    $result = $repo->store($inputs);

    expect($result)->toBe($newModel);
});

test('update fills and saves and returns the given model', function () {
    $inputs = ['nom' => 'Univers Modifié'];

    $existing = Mockery::mock(Univers::class);
    $existing->shouldReceive('fill')->once()->with($inputs)->andReturnSelf();
    $existing->shouldReceive('save')->once()->andReturnTrue();

    $dependency = Mockery::mock(Univers::class);

    $repo = new testRepositories($dependency);

    $result = $repo->update($existing, $inputs);

    expect($result)->toBe($existing);
});
