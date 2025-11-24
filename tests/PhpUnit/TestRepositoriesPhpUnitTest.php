<?php

namespace Tests\PhpUnit;

use App\Models\Univers;
use App\Repositories\testRepositories;
use Mockery;
use PHPUnit\Framework\TestCase;

class TestRepositoriesPhpUnitTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_store_fills_saves_and_returns_new_model()
    {
        $inputs = ['nom' => 'Mon Univers'];

        $newModel = Mockery::mock(Univers::class);
        $newModel->shouldReceive('fill')->once()->with($inputs)->andReturnSelf();
        $newModel->shouldReceive('save')->once()->andReturnTrue();

        $dependency = Mockery::mock(Univers::class);
        $dependency->shouldReceive('newInstance')->once()->andReturn($newModel);

        $repo = new testRepositories($dependency);

        $result = $repo->store($inputs);

        $this->assertSame($newModel, $result);
    }

    public function test_update_fills_saves_and_returns_given_model()
    {
        $inputs = ['nom' => 'Univers Modifié'];

        $existing = Mockery::mock(Univers::class);
        $existing->shouldReceive('fill')->once()->with($inputs)->andReturnSelf();
        $existing->shouldReceive('save')->once()->andReturnTrue();

        $dependency = Mockery::mock(Univers::class);

        $repo = new testRepositories($dependency);

        $result = $repo->update($existing, $inputs);

        $this->assertSame($existing, $result);
    }
}
