@extends('template-admin.master')

@section('title', 'Halaman Create Category')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Create Data Category</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form method="POST" action="{{route('category.store')}}" enctype='multipart/form-data'>
                                @csrf
                                <div class="mb-3">
                                    <div class="row mb-2">
                                        <label class="form-label" for="name">Name Category</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            aria-describedby="emailHelp" placeholder="Name Product" autocomplete="off">
                                        <small id="name" class="form-text text-muted">*Category is required</small>
                                    </div> 
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