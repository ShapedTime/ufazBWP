<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Budget Holder</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex-container home-body">
    <div class="nav-hide-show">≡</div>
    <nav>
        <div class="flex-container-col nav-links-container">
            <a href="{{ route('home') }}" class="flex-container-col align-center justify-center @yield('current_or_not_home')">
                <i class="icon-home x3"></i>Home
            </a>
            <a href="{{ route('paymentmethods') }}" class="flex-container-col align-center justify-center @yield('current_or_not_payment_methods')">
                <i class="icon-credit-cards x3"></i>Payment Methods
            </a>
            <a href="{{ route('transactions.export')}}" class="flex-container-col align-center justify-center @yield('current_or_not_statement')">
                <i class="icon-document x3"></i>Statement
            </a>
            <a href="{{ route('transactions.statistics')}}" class="flex-container-col align-center justify-center @yield('current_or_not_statistics')">
                <i class="icon-statistics x3"></i>Statistics
            </a>
            <a href="{{ route('logout') }}" class="flex-container-col align-center justify-center">
                <i class="icon-logout x3"></i>Log Out
            </a>
        </div>
    </nav>

    <main class="py-4 b-t">
        @yield('content')
    </main>

</body>
</html>
