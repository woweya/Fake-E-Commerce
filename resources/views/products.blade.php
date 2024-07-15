<x-layout>
    <main class="w-full mx-auto text-start flex items-start justify-start mb-12 p-10 rounded" style="min-height: 70.8vh">
        <div class="left-side-products-tag">
            <div class="tag-container">
                <p class="font-bold text-sm text-white  mb-4 underline ">Categories</p>
                @foreach ($categories as $category)
                    <div class="flex items-start justify-start mb-4">
                        <input id="category-{{ $loop->index }}" type="checkbox" value="{{ $category }}"
                            class="category-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="category-{{ $loop->index }}"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 capitalize">{{ $category }}</label>
                    </div>
                @endforeach
                <div class="flex items-center justify-center">
                    <hr class="w-[90%] border-black mb-5">
                </div>
                <div class="tag-price">
                    <p class="font-bold text-sm text-white mb-4 underline ">Price</p>
                    <div class="relative mb-6">
                        <label for="price-range-input" class="sr-only">Price range</label>
                        <input id="price-range-input" type="range" value="1000" min="8" max="1000"
                            class="price-range w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Min
                            ($8)</span>
                        <span id="price-range-value"
                            class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6 font-bold">$500</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Max
                            ($1000)</span>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <hr class="w-[90%] border-black mb-5 mt-5">
                </div>
                <div class="tag-filter-rated">
                    <p class="font-bold text-sm text-white mb-4 underline ">Rating</p>
                    <form class="max-w-sm mx-auto">
                        <label for="rating-filter"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                            option</label>
                        <select id="rating-filter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Choose a filter</option>
                            <option value="best_rated">Best Rated</option>
                            <option value="worst_rated">Worst Rated</option>
                            <option value="lowest_price">Lowest Price</option>
                            <option value="highest_price">Highest Price</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
        <div class="right-side-products">
            <div class="flex flex-wrap justify-center items-center">
                @foreach ($data as $product)
                    <a href="{{ route('product', $product['id']) }}" class="link-product">
                        <div id="products-{{ $product['id'] }}" class="card-product cursor-pointer" data-category="{{ $product['category'] }}"
                             data-price="{{ $product['price'] }}" data-rating="{{ $product['rating']['rate'] }}">
                            <img src="{{ $product['image'] }}" alt="">
                            <div class="card-product-body">
                                <h1 class="card-product-title font-semibold ">{{ Str::limit($product['title'], 18, '..') }}</h1>
                                <p class="text-gray-500 text-sm font-light capitalize">
                                    {{ Str::limit($product['description'], 18, '...') }}</p>
                                <p class="card-product-price font-semibold text-xl text-red-800">{{ $product['price'] }}$
                                </p>

                                @php
                                    $rating = $product['rating']['rate'];
                                    $numberRate = $product['rating']['count'];
                                    $roundedRating = round($rating); // Arrotonda al numero intero più vicino
                                    $stars = str_repeat('⭐', $roundedRating); // Genera le stelle dinamicamente
                                @endphp

                                <p class="text-gray-500 text-sm font-light capitalize">Rating: {{ $stars }} ({{ $numberRate }})</p>
                                <button class="card-product-button" id="add-to-cart">Add to cart</button>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
        <script>




            //Product filtering by tags
    document.addEventListener('DOMContentLoaded', function() {

        document.addEventListener('livewire:initialized', function() {
        const addToCart = document.getElementById('add-to-cart');
        addToCart.addEventListener('click', function() {
            Livewire.dispatchTo('product', 'addToCart');
        });
    });



        function updateArticles() {
        var selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(
            checkbox => checkbox.value
        );
        var maxPrice = document.getElementById('price-range-input').value;
        var ratingFilter = document.getElementById('rating-filter').value;

        console.log(selectedCategories, maxPrice, ratingFilter);

        var products = Array.from(document.querySelectorAll('.card-product'));

        products.sort((a, b) => {
            var ratingA = parseFloat(a.getAttribute('data-rating'));
            var ratingB = parseFloat(b.getAttribute('data-rating'));
            var priceA = parseFloat(a.getAttribute('data-price'));
            var priceB = parseFloat(b.getAttribute('data-price'));
            var popularityA = parseInt(a.getAttribute('data-popularity'), 10);
            var popularityB = parseInt(b.getAttribute('data-popularity'), 10);

            switch (ratingFilter) {
                case 'best_rated':
                    return ratingB - ratingA;
                case 'worst_rated':
                    return ratingA - ratingB;
                case 'highest_price':
                    return priceB - priceA;
                case 'lowest_price':
                    return priceA - priceB;
                default:
                    return ratingB - ratingA;
            }
        });

        var container = document.querySelector('.right-side-products .flex');
        container.innerHTML = '';  // Clear the container
        products.forEach(product => container.appendChild(product.closest('a'))); // Append the <a> tag containing the product

        products.forEach(product => {
            var productCategory = product.getAttribute('data-category');
            var productPrice = parseFloat(product.getAttribute('data-price'));

            var categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(productCategory);
            var priceMatch = productPrice <= maxPrice;

            if (categoryMatch && priceMatch) {
                product.closest('a').style.display = '';  // Show the <a> tag
            } else {
                product.closest('a').style.display = 'none';  // Hide the <a> tag
            }
        });
    }

    document.querySelectorAll('.category-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateArticles);
    });

    document.getElementById('price-range-input').addEventListener('input', function() {
        document.getElementById('price-range-value').textContent = '$' + this.value;
        updateArticles();
    });

    document.getElementById('rating-filter').addEventListener('change', updateArticles);

    updateArticles(); // Initialize the articles update
});

        </script>
    </main>
</x-layout>
