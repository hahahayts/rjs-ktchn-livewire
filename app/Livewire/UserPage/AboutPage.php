<?php

namespace App\Livewire\UserPage;

use Livewire\Attributes\Title;
use Livewire\Component;

class AboutPage extends Component
{
    #[Title("Why RJ's KTCHN")]
    // public function mount(){
    //     dd('okay');
    // }
    public function render()
    {
        return view('livewire.user-page.about-page');
    }
}
