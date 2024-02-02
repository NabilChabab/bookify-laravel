<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bookify</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/styles.css') }}">


    <style>
        .card-img-top {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .user-image {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-dark text-light">
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">{{ 'Login' }}</a>
                    @endif
                @else
                    <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="" srcset=""
                        class="rounded-circle me-3" style="width: 40px;height:40px">
                    <a href="#page-top">{{ Auth::user()->name }}</a>
                @endguest
            </li>
            <li class="sidebar-nav-item"><a href="#page-top">Home</a></li>
            <li class="sidebar-nav-item"><a href="#about">About</a></li>
            <li class="sidebar-nav-item"><a href="#services">Services</a></li>
            <li class="sidebar-nav-item"><a href="#portfolio">Portfolio</a></li>
            <li class="sidebar-nav-item"><a href="#contact">Contact</a></li>
            @guest
                @if (Route::has('login'))
                    <li class="sidebar-nav-item"></li>
                @endif
            @else
                <li class="sidebar-nav-item"><a href="{{ route('logout') }}">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </ul>
    </nav>
    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
            <h1 class="mb-1" style="font-weight: bold">Welcome To Bookify</h1>
            <h3 class="mb-5" style="font-weight: bold"><em>A Wonderfull Store to Book Any Book</em></h3>
            <a class="btn btn-warning btn-xl" href="#about" style="padding: 20px 30px;">Find Out More</a>
        </div>
    </header>
    <!-- About-->
    <section class="content-section bg-dark text-light"  id="about">
        <div class="container px-4 px-lg-5 text-center">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-10">
                    <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
                    <p class="lead mb-5">
                        This theme features a flexible, UX friendly sidebar menu and stock photos from our friends at
                        <a href="https://unsplash.com/">Unsplash</a>
                        !
                    </p>
                    <a class="btn btn-light btn-xl text-dark" href="#services">What We Offer</a>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Book Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="bookDetails">
                        <img id="bookCover" src="" alt="" srcset="" class="card-img-top">
                        <h5 id="bookTitle" style="font-weight: bold"></h5>
                        <p id="bookDescription"></p>
                    </div>
                    <form id="reservationForm" action="{{ route('home.store') }}" method="post">
                        @csrf
                        <input type="hidden" id="bookId" name="bookId" value="">
                        <div class="mb-3">
                            <label for="returnDate" class="form-label">Return Date (Max:
                                {{ date('Y-m-d', strtotime('+15 days')) }})
                            </label>
                            <input type="date" class="form-control" id="returnDate" name="returnDate" required
                                max="{{ date('Y-m-d', strtotime('+15 days')) }}">
                            @error('returnDate')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary" name="reserve">Submit Reservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reservationsModal" tabindex="-1" aria-labelledby="reservationsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationsModalLabel">Your Reservations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    @if (!empty($userReservations))
                        @foreach ($userReservations as $userReservation)
                            <div class="reservation-item mb-3 p-3 d-flex justify-content-between">
                               <div>
                                <h6 class="mb-2"><strong>Book Title: {{ $userReservation->book->title }} </strong>
                                </h6>
                                <p class="mb-0"><strong>Return Date:
                                        {{ $userReservation->return_date }}</strong> </p>
                               </div>
                               <img src="{{asset('storage/'.$userReservation->book->cover)}}" alt="" style="width: 50px ; height:50px">
                            </div>
                        @endforeach
                        @else
                        <p>No reservations found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

 
    <div class="container px-4 px-lg-5 mb-4 bg-dark">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by Title" name="search"
                            id="searchInput" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="content-section bg-dark text-white text-center" id="services">
        <button class="btn btn-light rounded-circle" id="viewReservationsBtn"
            style="position: fixed; top: 10px; left: 10px;">
            <i class="fas fa-book"></i>
        </button>
        <div class="container-fluid d-flex justify-content-center align-items-center" style="">

            <div class="row col-12" style="gap:2rem;">
                @foreach ($books as $book)
                    <div class="card" style="width: 21.2rem;border-radius:20px;">
                        <img class="card-img-top" src="{{ asset('storage/' . $book->cover) }}" alt="Card image cap" style="border-radius:20px;margin-top:10px">
                        <div class="card-body ">
                            <h5 class="card-title text-black" style="font-weight: bold">
                                {{ $book->title }}
                            </h5>
                            <p class="card-text text-dark">
                                {{ $book->description }}
                            </p>
                            @guest
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="btn btn-dark reserve-btn">
                                        Book Now
                                    </a>
                                @endif
                            @else
                                <button type="button" class="btn btn-dark reserve-btn" data-bs-toggle="modal"
                                    data-bs-target="#reservationModal" data-book-id="{{ $book->id }}"
                                    data-book-cover="{{ asset('storage/' . $book->cover) }}">
                                    Book Now
                                </button>
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Callout-->
    <section class="callout">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mx-auto mb-5">
                Welcome to
                <em>your</em>
                next website!
            </h2>
            <a class="btn btn-primary btn-xl" href="https://startbootstrap.com/theme/stylish-portfolio/">Download
                Now!</a>
        </div>
    </section>
    <!-- Portfolio-->
    <section class="content-section" id="portfolio">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Portfolio</h3>
                <h2 class="mb-5">Recent Projects</h2>
            </div>
            <div class="row gx-0">
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Stationary</div>
                                <p class="mb-0">A yellow pencil with envelopes on a clean, blue backdrop!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('user/assets/img/portfolio-1.jpg') }}"
                            alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Ice Cream</div>
                                <p class="mb-0">A dark blue background with a colored pencil, a clip, and a tiny ice
                                    cream cone!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('user/assets/img/portfolio-2.jpg') }}"
                            alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Strawberries</div>
                                <p class="mb-0">Strawberries are such a tasty snack, especially with a little sugar
                                    on
                                    top!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('user/assets/img/portfolio-3.jpg') }}"
                            alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Workspace</div>
                                <p class="mb-0">A yellow workspace with some scissors, pencils, and other objects.
                                </p>
                            </div>
                        </div>
                        <img class="img-fluid" src="{{ asset('user/assets/img/portfolio-4.jpg') }}"
                            alt="..." />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action-->
    <section class="content-section bg-dark text-white">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">The buttons below are impossible to resist...</h2>
            <a class="btn btn-xl btn-light me-4" href="#!">Click Me!</a>
            <a class="btn btn-xl btn-dark" href="#!">Look at Me!</a>
        </div>
    </section>
    <!-- Map-->
    <div class="map" id="contact">
        <iframe
            src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small><a
                href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a></small>
    </div>
    <!-- Footer-->
    <footer class="footer text-center text-white">
        <div class="container px-4 px-lg-5 text-white">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i
                            class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i
                            class="icon-social-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" href="#!"><i
                            class="icon-social-github"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0 text-light">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
    <script>
        setTimeout(function() {
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonClass: 'btn btn-success', // Custom class for the "OK" button
                confirmButtonText: 'Cancel',
                confirmButtonColor: 'rgb(102, 102, 245)',
                 // Custom text for the "OK" button
            });
        }, {{ session('delay', 0) }});
    </script>
    @endif



    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('user/js/scripts.js') }}"></script>
    <script src="{{ asset('user/js/filter.js') }}"></script>


</body>

</html>
