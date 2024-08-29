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
        body,
        html {
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
            <div class="card-header h5 text-white bg-primary">Forgot password?</div>
            <div class="card-body">
                <p class="card-text py-2">
                    Enter your email address and we'll send you an email with instructions to reset your password.
                </p>
                <form id="resetPasswordForm" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="typeEmail" >Email input</label>
                            <input type="email" name="email" id="typeEmail" class="form-control my-3" autocomplete="off" />
                        </div>
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary w-100">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
