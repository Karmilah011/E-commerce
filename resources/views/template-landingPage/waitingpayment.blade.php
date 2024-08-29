@extends('template-landingPage.master')
@section('title', 'WaitingPayment')
@section('content')
 <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
 <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
 data-client-key="{{config('midtrans.client_key')}}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Waiting To Payment</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopping-cart spad">
        <div class="container">
            @foreach ($processCodeWaiting as $processCode)
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
                                    @foreach ($waiting as $item)
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
                            {{-- <span>Payment Code : {{ $processCode->process_code }}</span> <br>
                            @php
                                $pesanWhatsApp = "Halo, saya ingin melanjutkan pembayaran dengan detail berikut:\n\n" . 'Nama : ' . Auth::user()->name . "\n" . "Code Pembayaran: $codePembayaran\n" . "Total Barang: $qty\n" . 'Total Harga : Rp.' . number_format($total, 2, ',', '.');
                                $urlWhatsApp = 'https://wa.me/6283878764076?text=' . urlencode($pesanWhatsApp);
                            @endphp
                            <span><a href="{{ $urlWhatsApp }}" target="_blank">Click Here</a> To Confirm Payment</span> --}}
                            <a class="primary-btn" href="{{route('selectPayment',$codePembayaran)}}">Payment</a>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>Rp.{{number_format(($total),2,',','.')}}</span></li>
                        <li>Total <span>Rp.{{number_format(($total),2,',','.')}}</span></li>
                    </ul>
                </div>
            </div> --}}
                    <hr>
                </div>
            @endforeach
            @if (count($processCodeWaiting) == 0)
                <div class="row mb-5"> </div>
                <div class="row mb-5"> </div>
                <div class="row mb-5"> </div>
                <div class="row mb-5"> </div>
            @endif
            {{-- <div class="product__details__content">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="product__details__text">
                                <p></p>
                                <div class="product__details__last__option">
                                    <h5><span>ID Transaction</span></h5>
                                    <img src="{{ asset('template-landing/img/shop-details/paymentpict.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{$snapToken}}', {
            onSuccess: function(result){
              /* You may add your own implementation here */
              alert("payment success!"); console.log(result);
            },
            onPending: function(result){
              /* You may add your own implementation here */
              alert("wating your payment!"); console.log(result);
            },
            onError: function(result){
              /* You may add your own implementation here */
              alert("payment failed!"); console.log(result);
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('you closed the popup without finishing the payment');
            }
          })
        });
    </script> 
@endsection
