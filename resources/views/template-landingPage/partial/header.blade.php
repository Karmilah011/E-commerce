<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7">
                <div class="header__top__left">
                    {{-- <p>Free shipping, 30-day return or refund guarantee.</p> --}}
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="header__top__right">
                    <div class="header__top__links">
                        @if (!isset(Auth::user()->id))
                        <a href="{{route('login')}}">Sign in</a>
                        @else
                        <a href="#">{{Auth::user()->name}}</a>
                        <a href="{{route('logout')}}">Logout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="header__logo" style="margin-top: -30px;">
                <a href="{{route('home')}}"><img src="{{asset('images/mala2.png')}}" alt=""></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <nav class="header__menu mobile-menu">
                <ul>
                    <li class=" @if(Request::url() == route('home')) active @endif"><a href="{{route('home')}}">Home</a></li>
                    <li class=" @if(Request::url() == route('shop')) active @endif"><a href="{{route('shop')}}">Shop</a></li>
                    <li><a href="#">Order</a>
                        <ul class="dropdown">
                            <li><a href="{{route('waitingToPayment')}}">Waiting To Payment</a></li>
                            <li><a href="{{route('packed')}}">Packed</a></li>
                            <li><a href="{{route('inDelivery')}}">In Delivery</a></li>
                            <li><a href="{{route('finish')}}">Finish</a></li>
                        </ul>
                    </li>
                    <li class=" @if(Request::url() == route('contact')) active @endif"><a href="{{route('contact')}}">Contacts</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="header__nav__option">
                <div class="cart-items">
                    @guest
                        <a href="{{ route('login') }}" class="main-btn">
                            <img src="{{ asset('template-landing/img/icon/cart.png') }}" alt="">
                            <span class="total-items">0</span>
                        </a>
                    @endguest
                    @auth
                        <?php
                         $userId = Auth::id();
        
                        // Menghitung jumlah produk yang unik dalam keranjang
                        $uniqueProductCount = \App\Models\Cart::where('user_id', $userId)->distinct()->count('product_id');

                        // Format notifikasi jika lebih dari 100
                        $displayNotif = $uniqueProductCount > 99 ? '99+' : $uniqueProductCount;
                        ?>
        
                        <a href="{{ $displayNotif > 0 ? route('cart') : route('cart') }}" class="main-btn">
                            <img src="{{ asset('template-landing/img/icon/cart.png') }}" alt="">
                            <span class="total-items">{{ $displayNotif }}</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
            </div>
            </div>
        </div>
    </div>
    <div class="canvas__open"><i class="fa fa-bars"></i></div>
</div>