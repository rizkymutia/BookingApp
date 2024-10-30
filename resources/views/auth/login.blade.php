@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <p id="password-alert" style="color: red; font-size: 12px; margin-top: 5px;"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const passwordInput = document.getElementById('password');
        const passwordAlert = document.getElementById('password-alert');

        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length < 8) {
                passwordAlert.textContent = '*Password harus terdiri dari 8 karakter atau lebih';
            } else {
                passwordAlert.textContent = '';
            }
        });

        const loginForm = document.getElementById('login-form');
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Use Fetch API to send the form data
            const formData = new FormData(loginForm);
            fetch(loginForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => {
                if (response.ok) {
                    // Show success alert if login is successful
                    Swal.fire({
                        title: "Login Berhasil!",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Redirect to the intended page or dashboard
                        window.location.href = response.url; // Adjust this to the correct URL
                    });
                } else {
                    // Handle errors (e.g., invalid credentials)
                    return response.json().then(data => {
                        Swal.fire({
                            title: "Login Gagal!",
                            text: data.message || "Silakan coba lagi.",
                            icon: "error"
                        });
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: "Terjadi Kesalahan!",
                    text: "Silakan coba lagi.",
                    icon: "error"
                });
            });
        });
    });
</script>
@endsection
