<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
    <style>
        .header {
            background-image: url('/images/download (3).jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 300px;
            margin-top: 10px;
            margin-right: 10px;
            margin-left: 10px;
            border-radius: 15px;
        }
    </style>
<body>
    <div class="header"><div>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="width: 400px; border-radius: 15px;">
            <div class="card-body text-center">
                <h4 class="mb-2" style="font-weight: bold;">Admin Login</h4>
                <p class="text-muted mb-4">Silahkan login untuk melanjutkan!</p>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus style="border-radius: 10px;" placeholder="Username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus style="border-radius: 10px;" placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px;">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    
</body>
</html>
