<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CEIIT</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('font-awesome/css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ url('css/animate.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <link rel="stylesheet" href="{{ url('css/plugins/ladda/ladda-themeless.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/plugins/datapicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ url('css/plugins/iCheck/custom.css') }}">
  <link rel="stylesheet" href="{{ url('css/plugins/summernote/summernote-bs4.css') }}">
  <link rel="icon" type="image/png" href="{{ url('/logo/logo4.png') }}" />
  <link rel="stylesheet" href="{{ url('css/plugins/c3/c3.min.css') }}">
  <link rel="icon" type="image/png" href="{{ url('/logo/logo4.png') }}" />

  <style type="text/css">
    @media print {
      #hide-at-print {
        display: none;
      }

      #center-at-print{
        text-align: center;
      }
    }

    #center-at-print{
        text-align: center;
    }

</style>

</head>

<body class="hold-transition fixed-sidebar skin-green fixed sidebar-mini">
  <div id="wrapper">
    @include('layouts.officer.sidebar')
    @include('layouts.officer.header')
    @yield('body')
  </div>

  <div class="modal inmodal" id="modal_sm" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal_sm_content">
            
        </div>
      </div>
  </div>


  <div class="modal inmodal" id="modal_md" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content" id="modal_md_content">
            
        </div>
      </div>
  </div>

  <div class="modal inmodal" id="modal_lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal_lg_content">
            
        </div>
      </div>
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
    <script type="text/javascript" src="{{ url('js/ajax-script.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.ajaxrequestlaravel.js') }}"></script>

      <!-- Input Mask-->
    <script type="text/javascript" src="{{ url('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>


    <!-- ChartJS-->
    <script type="text/javascript" src="{{ url('js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- iCheck -->
     <script type="text/javascript" src="{{ url('js/plugins/iCheck/icheck.min.js') }}"></script>
     
      <!-- Input Mask-->
    <script type="text/javascript" src="{{ url('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <!-- DatePicker-->
    <script type="text/javascript" src="{{ url('js/plugins/datapicker/bootstrap-datepicker.js
    ') }}"></script>

      <!-- Text Editor-->
      <script type="text/javascript" src="{{ url('js/plugins/summernote/summernote-bs4.js
    ') }}"></script>

    <script type="text/javascript" src="{{ url('js/plugins/d3/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/c3/c3.min.js') }}"></script>


    <script type="text/javascript">

      var mem = $('#data_1 .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
      });

     $('.i-checks').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green'
      });

    </script>


    <script type="text/javascript">
        function clearPage(frm, showTo)
        {
            $('#'+showTo).html('').append("<div style='padding:150px' class='col-lg-12'><center><div class='la-line-scale la-dark mt-0 mb-0'><div></div><div></div><div></div><div></div><div></div></div></center></div>").fadeTo(10,1,function(){
            });
            $("#"+frm).submit();

            return false;
        } 

        window.onload = function(){
          $("#btn-toggle-sidebar").click();
        }
    </script>

<script>
        $(document).ready(function(){

            $('.summernote').summernote({ height: 200 });

       });
    </script>

    @yield('script')

</body>
</html>
