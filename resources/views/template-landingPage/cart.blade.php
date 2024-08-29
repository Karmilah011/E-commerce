@extends('template-landingPage.master')
@section('title','Shopping Cart')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="padding-right: 25px;">Stock</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($data as $item)
                            @php
                                $total += ($item->price * $item->qty);
                            @endphp
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="@if($item->image != NULL) {{asset('/images'.'/'.$item->image)}} @else {{asset('/images/male.png')}} @endif" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$item->name}}</h6>
                                        <h5>Rp. {{number_format($item->price,2,',','.')}}</h5>
                                    </div>
                                </td>
                                <td style="padding-right: 20px;">{{ $item->stock }}</td>
                                <form id="form{{$item->id}}" action="{{route('cart.store',$item->id)}}" method="POST" onsubmit="return validateQuantity(event, {{$item->stock}}, {{$item->id}})">
                                    @csrf
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="number" value="{{$item->qty}}" name="qty" min="1" max="{{ $item->stock }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">Rp. {{number_format(($item->price * $item->qty),2,',','.')}}</td>
                                    <td class="cart__close"><a href="{{route('cart.destroy',$item->cart_id)}}"><i class="fa fa-close"></i></a></td>
                                    <td class="cart__save">
                                        <button type="submit"><i class="fa fa-save"></i></button>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{route('shop')}}">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>Rp.{{number_format(($total),2,',','.')}}</span></li>
                        <li>Total <span>Rp.{{number_format(($total),2,',','.')}}</span></li>
                    </ul>
                    <a href="{{route('checkout')}}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript function to validate quantity against stock
    function validateQuantity(event, stock, itemId) {
        var inputQty = parseInt(document.querySelector("#form" + itemId + " input[name='qty']").value);
        if (inputQty > stock) {
            // If quantity exceeds stock, show alert
            alert("Maaf, jumlah yang dimasukkan melebihi stok yang tersedia.");
            event.preventDefault(); // Prevent form submission
            return false;
        }
        return true;
    }
</script>
@endsection