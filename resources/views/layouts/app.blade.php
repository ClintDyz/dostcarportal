<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>DOST-CAR Portal</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">

    @yield('custom-css')
</head>
<body>
    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg 
                    unique-color scrolling-navbar">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand waves-effect" 
                   href="{{ url('/') }}">
                    <img src="{{ url('images/dost-logo-1.png') }}" height="60" alt="DOST-CAR Portal">
                </a>
            </div>
        </nav>
        <!-- Navbar -->

    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="container-fluid wow animated fadeIn">
            @yield('content')
        </div>

        @yield('modals')
    </main>

    <!--Footer-->
    <footer class="page-footer text-center font-small unique-color mt-4 wow fadeIn">

        <!--Copyright-->
        <div class="footer-copyright py-3 white-text">
            <p class="mb-0">
                <span class="font-weight-bold">
                    DOST-CAR Portal (Beta)
                </span><br>
                © Department of Science & Technology - CAR<br>
                All Rights Reserved 2019
            </p>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->

    <!-- JavaScripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            setInterval(function() { 
                
                var dayToday = moment().format('dddd').toUpperCase();
                var fullDateToday = moment().format('MMMM D, YYYY').toUpperCase();
                var timeToday = moment().format('h:mm:ssa');
                var dateTimeStr = "TODAY IS " + dayToday + " : " + fullDateToday + " [ " + timeToday + " ]";

                $("#datetime-display").text(dateTimeStr);
            }, 500);

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>

    @yield('custom-js')
</body>
</html>
