@extends('template-landingPage.master')
@section('title','Shop')
@section('content')
    
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('shop')}}">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="{{route('shop')}}" method="GET">
                            <input type="text" value="@if(isset($_GET['searchByProduct'])) {{$_GET['searchByProduct']}} @endif" name="searchByProduct" placeholder="Search By Name Product...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll" style="overflow-y: hidden; outline: none; touch-action: none;" tabindex="1">
                                                @foreach ($categories as $item)
                                                <li><a href="{{route('shop', ['categories' => $item->name])}}">{{$item->name}}</a></li>
                                                @endforeach
                                                {{-- <li><a href="#">Women (20)</a></li>
                                                <li><a href="#">Bags (20)</a></li>
                                                <li><a href="#">Clothing (20)</a></li>
                                                <li><a href="#">Shoes (20)</a></li>
                                                <li><a href="#">Accessories (20)</a></li>
                                                <li><a href="#">Kids (20)</a></li>
                                                <li><a href="#">Kids (20)</a></li>
                                                <li><a href="#">Kids (20)</a></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                @foreach ($brands as $item)
                                                <li><a href="{{route('shop', ['brands' => $item->name])}}">{{$item->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="{{route('shop',['price'=>'0-250'])}}">Rp.0 - Rp.250.000,00</a></li>
                                                <li><a href="{{route('shop',['price'=>'250-500'])}}">Rp.250.000,00 - Rp.500.000,00</a></li>
                                                <li><a href="{{route('shop',['price'=>'500-750'])}}">Rp.500.000,00 - Rp.750.000,00</a></li>
                                                <li><a href="{{route('shop',['price'=>'750-1jt'])}}">Rp.750.000,00 - Rp.1.000.000,00</a></li>
                                                <li><a href="{{route('shop',['price'=>'>1jt'])}}"> > Rp.1.000.000,00</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">
                                            @foreach ($tags as $item)
                                            <a href="{{route('shop',['tags'=>$item->name])}}">{{$item->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                {{-- <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select style="display: none;">
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select><div class="nice-select" tabindex="0"><span class="current">Low To High</span><ul class="list"><li data-value="" class="option selected">Low To High</li><li data-value="" class="option">$0 - $55</li><li data-value="" class="option">$55 - $100</li></ul></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    @foreach ($data as $item)            
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ $item->image != NULL && file_exists(public_path('images/' . $item->image)) ? asset('images/' . $item->image) : asset('images/male.png') }}">
                                <ul class="product__hover">
                                    <li><a href="{{route('shop.detail',$item->id)}}"><img src="{{asset('template-landing/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$item->name}}</h6>
                                {{-- <form action="{{route('cart.store',$item->id)}}" method="POST"> --}}
                                    {{-- @csrf --}}
                                    {{-- <input type="hidden" name="qty" value="1"> --}}
                                    <a href="{{route('cart.add',['qty'=>1,'product_id'=>$item->id])}}" class="">+ Add To Cart</a>
                                {{-- </form> --}}
                                {{-- <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div> --}}
                                <h5>Rp.  {{number_format($item->price,2,',','.')}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            @php
                            if($page > 5){
                                    $checkNumberPage = ceil($page / 5);
                                    $endPage = $checkNumberPage * 5;
                                    $startPage = $endPage - 4;
                                    $number = $startPage;
                                    if($totalPage < $endPage){
                                        $max = $totalPage;
                                    }else{
                                        $max = $endPage;    
                                    }
                                
                            }else{
                                $number = 1;
                                $max = 5; 
                                if($max > $totalPage){
                                    $max = $totalPage;
                                }
                            }
                        @endphp
                         @for($i = $number;$i <= $max;$i++)
                            
                         
                            <a class="@if($i == $page) active  @endif" href="{{route('shop',['page'=>$i, 
                            'price' => isset($_GET['price']) ? $_GET['price'] : null,
                            'categories' => isset($_GET['categories']) ? $_GET['categories'] : null,
                            'brands' => isset($_GET['brands']) ? $_GET['brands'] : null,
                            'tags' => isset($_GET['tags']) ? $_GET['tags'] : null])}}">{{$i}}</a>

                         @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection