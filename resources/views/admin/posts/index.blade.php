<x-dashboard>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between p-3">
                        <div class="card-header pb-0">
                            <h6>Posts table</h6>
                        </div>
                        <a href="/admin/posts/create" class="btn bg-secondary text-white mt-2">
                            Create Post</a>
                    </div>,
                    <div class="card-body px-2 pt-0 pb-2">
                        <div class="table-responsive p-2">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            #</th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Title</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Body</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                <p class="mb-0 text-secondary text-xs">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $post['title'] }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight mb-0">
                                                    {{ Str::limit($post['body'], 100) }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-{{ $post->kategori->color }}">{{ $post->kategori->name }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $post->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a class="btn btn-link text-dark text-gradient px-2 mb-0"
                                                    href="/admin/posts/{{ $post->slug }}"><i
                                                        class="far fa-eye me-2"></i></a>
                                                <a class="btn btn-link text-danger text-gradient px-2 mb-0"
                                                    href=""><i class="far fa-trash-alt me-2"></i></a>
                                                <a class="btn btn-link text-dark px-2 mb-0" href=""><i
                                                        class="fas fa-pencil-alt text-dark me-2"
                                                        aria-hidden="true"></i></a>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
