<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Mia Indo Ecom - Dashboard</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('backend/assets/images/mia-indo.jpg') }}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('backend/assets/css/typography.css') }}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('backend/assets/css/responsive.css') }}">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 text-center d-flex justify-content-center align-items-center">
                        {{-- <div class=" "> --}}
                            {{-- <a class=" mb-5" href="#"><img src="{{ asset('backend/assets/images/logo-white.png') }}" class="img-fluid" alt="logo"></a> --}}
                            {{-- <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0"> --}}
                                <div class="" style="width: 70%;">
                                    <img src="{{ asset('backend/assets/images/mia-indo.jpg') }}" style="border-radius: 10px;" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 ">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                {{-- <div class="item">
                                    <img src="{{ asset('backend/assets/images/login/1.png') }}" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('backend/assets/images/login/1.png') }}" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from mt-3 mb-5">
                            <h1 class="mb-0">Sign in</h1>
                            <p>Enter your email address and password to access admin panel.</p>
                            <form class="mt-4" action="{{ route('userLogin') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(Session::get('fail'))
                                    <div class="alert">
                                        {{Session::get('fail')}}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <a href="#" class="float-right">Forgot password?</a>
                                    <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" name="remember" value="1" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Sign in</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Sign in END -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
        <!-- Appear JavaScript -->
        <script src="{{ asset('backend/assets/js/jquery.appear.js') }}"></script>
        <!-- Countdown JavaScript -->
        <script src="{{ asset('backend/assets/js/countdown.min.js') }}"></script>
        <!-- Counterup JavaScript -->
        <script src="{{ asset('backend/assets/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/jquery.counterup.min.js') }}"></script>
        <!-- Wow JavaScript -->
        <script src="{{ asset('backend/assets/js/wow.min.js') }}"></script>
        <!-- Apexcharts JavaScript -->
        <script src="{{ asset('backend/assets/js/apexcharts.js') }}"></script>
        <!-- Slick JavaScript -->
        <script src="{{ asset('backend/assets/js/slick.min.js') }}"></script>
        <!-- Select2 JavaScript -->
        <script src="{{ asset('backend/assets/js/select2.min.js') }}"></script>
        <!-- Owl Carousel JavaScript -->
        <script src="{{ asset('backend/assets/js/owl.carousel.min.js') }}"></script>
        <!-- Magnific Popup JavaScript -->
        <script src="{{ asset('backend/assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Smooth Scrollbar JavaScript -->
        <script src="{{ asset('backend/assets/js/smooth-scrollbar.js') }}"></script>
        <!-- Sweet alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Custom JavaScript -->
        <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                width : '20em',
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
        @if (session('success'))
            <script>
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
                `{{Session::forget('success')}}`
            </script>
        @endif

        @if (session('fail'))
            <script>
                Toast.fire({
                    icon: 'error',
                    title: '{{session('fail')}}'
                });
                `{{Session::forget('fail')}}`
            </script>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    Toast.fire({
                        icon: "error",
                        title: "{{ $error }}",
                    });
                </script>
            @endforeach
        @endif
   </body>
</html>
