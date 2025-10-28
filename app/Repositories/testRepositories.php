<?php

namespace App\Repositories;

use App\Models\Univers;

class testRepositories
{
    protected Univers $test;

    public function __construct(Univers $test)
    {
        $this->test = $test;
    }

    /**
     * @param  array<string,mixed>  $inputs
     */
    private function save(Univers $test, array $inputs): Univers
    {
        $test->fill($inputs);
        $test->save();

        return $test;
    }

    /**
     * @param  array<string,mixed>  $inputs
     */
    public function store(array $inputs): Univers
    {
        $test = $this->test->newInstance();

        return $this->save($test, $inputs);
    }

    /**
     * @param  array<string,mixed>  $inputs
     */
    public function update(Univers $test, array $inputs): Univers
    {
        return $this->save($test, $inputs);
    }
}
