<nav class="w-full relative p-4 mx-auto ms-auto flex items-center justify-between">
    <ul class="flex items-center gap-4 container">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="">About</a></li>
        <li><a href="">Contact</a></li>
    </ul>
        <h1 class="text-3xl font-semibold uppercase text-white">E-commerce</h1>

        <ul class="flex items-center gap-4 container">
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="m-0 gap-0 flex items-center justify-between py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Cart <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg></button>
            <div id="dropdownNavbar" class=" visible z-10 absolute top-16 right-[16%]  font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="bg-gray-100 dark:bg-gray-700 p-10 rounded">
                    @livewire('cart')
                </div>
            </div>
            <li><a href="">Wishlist</a></li>
            <li><a href="{{route('products')}}">Products</a></li>

              @guest
              <li><a href="{{route('login')}}">Login</a></li>
              <li><a href="{{route('register')}}">Register</a></li>
              @endguest
              @auth
              <form action="{{route('logout')}}" method="POST">
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
