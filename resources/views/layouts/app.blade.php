<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    @php
        $title = App\Models\GeneralSetting::find(1)->business_name;
        $favicon = App\Models\GeneralSetting::find(1)->favicon;
    @endphp

    <title>{{ $title }} | @yield('title')</title>

    <link rel="icon" href="{{ url('images/upload/'.$favicon) }}" type="image/png">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <input type="hidden" id="mainurl" value="{{url('/')}}">

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="https://cdn.rawgit.com/leafo/sticky-kit/v1.1.2/jquery.sticky-kit.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.css">

    <link href="https://jvectormap.com/css/jquery-jvectormap-2.0.3.css" rel="stylesheet">

    @php
        $color = App\Models\GeneralSetting::find(1)->site_color;
        $colorsecondary = App\Models\GeneralSetting::find(1)->color_secondary;
    @endphp
    <style>
        :root
        {
            --site_color: <?php echo $color; ?>;
            --color_secondary: <?php echo $colorsecondary; ?>;
            --hover_color: <?php echo $colorsecondary.'c7'; ?>;
        }
    </style>

    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.css">

    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @if (session('direction') == 'rtl')
        <link rel="stylesheet" href="{{ url('css/rtl_direction.css')}}" type="text/css">
    @endif
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
</head>

<body>
    <div class="loader">Loading...</div>
    <div class="for-loader">
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                @include('layouts.topnav')
            </div>

            @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                @include('layouts.sidebar')
                <div class="main-content">
            @else
                <div class="main-content" style="padding-left: 30px !important;">
            @endif
                @if (App\Models\GeneralSetting::find(1)->license_verify == 1)
                    @yield('content')
                    @yield('setting')
                @else
                    <script>
                        var a = $('#mainurl').val()+'/admin/license_setting';
                        if (window.location.origin + window.location.pathname != $('#mainurl').val() + '/admin/license_setting')
                        {
                            setTimeout(() =>
                            {
                                Swal.fire({
                                title: 'Your License is deactivated!',
                                icon: 'info',
                                html: 'to get benifit of our app please activate your license<br><br>'+
                                '<a href="'+a+'" style="background:#3085d6;color:#fff;padding:8px 10px;border-radius:5px;">Activate License</a>',
                                showCloseButton: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                focusConfirm: false,
                                onClose: () => {
                                window.location.replace(a);
                            }
                        })}, 500);
                        }
                    </script>
                    @yield('setting')
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

    <script src="{{ url('js/bootstrap-colorpicker.min.js') }}"></script>

    <script src="{{ url('js/bootstrap-tagsinput.min.js') }}"></script>

    <script src="{{ url('js/chart.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

    <script src="{{ asset('js/stisla.js') }}"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    @if(Request::is('admin/vendor/*') || Request::is('admin/vendor/create') || Request::is('vendor/vendor/*') || Request::is('vendor/update_vendor'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&callback=initMap&libraries=places&v=weekly" defer></script>
        <script src="{{ asset('js/map.js') }}"></script>
    @endif

    @if (Request::is('admin/make_payment'))
        <script src="{{ asset('js/payment.js') }}"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="https://www.paypal.com/sdk/js?client-id={{ App\Models\PaymentSetting::first()->paypal_sendbox }}&currency={{ App\Models\GeneralSetting::first()->currency }}" data-namespace="paypal_sdk"></script>
    @endif

    @if (Request::is('admin/driver_make_payment'))
        <script src="{{ asset('js/driver_payment.js') }}"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        {{-- <script src="https://www.paypal.com/sdk/js?client-id={{ App\Models\PaymentSetting::first()->paypal_sendbox }}&currency={{ App\Models\GeneralSetting::first()->currency }}" data-namespace="paypal_sdk"></script> --}}
        <script src="https://www.paypal.com/sdk/js?client-id={{ App\Models\PaymentSetting::first()->paypal_sendbox }}&currency={{ App\Models\GeneralSetting::first()->currency }}" data-namespace="paypal_sdk"></script>
    @endif

    @if(Request::is('vendor/order/create'))
        {{-- <script src="http://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&sensor=false"></script>
        <script src="{{ asset('js/order_map.js') }}"></script> --}}
        <script src="{{ asset('js/order.js') }}"></script>
    @endif

    @if (Request::is('admin/delivery_zone_area/*') || Request::is('vendor/deliveryZoneArea/*'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&callback=initMap&libraries=places&v=weekly" defer></script>
        <script src="{{ asset('js/delivery_person_map.js') }}"></script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="{{ asset('js/cleave.min.js') }}"></script>

    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.min.js"></script>

    <script src="{{ asset('js/cleave-phone.us.js') }}"></script>

    <script src="{{ asset('js/forms-advanced-forms.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
