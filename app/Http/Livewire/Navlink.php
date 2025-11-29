<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navlink extends Component
{
    public $numLink;
    public $name;
    
    public function render()
    {
        return view('livewire.navlink');
    }
}
