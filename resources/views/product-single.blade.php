<x-layout>
<main id="single-product" class="w-full mx-auto text-start flex items-start justify-start p-10 rounded">
    <button id="back-button"><a href="/products"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
      </svg>
      </a></button>
    <div class="container mx-auto mt-10">
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
        <p class="text-xl mb-4 text-gray-500 capitalize">Rating: {{ $stars }} ({{ $numberRate }})</p>
       </div>
       <div class="flex items-center justify-center w-full">
        <div class="left-side text-center">
            <p class="text-2xl font-bold">${{ $products['price'] }}</p>
        </div>
        <div class="right-side ">
            <button class="btn-shop">Add to cart</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#breadcrumb a');
    console.log(tabs);
    const contentSections = document.querySelectorAll('.content');
    console.log(contentSections);

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
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
</section>

</x-layout>
