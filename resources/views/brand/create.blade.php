@extends('template-admin.master')

@section('title', 'Halaman Create Brand')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Data table</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form method="POST" action="{{route('brand.store')}}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Name Brand" autocomplete="off">
                                    <small id="emailHelp" class="form-text text-muted">Please input brand</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-12"></div>
            </div>
        </div>
    </div>
@endsection
