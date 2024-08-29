@extends('template-admin.master')

@section('title', 'Admin Transaction Finish')

@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0 ">Laporan</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="date-picker">
                                <form class="theme-form" method="POST" action="{{ route('generate.pdf') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="form-label col-sm-3 col-form-label text-end f_w_500 f_s_15">Range of dates</label>
                                        <div class="col-xl-5 col-sm-9 common_date_picker">
                                            <input class="datepicker-here digits" type="text" data-range="true"
                                                data-multiple-dates-separator=" - " data-language="en" name="date_range">
                                        </div>
                                        <div class="col-xl-4 col-sm-12">
                                            <button type="submit" class="btn btn-primary">Generate PDF</button>
                                        </div>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
