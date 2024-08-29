@extends('template-admin.master')

@section('title', 'Admin Transaction Packed')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    {{-- <h3 class="m-0">Data table</h3> --}}
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Table Packed</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form action="{{ route('admin.packed') }}" method="GET">
                                                    <div class="search_field">
                                                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
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
                                                        style="width: 50px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Code Payment</th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 50px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Name</th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 50px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Phone</th>
                                                        <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 50px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Transaction Date</th>
                                                    <th scope="col" class="sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 150px;" aria-sort="ascending"
                                                        aria-label="title: activate to sort column descending">Address</th>
                                                    <th scope="col" class="sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 171px;"
                                                        aria-label="Category: activate to sort column ascending">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($packed as $value)
                                                    <tr role="row" class="odd">
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->process_code }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->name }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->phone }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->transaction_date }}</th>
                                                        <th scope="row" tabindex="0" class="sorting_1">
                                                            {{ $value->address }}</th>
                                                        <td>
                                                            <a href="{{route('admin.showData',['status'=>'packed','process_code'=>$value->process_code])}}" class="btn btn-primary btn-sm">Show</a>
                                                            <a href="{{route('admin.updateStatus',['process_code'=>$value->process_code,'status'=>'in_delivery'])}}" class="btn btn-success btn-sm">Next To In Delivery</a>
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
