<x-layout>
    {{-- Component (X-slot) ini adalah Variable untuk title yang akan digunakan pada saat mengambil nilai pada route  --}}
    {{-- Dan title ini (:slot) akan menjadi variable untuk digunakan pada view (home.blade.php atau about.blade.php, dst) --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Search --}}
    <div class="row justify-content-center my-2">
        <div class="col-sm-6">
            <form action="/posts">
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>


    {{-- Hero Artikel --}}
    @if ($posts->count())
        <div class="container">
            <div class="row">
                <div class="text-center rounded mb-3 shadow-sm">
                    {{-- Header Hero --}}
                    <div class="position-relative">
                        <img src="https://picsum.photos/1200/400" class="card-img-top mt-2 rounded-xl"
                            style="object-fit: cover;" alt="...">
                        <div class="header position-absolute w-100 d-flex justify-content-between align-items-center py-3 px-4"
                            style="top: 0; left: 0; z-index: 10;">
                            <a href="/posts?kategori={{ $posts[0]->kategori->slug }}"
                                class="btn btn-{{ $posts[0]->kategori->color }}">
                                {{ $posts[0]->kategori->name }}
                            </a>
                            <span class="px-2 text-white rounded" style="background-color: rgba(0, 0, 0, 0.7)">
                                <i class="bi bi-clock"></i> {{ $posts[0]->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    {{-- Body Hero --}}
                    <div class="card-body">
                        <h3 class="card-title text-3xl fw-bold">{{ $posts[0]['title'] }}</h3>
                        <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">by :
                            {{ $posts[0]->author->name }}
                        </a>
                        <p class="card-text fs-5">{{ Str::limit($posts[0]['body'], 300) }}</p>
                        <a href="/posts/{{ $posts[0]['slug'] }}" class="btn btn-dark mt-2">Read More &raquo;</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Posts Content --}}
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    @foreach ($posts->skip(1) as $post)
                        <div class="col-md-3 mt-4">
                            <div class="card h-100 shadow rounded">
                                {{-- Image --}}
                                <img src="https://picsum.photos/500/400" class="card-img-top"
                                    alt="{{ $post->title }}">

                                {{-- Header with absolute position --}}
                                <div class="header position-absolute w-100 d-flex justify-content-between align-items-center p-2"
                                    style="top: 0; left: 0; z-index: 10;">
                                    <a href="/posts?kategori={{ $post->kategori->slug }}"
                                        class="btn btn-{{ $post->kategori->color }}">
                                        {{ $post->kategori->name }}
                                    </a>
                                    <span class="px-2 text-white rounded"
                                        style="background-color: rgba(0, 0, 0, 0.329)">
                                        <i class="bi bi-clock"></i> {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                {{-- Body --}}
                                <div class="card-body">
                                    <h3 class="card-title text-2xl fw-bold hover:underline">{{ $post['title'] }}</h3>
                                    <p class="card-text">{{ Str::limit($post['body'], 100) }}</p>
                                </div>

                                {{-- Footer --}}
                                <div class="card-footer border-top-0 bg-white py-2">
                                    {{-- Garis Pembatas --}}
                                    <hr class="mx-auto my-2 w-100">
                                    {{-- Content Footer --}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="https://picsum.photos/30/30" class="rounded-circle me-1"
                                                alt="{{ $post->author->name }}">
                                            <a href="/posts?author={{ $post->author->username }}"
                                                class="text-decoration-none">
                                                {{ Str::limit($post->author->name, 18) }}
                                            </a>
                                        </div>
                                        <a href="/posts/{{ $post['slug'] }}" class="btn btn-dark">Read More &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <p class="text-center fs-4">Not Found</p>
    @endif

    {{-- Pagination --}}
    <section>
        <div class="container">
            <div class="mt-3">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</x-layout>
