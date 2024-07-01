<div>
    <h2>Cart</h2>
    <ul>
        @foreach($cart as $product)
            <li>
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" width="50">
                <strong>{{ $product['name'] }}</strong>
                <p>Quantity: {{ $product['quantity'] }}</p>
                <p>Price: ${{ $product['price'] }}</p>
            </li>
        @endforeach
    </ul>

    <button >Checkout</button>
</div>

