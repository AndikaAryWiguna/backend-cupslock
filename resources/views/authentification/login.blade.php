<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- CSS Login --}}
    <link rel="stylesheet" href="/css/style.css" />

    <div class="d-flex justify-content-center">
        <div class="col-sm-4 shadow-lg">
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show mt-2 mx-2" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1 class="h3 mb-4 fw-normal text-center py-3">Please {{ $title }}</h1>
            {{-- Message succes register --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2 mx-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Form Login --}}
            <form class="p-3" action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="email" name="email"
                            class="form-control @error('email')
                            is-invalid
                            @enderror"
                            id="email" placeholder="name@example.com" autofocus required
                            value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="password" name="password"
                            class="form-control @error('password')
                            is-invalid
                            @enderror"
                            id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary w-40 py-2" type="submit">Login</button>
                </div>
            </form>
            <div class="mb-4 text-center">
                <small>Not Register? <a href="/register">Register Now!</a></small>
            </div>

        </div>
    </div>
    </div>
</x-layout>
