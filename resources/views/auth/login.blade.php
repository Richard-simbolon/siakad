@extends('layouts.app')

@section('content')

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{url('assets/media/bg/bg-3-3.png')}});background-size: cover">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container" style="width: 550px!important;">


                        <div class="kt-login__signin">
                            <div class="kt-login__logo" style="margin:0;">
                                <a href="#">
                                    <img src="{{url('assets/logo/logopolbangtan.png')}}" width="100px">
                                </a>
                            </div>
                            <div class="kt-login__head">
                                <h3 class="kt-login__title" style="font-size: 14pt!important;">SIAPDUDIK <br/> (Sistem Aplikasi Terpadu Pendidikan)</h3>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 icon">
                                    <div class="row" style="padding-top: 100px;">
                                        <div class="col-xl-4">
                                            <div style="width: 100%;text-align: left;">
                                                <a href="/login/akademik">
                                                    <img src="{{url('assets/logo/akademik.png')}}" width="90%" style="max-width: 100px">
                                                </a>
                                            </div>
                                            <div style="width: 100%;text-align: left;padding-top: 20px;color: #00ac8e;">
                                                <p><b>Administrator</b></p>
                                            </div>
                                            <div style="width: 70%;height:1px;max-width:100px;background-image: linear-gradient(to right, #fafafa, #00ac8e , #fafafa);margin-bottom: 5px;"></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div style="width: 100%;text-align: center;">
                                                <a href="/login/dosen">
                                                    <img src="{{url('assets/logo/lecture.png')}}" width="90%" style="max-width: 100px">
                                                </a>
                                            </div>
                                            <div style="width: 100%;text-align: center;padding-top: 20px;color: #00ac8e;">
                                                <p><b>Dosen</b></p>
                                            </div>
                                            <div style="width: 70%;margin:auto;height:1px;max-width:100px;background-image: linear-gradient(to right, #fafafa, #00ac8e , #fafafa);margin-bottom: 5px;"></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div style="width: 100%;text-align: right;">
                                                <a href="/login/mahasiswa">
                                                    <img src="{{url('assets/logo/graduation.png')}}" width="90%" style="max-width: 100px" >
                                                </a>
                                            </div>
                                            <div style="width: 100%;text-align: right;padding-right:15px;padding-top: 20px;color: #00ac8e;">
                                                <p><b>Mahasiswa</b></p>
                                            </div>
                                            <div style="width: 70%;float:right;height:1px;max-width:100px;background-image: linear-gradient(to right, #fafafa, #00ac8e, #fafafa);margin-bottom: 5px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <style>
        .icon img:hover{
            border: 4px solid #cef3d0;
            border-radius: 50%;
        }
    </style>
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
