<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                <img src="{{ asset('images/logo-desa.png') }}" alt="Logo" height="40">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Daftar menu navbar -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('frontend.index') }}">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('list-book') }}">Repository Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('list-quiz') }}">Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('history') }}">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('return.index') }}">Pengembalian</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="{{ route('search') }}" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
            <div class="notification">
                <!-- Notifikasi dropdown -->
                <a class="btn btn-outline-danger position-relative" href="#" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-bell"></i>
                    @if($notifications->count() > 0)
                        <span class="badge position-absolute">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                    @forelse($notifications as $notification)
                        <li>
                            <a class="dropdown-item d-flex align-items-start" href="#" data-id="{{ $notification->id }}">
                                <i class="fa-solid fa-bell fa-beat-fade" style="color: #FFD43B;"></i>
                                <div class="notification-content">
                                    <h6 class="notification-title">{{ $notification->type }}</h6>
                                    <p class="notification-message">{{ $notification->data }}</p>
                                    <small class="notification-time">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li><a class="dropdown-item" href="#">Tidak ada notifikasi</a></li>
                    @endforelse
                </ul>
            </div>
        </div>
        @if(Auth::check())
        <div class="nav-item dropdown no-arrow ms-4 d-lg-block profile" id="userProfile">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="me-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('backend/sb_admin/img/undraw_profile.svg') }}" height="40">
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in profile-modal" aria-labelledby="userDropdown">
                <a class="dropdown-item profile-modal" href="#" data-toggle="modal" data-target="#addMemberModal">
                    <i class="fa-solid fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                    Member
                </a> 
                <a class="dropdown-item" href="{{ route('member.edit', ['user' => Auth::user()->id]) }}">
                    <i class="fa-solid fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>             
                <div class="dropdown-divider"></div>
                <a class="dropdown-item profile-modal" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa-solid fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </div>
        <div class="modal fade logoutModal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form id="logout-form" method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <button class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <a class="btn btn-primary ms-3" href="{{ route('login') }}">Login</a>
        @endif
    </div>
</nav>
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Add New Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="memberForm" method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="study">Study</label>
                        <select class="form-control" id="study" name="study" required>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    nav.navbar {
        background-color: #f1f1f1 !important;
    }

    .navbar-nav .nav-item .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-item:hover .nav-link {
        color: #7e7e7e; 
    }

    .navbar-nav .nav-item .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #ffe310; 
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-item:hover .nav-link::before {
        width: 100%;
    }
    .navbar .notification .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.6em;
    }
    .notification{
        margin-left: 10px;
    }
    .navbar .dropdown-menu {
        min-width: 10rem;
    }
    .navbar .dropdown-menu .dropdown-item {
        padding: 0.5rem 1rem;
    }
    .navbar .img-profile {
        width: 40px;
        height: 40px;
    }
    .navbar .dropdown-toggle::after {
        display: none;
    }
    .navbar .dropdown-menu-end {
        right: 0;
        left: auto;
    }
    .navbar .dropdown-menu.show {
        display: block;
        transform: translate3d(0px, 0px, 0px);
    }
    .navbar .dropdown-menu {
        display: none;
    }
    .navbar .dropdown-toggle:hover + .dropdown-menu,
    .navbar .dropdown-menu:hover {
        display: block;
    }
    .navbar .dropdown-menu {
        background-color: #ffffff;
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58,59,69,.15);
    }
    .dropdown-item {
        display: flex;
        align-items: start;
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid #e9ecef;
        cursor: pointer;
        text-decoration: none; 
        color: #000; 
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    .notification-content {
        margin-left: 1rem; 
    }
    .notification-title {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .notification-message {
        margin-bottom: 0.5rem;
    }
    .notification-time {
        color: #5d6165;
    }
    .dropdown-item:last-child {
        border-bottom: 0;
    }
    .dropdown-menu {
        max-height: 400px;
        overflow-y: auto;
    }
    .read {
        background-color: #e9ecef;
        color: #6c757d;
    }

    @media (max-width: 720px) {
        .profile {
            margin-left: auto;
        }
        .navbar .dropdown-menu {
            min-width: 10rem; 
            right: 0; 
            left: auto; 
            transform: translateX(-20%); 
        }
        .notification {
            margin-top: 20px;
        }

        .notification .dropdown-menu {
            left: 0;
            right: auto;
            width: 300px; /* Set an explicit width to make the container wider */
            max-width: none; /* Remove the max-width limit */
        }

        .notification .dropdown-item {
            font-size: 0.85rem; /* Adjust font size for smaller text */
            padding: 0.5rem; /* Reduce padding for a more compact appearance */
            white-space: normal; /* Allow wrapping if text is too long */
        }

        .notification-content {
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis for overflowed text */
            max-width: 200px; /* Set a maximum width for the notification content */
        }
        #logoutModal .modal-dialog {
            margin: 0 auto;    
            max-width: 80%; 
        }
        
        #logoutModal .modal-content {
            width: 80%; 
        }
    }
    .d-none {
        display: none !important;
    }
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var dropdownElement = document.getElementById('notificationDropdown');
    var dropdownMenu = document.querySelector('.notification .dropdown-menu');

    if (dropdownElement && dropdownMenu) {
        dropdownElement.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah aksi default jika ada

            // Toggle 'show' class pada dropdown menu
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            } else {
                dropdownMenu.classList.add('show');
            }
        });

        // Menutup dropdown jika mengklik di luar
        document.addEventListener('click', function (event) {
            if (!dropdownElement.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // Logika sebelumnya untuk menampilkan/menyembunyikan userProfile
    var navbarToggle = document.getElementById('navbarToggle');
    var userProfile = document.getElementById('userProfile');

    navbarToggle.addEventListener('click', function () {
        if (window.innerWidth <= 720) {
            if (!document.getElementById('navbarNav').classList.contains('show')) {
                userProfile.classList.add('d-none');
            } else {
                userProfile.classList.remove('d-none');
            }
        }
    });
});
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.profile-modal').forEach(function (link) {
            link.addEventListener('click', function (event) {
                if (event.currentTarget.getAttribute('data-target') === '#addMemberModal') {
                    event.preventDefault(); // Mencegah aksi default
    
                    fetch('{{ route('check.member.status') }}', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.is_member) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan!',
                                text: 'Anda sudah terdaftar sebagai member. Jika Anda ingin mengedit profil member, klik "Edit Member".',
                                confirmButtonText: 'Edit Member',
                                showCancelButton: true,
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '{{ route('member.edit', ['user' => Auth::id()]) }}';
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan!',
                                text: data.message,
                                confirmButtonText: 'Daftar Member'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#addMemberModal').modal('show');
                                }
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silakan coba lagi nanti.',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        });
    });
    </script>
    

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('memberForm').addEventListener('submit', function (event) {
                event.preventDefault();
        
                const form = this;
                const formData = new FormData(form);
        
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#addMemberModal').modal('hide');
                        form.reset();
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                });
            });
        });
        </script>
    
@endpush

