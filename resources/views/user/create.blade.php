@extends('template-admin.master')

@section('title', 'Halaman Create User')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Create Data User</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form method="POST" action="{{route('user.store')}}" enctype='multipart/form-data'>
                                @csrf
                                <div class="mb-3">
                                    <div class="row mb-2">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            aria-describedby="emailHelp" placeholder="Name User" autocomplete="off">
                                        <small id="name" class="form-text text-muted">*Name is required</small>
                                    </div> 
                                    <div class="row mb-2">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="number" name="phone" class="form-control" id="phone"
                                            aria-describedby="emailHelp" placeholder="phone" autocomplete="off">
                                        <small id="phone" class="form-text text-muted">*Phone is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" name="email" class="form-control" id="email"
                                            aria-describedby="emailHelp" placeholder="email" autocomplete="off">
                                        <small id="email" class="form-text text-muted">*Email is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="emailHelp" placeholder="password">
                                        <small id="password" class="form-text text-muted">*Password is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="role">Role</label>
                                            <select name="role" id="role" class="form-select">
                                                    <option value="admin">Admin</option>
                                            </select>
                                        <small id="role" class="form-text text-muted">*Role is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address"
                                            aria-describedby="emailHelp" placeholder="address" autocomplete="off"></textarea>
                                        <small id="address" class="form-text text-muted">*address is required</small>
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