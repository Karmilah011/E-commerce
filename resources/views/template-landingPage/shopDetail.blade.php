@extends('template-landingPage.master')

@section('content')
<section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{route('home')}}">Home</a>
                            <a href="{{route('shop')}}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        {{-- <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{asset('template-landing/img/shop-details/thumb-1.png')}}" style="background-image: url(&quot;{{asset('template-landing/img/shop-details/thumb-1.png')}}&quot;);">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{asset('template-landing/img/shop-details/thumb-2.png')}}" style="background-image: url(&quot;{{asset('template-landing/img/shop-details/thumb-2.png')}}&quot;);">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{asset('template-landing/img/shop-details/thumb-3.png')}}" style="background-image: url(&quot;{{asset('template-landing/img/shop-details/thumb-3.png')}}&quot;);">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{asset('template-landing/img/shop-details/thumb-4.png')}}" style="background-image: url(&quot;{{asset('template-landing/img/shop-details/thumb-4.png')}}&quot;);">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul> --}}
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="@if($data->image != NULL) {{asset('/images'.'/'.$data->image)}} @else {{asset('/images/male.png')}} @endif" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <form action="{{route('cart.store',$data->id)}}" method="POST">
                            @csrf
                            <div class="product__details__text">
                                <h4>{{$data->name}}</h4>
                                <h5>{{$data->description}}</h5>
                                <h3>Rp. {{number_format($data->price,2,',','.')}}</h3>
                                <p>{{$data->desc}}</p>
                                {{-- <div class="product__details__option">
                                    <div class="product__details__option__size">
                                        <span>Size:</span>
                                        <label for="xxl">xxl
                                            <input type="radio" id="xxl">
                                        </label>
                                        <label class="active" for="xl">xl
                                            <input type="radio" id="xl">
                                        </label>
                                        <label for="l">l
                                            <input type="radio" id="l">
                                        </label>
                                        <label for="sm">s
                                            <input type="radio" id="sm">
                                        </label>
                                    </div>
                                    <div class="product__details__option__color">
                                        <span>Color:</span>
                                        <label class="c-1" for="sp-1">
                                            <input type="radio" id="sp-1">
                                        </label>
                                        <label class="c-2" for="sp-2">
                                            <input type="radio" id="sp-2">
                                        </label>
                                        <label class="c-3" for="sp-3">
                                            <input type="radio" id="sp-3">
                                        </label>
                                        <label class="c-4" for="sp-4">
                                            <input type="radio" id="sp-4">
                                        </label>
                                        <label class="c-9" for="sp-9">
                                            <input type="radio" id="sp-9">
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <span class="fa fa-angle-up dec qtybtn"></span>
                                            <input type="number" value="1" name="qty">
                                            <span class="fa fa-angle-down inc qtybtn"></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="primary-btn">add to cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection