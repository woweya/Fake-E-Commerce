<div>
    <h2>Cart</h2>
  @if ($cart)
  <ul>
    @foreach ($cart as $product)
    <img src="{{ $product['image'] }}" alt="">
   <li>{{Str::limit($product['title'], 10)}}</li>
   <li>{{Str::limit($product['price'], 10)}}</li>
   <li>{{$product['0']['quantity']}}</li>
    @endforeach
</ul>
  @else
    <p>Your cart is empty.</p>
  @endif



</div>

