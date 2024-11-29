@extends('layouts.app')

@section('content')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items:center;
            height: 100vh;
            margin: 0;
            background-color: #1a1a1a;
        }

        .register-container {
            display: flex;
            width: 70%;
            background-color: #333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .register-left {
            background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
            color: white;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .register-left h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .register-left p {
            font-size: 18px;
            opacity: 0.8;
        }

        .register-right {
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

        .btn-outline-white {
            border-color: white;
            color: white;
        }

        .btn-outline-white:hover {
            background-color: white;
            color: #2B7A78;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                width: 90%;
            }

            .register-left {
                display: none;
            }

            .register-right {
                width: 100%;
                padding: 20px;
            }

            .btn-outline-white {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .register-left {
                display: none;
            }

            .form-control {
                font-size: 14px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 10px;
            }
        }

    </style>
<body>
    <div class="register-container">
        <div class="register-left">
            <h2>Silahkan mengisi form disini untuk membuat akun.</h2>
            <p>Apabila sudah memiliki akun, silahkan login.</p>
            <a href="{{ route('login') }}" class="btn bt-light btn-outline-light w-75 mt-3">Login</a>
        </div>
        <div class="col-md-6 p-5">
            <h4 class="mb-4" style="color: white;">Registrasi</h4>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name" style="color: white;">Name</label>
                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                </div>

                <div class="form-group">
                    <label for="email" style="color: white;">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="password" style="color: white;">Password</label>
                    <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">
                    <p id="password-alert" style="color: red; font-size: 12px; margin-top: 5px;"></p>
                </div>

                <div class="form-group">
                    <label for="password-confirm" style="color: white;">Konfirmasi Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <p id="password-alert" style="color: red; font-size: 12px; margin-top: 5px;"></p>
                </div>

                <button type="submit" onclick="alertSuccess(event)" class="btn btn-primary btn-block"> {{ __('Register') }}</button>
            </form>
        </div>
    </div>
    


    <script>
        const passwordInput = document.getElementById('password');
        const passwordAlert = document.getElementById('password-alert');

        passwordInput.addEventListener('input', () => {
            if (passwordInput.value.length < 8) {
                passwordAlert.textContent = '*Password harus terdiri dari 8 karakter atau lebih';
            }else {
                passwordAlert.textContent = '';
            }
        });

        const nameInput = document.getElementById('nama');
        const nameAlert = document.getElementById('name-alert');

        nameInput.addEventListener('input', () => {
                const nameValue = nameInput.value;
                const regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(nameValue) || nameValue.length < 3) {
                    nameAlert.textContent = 'Nama harus berupa huruf dan minimal 3 karakter';
                    nameAlert.classList.add('error');
                } else {
                    nameAlert.textContent = '';
                    nameAlert.classList.remove('error');
                }
            });

            function alertSuccess(event) {
            event.preventDefault(); // Prevent form submission
            
            Swal.fire({
                title: "Berhasil!",
                text: "Berhasil Membuat Akun!",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                // After the alert is closed, submit the form
                event.target.closest('form').submit();
            });
        }
    
    </script>
@endsection
