<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="icon" href="{{ asset('images/logo-desa.png') }}" type="image/png">
        <style>
            .container-fluid {
                height: 100vh;
            }
            .bg-warning {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .carousel-container {
                width: 100%;
                max-width: 500px;
                margin: 0 auto;
            }
            .carousel-inner img {
                width: 100%;
                height: auto;
            }
            .register-container {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .register-box {
                width: 100%;
                max-width: 400px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }
            .welcome-text {
                text-align: center;
                margin-bottom: 20px;
                animation: fadeIn 2s ease-in-out;
                font-family: 'Poppins', sans-serif;
            }
            .welcome-text h1 {
                font-size: 2.2em;
                background: linear-gradient(90deg, #007bff, #00c0ef);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
                position: relative;
            }
            .welcome-text h1::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border-radius: 10px;
                transform: scale(1.1);
                z-index: -1;
                animation: borderAnimation 3s infinite;
            }
            .welcome-text p {
                font-size: 1.1em;
                color: #555;
            }
            .form-check {
                text-align: left;
            }
            .d-flex.justify-content-between {
                justify-content: space-between !important;
            }
            .text-danger {
                color: red;
            }
            .error-message {
                color: red;
                list-style-type: none;
                padding: 0;
            }
            .arrow-down {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 2em;
                color: #007bff;
                animation: bounce 2s infinite;
            }
            .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
        }
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes borderAnimation {
                0% {
                    transform: scale(1.1);
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
                100% {
                    transform: scale(1.1);
                    opacity: 0;
                }
            }
            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-10px);
                }
                60% {
                    transform: translateY(-5px);
                }
            }
            @media (min-width: 992px) {
                .arrow-down {
                    display: none;
                }
            }
            @media (max-width: 767px) {
            .welcome-text {
                position: absolute;
            }
            .welcome-text h1 {
                font-size: 1.5em;
            }
            .welcome-text p {
                font-size: 1em;
            }
            .logo {
                position: absolute;
                top: 20px;
                right: -2%;
                transform: translateX(-50%);
                width: 32px;
            }
            .carousel-inner .carousel-item:nth-child(1) img {
                max-width: 88% !important;
                height: auto !important;
                display: block;
                margin: 0 auto;
            }
            .carousel-inner .carousel-item:nth-child(3) img {
                max-width: 70% !important;
                height: auto !important;
                display: block;
                margin: 0 auto;
                margin-top: 75px;
                padding-bottom: 50px;
            }
        }
            
        </style>
    </head>
<body>
    <div class="container-fluid">
        <div class="row h-100">
            <div class="col-md-6 bg-warning d-flex justify-content-center align-items-center">
                <div class="carousel-container">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="welcome-text">
                            <h1>Selamat Datang Kembali</h1>
                            <p>Register to access your account</p>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/buku.png') }}" class="d-block w-100" alt="Image 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/buku3.png') }}" class="d-block w-100" alt="Image 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/buku2.png') }}" class="d-block w-100" alt="Image 3">
                            </div>
                        </div>
                        <div class="arrow-down">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('images/logo-desa.png') }}" class="logo" alt="Logo">
            </div>
            <div class="col-lg-6 col-md-12 register-container">
                <div class="register-box p-5 bg-light rounded shadow">
                    <h2>Register</h2>
                    <p>Enter your account details</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="form-control mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            @if ($errors->has('name'))
                                <ul class="error-message">
                                    @foreach ($errors->get('name') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            @if ($errors->has('email'))
                                <ul class="error-message">
                                    @foreach ($errors->get('email') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="new-password" />
                            @if ($errors->has('password'))
                                <ul class="error-message">
                                    @foreach ($errors->get('password') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="mb-3">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                            @if ($errors->has('password_confirmation'))
                                <ul class="error-message">
                                    @foreach ($errors->get('password_confirmation') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>    

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="btn btn-warning">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
