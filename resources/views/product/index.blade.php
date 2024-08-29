@extends('template-admin.master')

@section('title', 'Halaman Products')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Table Products</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form active="" method="GET">
                                                    <div class="search_field">
                                                        <input type="text" name="search" value="@if(isset($_GET['search'])) {{$_GET['search']}} @endif"  placeholder="Search content here...">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2">
                                            <a href="{{ route('products.create') }}" data-bs-toggle="modal"
                                                data-bs-target="#addcategory" class="btn btn-success">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                        <table class="table lms_table_active dataTable no-footer dtr-inline"
                                            id="DataTables_Table_0" role="grid"
                                            aria-describedby="DataTables_Table_0_info" style="width: 1149px;">
                                            <thead>
                                                <tr role="row">
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 115px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Name Products
                                                    </th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 115px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Price</th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 115px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Category
                                                    </th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 115px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Brand
                                                    </th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 115px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Description
                                                    </th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 171px;"
                                                        aria-label="Category: activate to sort column ascending">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $value)
                                                    <tr role="row" class="odd">
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->name }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            Rp. {{number_format($value->price,2,',','.')}}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->category }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->brand }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->description }}</th>
                                                            <td><a href="{{ route('products.edit', $value->id) }}"class="btn btn-primary btn-sm">Edit</a>
                                                            <a href="{{ route('products.destroy', $value->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                                        </td>
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
                <div class="col-12"></div>
            </div>
        </div>
    </div>
@endsection