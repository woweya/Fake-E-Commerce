<div>
    <h2 class="text-xl font-bold text-center">Shopping Cart</h2>
    <hr class="py-2 mt-2 border-gray-500">
  @if ($cart)
  <ul class="flex flex-nowrap justify-center items-center">
    @foreach ($cart as $product)
    <div class="left-cart-side" style="float:left; width: 50%; height: 100%;">
        <img width="200" height="200" src="{{ $product['image'] }}" alt="">
    </div>
    <div class="right-cart-side" style="float:right; width: 50%; height: 100%;">
        <p class="text-md font-bold capitalize">{{Str::limit($product['title'], 14)}}</p>
        <p class="text-gray-500 font-light">${{Str::limit($product['price'], 10)}}</p>
        <div class="quantity-product flex items-center justify-start">
            <div class="left-side-quantity h-full">
                <span id="quantity" class="m-0 py-1 px-2 text-sm">{{ $product['quantity'] }}</span>
            </div>
            <div class="right-side-quantity flex flex-col items-center justify-start h-full m-0">
                <button wire:click="increment()" id="increment" class="py-[6.7px] border-2 border-gray-400 text-gray-400 text-sm hover:bg-gray-200  hover:scale-110">˄</button>
                <button wire:click="decrement()" id="decrement" class="py-[6.7px] border-2 border-gray-400 text-gray-400 text-sm hover:bg-gray-200  hover:scale-110">˅</button>

            </div>
            <div class="delete-product w-full flex items-center justify-flex-end">
                <svg wire:click="remove({{ $product['id'] }})"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgb(185 28 28)" class="size-5 cursor-pointer hover:scale-110">
                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                  </svg>

            </div>
        </div>


    </div>
    @endforeach
</ul>
  @else
    <p>Your cart is empty.</p>
  @endif

</div>


