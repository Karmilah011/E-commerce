@extends('template-landingPage.master')
@section('title','Shopping Cart')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Select Payment</h4>
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
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($data as $detail)
                            @php
                                $total += ($detail->price * $detail->qty);
                            @endphp
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="@if($detail->image != NULL) {{asset('/images'.'/'.$detail->image)}} @else {{asset('/images/male.png')}} @endif" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$detail->name}}</h6>
                                        <h5>Rp. {{number_format($detail->price,2,',','.')}}</h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="d-flex justify-content-center">
                                        {{$detail->qty}}
                                    </div>
                                </td>
                                <td class="cart__price">Rp. {{number_format(($detail->price * $detail->qty),2,',','.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>Rp.{{number_format(($total),2,',','.')}}</span></li>
                        <li>Total <span>Rp.{{number_format(($total),2,',','.')}}</span></li>
                    </ul>
                    <button class="primary-btn" id="pay-button">Payment Method</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    var snapToken = @json($transaction->snap_token);
    payButton.addEventListener('click', function () {
      // Trigger snap popup.
     window.snap.pay('{{ $transaction->snap_token }}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
          window.location.href = `{{ route('goToPackedWithReturn',$transaction->id)}}`
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