<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>E-commerce</title>
</head>
<body >
    <x-navbar></x-navbar>

    {{ $slot }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    function updateArticles() {
        var selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(checkbox => checkbox.value);
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
        container.innerHTML = '';
        products.forEach(product => container.appendChild(product));

        products.forEach(product => {
            var productCategory = product.getAttribute('data-category');
            var productPrice = parseFloat(product.getAttribute('data-price'));

            var categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(productCategory);
            var priceMatch = productPrice <= maxPrice;

            if (categoryMatch && priceMatch) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
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

    updateArticles(); // Inizializza la vista degli articoli
});
        </script>



</body>
</html>
