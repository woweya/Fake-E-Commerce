<div>
    <main id="single-product" class="w-full mx-auto text-start flex items-start justify-start p-10 rounded">

        <button id="back-button"><a href="/products"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z"
                        clip-rule="evenodd" />
                </svg>
            </a></button>
        <div class="container mx-auto mt-10 relative">
                <div role="alert" id="alert" style="box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);"
                    class="alert alert-success bg-green-200 dark:bg-green-600 text-white p-4 rounded absolute top-0 right-0 @if (session()->has('success'))
                    visible @else hidden @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    @if (session()->has('success'))
                    <span> {{ session('success') }}</span>
                    @endif
                </div>

            <div class="left-side-single-product w-1/2 flex items-center justify-center">
                <img src="{{ $products['image'] }}" class="fixed-size-image" alt="{{ $products['title'] }}">

            </div>
            <div class="right-side-single-product w-1/2 flex flex-col items-start justify-center pl-10">
                <h1 class="text-4xl font-bold mb-4">{{ $products['title'] }}</h1>
                <p class="text-xl mb-4 capitalize">{{ $products['description'] }}</p>
                <div class="flex justify-between items-center w-full">
                    <p class="text-xl mb-4 text-gray-500 capitalize">Category: {{ $products['category'] }}</p>
                    @php
                        $rating = $products['rating']['rate'];
                        $numberRate = $products['rating']['count'];
                        $roundedRating = round($rating); // Arrotonda al numero intero più vicino
                        $stars = str_repeat('⭐', $roundedRating); // Genera le stelle dinamicamente
                    @endphp
                    <p class="text-xl mb-4 text-gray-500 capitalize">Rating: {{ $stars }} ({{ $numberRate }})
                    </p>
                </div>
                <div class="flex items-center justify-center w-full">
                    <div class="left-side text-center">
                        <p class="text-2xl font-bold">${{ $products['price'] }}</p>
                    </div>
                    <form class="w-full mb-1" id="quantity-form" wire:submit.prevent="addToCart">

                        <div class="right-side ">
                            <button type="submit" class="btn-shop">Add to cart</button>
                        </div>
                        <div class="quantity-product w-1/3 ">
                            <div class="relative flex items-center max-w-[8rem] gap-0">
                                <button wire:click="decrementQuantity" type="button" id="decrement-button"
                                    data-input-counter-decrement="quantity-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" name="quantity" wire:model="quantity" id="quantity-input"
                                    data-input-counter data-input-counter-min="1" data-input-counter-max="50"
                                    aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="999" value='{{ $quantity }}' required />
                                <button wire:click="incrementQuantity" type="button" id="increment-button"
                                    data-input-counter-increment="quantity-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                    </form>

                </div>
            </div>
        </div>
</div>
</main>
<section class="w-full flex flex-col items-center justify-start mt-2 container">
    <ul id="breadcrumb" class="flex items-center w-full text-center justify-start gap-10 p-0 m-0">
        <li><a href="#" data-section="description">Description</a></li>
        <li><a href="#" data-section="features">Features</a></li>
        <li><a href="#" data-section="reviews">Reviews</a></li>
        <li><a href="#" data-section="category">Category</a></li>
    </ul>
    <hr width="100%" class="m-0 p-0">
    <section id="content-section" class="container mt-4">
        <div id="description" class="content active">
            <h2 class="text-2xl font-bold mb-4 underline">Description of the product</h2>
            <p class="text-lg">{{ $products['description'] }}</p>
        </div>
        <div id="features" class="content">
            <h2 class="text-2xl font-bold mb-4 underline">Features</h2>
            <p class="text-lg">Here are the features of the product...</p>
        </div>
        <div id="reviews" class="content">
            <h2 class="text-2xl font-bold mb-4 underline">Reviews</h2>
            <p class="text-xl mb-4 text-gray-500 capitalize">Rating: {{ $stars }} ({{ $numberRate }})</p>
        </div>
        <div id="category" class="content">
            <h2 class="text-2xl font-bold mb-4 underline">Category</h2>
            <p class="text-lg capitalize">{{ $products['category'] }}</p>
        </div>
    </section>


</section>

@script
    <script>
        document.addEventListener('livewire:initialized', function() {
            Livewire.on('addToCart', () => {
                const alert = document.getElementById('alert');
                alert.classList.remove('hidden');
                setTimeout(() => {
                    alert.classList.add('hidden');
                    alert.classList.remove('visible');
                }, 3000);
         });

            const tabs = document.querySelectorAll('#breadcrumb a');
            console.log(tabs);
            const contentSections = document.querySelectorAll('.content');
            console.log(contentSections);
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = tab.getAttribute('data-section');
                    contentSections.forEach(section => {
                        if (section.id === sectionId) {
                            section.classList.add('active');
                        } else {
                            section.classList.remove('active');
                        }
                    });
                    tabs.forEach(tab => tab.parentElement.classList.remove('active'));
                    tab.parentElement.classList.add('active');
                });
            });

        });
    </script>
@endscript
</div>
