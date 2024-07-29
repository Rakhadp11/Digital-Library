<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @stack('css')
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/sb_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/sb_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Font Awesomee-->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/v/bs5/dt-1.13.2/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css') }}">

    <link  href="{{ asset('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/logo-desa.png') }}" type="image/png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
                <img src="{{ asset('images/logo-desa.png') }}" alt="Logo" height="40">
                <div class="sidebar-brand-text mx-3">LIBRARY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components Feature</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href={{ route('user.admin') }}>Data User</a>
                        <a class="collapse-item" href={{ route('member.admin') }}>Data Member</a>
                        <a class="collapse-item" href={{ route('borrow.index') }}>Data Peminjaman</a>
                        <a class="collapse-item" href={{ route('returnbook') }}>Data Pengembalian</a>
                        <a class="collapse-item" href={{ route('hero') }}>Home Hero</a>
                        <a class="collapse-item" href={{ route('hero-feature') }}>Hero Feature</a>
                        {{-- <a class="collapse-item" href={{ route('explore-feature') }}>Explore Feature</a> --}}
                        <a class="collapse-item" href={{ route('book') }}>Book</a>
                        <a class="collapse-item" href={{ route('quiz.admin') }}>Quiz</a>
                        <a class="collapse-item" href={{ route('question') }}>Question</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('backend/sb_admin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

                    @if (Route::currentRouteName() == 'dashboard')
                        <div class="dashboard">
                            <!-- Books Borrowed Card -->
                            <div class="card-info bg-blue">
                                <i class="fas fa-shopping-cart icon"></i>
                                <div class="number">{{ $totalBorrowed }}</div>
                                <div class="text">Daftar Peminjaman Buku</div>
                                <a href="/admin/borrow" class="more-info" data-target="#borrowedTable">More info</a>
                            </div>
                            <!-- Books Returned Card -->
                            <div class="card-info bg-green">
                                <i class="fas fa-book icon"></i>
                                <div class="number">{{ $totalReturned }}</div>
                                <div class="text">Daftar Pengembalian Buku</div>
                                <a href="/admin/returnbook" class="more-info" data-target="#returnedTable">More info</a>
                            </div>
                            <!-- New Users Card -->
                            <div class="card-info bg-yellow">
                                <i class="fas fa-user-plus icon"></i>
                                <div class="number">{{ $totalMembers }}</div>
                                <div class="text">Member Terdaftar</div>
                                <a href="/admin/member" class="more-info" data-target="#membersTable">More info</a>
                            </div>
                        </div>
                        <div class="charts-container">
                            <div class="col-md-4">
                                <canvas id="chartBorrowed" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-4">
                                <canvas id="chartReturned" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-4">
                                <canvas id="chartMembers" width="400" height="200"></canvas>
                            </div>
                        </div>
                    @endif


                    @yield('content')


                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <!-- Include the Logout Form inside the modal -->
                    <form id="logout-form" method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/admin/dashboard-data')
                .then(response => response.json())
                .then(data => {
                    // Chart for Books Borrowed
                    var ctxBorrowed = document.getElementById('chartBorrowed');
                    if (ctxBorrowed) {
                        ctxBorrowed = ctxBorrowed.getContext('2d');
                        new Chart(ctxBorrowed, {
                            type: 'bar',
                            data: {
                                labels: data.borrowedLabels,
                                datasets: [{
                                    label: 'Books Borrowed',
                                    data: data.borrowedValues,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        console.error('Element with ID "chartBorrowed" not found');
                    }

                    // Chart for Books Returned
                    var ctxReturned = document.getElementById('chartReturned');
                    if (ctxReturned) {
                        ctxReturned = ctxReturned.getContext('2d');
                        new Chart(ctxReturned, {
                            type: 'bar',
                            data: {
                                labels: data.returnedLabels,
                                datasets: [{
                                    label: 'Books Returned',
                                    data: data.returnedValues,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        console.error('Element with ID "chartReturned" not found');
                    }

                    // Chart for New Members
                    var ctxMembers = document.getElementById('chartMembers');
                    if (ctxMembers) {
                        ctxMembers = ctxMembers.getContext('2d');
                        new Chart(ctxMembers, {
                            type: 'bar',
                            data: {
                                labels: data.membersLabels,
                                datasets: [{
                                    label: 'New Members',
                                    data: data.membersValues,
                                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                    borderColor: 'rgba(255, 206, 86, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    } else {
                        console.error('Element with ID "chartMembers" not found');
                    }
                });
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/sb_admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/sb_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/sb_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('https://code.jquery.com/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js') }}"></script>  
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>


    {{-- <script src="{{ asset('js\app.js') }}"></script> --}}

    @stack('scripts')

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <style>
        .charts-container {
            display: flex;
            gap: 20px; 
            justify-content: space-around; 
            padding: 20px;
            margin-top: 250px;
        }

        .chart-card {
            width: 500px; 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        canvas {
            width: 100% !important;
            height: auto !important; 
        }
        .info-box {
            display: flex;
            align-items: center;
            background: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            width: 100%;
        }
        .info-box-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 5px;
            font-size: 2em;
            color: #fff;
            margin-right: 10px;
        }
        .bg-blue {
            background: #00c0ef;
        }
        .bg-green {
            background: #00a65a;
        }
        .bg-yellow {
            background: #f39c12;
        }
        .info-box-content {
            flex: 1;
        }
        .info-box-text {
            font-size: 1.1em;
            margin: 0;
            color: #fff;

        }
        .info-box-number {
            font-size: 2.2em;
            font-weight: bold;
            margin: 5px 0 0;
        }
        .dashboard {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card-info {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            width: calc(33% - 20px);
            min-width: 250px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .card-info .icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2.5em;
            color: rgba(0, 0, 0, 0.1);
        }
        .card-info .number {
            font-size: 2.5em;
            font-weight: bold;
            color: #fff;

        }
        .card-info .text {
            font-size: 1.2em;
            color: #fff;

        }
        .bg-blue {
            background: #00c0ef;
        }
        .bg-green {
            background: #00a65a;
        }
        .bg-yellow {
            background: #f39c12;
        }
        .more-info {
            color: #007bff;
            text-decoration: none;
            font-size: 1em;
            margin-top: 10px;
        }
</style>
</body>
</html>