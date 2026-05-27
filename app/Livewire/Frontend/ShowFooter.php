<?php

namespace App\Livewire\Frontend;

use App\Models\Footer;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShowFooter extends Component
{
#[Computed(persist:true)]
public function footerInfos()
{
    return Footer::query()
    ->first();
}
    public function render()
    {
        return view('livewire.frontend.show-footer');
    }
}
