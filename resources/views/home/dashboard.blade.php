@extends('template-admin.master')

@section('title', 'Halaman Dashboard')

@section('content')

<div class="main_content_iner overly_inner ">
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Male Fashion </a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-6">
            <div class="white_card card_height_100 mb_30 ">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Latest Invoices</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body QA_section">
                    <div class="QA_table ">
    
                        <table class="table lms_table_active2 p-0">
                            <thead>
                                <tr>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Transaction Date</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finish as $value)
                                <tr>
                                    <td>
                                        <div class="customer d-flex align-items-center">
                                            {{$value->name}}
                                        </div>
                                    </td>
                                    <td class="f_s_14 f_w_400 color_text_3">{{$value->process_code}}</td>
                                    <td class="f_s_14 f_w_400 color_text_4">{{$value->transaction_date}}</td>
                                    <td class="f_s_14 f_w_400 color_text_4">Rp. {{number_format($value->price,2,',','.')}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Tabel top selling product -->
            <div class="white_card card_height_100 mb_20 ">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title d-flex justify-content-between align-items-center">
                            <h3 class="m-0">Top Selling Product</h3>
                        </div>
                        <form method="POST" action="{{ route('generate.pdf-topSelling') }}">
                            @csrf
                            <!-- Isi form untuk pengaturan PDF -->
                            <button type="submit" class="btn btn-primary ml-auto">Generate PDF</button>
                        </form>
                    </div>
                </div>
                <div class="white_card_body QA_section">
                    <div class="QA_table">
                        <table class="table lms_table_active2 p-0">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ProductSell as $item)
                                <tr>
                                    <td>
                                        <div class="customer d-flex align-items-center">
                                            <span class="f_s_14 f_w_400 color_text_1">{{$item->name}}</span>
                                        </div>
                                    </td>
                                    <td class="f_s_14 f_w_400 color_text_2">Rp. {{number_format($item->price,2,',','.')}}</td>
                                    <td class="f_s_14 f_w_400 color_text_4">{{$item->sold}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection
