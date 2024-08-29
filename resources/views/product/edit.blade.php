@extends('template-admin.master')

@section('title', 'Halaman Update Products')

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
                        <form method="POST" action="{{ route('products.update', $products->id) }}">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">Name Product</label>
                                    <input type="text" name="namaproduk" value="{{ $products->namaproduk }}" required class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Name Product">
                                    <small id="emailHelp" class="form-text text-muted">Please input Product</small>
                                    <label class="form-label" for="exampleInputEmail1">Price</label>
                                    <input type="text" name="price"  value="{{ $products->price }}" required class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Price">
                                    <small id="emailHelp" class="form-text text-muted">Please input Price</small>
                                    <label class="form-label" for="exampleInputEmail1" >Description</label>
                                    <textarea name="desc" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Name Description" required>{{ $products->desc }}</textarea>
                                    <small id="emailHelp" class="form-text text-muted">Please input Description</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12"></div>
            </div>
        </div>
    </div>
@endsection