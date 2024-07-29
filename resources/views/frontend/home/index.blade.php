@extends('frontend.layout.app')

@section('title', 'Homepage')

@push('css')
@endpush

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                @foreach ($heroes as $hero)
                    <h1>{{ $hero->title }}</h1>
                    <p>{{ $hero->deskripsi }}</p>
                    <a href="/list-book"> 
                        <button class="btn btn-primary">{{ $hero->button }}</button>
                    </a>
            </div>
            <div class="col-lg-6 text-center hero-image-container">
                <img src="{{ asset('storage/' . $hero->image) }}" alt="Hero Image" class="img-fluid">
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Hero Feature Section -->
<div class="hero-feature">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <i class="fa-regular fa-id-card fa-6x  card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Member</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <i class="fa-solid fa-gears fa-6x  card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Quiz</h5>
                        <a href="/list-quiz" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <i class="fa-solid fa-clock-rotate-left fa-6x  card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">History</h5>
                        <a href="/history" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <i class="fa-solid fa-book fa-6x  card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Pinjam Buku</h5>
                        <a href="/list-book" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <i class="fa-solid fa-book-bookmark fa-6x  card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Kembali Buku</h5>
                        <a href="/return" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Feature Section -->
<div class="feature-section">
    <div class="container text-center">
        <h2>Explore Digital Resources</h2>
        <p>Discover powerful tools and services tailored for your digital library needs.</p>
        <div class="scrolling-wrapper">
            <div class="card">
                <div class="card-body">
                    <img src="images/dipon.jpg" alt="" class="img-fluid">
                    <h5 class="card-title">E-Library Access</h5>
                    <p class="card-text">Access thousands of e-books and academic resources.</p>
                    <a href="/list-book" class="btn btn-primary">Explore Now</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <img src="images/juki.jpeg" alt="" class="img-fluid">
                    <h5 class="card-title">Virtual Learning</h5>
                    <p class="card-text">Engage in virtual learning experiences with interactive tools.</p>
                    <a href="/list-book" class="btn btn-primary">Explore Now</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <img src="images/fet-ing.jpeg" alt="" class="img-fluid">
                    <h5 class="card-title">Digital Archives</h5>
                    <p class="card-text">Explore historical documents and archives digitally.</p>
                    <a href="/list-book" class="btn btn-primary">Explore Now</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <img src="images/fet-java.png" alt="" class="img-fluid">
                    <h5 class="card-title">Virtual Learning</h5>
                    <p class="card-text">Engage in virtual learning experiences with interactive tools.</p>
                    <a href="/list-book" class="btn btn-primary">Explore Now</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <img src="images/mpsi.jpg" alt="" class="img-fluid">
                    <h5 class="card-title">E-Library Access</h5>
                    <p class="card-text">Access thousands of e-books and academic resources.</p>
                    <a href="/list-book" class="btn btn-primary">Explore Now</a>
                </div>
            </div>            <div class="card">
                <div class="card-body">
                    <img src="images/jerman.jpeg" alt="" class="img-fluid">
                    <h5 class="card-title">E-Library Access</h5>
                    <p class="card-text">Access thousands of e-books and academic resources.</p>
                    <a href="/list-book" class="btn btn-primary">Explore Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Information Section -->
<div class="information-section">
    <div class="container text-center">
        <h2>Information Section</h2>
        <p>Start enjoying your time with exploreing the word</p>
        <div class="row">
            <div class="col-md-6 information-image">
                <img src="images/b-information1.jpg" class="img-fluid" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Hari Pendidikan Nasional</h5>
                    <p class="card-text">Hari Pendidikan Nasional atau Hardiknas merupakan hari Nasional yang bukan hari libur dan diperingati setiap tanggal 2 Mei. Penetapan tanggal tersebut sesuai dengan hari kelahiran Bapak Pendidikan Nasional, Ki Hajar Dewantara. Peringatan Hardiknas diselenggarakan sebagai bentuk apresiasi terhadap pahlawan Pendidikan serta refleksi bagi semua orang tentang esensi pentingnya pendidikan bagi bangsa dan negara Indonesia.</p>
                    <a href="https://id.wikipedia.org/wiki/Hari_Pendidikan_Nasional" class="btn btn-primary" target="_blank">Read More</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Hari Kemerdekaan Republik Indonesia</h5>
                    <p class="card-text">Hari Kemerdekaan Bangsa Indonesia adalah hari libur nasional di Indonesia untuk memperingati proklamasi kemerdekaan Bangsa Indonesia pada tanggal 17 Agustus 1945. Yang merupakan deklarasi independensi bangsa Indonesia. Setiap tanggal 17 Agustus, warga Indonesia merayakan dan mensyukuri peringatan kemerdekaan bangsa Indonesia dengan melakukan upacara bendera serta biasanya diselenggarakan berbagai macam perlombaan, yang populer adalah tarik tambang.</p>
                    <a href="https://id.wikipedia.org/wiki/Hari_Kemerdekaan_Republik_Indonesia" class="btn btn-primary" target="_blank">Read More</a>
                </div>
            </div>
            <div class="col-md-6 information-image">
                <img src="images/b-information2.jpg" class="img-fluid" alt="...">
            </div>
        </div>
    </div>
</div>

<!-- Member Modal -->
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

@endsection

@push('scripts')
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
