@extends('layouts.app')

@section('content')

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{url('assets/media/bg/bg-3-3.png')}});background-size: cover">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container" style="max-width: 550px!important;">
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
                                <div class="col-sm-12 icon">
                                    <div class="menu-desktop row row-icon" style="padding-top: 100px;">
                                        <div class="col-sm-4">
                                            <div class="icon-akademik" style="width: 100%;text-align: left;">
                                                <a href="/login/akademik">
                                                    <img src="{{url('assets/logo/akademik.png')}}" width="90%" style="max-width: 100px">
                                                </a>
                                            </div>
                                            <div class="text-desktop">
                                                <div style="width: 100%;text-align: left;padding-top: 20px;padding-left:15px;color: #00ac8e;">
                                                    <p><b>Akademik</b></p>
                                                </div>
                                                <div style="width: 70%;height:1px;max-width:100px;background-image: linear-gradient(to right, #fafafa, #00ac8e , #fafafa);margin-bottom: 5px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="icon-dosen" style="width: 100%;text-align: center;">
                                                <a href="/login/dosen">
                                                    <img src="{{url('assets/logo/lecture.png')}}" width="90%" style="max-width: 100px">
                                                </a>
                                            </div>
                                            <div style="width: 100%;text-align: center;padding-top: 20px;color: #00ac8e;">
                                                <p><b>Dosen</b></p>
                                            </div>
                                            <div style="width: 70%;margin:auto;height:1px;max-width:100px;background-image: linear-gradient(to right, #fafafa, #00ac8e , #fafafa);margin-bottom: 15px;"></div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="icon-mahasiswa" style="width: 100%;text-align: right;">
                                                <a href="/login/mahasiswa">
                                                    <img src="{{url('assets/logo/graduation.png')}}" width="90%" style="max-width: 100px" >
                                                </a>
                                            </div>
                                            <div class="text-desktop">
                                                <div style="width: 100%;text-align: right;padding-right:15px;padding-top: 20px;color: #00ac8e;">
                                                    <p><b>Mahasiswa</b></p>
                                                </div>
                                                <div style="width: 70%;float:right;height:1px;max-width:100px;background-image: linear-gradient(to right, #fafafa, #00ac8e, #fafafa);margin-bottom: 5px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-mobile" style="display: none">
                                        <div style="width: 33.3%;float:left;text-align: center;">
                                            <a href="/login/dosen">
                                                <img src="{{url('assets/logo/akademik.png')}}" width="90%" style="max-width: 100px"><br/>
                                                <div style="width: 100%;text-align: center;padding-top: 20px;color: #00ac8e;">
                                                    <p><b>Akademik</b></p>
                                                </div>
                                            </a>
                                        </div>
                                        <div style="width: 33.3%;float:left;text-align: center;">
                                            <a href="/login/dosen">
                                                <img src="{{url('assets/logo/lecture.png')}}" width="90%" style="max-width: 100px"><br/>
                                                <div style="width: 100%;text-align: center;padding-top: 20px;color: #00ac8e;">
                                                    <p><b>Dosen</b></p>
                                                </div>
                                            </a>
                                        </div>
                                        <div style="width: 33.3%;float:left;text-align: center;">
                                            <a href="/login/mahasiswa">
                                                <img src="{{url('assets/logo/graduation.png')}}" width="90%" style="max-width: 100px" ><br/>
                                                <div style="width: 100%;text-align: center;padding-top: 20px;color: #00ac8e;">
                                                    <p><b>Mahasiswa</b></p>
                                                </div>
                                            </a>
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
        @media only screen and (max-width: 600px) {
            .icon-akademik {
                text-align: center!important;
            }
            .icon-dosen {
                text-align: center!important;
            }
            .icon-mahasiswa{
                text-align: center!important;
            }
            .row-icon{
                padding-top: 0px!important;
            }
            .menu-desktop{
                display: none;
            }
            .menu-mobile{
                display: block!important;
                width: 90%;
                margin: auto;
                margin-top:100px;
            }
            .icon img{
                width: 80px!important;
            }
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
