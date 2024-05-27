<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{csrf_token()}}">
      <title>Mia Indo Ecom | Dashboard</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('backend/assets/images/mia-indo.jpg') }}" />
      @include('backend.layouts.assets.styles')
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         @include('backend.layouts.templates.sidebar')
         <!-- TOP Nav Bar -->
         @include('backend.layouts.templates.navbar')
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  @yield('content')
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      @include('backend.layouts.templates.footer')
      <!-- Footer END -->

      <!-- Scripts -->

      @include('backend.layouts.assets.scripts')
   </body>
</html>
