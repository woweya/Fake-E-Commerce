<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class Cart extends Component
{


    public $totalPrice;
    public $cart = [];

    public function mount()
    {
        $this->totalPrice =  $this->calculateTotalPrice();
        $this->cart =  Session::get('Cart', []);
    }

    public function render()
    {
        return view('livewire.cart');
    }


    #[On('addToCart')]
    public function add()
    {
        $this->cart = Session::get('Cart', []);
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function increment($id)
    {
        foreach ($this->cart['products'] as $key => $product) {
            if ($product['id'] == $id) {
                $this->cart['products'][$key]['quantity']++;
                break;
            }
        }
        Session::put('Cart', $this->cart);
        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function decrement($id)
    {
        foreach ($this->cart['products'] as $key => $product) {
            if ($product['id'] == $id) {
                $this->cart['products'][$key]['quantity']--;
                if ($this->cart['products'][$key]['quantity'] <= 0) {
                    unset($this->cart['products'][$key]);
                }
                break;
            }
        }
        $this->cart['products'] = array_values($this->cart['products']);
        Session::put('Cart', $this->cart);

        $this->totalPrice = $this->calculateTotalPrice();
    }

    public function refreshCart()
    {
        $this->cart = Session::get('Cart', []);

        $this->totalPrice = $this->calculateTotalPrice();

    }


    public function remove($index)
    {

        // Retrieve the current cart from the session
        $cart = Session::get('Cart', []);
        // Check if the cart has products
        if (isset($cart['products'])) {
            //Filter the products array to remove the product with the given index
            $cart['products'] = array_filter($cart['products'], function ($product) use ($index) {
                // Ensure $product is an array and has an 'id' key
                return is_array($product) && isset($product['id']) && $product['id'] != $index;
            });

            //Reindex the array to avoid issues with non-sequential keys
            $cart['products'] = array_values($cart['products']);


            // If no products left, remove the 'products' key from the cart
            if (empty($cart['products'])) {
                unset($cart['products']);
            }
        }
        //Save the updated cart back to the session

        Session::put('Cart', $cart);

        $this->cart = $cart;

        $this->refreshCart();
    }


    private function calculateTotalPrice()
    {

        $total = 0;
        $cart = Session::get('Cart', []);

        if (isset($cart['products'])) {
            foreach ($cart['products'] as $product) {
                $total += $product['price'] * $product['quantity'];
            }
        }
        return $total;

    }
}
