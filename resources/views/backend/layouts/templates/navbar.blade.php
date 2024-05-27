<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
       <div class="iq-sidebar-logo">
          <div class="top-logo">
             <a href="{{ route('dashboard') }}" class="logo">
             <img src="{{ asset('backend/assets/images/logo.gif') }}" class="img-fluid" alt="">
             <span>Vito</span>
             </a>
          </div>
       </div>
       <nav class="navbar navbar-expand-lg navbar-light p-0">
          <div class="navbar-left">
             <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
                <li><a href="{{ route('dashboard') }}" class="nav-link"><i class="ri-dashboard-line"></i></a></li>
                <li><a href="{{ route('categories.index') }}" class="nav-link"><i class="ri-scan-line"></i></a></li>
                <li><a href="{{ route('brands.index') }}" class="nav-link"><i class="ri-star-s-line"></i></a></li>
                <li><a href="{{ route('colors.index') }}" class="nav-link"><i class="ri-palette-line"></i></a></li>
                <li><a href="{{ route('sizes.index') }}" class="nav-link"><i class="ri-ruler-line"></i></a></li>
                <li><a href="{{ route('products.index') }}" class="nav-link"><i class="ri-product-hunt-line"></i></a></li>
                <li><a href="{{ route('points.index') }}" class="nav-link"><i class="ri-copper-diamond-line"></i></a></li>
             </ul>
             <div class="iq-search-bar">
                <form action="@yield('search-route')" class="searchbox">
                    <input type="text" name="keyword" id="search" class="text search-input" placeholder="Type here to search..." onkeyup="checkValue()" value="{{request()->keyword}}" autocomplete="off">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                 </form>
             </div>

          </div>

          </button>
          <div class="iq-menu-bt align-self-center">
             <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
             </div>
          </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ml-auto navbar-list">
                {{-- <li class="nav-item">
                   <a class="search-toggle iq-waves-effect language-title" href="#"><img src="{{ asset('backend/assets/images/small/flag-01.png') }}" alt="img-flaf" class="img-fluid mr-1" style="height: 16px; width: 16px;" /> English <i class="ri-arrow-down-s-line"></i></a>
                   <div class="iq-sub-dropdown">
                      <a class="iq-sub-card" href="#"><img src="{{ asset('backend/assets/images/small/flag-02.png') }}" alt="img-flaf" class="img-fluid mr-2" />French</a>
                      <a class="iq-sub-card" href="#"><img src="{{ asset('backend/assets/images/small/flag-03.png') }}" alt="img-flaf" class="img-fluid mr-2" />Spanish</a>
                      <a class="iq-sub-card" href="#"><img src="{{ asset('backend/assets/images/small/flag-04.png') }}" alt="img-flaf" class="img-fluid mr-2" />Italian</a>
                      <a class="iq-sub-card" href="#"><img src="{{ asset('backend/assets/images/small/flag-05.png') }}" alt="img-flaf" class="img-fluid mr-2" />German</a>
                      <a class="iq-sub-card" href="#"><img src="{{ asset('backend/assets/images/small/flag-06.png') }}" alt="img-flaf" class="img-fluid mr-2" />Japanese</a>
                   </div>
                </li>
                <li class="nav-item">
                   <a href="#" class="search-toggle iq-waves-effect">
                      <div id="lottie-beil"></div>
                      <span class="bg-danger dots"></span>
                   </a>
                   <div class="iq-sub-dropdown">
                      <div class="iq-card shadow-none m-0">
                         <div class="iq-card-body p-0 ">
                            <div class="bg-primary p-3">
                               <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                            </div>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/01.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Emma Watson Nik</h6>
                                     <small class="float-right font-size-12">Just Now</small>
                                     <p class="mb-0">95 MB</p>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/02.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">New customer is join</h6>
                                     <small class="float-right font-size-12">5 days ago</small>
                                     <p class="mb-0">Jond Nik</p>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/03.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Two customer is left</h6>
                                     <small class="float-right font-size-12">2 days ago</small>
                                     <p class="mb-0">Jond Nik</p>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/04.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">New Mail from Fenny</h6>
                                     <small class="float-right font-size-12">3 days ago</small>
                                     <p class="mb-0">Jond Nik</p>
                                  </div>
                               </div>
                            </a>
                         </div>
                      </div>
                   </div>
                </li>
                <li class="nav-item dropdown">
                   <a href="#" class="search-toggle iq-waves-effect">
                      <div id="lottie-mail"></div>
                      <span class="bg-primary count-mail"></span>
                   </a>
                   <div class="iq-sub-dropdown">
                      <div class="iq-card shadow-none m-0">
                         <div class="iq-card-body p-0 ">
                            <div class="bg-primary p-3">
                               <h5 class="mb-0 text-white">All Messages<small class="badge  badge-light float-right pt-1">5</small></h5>
                            </div>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/01.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Nik Emma Watson</h6>
                                     <small class="float-left font-size-12">13 Jun</small>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/02.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                     <small class="float-left font-size-12">20 Apr</small>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/03.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Why do we use it?</h6>
                                     <small class="float-left font-size-12">30 Jun</small>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/04.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Variations Passages</h6>
                                     <small class="float-left font-size-12">12 Sep</small>
                                  </div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card" >
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="avatar-40 rounded" src="{{ asset('backend/assets/images/user/05.jpg') }}" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                     <small class="float-left font-size-12">5 Dec</small>
                                  </div>
                               </div>
                            </a>
                         </div>
                      </div>
                   </div>
                </li> --}}
             </ul>
          </div>
          <div class="mx-4">
            @if (session()->has('locale'))
               @if (session('locale') === 'my')
                  <a href="{{ route('lang','en') }}" class="mx-1 text-dark">EN</a><a href="{{ route('lang','my') }}" style="text-decoration: underline;" class="mx-1">MM</a>
               @else
                  <a href="{{ route('lang','en') }}" style="text-decoration: underline;" class="mx-1">EN</a><a href="{{ route('lang','my') }}" class="mx-1 text-dark">MM</a>
               @endif
            @else
               <a href="{{ route('lang','en') }}" class="mx-1 text-dark">EN</a><a href="{{ route('lang','my') }}" class="mx-1 text-dark">MM</a>
            @endif
          </div>

          <ul class="navbar-list">
             <li>
                <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                   {{-- <img src="{{ asset('backend/assets/images/user/1.jpg') }}" class="img-fluid rounded mr-3" alt="user"> --}}
                   <div class="caption">
                      <h6 class="mb-0 line-height text-white">{{ Auth::user()->name }}</h6>
                      <span class="font-size-12 text-white">Available</span>
                   </div>
                </a>
                <div class="iq-sub-dropdown iq-user-dropdown">
                   <div class="iq-card shadow-none m-0">
                      <div class="iq-card-body p-0 ">
                         <div class="bg-primary p-3">
                            <h5 class="mb-0 text-white line-height">Hello {{ Auth::user()->name }}</h5>
                            <span class="text-white font-size-12">Available</span>
                         </div>
                         {{-- <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-file-user-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">My Profile</h6>
                                  <p class="mb-0 font-size-12">View personal profile details.</p>
                               </div>
                            </div>
                         </a>
                         <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-profile-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">Edit Profile</h6>
                                  <p class="mb-0 font-size-12">Modify your personal details.</p>
                               </div>
                            </div>
                         </a> --}}
                         <a href="{{ route('admin.edit') }}" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-account-box-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">Account settings</h6>
                                  <p class="mb-0 font-size-12">Manage your account parameters.</p>
                               </div>
                            </div>
                         </a>
                         {{-- <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-lock-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">Privacy Settings</h6>
                                  <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                               </div>
                            </div>
                         </a> --}}
                         <div class="d-inline-block w-100 text-center p-3">
                            <a class="bg-primary iq-sign-btn" href="{{route('admin.logout')}}" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                         </div>
                      </div>
                   </div>
                </div>
             </li>
          </ul>
       </nav>
    </div>
 </div>
