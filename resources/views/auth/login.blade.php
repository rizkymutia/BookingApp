@extends('layouts.app')

@section('content')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #1a1a1a;
        }

        .login-container {
            display: flex;
            width: 70%;
            background-color: #333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .login-left {
            background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
            color: white;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-left h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 18px;
            opacity: 0.8;
        }

        .login-right {
            width: 50%;
            padding: 40px;
            background-color: #282828;
            color: #fff;
        }

        .form-control {
            background-color: #444;
            color: #ddd;
            border: none;
            border-radius: 4px;
        }

        .form-control:focus {
            background-color: #555;
            color: #fff;
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
            border-radius: 4px;
        }

        .btn-primary:hover {
            background-color: #357ABD;
        }

        .text-link {
            color: #4a90e2;
        }

        .text-link:hover {
            color: #357ABD;
            text-decoration: underline;
        }

        .form-check-label {
            color: #ddd;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 90%;
            }

            .login-left, .login-right {
                width: 100%;
                padding: 20px;
                text-align: center;
            }

            .login-left h2 {
                font-size: 20px;
            }

            .login-left p {
                font-size: 14px;
            }

            .login-right {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .login-left h2 {
                font-size: 18px;
            }

            .login-left p {
                font-size: 12px;
            }

            .form-control {
                font-size: 14px;
                padding: 8px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 10px 15px;
            }
        }
    </style>
<body>
    <div class="login-container">
        <div class="login-left">
            <h2>Selamat Datang di Aplikasi Pesan Ruangan Disdik</h2>
            <p>Silahkan login untuk menggunakan aplikasi ini.</p>
        </div>

        <div class="login-right">
            <h4 class="mb-4">Login</h4>
            <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email"required autocomplete="email" autofocus>
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password" required autocomplete="current-password">
                    <p id="password-alert" style="color: red; font-size: 12px; margin-top: 5px;"></p>
                </div>

                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember"> Remember me</label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                <div class="text-center mt-2">
                    <p>Belum punya akun? <a href={{ route('register') }} class="text-link">Daftar Sekarang</a></p>
                </div>
            </form>
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
    

