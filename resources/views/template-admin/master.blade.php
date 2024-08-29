<!DOCTYPE html>
<html lang="zxx">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        @yield('title', config('app.name'))
    </title>
    <link rel="shorcut icon" href="{{ asset('template-landing/img/male.png') }}">

    <link rel="stylesheet" href="{{asset('template-admin/css/bootstrap1.min.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/themefy_icon/themify-icons.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/niceselect/css/nice-select.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/owl_carousel/css/owl.carousel.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/gijgo/gijgo.min.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/font_awesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template-admin/vendors/tagsinput/tagsinput.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/datepicker/date-picker.css')}}" />
    <link rel="stylesheet" href="{{asset('template-admin/vendors/vectormap-home/vectormap-2.0.2.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/scroll/scrollable.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/datatable/css/jquery.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template-admin/vendors/datatable/css/responsive.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template-admin/vendors/datatable/css/buttons.dataTables.min.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/text_editor/summernote-bs4.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/vendors/morris/morris.css')}}">

    <link rel="stylesheet" href="{{asset('template-admin/vendors/material_icon/material-icons.css')}}" />

    <link rel="stylesheet" href="{{asset('template-admin/css/metisMenu.css')}}">

    <link rel="stylesheet" href="{{asset('template-admin/css/style1.css')}}" />
    <link rel="stylesheet" href="{{asset('template-admin/css/colors/default.css')}}" id="colorSkinCSS">
</head>

<body class="crm_body_bg">

    <nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
        @include('template-admin.partial.sidebar')
    </nav>

    <section class="main_content dashboard_part large_header_bg">
        <div class="container-fluid g-0">
            @include('template-admin.partial.topbar')
        </div>
        @yield('content')
    </section>

    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    <script src="{{asset('template-admin/js/jquery1-3.4.1.min.js')}}"></script>

    <script src="{{asset('template-admin/js/popper1.min.js')}}"></script>

    <script src="{{asset('template-admin/js/bootstrap.min.html')}}"></script>

    <script src="{{asset('template-admin/js/metisMenu.js')}}"></script>

    <script src="{{asset('template-admin/vendors/count_up/jquery.waypoints.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/chartlist/Chart.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/count_up/jquery.counterup.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datatable/js/buttons.print.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datepicker/datepicker.en.js')}}"></script>
    <script src="{{asset('template-admin/vendors/datepicker/datepicker.custom.js')}}"></script>
    <script src="{{asset('template-admin/js/chart.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/chartjs/roundedBar.min.js')}}"></script>

    <script src="{{asset('template-admin/vendors/progressbar/jquery.barfiller.js')}}"></script>

    <script src="{{asset('template-admin/vendors/tagsinput/tagsinput.js')}}"></script>

    <script src="{{asset('template-admin/vendors/text_editor/summernote-bs4.js')}}"></script>
    <script src="{{asset('template-admin/vendors/am_chart/amcharts.js')}}"></script>

    <script src="{{asset('template-admin/vendors/scroll/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/scroll/scrollable-custom.js')}}"></script>

    <script src="{{asset('template-admin/vendors/vectormap-home/vectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/vectormap-home/vectormap-world-mill-en.js')}}"></script>

    <script src="{{asset('template-admin/vendors/apex_chart/apex-chart2.js')}}"></script>
    <script src="{{asset('template-admin/vendors/apex_chart/apex_dashboard.js')}}"></script>
    <script src="{{asset('template-admin/vendors/echart/echarts.min.js')}}"></script>
    <script src="{{asset('template-admin/vendors/chart_am/core.js')}}"></script>
    <script src="{{asset('template-admin/vendors/chart_am/charts.js')}}"></script>
    <script src="{{asset('template-admin/vendors/chart_am/animated.js')}}"></script>
    <script src="{{asset('template-admin/vendors/chart_am/kelly.js')}}"></script>
    <script src="{{asset('template-admin/vendors/chart_am/chart-custom.js')}}"></script>

    <script src="{{asset('template-admin/js/dashboard_init.js')}}"></script>
    <script src="{{asset('template-admin/js/custom.js')}}"></script>
</body>
</html>
