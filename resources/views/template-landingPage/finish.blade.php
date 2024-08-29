@extends('template-landingPage.master')
@section('title', 'Finish')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Finish</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopping-cart spad">
        <div class="container">
            @foreach ($processCodeFinish as $processCode)
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $codePembayaran = $processCode->process_code;
                                        $total = 0;
                                        $qty = 0;
                                    @endphp
                                    @foreach ($finish as $item)
                                        @if ($processCode->process_code == $item->process_code)
                                            @php
                                                $total += $item->price * $item->qty;
                                                $qty += $item->qty;
                                            @endphp
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="@if($item->image != NULL) {{asset('/images'.'/'.$item->image)}} @else {{asset('/images/male.png')}} @endif"
                                                            alt="">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $item->name }}</h6>
                                                        <h5>Rp. {{ number_format($item->price, 2, ',', '.') }}</h5>
                                                    </div>
                                                </td>
                                                <form action="{{ route('cart.store', $item->id) }}" method="POST">
                                                    @csrf
                                                    <td class="cart__price">{{ $item->qty }}</td>
                                                    <td class="cart__price">Rp.
                                                        {{ number_format($item->price * $item->qty, 2, ',', '.') }}</td>
                                                </form>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td>TOTAL</td>
                                        <td>{{ $qty }}</td>
                                        <td>{{ number_format($total, 2, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <span>ID Transaction : <a href="{{route('invoice',['status'=>'finish','process_code'=>$item->process_code])}}">{{$item->process_code}}</a></span> <br>
                        </div>
                    </div>
                    <hr>
                </div>
            @endforeach
            @if (count($processCodeFinish) == 0)
                <div class="row mb-5"> </div>
                <div class="row mb-5"> </div>
                <div class="row mb-5"> </div>
                <div class="row mb-5"> </div>
            @endif
        </div>
    </section>
@endsection
