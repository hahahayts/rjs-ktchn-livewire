<?php

namespace App\Livewire\AdminPage;

use Livewire\Component;

class Dashboard extends Component
{
    public $total_customers;
    // public $total_current_customers;
    public $total_orders;

    public function mount(){
        $this->total_customers = \App\Models\User::whereHas('roles', function($query){
            $query->where('name','user');
        })->count();

        // $this->total_current_customers = \App\Models\User::whereHas('roles', function($query){
        //     $query->where('name','user');
        // })->where('status','active')->count();
        $this->total_orders = \App\Models\Order::count();
       




    }
    public function render()
    {
        return view('livewire.admin-page.dashboard');
    }
}
