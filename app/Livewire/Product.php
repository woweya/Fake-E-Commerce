<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Product extends Component
{

    public $products;

    public $cart = [];
    public int $quantity = 1;


    public function mount(){


        $this->products['quantity'] = $this->quantity;
        $this->cart = Session::get('Cart', []);
    }

    public function render()
    {
        return view('livewire.product');
    }

    public function addToCart()
    {

        $productExists = false;


        if (isset($this->cart['products'])) {
            foreach ($this->cart['products'] as $key => $item) {

                if ($item == $this->products['id']) {
                    $productExists = true;
                    $this->cart['products'][$key]['quantity'] += $this->quantity;
                    break;
                }
            }
        } else {
            $this->cart['products'] = [];
        }

        if(!$productExists) {
            $this->products['quantity'] = $this->quantity;
            $this->cart['products'][] = $this->products;

        }

        Session::put('Cart', $this->cart);


        $this->dispatch('addToCart');

        session()->flash('success', 'Product added to cart');
    }

    public function incrementQuantity()
{
    $this->quantity++;
}

public function decrementQuantity()
{
    if ($this->quantity > 1) {
        $this->quantity--;
    }
}
}
