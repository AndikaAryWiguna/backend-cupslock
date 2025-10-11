<x-dashboard>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Create Post</h3>
                    </div>

                    <div class="card-body px-2 pt-0 pb-2">
                        <div class="row">
                            <div class="col-lg-8 mx-auto d-flex justify-content-center flex-column">
                                <form role="form" action="/admin/posts/store" id="contact-form" method="post"
                                    autocomplete="off">
                                    @csrf
                                    <div class="card-body">

                                        <div class="mb-4">
                                            <label for="title" class="form-label">Title Post</label>
                                            <input type="text"
                                                class="form-control @error('title')
                                            is-invalid 
                                            @enderror"
                                                id="title" name="title" placeholder="Masukkan Judul" autofocus
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="slug" class="form-label">Slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    disable readonly value="{{ old('slug') }}">
                                            </div>
                                            <div class="col-md-6 ps-2">
                                                <label for="kategori" class="form-label">Kategori</label>
                                                <select class="form-select" name="kategori_id">
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="py-4">
                                                <label>Body</label>
                                                <textarea name="body" class="form-control" id="texteditor" rows="4"></textarea>
                                                @error('body')
                                                    <p class="text-sm text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn text-white bg-secondary">Create
                                                    Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slug Check --}}
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/admin/posts/checkslug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
</x-dashboard>
