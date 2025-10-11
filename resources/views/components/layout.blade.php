<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman {{ $title }}</title>
    {{-- Bootsrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- CDN icon bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    {{-- Tailwind CSS Complementary --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css')

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="min-h-full">
        {{-- Navbar dari component Navbar --}}
        <x-navbar></x-navbar>

        {{-- Header dari component Header --}}
        {{-- Isi Component ($title) Pada Component Header akan menggantikan variable {{ $slot }} di component header.blade.php --}}
        {{-- Variable title ini dimabil bukan dari routes tapi dari masing-masing view yang diisi dengan (<x-slot:title>{{ $title }}</x-slot:title>) --}}
        <x-header>{{ $title }}</x-header>

        {{-- Main --}}
        {{-- Variable {{ $slot }} akan diisi pada apapun yang ada dalam isi component ketika digunakan pada view --}}
        <main>
            <div class="mx-auto py-6">
                {{-- Slot ini akan diisi oleh konten yang ada pada tampilan ketika dipanggil (x-templating) --}}
                {{ $slot }}
            </div>
        </main>
    </div>

    {{-- Script Bootstrap CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    {{-- Script Icon --}}
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>

</html>
