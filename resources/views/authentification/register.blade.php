<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- CSS Login --}}
    <link rel="stylesheet" href="/css/style.css" />

    <div class="d-flex justify-content-center">
        <div class="col-sm-4 shadow-lg">
            <h1 class="h3 mb-4 fw-normal text-center py-3">Please {{ $title }}</h1>
            <form class="p-3" action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="name"
                            class="form-control @error('name')
                        is-invalid
                        @enderror"
                            id="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                        <label for="name">Nama Lengkap</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="username"
                            class="form-control @error('username')
                        is-invalid
                        @enderror"
                            id="username" placeholder="Username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="email" name="email"
                            class="form-control @error('email')
                        is-invalid
                        @enderror"
                            id="email" placeholder="name@example.com" required value="{{ old('email') }}">
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
                    <button class="btn btn-primary w-40 py-2" type="submit">Register</button>
                </div>
            </form>
            <div class="mb-4 text-center">
                <small>Already Register? <a href="/login">Login!</a></small>
            </div>
        </div>
    </div>

</x-layout>
