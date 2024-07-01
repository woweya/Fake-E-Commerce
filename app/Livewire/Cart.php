<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class Cart extends Component
{

    public $cart = [];

    public function render()
    {
        return view('livewire.cart');
    }

    public function mount(){

        $this->cart = Session::get('cart-products', []);
    }

    #[On('addToCart')]
    public function add($product){
        dd($product);

    }


}
