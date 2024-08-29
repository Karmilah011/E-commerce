<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('template-regist/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template-regist/css/style.css') }}">
    <meta name="robots" content="noindex, follow">
    <style>
        /* Additional CSS */
        .checkbox {
            display: block;
            margin-bottom: 10px;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        .checkbox input {
            opacity: 0;
            height: 0;
            width: 0;
        }

        .checkbox label {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            display: block;
        }

        .checkbox label:hover .checkmark {
            background-color: #ccc;
        }

        .checkbox input:checked+.checkmark {
            background-color: #2196F3;
        }

        button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        /* New CSS for layout */
        .forgot-password {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="inner">
            <form action="{{ route('postlogin') }}" method="POST">
                @csrf
                <h3>Login Form</h3>
                <div class="form-wrapper">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" autocomplete="off">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-wrapper">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="off">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="privacyCheckbox" onchange="checkPrivacy()"> I accept the Terms of Use & Privacy Policy.
                        <span class="checkmark"></span>
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a><br>
                <a href="{{ route('register')}}">Register Account</a>
                <button type="submit" id="loginButton" disabled>Login</button>
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </form>
        </div>
    </div>
    <script>
        // Script untuk memeriksa apakah checkbox untuk kebijakan privasi dicentang atau tidak
        function checkPrivacy() {
            var privacyCheckbox = document.getElementById("privacyCheckbox");
            var loginButton = document.getElementById("loginButton");

            // Jika checkbox dicentang, aktifkan tombol Login, jika tidak, nonaktifkan.
            loginButton.disabled = !privacyCheckbox.checked;
        }
    </script>
</body>

</html>
