<?php

namespace App\Livewire;

use Livewire\Component;

class SimpleLink extends Component
{
    public string $link;
    public string $linkText;

    public function render()
    {
        return view('livewire.simple-link');
    }
}
