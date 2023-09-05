<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in | Sinar Jaya</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Selamat datang di Toko Emas Murni. Temukan berbagai koleksi perhiasan emas berkualitas tinggi dan desain eksklusif untuk gaya Anda. Kunjungi toko kami sekarang!">
    <meta name="keywords"
        content="toko emas, perhiasan emas, perhiasan berkualitas, emas murni, perhiasan eksklusif, cincin emas, kalung emas, gelang emas">
    <meta name="author" content="ECBT Team">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Nama Kota atau Lokasi Toko Emas">
    <meta name="geo.position" content="Latitude;Longitude">
    <meta name="ICBM" content="Latitude, Longitude">

    <!-- Meta tag Open Graph untuk berbagi di media sosial -->
    <meta property="og:title" content="Toko Emas Murni - Koleksi Perhiasan Emas Berkualitas Tinggi">
    <meta property="og:description"
        content="Temukan berbagai koleksi perhiasan emas berkualitas tinggi dan desain eksklusif untuk gaya Anda di Toko Emas Murni. Kunjungi toko kami sekarang!">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('') }}/">
    <meta property="og:image" content="{{ url('') }}/logo.png">
    <meta property="og:image:width" content="1332">
    <meta property="og:image:height" content="815">
    <meta property="og:image:alt" content="Toko Emas Murni">
    <meta property="og:site_name" content="Toko Emas Murni">

    <!-- Meta tag Twitter Card untuk berbagi di Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Toko Emas Murni - Koleksi Perhiasan Emas Berkualitas Tinggi">
    <meta name="twitter:description"
        content="Temukan berbagai koleksi perhiasan emas berkualitas tinggi dan desain eksklusif untuk gaya Anda di Toko Emas Murni. Kunjungi toko kami sekarang!">
    <meta name="twitter:image" content="{{ url('') }}/logo.png">
    <meta name="twitter:image:width" content="1332">
    <meta name="twitter:image:height" content="815">

    <link rel="icon" href="{{ url('') }}/logo2.png" type="image/png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ 'template' }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ 'template' }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ 'template' }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <a href="{{ 'template' }}/index2.html" class="h1"><b>Sinar</b>Jaya</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username"
                            value="admin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password" value="admin1234">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-info">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-info btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3 d-none">
                    <a href="#" class="btn btn-block btn-info">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ 'template' }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ 'template' }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ 'template' }}/dist/js/adminlte.min.js"></script>
    @include('sweetalert::alert')
</body>

</html>
