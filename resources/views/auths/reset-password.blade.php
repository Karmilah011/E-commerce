<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS to center the card */
        body, html {
            height: 100%;
        }
        .vertical-center {
            min-height: 100%;
            display: flex;
            align-items: center;
            margin-left: 38%;
        }
    </style>
</head>
<body>
    <div class="container vertical-center">
        <div class="card text-center" style="width: 300px;">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="card-header h5 text-white bg-primary">Reset Password</div>
            <div class="card-body">
                <form action="{{route('password.update')}}" method="post">
                    @csrf
                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <div data-mdb-input-init class="form-outline">
                            <input type="hidden" name="token" value="{{request()->token}}">
                            <input type="hidden" name="email" value="{{request()->email}}">
                            <label class="form-label" for="typeEmail">Password</label>
                            <input type="password" name="password" id="typepassword" class="form-control my-3" />
                            <label class="form-label" for="typepassword">Confirmed Password</label>
                            <input type="password" name="password_confirmation" id="typepassword" class="form-control my-3" />
                        </div>
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary w-100">Update password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
