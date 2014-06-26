<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - Image Archive</title>
    <meta name="description" content="Simple, fast and secure archive for images">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- styles -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/magnific-popup.css">
    @yield('styles')
    <link rel="stylesheet" href="/css/main.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.min.js"></script>
</head>
<body>
<!-- body -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-right" href="/categories">Image Archive</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            @if (Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li><p class="navbar-text">Signed in as: {{{ Auth::user()->email }}}</p></li>
                @if ((int) Auth::user()->role === User::ADMIN)
                <li
                    @if (Request::is('users*'))
                    class="active"
                    @endif
                ><a href="/users"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
                @endif
                <li><a href="/signout"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
            </ul>
            @endif
        </div>
    </div>
</nav>
<div class="container">
    <!--[if lt IE 8]>
    <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
        You are using an <strong>outdated</strong> browser.
        Please <a href="http://browsehappy.com/">upgrade your browser</a>.
    </div>
    <![endif]-->
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ $error }}
    </div>
    @endforeach
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('error') }}
    </div>
    @endif
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif
    @yield('body')
</div>

<!-- js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js"></script>
@yield('scripts')
<script src="/js/main.js"></script>
</body>
</html>