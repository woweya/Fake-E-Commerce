<nav class="w-full relative p-4 mx-auto ms-auto flex items-center justify-between">
    <ul class="flex items-center gap-4 container">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="">About</a></li>
        <li><a href="">Contact</a></li>
    </ul>
    <h1 class="text-3xl font-semibold uppercase text-white">E-commerce</h1>

    <ul class="flex items-center gap-4 container">
        @php
            if (session()->has('Cart')) {
                $cart = session()->get('Cart');
                $count = count($cart);
            }else{
                $count = 0;
            }

        @endphp
        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
            class="m-0 gap-0 flex items-center justify-between py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent relative">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-6">
                <path
                    d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
            </svg>
            @if ($count > 0)
            <span class="sr-only">Notifications</span>
            <div class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                {{ $count }}

            </div>
            @else

            @endif
        </button>
        <div id="dropdownNavbar"
            class=" visible z-10 absolute top-16 right-[16%]  font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-[18rem]">
            <div class="bg-gray-100 p-5 rounded">
                @livewire('cart')
            </div>
        </div>
        <li><a href="">Wishlist</a></li>
        <li><a href="{{ route('products') }}">Products</a></li>

        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endguest
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white">Logout</button>
            </form>
        @endauth
    </ul>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdown = document.getElementById('dropdownNavbar');
            const button = document.getElementById('dropdownNavbarLink');
            button.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
            });
        })
    </script>
</nav>
