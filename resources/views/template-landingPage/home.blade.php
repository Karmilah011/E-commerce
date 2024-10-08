@extends('template-landingPage.master')
@section('title','Home')
@section('content')
        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg" data-setbg="{{asset('template-landing/img/hero/hero-1.jpg')}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                                <div class="hero__text">
                                    <h6>Summer Collection</h6>
                                    <h2>Fall - Summer Collections 2030</h2>
                                    <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                    <a href="{{route('shop')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                    <div class="hero__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="{{asset('template-landing/img/hero/hero-2.jpg')}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                                <div class="hero__text">
                                    <h6>Winter Collection</h6>
                                    <h2>Fall - Winter Collections 2030</h2>
                                    <p>Experience our Winter Collections: luxury essentials designed for warmth and style. Crafted ethically with exceptional quality, each piece embodies the cozy elegance of the season</p>
                                    <a href="{{route('shop')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                    <div class="hero__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    
        <!-- Banner Section Begin -->
        <section class="banner spad">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-lg-7 offset-lg-4">
                        <div class="banner__item">
                            <div class="banner__item__pic">
                                <img src="{{asset('template-landing/img/banner/banner-1.jpg')}}" alt="">
                            </div>
                            <div class="banner__item__text">
                                <h2>Clothing Collections 2030</h2>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="banner__item banner__item--middle">
                            <div class="banner__item__pic">
                                <img src="{{asset('template-landing/img/banner/banner-2.jpg')}}" alt="">
                            </div>
                            <div class="banner__item__text">
                                <h2>Accessories</h2>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="banner__item banner__item--last">
                            <div class="banner__item__pic">
                                <img src="{{asset('template-landing/img/banner/banner-3.jpg')}}" alt="">
                            </div>
                            <div class="banner__item__text">
                                <h2>Shoes Spring 2030</h2>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <!-- Banner Section End -->
    
        <!-- Product Section Begin -->
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="filter__controls">
                             <li class="active" data-filter="*">Products</li> 
                            <!-- <li data-filter=".new-arrivals">New Products</li> -->
                            {{-- <li data-filter=".hot-sales">Hot Sales</li> --}}
                        </ul>
                    </div>
                </div>
                <div class="row product__filter">
                    @foreach ($data as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ $item->image != NULL && file_exists(public_path('images/' . $item->image)) ? asset('images/' . $item->image) : asset('images/male.png') }}">
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li><a href="{{route('shop.detail',$item->id)}}"><img src="{{asset('template-landing/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$item->name}}</h6>
                                <a href="{{route('cart.add',['qty'=>1,'product_id'=>$item->id])}}" class="">+ Add To Cart</a>
                                <h5>Rp. {{number_format($item->price,2,',','.')}}</h5>
                                {{-- <div class="product__color__select">
                                    <label for="pc-1">
                                        <input type="radio" id="pc-1">
                                    </label>
                                    <label class="active black" for="pc-2">
                                        <input type="radio" id="pc-2">
                                    </label>
                                    <label class="grey" for="pc-3">
                                        <input type="radio" id="pc-3">
                                    </label>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('template-landing/img/product/product-2.jpg')}}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/heart.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Piqué Biker Jacket</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$67.24</h5>
                                <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('template-landing/img/product/product-4.jpg')}}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/heart.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Diagonal Textured Cap</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$60.9</h5>
                                <div class="product__color__select">
                                    <label for="pc-10">
                                        <input type="radio" id="pc-10">
                                    </label>
                                    <label class="active black" for="pc-11">
                                        <input type="radio" id="pc-11">
                                    </label>
                                    <label class="grey" for="pc-12">
                                        <input type="radio" id="pc-12">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('template-landing/img/product/product-6.jpg')}}">
                                <span class="label">Sale</span>
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/heart.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Ankle Boots</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$98.49</h5>
                                <div class="product__color__select">
                                    <label for="pc-16">
                                        <input type="radio" id="pc-16">
                                    </label>
                                    <label class="active black" for="pc-17">
                                        <input type="radio" id="pc-17">
                                    </label>
                                    <label class="grey" for="pc-18">
                                        <input type="radio" id="pc-18">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('template-landing/img/product/product-8.jpg')}}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/heart.png')}}" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="{{asset('template-landing/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Basic Flowing Scarf</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$26.28</h5>
                                <div class="product__color__select">
                                    <label for="pc-22">
                                        <input type="radio" id="pc-22">
                                    </label>
                                    <label class="active black" for="pc-23">
                                        <input type="radio" id="pc-23">
                                    </label>
                                    <label class="grey" for="pc-24">
                                        <input type="radio" id="pc-24">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- Product Section End -->
    
        <!-- Latest Blog Section Begin -->
        {{-- <section class="latest spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Latest News</span>
                            <h2>Fashion New Trends</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{asset('template-landing/img/blog/blog-1.jpg')}}"></div>
                            <div class="blog__item__text">
                                <span><img src="{{asset('template-landing/img/icon/calendar.png')}}" alt=""> 16 February 2020</span>
                                <h5>What Curling Irons Are The Best Ones</h5>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{asset('template-landing/img/blog/blog-2.jpg')}}"></div>
                            <div class="blog__item__text">
                                <span><img src="{{asset('template-landing/img/icon/calendar.png')}}" alt=""> 21 February 2020</span>
                                <h5>Eternity Bands Do Last Forever</h5>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{asset('template-landing/img/blog/blog-3.jpg')}}"></div>
                            <div class="blog__item__text">
                                <span><img src="{{asset('template-landing/img/icon/calendar.png')}}" alt=""> 28 February 2020</span>
                                <h5>The Health Benefits Of Sunglasses</h5>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Latest Blog Section End -->
@endsection