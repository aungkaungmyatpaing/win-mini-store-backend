<ul class="navbar-nav justify-content-center" id="navbar-nav">
    <li class="nav-item">
        <a class="nav-link menu-link {{request()->is('dashboard') || request()->is('dashboard/*') ? 'active' : ''}}" href="{{route('dashboard')}}" role="button" >
            <i class="ri-dashboard-fill"></i> <span data-key="t-authentication">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link {{request()->is('cashiers') || request()->is('cashiers/*') ? 'active' : ''}}" href="{{route('cashier')}}" role="button" >
            <i class="ri-currency-fill"></i> <span data-key="t-authentication">Cashier</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link {{request()->is('categories') || request()->is('categories/*') ? 'active' : ''}}" href="{{route('category')}}" role="button" >
            <i class="ri-scan-line"></i><span data-key="t-authentication">Categories</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link {{request()->is('products') || request()->is('products/*') ? 'active' : ''}}" href="{{route('product')}}" role="button" >
            <i class="ri-t-shirt-fill"></i> <span data-key="t-authentication">Products</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link menu-link {{request()->is('invoices') || request()->is('invoices/*') ? 'active' : ''}}" href="{{route('invoice')}}" role="button" >
            <i class="ri-newspaper-fill"></i> <span data-key="t-authentication">Invoice</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link menu-link @yield('history')" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class=" bx bx-history"></i> <span data-key="t-layouts">History</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarLayouts">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link menu-link"  href="" role="button" >
                        <span data-key="t-authentication"> Delivery History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="" role="button" >
                        <span data-key="t-authentication"> Returned History</span>
                    </a>
                </li>
            </ul>
        </div>
    </li> --}}
</ul>
