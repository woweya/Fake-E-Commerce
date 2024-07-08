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


    #[On('addToCart')]
    public function add(array $product){
         // Append the product to the cart
    $this->cart[] = $product;
}

}
