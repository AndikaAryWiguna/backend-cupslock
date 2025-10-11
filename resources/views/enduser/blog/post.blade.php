<x-layout>
    {{-- Component (X-slot) ini adalah Variable untuk title yang akan digunakan pada saat mengambil nilai pada route  --}}
    {{-- Dan title ini (:slot) akan menjadi variable untuk digunakan pada view (home.blade.php atau about.blade.php, dst) --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    <section>
        <div class="container px-4 rounded">
            <div class="row mt-3 shadow-lg rounded">
                <div class="col-md-4 p-2">
                    <img src="https://picsum.photos/1200/1400" class="card-img-top rounded-md" alt="">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title text-4xl fw-bold">{{ $post['title'] }}</h3>
                        <a href="/posts?kategori={{ $post->kategori->slug }}"
                            class="btn btn-{{ $post->kategori->color }}">
                            {{ $post->kategori->name }}
                        </a>
                        <p class="card-text fs-5 mt-2">{{ $post['body'] }}</p>
                        <div class="mt-2">
                            <a href="/posts?author{{ $post->author->username }}" class="text-decoration-none">
                                {{ $post->author->name }}
                            </a> |
                            {{ $post->created_at->format('j-F-Y') }}
                        </div>

                        <a href="/posts" class="btn btn-primary mt-2"> &laquo; Back To Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
