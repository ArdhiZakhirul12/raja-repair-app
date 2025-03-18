<?php

namespace App\Livewire;

use Livewire\Component;

class CreateService extends Component
{
    public $cabangs;

    public function mount($cabangs)
    {
        $this->cabangs = $cabangs;
    }

    public function render()
    {
        return view('livewire.create-service');
    }
}
