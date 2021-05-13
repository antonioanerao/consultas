<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{ env('APP_URL') }}/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">

    <title>@yield('title')</title>

    <script src="{{ asset('dashboard/assets/js/jquery-3.4.0.min.js') }}"></script>

    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('dashboard/assets/js/modernizr.min.js') }}"></script>
    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet" type="text/css">

    @yield('css')
</head>


<body class="fixed-left">

@include('layouts.painel.header')
@include('layouts.painel.sidebar')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@yield('page-title')</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ env('APP_NAME') }}</a></li>
                            @yield('breadcrumb')
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
           @yield('content')
        </div>
    </div>

    <footer class="footer">
        2019 - {{ date('Y') }} © {{ env('APP_NAME') }}
    </footer>

</div>

<script>
    var resizefunc = [];
</script>


@yield('modals')
<script src="{{ asset('dashboard/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery.core.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery.app.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/detect.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/waves.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/wow.min.js') }}"></script>

<!-- Notification js -->
<script src="{{ asset('dashboard/plugins/notifyjs/dist/notify.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/notifications/notify-metro.js') }}"></script>

@if(session()->get('erro'))
    <script>
        window.onload = notify;
        function notify(){$.Notification.notify('error','botton right', 'ATENÇÃO', '{{ session()->get('erro') }}')}
    </script>
@endif

@if(session()->get('sucesso'))
    <script>
        window.onload = notify;
        function notify(){$.Notification.notify('success','botton right', 'ATENÇÃO', '{{ session()->get('sucesso') }}')}
    </script>
@endif

@if(session()->get('aviso'))
    <script>
        window.onload = notify;
        function notify(){$.Notification.notify('warning','botton right', 'ATENÇÃO', '{{ session()->get('aviso') }}')}
    </script>
@endif

@yield('js')

</body>
</html>
