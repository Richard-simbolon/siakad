@extends('layouts.app')

@section('content')

    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{url('assets/media/bg/bg-3-3.png')}});background-size: cover;">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="{{url('assets/logo/logopolbangtan.png')}}" width="100px">
                            </a>
                        </div>

                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">SIAPDUDIK <br/> (Sistem Aplikasi Terpadu Pendidikan)</h3>
                            </div>

                            <form class="kt-form" method="POST" action="{{ route('login') }}" autocomplete="off">
                                @csrf
                                <input type="hidden" name="login_type_role" value="admin">
                                <div class="row kt-login__extra text-center" style="display: block;text-align: center">
                                    <p style="font-size: 11pt;">Anda akan login sebagai <u>Akademik</u></p>
                                </div>
                                <div class="input-group">
                                    <input id="login" placeholder="User Login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required  autofocus autocomplete="ofadfadf">
                                    @error('login')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="kt-login__actions">
                                    <button style="width: 150px"  type="submit" class="btn btn-outline-success kt-login__btn-success">{{ __('Masuk') }} <i class="fa fa-arrow-right"></i> </button>
                                </div>

                                <div class="row kt-login__extra text-center" style="display: block;text-align: center">
                                    Kembali ke <a href="{{url('login')}}"><u>Beranda</u></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <script src="{{url('assets/plugins/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>

    <script src="{{url('assets/js/pages/custom/login/login-general.js')}}" type="text/javascript"></script>

    <!--end::Page Scripts -->
    </body>
@endsection
