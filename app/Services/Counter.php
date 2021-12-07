<?php

namespace App\Services;

use Illuminate\Contracts\Session\Session;
use App\Contracts\CounterContract;

class Counter implements CounterContract
{

    private $counter;
    private $session;

    public function __construct(int $counter, Session $session)
    {
        $this->counter = $counter;
        $this->session =  $session;
    }

    public function increment()
    {
        echo "test ".$this->counter ." Increment >".random_int(10,100);
    }
}





?>
