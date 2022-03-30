<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    @php
        $title = App\Models\GeneralSetting::find(1)->business_name;
        $favicon = App\Models\GeneralSetting::find(1)->favicon;
    @endphp

    <title>{{ $title }} | @yield('title','Admin login')</title>

    <link rel="icon" href="{{ url('images/upload/'.$favicon) }}" type="image/png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        @php
            $favicon = App\Models\GeneralSetting::find(1)->company_favicon;
            $icon = App\Models\GeneralSetting::find(1)->company_black_logo;
            $color = App\Models\GeneralSetting::find(1)->site_color;
            $color_secondary = App\Models\GeneralSetting::find(1)->color_secondary;
        @endphp
        <style>
            :root {
                --site_color: <?php echo $color; ?>;
                --color_secondary: <?php echo $color_secondary; ?>;
                --hover_color: <?php echo $color_secondary.'c7'; ?>;
            }
        </style>

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/components.css')}}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-8 col-12 col-md-6 order-lg-1 order-1 min-vh-100 background-walk-y overlay-gradient-bottom" data-background="{{ url('images/wall.jpg') }}" style="background-color: #23110f">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <!--<h1 class="mb-2 display-4 font-weight-bold">{{__("OGALOP COLIS")}}</br>{{__("ADMIN PANEL")}}</h1>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 pt-5 col-md-6 order-lg-2 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <div class="w-100 text-center">
                            <img src="{{ url('images/upload/'.$icon) }}" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                        </div>
                        <h4 class="text-dark mb-5 font-weight-normal" style="text-align: center;">{{__('Login to your admin panel')}}<br><span class="font-weight-bold">{{ $title }}</span>
                        </h4>
                        @if ($errors->any())
                        <div class="alert alert-primary alert-dismissible show fade">
                            <div class="alert-body">
                              <button class="close" data-dismiss="alert">
                                <span>×</span>
                              </button>
                              @foreach ($errors->all() as $item)
                                {{ $item }}
                              @endforeach
                            </div>
                          </div>
                        @endif
                        <form method="POST" action="{{ url('confirm_login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="username">{{__('Enter your username ')}}</label>
                                <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">{{__('Enter your password')}}</label>
                                    <div class="float-right">
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                tabindex="2" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{__('Login')}}
                                </button>
                            </div>

                            <!--<div class="form-group text-center">
                                <a href="{{ url('admin/forgot_password') }}" class="text-small text-center">
                                    {{__('Forgot Password?')}}
                                </a>
                            </div>
                            <div class="form-group text-center">
                                <a href="{{ url('vendor/login') }}">{{__('Vendor Login')}}</a>
                            </div>-->
                        </form>

                        
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ url('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ url('js/scripts.js') }}"></script>
    <script src="{{ url('js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
</body>

</html>
