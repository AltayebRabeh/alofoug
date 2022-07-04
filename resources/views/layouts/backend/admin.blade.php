<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl" dir="rtl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>{{ $cache_settings->name }} - لوحة التحكم</title>
  <link rel="apple-touch-icon" href="{{ $cache_settings->min_logo }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ $cache_settings->min_logo }}">

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Cairo', sans-serif;
        }

        .cairo, .brand-text {
            font-family: 'Cairo', sans-serif !important;
        }

        .brand-text {
            font-size: 14px;
        }
    </style>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.2.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/vendors.css') }}">
  @yield('css')
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/custom-rtl.css') }}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/core/colors/palette-gradient.css') }}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style-rtl.css') }}">
  <!-- END Custom CSS-->

</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar @yield('bodyClass')"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->
@include('layouts.backend.navbar')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
@include('layouts.backend.main_menu')
  <div class="app-content content">
      @yield('content')
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey text-center lighten-2 text-sm-center mb-0 px-2">
        جميع الحقوق محفوظة &copy; {{date('Y')}} {{ $cache_settings->name }}
    </p>
  </footer>

  <!-- BEGIN VENDOR JS-->
  <script src="{{ asset('backend/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->

  <!-- BEGIN MODERN JS-->
  <script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->


  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

  <script>
      $(function() {
            let url = location.href;
            $('#main-menu-navigation a').each(function(i, e) {
                link = $(e).attr('href');

                if(url == link) {
                    $(this).parents('li.nav-item').addClass('open');
                    $(this).parents('li').addClass('active');
                }
            });
      });
  </script>


  @yield('js')



</body>
</html>
