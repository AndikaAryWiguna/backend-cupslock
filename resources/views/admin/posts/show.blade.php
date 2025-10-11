<x-dashboard>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Detail Post</h6>
                    </div>
                    <div class="col-sm-8 mx-auto text-center">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src="https://picsum.photos/1200/675" alt="img-blur-shadow"
                                        class="img-fluid shadow border-radius-lg">
                                </a>
                            </div>
                            <div class="card-body px-0 pt-4">
                                <span
                                    class="badge badge-sm bg-gradient-{{ $post->kategori->color }}">{{ $post->kategori->name }}</span>
                                <a href="javascript:;">
                                    <h4 class="mt-2">
                                        {{ $post->title }}
                                    </h4>
                                </a>
                                <p>
                                    {{ $post->body }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between p-3">
                        <a href="/admin/posts" class="btn bg-gradient-secondary"><i data-feather="arrow-left"></i> Back
                            To
                            Posts</a>
                        <div>
                            <a class="btn btn-link text-danger text-gradient px-2 mb-0" href=""><i
                                    class="far fa-trash-alt me-2"></i></a>
                            <a class="btn btn-link text-dark px-2 mb-0" href=""><i
                                    class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i></a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
