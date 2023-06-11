<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{

    // public $counter = 0;

    // public function increment()                //CONTATORE AL CLICK
    // {
    //     $this->counter++;
    // }
// ---------------------------------------------------------


    public function render()
    {
        return view('livewire.counter');
    }
}
