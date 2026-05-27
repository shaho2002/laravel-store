<?php

namespace App\Livewire\Admin\Footer;

use App\Models\Footer as ModelsFooter;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Footer extends Component
{
    public $index = 0;

    #[Layout('admin.master'), Title('مدیریت فوتر')]

    #[Computed]
    public function footer_values()
    {
        return ModelsFooter::query()
        ->get();
    }

    public function render()
    {
        return view('livewire.admin.footer.footer');
    }
}
