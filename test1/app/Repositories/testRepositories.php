<?php
namespace App\Repositories;
use App\Models\Univers;
class testRepositories{
    protected $test;
    public function __construct(Univers $test){
            $this->test = $test;
    }

    private function save(Univers $test, array $inputs){
        $test->save();
        return $test;
    }
    public function store(array $inputs){
        $test = new $this->test;
        return $this->save($test, $inputs);
    }
    public function update(Univers $test, array $inputs){
        return $this->save($test, $inputs);
    }

}

?>



































