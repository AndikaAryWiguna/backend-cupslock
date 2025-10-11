<x-layout>
    {{-- Component (X-slot) ini adalah Variable untuk title yang akan digunakan pada saat mengambil nilai pada route  --}}
    {{-- Dan title ini (:slot) akan menjadi variable untuk digunakan pada view (home.blade.php atau about.blade.php, dst) --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <h3>Ini Adalah Halaman Contact</h3>
</x-layout>
