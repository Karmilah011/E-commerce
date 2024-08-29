@extends('template-landingPage.master')
@section('title','Checkout')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{route('placeOrder')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <select name="address_option" id="address_option" class="form-select">
                                <option value="new">Use New Address</option>
                                <option value="registered">Use Registered Address</option>
                            </select>
                            <input type="text" name="address" id="address" placeholder="Input a new address " class="checkout__input__add" style="font-weight: bold;" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total Price</span> <span class="mr-2">Total Item</span></div>
                            <ul class="checkout__total__products">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($data as $item)
                                    <li>{{$item->name}} <span>Rp. {{number_format(($item->price * $item->qty),2,',','.')}}</span> <span class="mr-2">{{$item->qty}}</span></li>
                                    @php
                                        $total += ($item->price * $item->qty);
                                    @endphp
                                @endforeach
                               
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span>Rp. {{number_format($total,2,',','.')}}</span></li>
                                <li>Total <span>Rp. {{number_format($total,2,',','.')}}</span></li>
                            </ul>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#address_option').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption == 'registered') {
                // Isi input alamat dengan alamat yang telah diregistrasikan
                var registeredAddress = "{{ $user->address }}"; // Ganti $user->address dengan cara yang sesuai untuk mengambil alamat pengguna dari model User
                $('#address').val(registeredAddress);
                $('#address').prop('readonly', true); // Mengunci input agar tidak dapat diedit
            } else {
                $('#address').val(''); // Bersihkan input jika pengguna memilih opsi baru
                $('#address').prop('readonly', false); // Lepaskan kunci input agar dapat diedit
            }
        });
    });
</script>
@endsection