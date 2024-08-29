<!DOCTYPE html>
<html>

<!-- Mirrored from colorlib.com/etc/regform/colorlib-regform-18/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Dec 2023 07:15:27 GMT -->

<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="{{ asset('template-regist/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="shorcut icon" href="{{ asset('template-landing/img/male.png') }}">


    <link rel="stylesheet" href="{{ asset('template-regist/css/style.css') }}">
    <meta name="robots" content="noindex, follow">
    <script nonce="4ae5ab6b-6f29-47b3-b3c8-eff115c42415">
        (function(w, d) {
            ! function(j, k, l, m) {
                j[l] = j[l] || {};
                j[l].executed = [];
                j.zaraz = {
                    deferred: [],
                    listeners: []
                };
                j.zaraz.q = [];
                j.zaraz._f = function(n) {
                    return async function() {
                        var o = Array.prototype.slice.call(arguments);
                        j.zaraz.q.push({
                            m: n,
                            a: o
                        })
                    }
                };
                for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                j.zaraz.init = () => {
                    var q = k.getElementsByTagName(m)[0],
                        r = k.createElement(m),
                        s = k.getElementsByTagName("title")[0];
                    s && (j[l].t = k.getElementsByTagName("title")[0].text);
                    j[l].x = Math.random();
                    j[l].w = j.screen.width;
                    j[l].h = j.screen.height;
                    j[l].j = j.innerHeight;
                    j[l].e = j.innerWidth;
                    j[l].l = j.location.href;
                    j[l].r = k.referrer;
                    j[l].k = j.screen.colorDepth;
                    j[l].n = k.characterSet;
                    j[l].o = (new Date).getTimezoneOffset();
                    if (j.dataLayer)
                        for (const w of Object.entries(Object.entries(dataLayer).reduce(((x, y) => ({
                                ...x[1],
                                ...y[1]
                            })), {}))) zaraz.set(w[0], w[1], {
                            scope: "page"
                        });
                    j[l].q = [];
                    for (; j.zaraz.q.length;) {
                        const z = j.zaraz.q.shift();
                        j[l].q.push(z)
                    }
                    r.defer = !0;
                    for (const A of [localStorage, sessionStorage]) Object.keys(A || {}).filter((C => C.startsWith(
                        "zaraz"))).forEach((B => {
                        try {
                            j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B))
                        } catch {
                            j[l]["z_" + B.slice(7)] = A.getItem(B)
                        }
                    }));
                    r.referrerPolicy = "origin";
                    r.src = "../../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                    q.parentNode.insertBefore(r, q)
                };
                ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
    <style>
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
    </style>
</head>

<body>
    <div class="wrapper" style="background-image: url('images/bg-registration-form-2.jpg');">
        @if (session('success'))
            <script>
                Swal.fire("Success", "Registration successful. Please Login!", "success");
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire("Oops!", "{{ session('error') }}", "error");
            </script>
        @endif

        <div class="inner">
            <form action="{{ route('postregister') }}" method="POST">
                @csrf
                <h3>Registration Form</h3>
                <div class="form-wrapper">
                    <label for>Username</label>
                    <input type="text" name="name"  class="form-control" autocomplete="off" placeholder="Enter your name">
                </div>
                <div class="form-wrapper">
                    <label for>Phone</label>
                    <input type="text" name="phone" class="form-control" autocomplete="off" aria-describedby="emailHelp"  placeholder="08xxxxxxxx" autocomplete="off"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                <div class="form-wrapper">
                    <div class="col mb-3">
                        <label id="addressLabel" class="form-label">Address</label>
                        <select id="Provinsi" class="form-control" onchange="fetchKota()"></select><br>
                        <select id="Kota" class="form-control" onchange="fetchKecamatan()"></select><br>
                        <select id="Kecamatan" class="form-control" onchange="fetchKelurahan()"></select>
                        <br>
                        <select id="Kelurahan" class="form-control"></select>
                    </div>
                </div>
                <div class="form-wrapper">
                    <div class="col mb-3">
                        <label id="addressLabel" class="form-label">Full Address</label>
                        <textarea name="address" id="addressInput" cols="30" rows="10" class="form-control" value="" autocomplete="off" placeholder="Enter your address completely"></textarea>
                    </div>
                </div>
                <div class="form-wrapper">
                    <label for>Email</label>
                    <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter your email">
                </div>
                <div class="form-wrapper">
                    <label for>Password</label>
                    <input type="password" name="password" class="form-control" autocomplete="off" >
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="privacyCheckbox" onchange="checkPrivacy()"> I accept the Terms of Use
                        & Privacy Policy.
                        <span class="checkmark"></span>
                    </label>
                </div>
                <a href="{{ route('login') }}">Have Account?</a>
                <button type="submit" id="registerButton" disabled onclick="registerNow()">Register Now</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function checkPrivacy() {
            var privacyCheckbox = document.getElementById("privacyCheckbox");
            var registerButton = document.getElementById("registerButton");

            // Jika checkbox dicentang, aktifkan tombol Register Now, jika tidak, nonaktifkan.
            registerButton.disabled = !privacyCheckbox.checked;
        }

        function registerNow() {
            var registerForm = document.querySelector('form');

            var nameInput = document.querySelector('input[name="name"]');
            var phoneInput = document.querySelector('input[name="phone"]');
            var emailInput = document.querySelector('input[name="email"]');
            var passwordInput = document.querySelector('input[name="password"]');
            var privacyCheckbox = document.getElementById("privacyCheckbox");

            if (nameInput.value.trim() === "") {
                Swal.fire("Error", "Name field is required.", "error");
            } else if (phoneInput.value.trim() === "") {
                Swal.fire("Error", "phone field is required.", "error");
            } else if (emailInput.value.trim() === "") {
                Swal.fire("Error", "Email field is required.", "error");
            } else if (passwordInput.value.trim() === "") {
                Swal.fire("Error", "Password field is required.", "error");
            } else if (!privacyCheckbox.checked) {
                Swal.fire("Error", "Please accept the Terms of Use & Privacy Policy.", "error");
            } else {
                // Jika semua validasi berhasil, kirim formulir
                registerForm.submit();
                return; // Keluar dari fungsi karena formulir sudah dikirim
            }
        }
    </script>
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    
        const Provinsi = document.getElementById('Provinsi');
        const Kota = document.getElementById('Kota');
        const Kecamatan = document.getElementById('Kecamatan');
        const Kelurahan = document.getElementById('Kelurahan');
        const addressInput = document.getElementById('addressInput');
    
        // Fetch Provinsi
        async function fetchProvinsi() {
            const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            const data = await response.json();
    
            Provinsi.innerHTML = '<option value="">Choose province</option>';
    
            data.forEach(provinsi => {
                const option = document.createElement('option');
                option.value = provinsi.id;
                option.textContent = provinsi.name;
                Provinsi.appendChild(option);
            });
        }
    
        // Fetch Kota berdasarkan Provinsi terpilih
        async function fetchKota() {
            const provinsiId = Provinsi.value;
            if (provinsiId) {
                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`);
                const data = await response.json();
    
                Kota.innerHTML = '<option value="">Choose City</option>';
    
                data.forEach(kota => {
                    const option = document.createElement('option');
                    option.value = kota.id;
                    option.textContent = kota.name;
                    Kota.appendChild(option);
                });
            } else {
                Kota.innerHTML = '<option value="">Choose City</option>';
                Kecamatan.innerHTML = '<option value="">Choose District</option>';
                Kelurahan.innerHTML = '<option value="">Choose Sub-district</option>';
            }
            updateAddress();
        }
    
        // Fetch Kecamatan berdasarkan Kota terChoose
        async function fetchKecamatan() {
            const kotaId = Kota.value;
            if (kotaId) {
                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`);
                const data = await response.json();
    
                Kecamatan.innerHTML = '<option value="">Choose District</option>';
    
                data.forEach(kecamatan => {
                    const option = document.createElement('option');
                    option.value = kecamatan.id;
                    option.textContent = kecamatan.name;
                    Kecamatan.appendChild(option);
                });
            } else {
                Kecamatan.innerHTML = '<option value="">Choose District</option>';
                Kelurahan.innerHTML = '<option value="">Choose Sub-district</option>';
            }
            updateAddress();
        }
    
        // Fetch Kelurahan berdasarkan Kecamatan terChoose
        async function fetchKelurahan() {
            const kecamatanId = Kecamatan.value;
            if (kecamatanId) {
                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`);
                const data = await response.json();
    
                Kelurahan.innerHTML = '<option value="">Choose Sub-district</option>';
    
                data.forEach(kelurahan => {
                    const option = document.createElement('option');
                    option.value = kelurahan.id;
                    option.textContent = kelurahan.name;
                    Kelurahan.appendChild(option);
                });
            } else {
                Kelurahan.innerHTML = '<option value="">Choose Sub-district</option>';
            }
            updateAddress(); // Panggil fungsi updateAddress() saat pilihan kelurahan berubah
        }
        Kelurahan.addEventListener('change', updateAddress);
    
        // Update alamat saat pilihan berubah
        function updateAddress() {
            const provinsiName = Provinsi.options[Provinsi.selectedIndex].textContent;
            const kotaName = Kota.options[Kota.selectedIndex].textContent;
            const kecamatanName = Kecamatan.options[Kecamatan.selectedIndex].textContent;
            const kelurahanName = Kelurahan.options[Kelurahan.selectedIndex].textContent;
    
            const address = `${provinsiName}, ${kotaName}, ${kecamatanName}, ${kelurahanName},`;
            addressInput.value = address;
        }
    
        // Panggil fungsi fetchProvinsi saat halaman dimuat
        fetchProvinsi();
    </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
    
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
    
            gtag('config', 'UA-23581568-13');
        </script>
        <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
            integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
            data-cf-beacon='{"rayId":"8312bcea5b814050","b":1,"version":"2023.10.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
            crossorigin="anonymous"></script>
    </body>
    
    <!-- Mirrored from colorlib.com/etc/regform/colorlib-regform-18/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Dec 2023 07:15:28 GMT -->
    
    </html>    