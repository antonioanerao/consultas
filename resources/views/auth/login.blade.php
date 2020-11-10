<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="{{ env('LOGIN_DESCRIPTION') }}">
    <meta name="author" content="{{ env('AUTHOR') }}">
    <meta name="robots" content="{{ env('ROBOTS_LOGIN') }}" />

    <title>Login em {{ env('APP_NAME') }}</title>

    <link href="dashboard/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <link href="dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="dashboard/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="dashboard/assets/css/style.css" rel="stylesheet" type="text/css">

    <script src="dashboard/assets/js/modernizr.min.js"></script>

</head>
<body>

<div class="wrapper-page">

    <div class="text-center">
        <a href="{{ route('dashboard') }}" class="logo-lg">
            {{ env('APP_NAME') }}
        </a> <br> <br>
    </div>

    @if (session('message'))
        <div class="alert alert-danger text-center">{{ session('message') }}</div>
    @endif

    <form method="post" action="/login">
        {{ csrf_field() }} {{ method_field('POST') }}

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                E-mail e/ou senha inválidos. <br> Tente novamente.
            </div>
        @endif

        <div class="form-group row">
            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                    </div>
                    <input id="email" type="email" name="email" required value="{{ old('email') }}" class="form-control{{ $errors->any() ? ' is-invalid' : '' }}" placeholder="Email">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-lock"></i></span>
                    </div>
                    <input id="password" type="password" required placeholder="Senha" class="form-control{{ $errors->any() ? ' is-invalid' : '' }}" name="password" />
                </div>
            </div>
        </div>

        <div class="form-group text-right m-t-20">
            <button class="btn btn-primary btn-custom w-md waves-effect waves-light btn-block" type="submit"><span class="fa fa-user-circle"></span> ACESSAR CONTA</button> <br> <br>
            <a href="{{ route('password.request') }}" class="text-muted text-center"><i class="fa fa-lock m-r-5"></i> Esqueci minha senha</a>
        </div>
    </form>
</div>

<script>
    var resizefunc = [];
</script>

<!-- Custom main Js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Plugins  -->
<script
    src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
    crossorigin="anonymous"></script>

<script src="assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

</body>
</html>
