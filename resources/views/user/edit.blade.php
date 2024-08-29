@extends('template-admin.master')

@section('title', 'Halaman Update User')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Update Data User</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form method="POST" action="{{route('user.update',$user->id)}}" enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="row mb-2">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" required class="form-control" id="name"
                                            aria-describedby="emailHelp" placeholder="Name User">
                                        <small id="name" class="form-text text-muted">*Name is required</small>
                                    </div> 
                                    <div class="row mb-2">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="number" name="phone" value="{{ $user->phone }}" required class="form-control" id="phone"
                                            aria-describedby="emailHelp" placeholder="phone">
                                        <small id="phone" class="form-text text-muted">*Phone is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" name="email" value="{{ $user->email }}" required class="form-control" id="email"
                                            aria-describedby="emailHelp" placeholder="email">
                                        <small id="email" class="form-text text-muted">*Email is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" value="{{ $user->password }}" required class="form-control" id="password"
                                            aria-describedby="emailHelp" placeholder="password">
                                        <small id="password" class="form-text text-muted">*Password is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="role">Role</label>
                                            <select name="role" value="{{ $user->role }}" required  id="role" class="form-select">
                                                    <option value="admin">Admin</option>
                                                    <option value="customer">Customer</option>
                                            </select>
                                        <small id="role" class="form-text text-muted">*Role is required</small>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address"
                                            aria-describedby="emailHelp" placeholder="address"required>{{ $user->address }}</textarea>
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