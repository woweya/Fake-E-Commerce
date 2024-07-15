<!DOCTYPE html>
<html lang="en" style="padding: 0; margin: 0;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>E-commerce</title>
    @livewireStyles
</head>

<body style="margin: 0; padding: 0;">
    <div class="wrapper flex flex-col min-h-[100vh]">
        <x-navbar></x-navbar>

        <main class="w-full " style="flex:1;">
            {{ $slot }}
        </main>




        <section class="w-full">
            @persist('footer')

            <x-footer></x-footer>
            @endpersist('footer')
        </section>
    </div>
    @livewireScripts
</body>

</html>
