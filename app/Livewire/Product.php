<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Product extends Component
{
    public $products = [];
    public int $quantity = 1;


    public function mount()
    {
        if(empty($this->products)) {
            $this->products = [];
        }
    }
    public function render()
    {
        return view('livewire.product');
    }

    public function addToCart()
    {

        $this->products[] = ['quantity' => $this->quantity];
        $this->dispatch('addToCart', product: $this->products);
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
