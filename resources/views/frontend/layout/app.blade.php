<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesomee-->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- Navbar -->
@include('frontend.partials.navbar')

@yield('hero')

<!-- Content -->
<div class="content">

    <div class="hero-section">
        <div class="container d-flex align-items-center">
            <div class="hero-content">
                @foreach ($heroes as $hero)
                    <h1>{{ $hero->title }}</h1>
                    <p>{{ $hero->deskripsi }}</p>
                    <button class="btn btn-primary">{{ $hero->button }}</button>
                @endforeach
            </div>
            <img src="{{ asset('storage/' . $hero->image) }}" alt="Hero Image">
        </div>
    </div>

    <div class="hero-feature">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <i class="fa-regular fa-id-card fa-beat fa-6x card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Feature 03</h5>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <i class="fa-solid fa-gears fa-beat fa-6x card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Feature 02</h5>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <i class="fa-solid fa-clock-rotate-left fa-beat fa-6x card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Feature 03</h5>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <i class="fa-solid fa-book fa-beat fa-6x card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Feature 01</h5>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <i class="fa-solid fa-book-bookmark fa-beat fa-6x card-icon mt-5 mb-4" style="color: #f9a825;"></i>
                    <div class="card-body">
                        <h5 class="card-title mb-3">Feature 02</h5>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <<!-- Feature Section -->
    <div class="feature-section">
        <div class="container text-center">
            <h2>Explore Digital Resources</h2>
            <p>Discover powerful tools and services tailored for your digital library needs.</p>
            <div class="scrolling-wrapper">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">E-Library Access</h5>
                        <p class="card-text">Access thousands of e-books and academic resources.</p>
                        <a href="#" class="btn btn-primary">Explore Now</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Digital Archives</h5>
                        <p class="card-text">Explore historical documents and archives digitally.</p>
                        <a href="#" class="btn btn-primary">Explore Now</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Virtual Learning</h5>
                        <p class="card-text">Engage in virtual learning experiences with interactive tools.</p>
                        <a href="#" class="btn btn-primary">Explore Now</a>
                    </div>
                </div>
                <!-- Add more cards related to digital library features -->
            </div>
        </div>
    </div>

    <!-- Information Section -->
    <div class="information-section">
        <div class="container text-center">
            <h2>Launch fast your great products.</h2>
            <p>Start enjoying your time with Flexure Wordframe Web UI Kit 3.</p>
            <div class="row">
                <div class="col-md-6">
                        <img src="images/b-information1.jpg" class="card-img-top" alt="...">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">Launch fast your great products.</h5>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 card-inf">
                    <div class="card-body">
                        <h5 class="card-title">Launch fast your great products.</h5>
                        <p class="card-text">Start enjoying your time with Flexure Wordframe Web UI Kit 3.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="images/b-information2.jpg" class="card-img-top" alt="...">
                </div>
            </div>

            </div>
        </div>
    </div>
    



</div>

<!-- Footer Section -->
@include('frontend.partials.footer')

</body>
</html>
