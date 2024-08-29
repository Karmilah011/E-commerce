<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8oR3zIY9w2A4PKUr5OtF0xhFpyw8jNxTEggF5U" crossorigin="anonymous">

    <style>
        body {
            background-color: #000;
        }

        .padding {
            padding: 2rem !important;
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2;
        }

        h3 {
            font-size: 20px;
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium';
        }

        .text-dark {
            color: #3d405c !important;
        }

        /* Media query to hide print button on small screens */
        @media print {
            .print-button {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <!-- Print button -->
                <a class="pt-2 d-inline-block btn btn-info print-button" href="javascript:void(0);"
                    onclick="window.print()" data-abc="true">Print</a>
                <div class="float-right">
                    <h3 class="mb-0">Invoice {{ $dataDetail->process_code }}</h3>
                    Date: {{ date('d M Y', strtotime($dataDetail->transaction_date)) }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">From:</h5>
                        <h3 class="text-dark mb-1">Mala ApparelCO.</h3>
                        <div>71-101 Southcity, Jakarta</div>
                        <div>Email: malaapparelco@gmail.com</div>
                        <div>Phone: +62 838-7876-4076</div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1">{{ $dataDetail->user_name }}</h3>
                        @if ($dataDetail->address)
                            <div>{{ $dataDetail->address }}</div>
                        @else
                            <div>{{ $dataDetail->user_address }}</div>
                        @endif
                        <div>{{ $dataDetail->user_email }}</div>
                        <div>Phone: {{ $dataDetail->user_phone }}</div>
                    </div>
                </div>
                <<div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Price</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td class="center">{{ $loop->iteration }}</td>
                                    <td class="left strong">{{ $item->product_name }}</td>
                                    <td class="right">Rp. {{ number_format($item->product_price, 2, ',', '.') }}</td>
                                    <td class="center">{{ $item->product_qty }}</td>
                                    <td class="right">Rp.
                                        {{ number_format($item->product_qty * $item->product_price, 2, ',', '.') }}
                                    </td>

                                </tr>
                                @php
                                    $total += $item->product_price * $item->product_qty;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Subtotal</strong>
                                </td>
                                <td class="right">Rp.{{ number_format($total, 2, ',', '.') }}</td>
                            </tr>
                            <!-- You can add more rows for discounts, taxes, etc. -->
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total</strong>
                                </td>
                                <td class="right">
                                    <strong class="text-dark">Rp.{{ number_format($total, 2, ',', '.') }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
