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
    public function add(){
       $this->cart = Session::get('Cart', []);

    }

public function increment(){
    $this->cart['products']['quantity']++;
}

public function decrement(){
    $this->cart['products']['quantity']--;

    if($this->cart['products']['quantity'] == 0){
        $this->cart = [];
    }


}

public function remove($index)
{

      // Retrieve the current cart from the session
      $cart = Session::get('Cart', []);
    dd($cart);

}

}
