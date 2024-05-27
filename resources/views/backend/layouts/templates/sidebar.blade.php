<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
       <a href="{{ route('dashboard') }}">
       <img src="{{ asset('backend/assets/images/mia-indo.jpg') }}" class="img-fluid" alt="">
       <span class="text-uppercase">MIA</span>
       </a>
       <div class="iq-menu-bt-sidebar">
          <div class="iq-menu-bt align-self-center">
             <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
             </div>
          </div>
       </div>
    </div>
    <div id="sidebar-scrollbar">
       <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{ __('lang.dashboard')}}</span></li>
             <li class="@yield('dashboard')">
                <a href="{{ route('dashboard') }}" class="iq-waves-effect"><i class="ri-dashboard-line"></i><span>{{ __('lang.dashboard')}}</span></a>
             </li>
             <li class="@yield('currency')">
               <a href="{{ route('currency.index')}}" class="iq-waves-effect"><i class="ri-palette-line"></i><span>{{ __('lang.currency')}}</span></a>
            </li>
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{ __('lang.manage_products')}}</span></li>
             <li class="@yield('category')">
                <a href="{{ route('categories.index') }}" class="iq-waves-effect"><i class="ri-scan-line"></i><span>{{ __('lang.categories')}}</span></a>
             </li>
             <li class="@yield('brand')">
                <a href="{{ route('brands.index') }}" class="iq-waves-effect"><i class="ri-star-s-line"></i><span>{{ __('lang.brands')}}</span></a>
             </li>
             <li class="@yield('color')">
                <a href="{{ route('colors.index') }}" class="iq-waves-effect"><i class="ri-palette-line"></i><span>{{ __('lang.product_colors')}}</span></a>
             </li>
             <li class="@yield('size')">
                <a href="{{ route('sizes.index') }}" class="iq-waves-effect"><i class="ri-ruler-line"></i><span>{{ __('lang.product_sizes')}}</span></a>
             </li>
             <li class="@yield('product')">
                <a href="{{ route('products.index') }}" class="iq-waves-effect"><i class="ri-product-hunt-line"></i><span>{{ __('lang.products')}}</span></a>
             </li>
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{ __('lang.manage_accounts')}}</span></li>
             <li class="@yield('customer')">
                <a href="{{ route('customer.index') }}" class="iq-waves-effect"><i class="ri-copper-diamond-line"></i><span>{{ __('lang.users')}}</span></a>
             </li>
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{ __('lang.manage_points')}}</span></li>
             <li class="@yield('point')">
                <a href="{{ route('points.index') }}" class="iq-waves-effect"><i class="ri-copper-diamond-line"></i><span>{{ __('lang.points')}}</span></a>
             </li>
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{ __('lang.manage_payments')}}</span></li>
             <li class="@yield('payment')">
                <a href="{{ route('payments.index') }}" class="iq-waves-effect"><i class="ri-bank-card-line"></i><span>{{ __('lang.payments')}}</span></a>
             </li>
             <li class="@yield('payment-account')">
                <a href="{{ route('payment-accounts.index') }}" class="iq-waves-effect"><i class="ri-bank-card-line"></i><span>{{ __('lang.payment_accounts')}}</span></a>
             </li>
             <li class="@yield('region')">
                <a href="{{ route('regions.index') }}" class="iq-waves-effect"><i class="ri-truck-line"></i><span>{{ __('lang.regions')}}</span></a>
             </li>
             <li class="@yield('township')">
                <a href="{{ route('township.index') }}" class="iq-waves-effect"><i class="ri-truck-line"></i><span>{{ __('lang.townships')}}</span></a>
             </li>
             {{-- <li class="@yield('deli')">
                <a href="{{ route('deli-fees.index') }}" class="iq-waves-effect"><i class="ri-truck-line"></i><span>{{ __('lang.delivery_fees')}}</span></a>
             </li> --}}
             <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{ __('lang.manage_orders')}}</span></li>
             {{-- <li class="@yield('refund-order')">
                <a href="{{ route('order.refund.list') }}" class="iq-waves-effect"><i class="ri-refund-line"></i><span>{{ __('lang.refund_orders')}}</span></a>
             </li> --}}
             <li class="@yield('order')">
                <a href="#order" class="iq-waves-effect collapsed"  data-toggle="collapse" aria-expanded="@yield('order-aria')"><i class="ri-file-list-line"></i><span>{{ __('lang.orders')}}</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="order" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li class="@yield('pending-order')"><a href="{{ route('pending-order.index') }}"><i class="ri-subtract-line"></i>{{ __('lang.pending_orders')}}</a></li>
                  <li class="@yield('confirm-order')"><a href="{{ route('confirm-order.index') }}"><i class="ri-subtract-line"></i>{{ __('lang.confirmed_orders')}}</a></li>
                  <li class="@yield('deliver-order')"><a href="{{ route('deliver-order.index') }}"><i class="ri-subtract-line"></i>{{ __('lang.delivered_orders')}}</a></li>
                  <li class="@yield('complete-order')"><a href="{{ route('complete-order.index') }}"><i class="ri-subtract-line"></i>{{ __('lang.completed_orders')}}</a></li>
                  <li class="@yield('cancel-order')"><a href="{{ route('cancel-order.index') }}"><i class="ri-subtract-line"></i>{{ __('lang.cancel_orders')}}</a></li>

                    {{-- <li class="@yield('process-order')"><a href="{{ route('orderByStatus','processing') }}"><i class="ri-subtract-line"></i>Processing Orders</a></li>
                   <li class="@yield('deliver-order')"><a href="{{ route('orderByStatus','delivered') }}"><i class="ri-subtract-line"></i>{{ __('lang.delivered_orders')}}</a></li>
                   <li class="@yield('complete-order')"><a href="{{ route('orderByStatus','complete') }}"><i class="ri-subtract-line"></i>{{ __('lang.completed_orders')}}</a></li>
                   <li class="@yield('cancel-order')"><a href="{{ route('orderByStatus','cancel') }}"><i class="ri-subtract-line"></i>{{ __('lang.cancel_orders')}}</a></li>
                   <li class="@yield('order-history')"><a href="{{ route('order') }}"><i class="ri-subtract-line"></i>{{ __('lang.order_histories')}}</a></li> --}}
                </ul>
             </li>

          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
 </div>
