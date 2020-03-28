<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name') }} | {{ __('Login') }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="adminlte/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="adminlte/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="adminlte/fonts/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="adminlte/css/AdminLTE.min.css">
        <link rel="stylesheet" href="adminlte/plugins/iCheck/square/blue.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Administración</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Ingresa tus credenciales para iniciar sesión</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group @error('email') has-error @enderror has-feedback">
                    <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                        <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror has-feedback">
                    <input type="password" placeholder="Password" class="form-control" name="password" required autocomplete="current-password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                        <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuérdame') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
                </div>
            </form>
            @if (Route::has('password.request'))
                <a href={{ route('password.request') }}>{{ __('Reestablecer contraseña') }}</a><br>
            @endif
            {{-- <a href="register.html" class="text-center">Register a new membership</a> --}}
        </div>
    </div>

    <script src="adminlte/plugins/jquery/dist/jquery.min.js"></script>
    <script src="adminlte/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="adminlte/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
    </body>
</html>