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
<!-- lottie JavaScript -->
<script src="{{ asset('backend/assets/js/lottie.js') }}"></script>
<!-- am core JavaScript -->
<script src="{{ asset('backend/assets/js/core.js') }}"></script>
<!-- am charts JavaScript -->
<script src="{{ asset('backend/assets/js/charts.js') }}"></script>
<!-- am animated JavaScript -->
<script src="{{ asset('backend/assets/js/animated.js') }}"></script>
<!-- am kelly JavaScript -->
<script src="{{ asset('backend/assets/js/kelly.js') }}"></script>
<!-- am maps JavaScript -->
<script src="{{ asset('backend/assets/js/maps.js') }}"></script>
<!-- am worldLow JavaScript -->
<script src="{{ asset('backend/assets/js/worldLow.js') }}"></script>
<!-- Flatpicker Js -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('backend/assets/js/chart-custom.js') }}"></script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- image upload-->
<script src="{{ asset('backend/assets/uploader/dist/image-uploader.min.js') }}"></script>
<script src="{{ asset('backend/assets/uploader/src/image-uploader.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>

@stack('script')

<script>
    $(document).ready(function() {
        let token = document.head.querySelector('meta[name="csrf-token"]')

        if(token) {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : token.content
                }
            })
        };
    })

    window.popupWindow = (url, w, h) => {
        const y = window.top.outerHeight / 2 + window.top.screenY - h / 2
        const x = window.top.outerWidth / 2 + window.top.screenX - w / 2
        return window.open(
            url,
            'pink-lady',
            `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`,
        )
    }

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
            icon: 'fail',
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
