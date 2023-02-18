<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CEIIT</title>
  <link rel="icon" type="image/png" href="{{ url('/logo/logo4.png') }}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('font-awesome/css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ url('css/animate.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="stylesheet" href="{{ url('css/plugins/ladda/ladda-themeless.min.css') }}">

</head>

<body class="hold-transition skin-green fixed sidebar-mini">
  <div id="wrapper">
    @include('layouts.system-admin.sidebar')
    @include('layouts.system-admin.header')
    @yield('body');
    @include('layouts.system-admin.footer')
  </div>
 
  <!-- Mainly scripts -->
    <script type="text/javascript" src="{{ url('js/jquery-3.1.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>


    <!-- Flot -->
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.symbol.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/flot/jquery.flot.time.js') }}"></script>


    <!-- Peity -->
    <script type="text/javascript" src="{{ url('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script type="text/javascript" src="{{ url('js/inspinia.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/pace/pace.min.js') }}"></script>

       <!-- Input Mask-->
    <script type="text/javascript" src="{{ url('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script type="text/javascript" src="{{ url('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Jvectormap -->
    <script type="text/javascript" src="{{ url('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- EayPIE -->
    <script type="text/javascript" src="{{ url('js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

    <!-- Sparkline -->
    <script type="text/javascript" src="{{ url('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script type="text/javascript" src="{{ url('js/demo/sparkline-demo.js') }}"></script>

    <!-- Ladda -->
    <script type="text/javascript" src="{{ url('js/plugins/ladda/spin.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/ladda/ladda.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

</body>
</html>
