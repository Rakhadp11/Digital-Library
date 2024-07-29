<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesomee-->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Sweet Alert!-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css') }}">

    <link  href="{{ asset('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo-desa.png') }}" type="image/png">

    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar -->
    @include('frontend.partials.navbar')
    <!-- Flash Messages -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @yield('content')

    @if(!isset($noFooter) || !$noFooter)
    <!-- Footer Section -->
    @include('frontend.partials.footer')
    @endif


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @stack('css')
    @stack('scripts')
    <script src="{{ asset('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') }}"></script>

</body>
</html>
