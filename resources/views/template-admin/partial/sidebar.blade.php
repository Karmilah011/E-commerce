<div class="logo d-flex justify-content-between">
    <a href="{{ route('dashboard-admin') }}"><img src="{{ asset('images/mala.png') }}" alt></a>
    <div class="sidebar_close_icon d-lg-none">
        <i class="ti-close"></i>
    </div>
</div>

<ul id="sidebar_menu">
    <li class="mm-active">
        <a href="{{ route('dashboard-admin') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('template-admin/img/menu-icon/dashboard.svg') }}" alt>
            </div>
            <span>Dashboard</span>
        </a>
    </li>
    <li class>
        <a href="{{ route('user.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('template-admin/img/menu-icon/8.svg') }}" alt>
            </div>
            <span>Data User</span>
        </a>
    </li>
    <li class>
        <a href="{{ route('products.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('template-admin/img/menu-icon/8.svg') }}" alt>
            </div>
            <span>Products</span>
        </a>
    </li>
    <li class>
        <a href="{{ route('brand.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('template-admin/img/menu-icon/8.svg') }}" alt>
            </div>
            <span>Brand</span>
        </a>
    </li>
    <li class>
        <a href="{{ route('category.index') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('template-admin/img/menu-icon/8.svg') }}" alt>
            </div>
            <span>Category</span>
        </a>
    </li>
    <li class>
        <a class="has-arrow" href="#" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{ asset('template-admin/img/menu-icon/4.svg') }}" alt="">
            </div>
            <span>Data Transaction</span>
        </a>
        <ul class="mm-collapse">
            <li><a href="{{ route('admin.waitingToPayment') }}">Waiting</a></li>
            <li><a href="{{ route('admin.packed') }}">Packed</a></li>
            <li><a href="{{ route('admin.inDelivery') }}">Delivery</a></li>
            <li><a href="{{ route('admin.finish') }}">Finish</a></li>
        </ul>
    </li>
    <li class>
        <a href="{{ route('admin.laporan') }}" aria-expanded="false">
            <div class="icon_menu">
                <img src="{{asset('template-admin/img/menu-icon/6.svg') }}" alt="">
            </div>
            <span>Invoice</span>
        </a>
    </li>
</ul>
