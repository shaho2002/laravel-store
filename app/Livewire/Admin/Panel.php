<?php

namespace App\Livewire\Admin;

use App\Enums\OrderDetailsStatus;
use App\Models\OrderDetail;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Hekmatinasser\Verta\Verta;

class Panel extends Component
{
    public $users;
    public $userInMonth = 0;
    public $inProgressProducts = 0;
    public $sentProducts = 0;
    public $canceledProducts = 0;
    //
    public $inProgressProductsThisMonth = 0;
    public $sentProductsThisMonth = 0;
    public $canceledProductsThisMonth = 0;
    public function mount()
    {
        // users count
        $this->users = User::query()->get();
        $nowShamsi = new Verta();
        $startOfCurrentMonthShamsi = $nowShamsi->startMonth();
        $startOfCurrentMonthGregorian = $startOfCurrentMonthShamsi->toCarbon()->startOfDay();
        $userCountInMonth = User::query()
            ->where('created_at', '>=', $startOfCurrentMonthGregorian)
            ->count();

        $this->userInMonth = $userCountInMonth;


        // products count
        $orderDetails = OrderDetail::query()->get();
        foreach ($orderDetails as $orderDetail) {
            if ($orderDetail->status == OrderDetailsStatus::InProgress->value) {

                $this->inProgressProducts++;
            } elseif ($orderDetail->status == OrderDetailsStatus::Sent->value) {

                $this->sentProducts++;
            } elseif ($orderDetail->status == OrderDetailsStatus::Canceled->value) {

                $this->canceledProducts++;
            }
        }
        //products count in this month
    $orderDetailsThisMonth = OrderDetail::query()->where('created_at', '>=' ,$startOfCurrentMonthGregorian)->get();
    foreach ($orderDetailsThisMonth as $orderDetailThisMonth) {
            if ($orderDetailThisMonth->status == OrderDetailsStatus::InProgress->value) {

                $this->inProgressProductsThisMonth++;
            } elseif ($orderDetailThisMonth->status == OrderDetailsStatus::Sent->value) {

                $this->sentProductsThisMonth++;
            } elseif ($orderDetailThisMonth->status == OrderDetailsStatus::Canceled->value) {

                $this->canceledProductsThisMonth++;
            }
        }

    
    }

    #[Layout('admin.master'), Title('پنل مدیریت')]
    public function render()
    {
        return view('livewire.admin.panel');
    }
}
