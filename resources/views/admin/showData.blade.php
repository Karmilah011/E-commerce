@extends('template-admin.master')

@section('title', 'Invoice Transaction')

@section('content')
    <style>
        .print-content {
            max-width: 800px; /* Atur lebar maksimum untuk konten yang ingin dicetak */
            margin: auto; /* Pusatkan konten */
        }

        .print-button {
            display: inline-block; /* Ubah display menjadi inline-block */
        }

        .inner-card {
            margin-bottom: 30px; /* Tambahkan margin bottom pada card invoice */
        }

        .print-icon {
            margin-left: 5px; /* Berikan margin kiri untuk meletakkan ikon di samping status */
        }

        @media print {
            body * {
                visibility: hidden; /* Semua elemen tidak terlihat saat mencetak */
            }

            .print-content, .print-content * {
                visibility: visible; /* Tampilkan hanya konten yang ingin dicetak */
            }

            .print-content {
                position: absolute;
                left: 0;
                top: 0;
            }

            .print-button {
                display: none !important;
            }
        }
    </style>
    <div class="container-fluid"> <!-- Menggunakan kelas container-fluid untuk mengatur lebar card luar -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30 inner-card"> <!-- Tambahkan kelas inner-card -->
                    <div class="col-12 QA_section print-content">
                        <div class="card QA_table ">
                            <div class="card-header">
                                Invoice
                                <strong>{{ $data[0]->process_code }}</strong>
                                <span class="float-end">
                                    <strong>Status:</strong>{{ $data[0]->transaction_status }}
                                    <button class="btn btn-primary btn-sm print-button" onclick="printInvoice()"><i class="fas fa-print print-icon"></i></button>
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <h6 class="mb-3">From:</h6>
                                        <div>
                                            <strong>Mala ApparelCO.</strong>
                                        </div>
                                        <div>71-101 Southcity, Jakarta</div>
                                        <div>Email: malaapparelco@gmail.com</div>
                                        <div>Phone: +62 838-7876-4076</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="mb-3">To:</h6>
                                        <div>
                                            <strong>{{ $data[0]->user_name }}</strong>
                                        </div>
                                        <div>{{ $data[0]->user_address }}</div>
                                        <div>Email: {{ $data[0]->user_email }}</div>
                                        <div>Phone: {{ $data[0]->user_phone }}</div>
                                    </div>
                                </div>
                                <div class="table-responsive-sm">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">Item</th>
                                                <th class="right">Unit Cost</th>
                                                <th class="center">Qty</th>
                                                <th class="right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $value)
                                                <tr>
                                                    <td class="left strong">{{ $value->product_name }}</td>
                                                    <td class="right">Rp.
                                                        {{ number_format($value->product_price, 2, ',', '.') }}</td>
                                                    <td class="center">{{ $value->product_qty }}</td>
                                                    <td class="right">Rp.
                                                        {{ number_format($value->product_price * $value->product_qty, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $total += $value->product_price * $value->product_qty;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                    </div>
                                    <div class="col-lg-4 col-sm-5 ms-auto QA_section">
                                        <table class="table table-clear QA_table">
                                            <tbody>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Subtotal</strong>
                                                    </td>
                                                    <td class="right">Rp.{{ number_format($total, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong>Rp.{{ number_format($total, 2, ',', '.') }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12"></div>
        </div>
    </div>
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
@endsection
