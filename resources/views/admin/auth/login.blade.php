<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('dir') }}">
<head>

    <title>{{ getTransSetting('websit_title', app()->getLocale()) . ' - ' . trans('auth.sign_in') }}</title>

    <meta name="description" content="{{ getTransSetting('websit_description', app()->getLocale()) }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/main-teal.css') }}" media="all">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">

</head>
<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">

        <div class="logo">
            <h1>{{ getTransSetting('websit_title', app()->getLocale()) }}</h1>
        </div>{{-- logo --}}

        <div class="login-box">

            <form class="login-form" method="post" action="{{ route('admin.login.store') }}">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{ trans('auth.sign_in') }}</h3>

                    @csrf
                    @method('post')

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="control-label">@lang('auth.email')</label>
                        <input id="login" type="text" name="login" class="form-control @error('login') is-invalid @enderror" value="{{ old('login','super_admin@app.com') }}" required autofocus>
                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- password --}}
                    <div class="form-group">
                        <label class="control-label">@lang('auth.password')</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password','password') }}" required autofocus>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- remember me --}}
                    <div class="form-group">
                        <div class="utility">
                            <div class="animated-checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><span class="label-text">{{ trans('auth.remember_me') }}</span>
                                </label>
                            </div>
                            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">{{ trans('auth.forgot_password') }}</a></p>
                        </div>{{-- utility --}}
                    </div>{{-- form-group --}}

                    {{-- button --}}
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>{{ trans('auth.sign_in') }}</button>
                    </div>{{-- form-group btn-container --}}

            </form>{{-- login-form --}}

            <form class="forget-form" action="#">

                @csrf
                @method('post')

                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>{{ trans('auth.forgot_password') }}</h3>

                {{-- email --}}
                <div class="form-group">
                    <label class="control-label">{{ trans('auth.email') }}</label>
                    <input class="form-control" type="text" placeholder="{{ trans('auth.email') }}">
                </div>

                {{-- button --}}
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>{{ trans('auth.reset') }}</button>
                </div>

                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>{{ trans('auth.back_login') }}</a></p>
                </div>

            </form>{{-- forget-form --}}

        </div>{{-- login-box --}}

    </section>{{-- login-content --}}

    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('admin_assets/js/plugins/pace.min.js') }}"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });
    </script>

</body>
</html>
