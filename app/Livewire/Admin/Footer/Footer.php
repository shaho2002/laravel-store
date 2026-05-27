<?php

namespace App\Livewire\Admin\Footer;

use App\Models\Footer as ModelsFooter;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Footer extends Component
{

    public $aboutUs;
    public $mobile;
    public $emailAddress;
    public $address;
    public $editMode = false;
    public $alertMessage;
    public $alertType;

    #[Layout('admin.master'), Title('مدیریت فوتر')]

    #[Computed]
    public function mount()
    {
        $footerInfos = ModelsFooter::query()
            ->first();

        $this->aboutUs = $footerInfos->aboutUs;
        $this->mobile = $footerInfos->mobile;
        $this->emailAddress = $footerInfos->emailAddress;
        $this->address = $footerInfos->address;
    }
    public function editFooter()
    {
        $this->editMode = true;
    }
    public function updateFooter()
    {
        $this->validate([
            'aboutUs' => 'required',
            'emailAddress' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        ModelsFooter::query()
            ->update([
                'aboutUs' => $this->aboutUs,
                'mobile' => $this->mobile,
                'emailAddress' => $this->emailAddress,
                'address' => $this->address,
            ]);

        $this->editMode = false;
        $this->alertType = 'success';
        $this->alertMessage = ' اطلاعات با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editCancel()
    {
        $this->editMode = false;
        $this->resetErrorBag();


        $footerInfos = ModelsFooter::query()
            ->first();

        $this->aboutUs = $footerInfos->aboutUs;
        $this->mobile = $footerInfos->mobile;
        $this->emailAddress = $footerInfos->emailAddress;
        $this->address = $footerInfos->address;
    }

    public function render()
    {
        return view('livewire.admin.footer.footer');
    }
}
