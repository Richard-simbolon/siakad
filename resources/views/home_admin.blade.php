@extends('layout.app')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Dashboard</h3>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn btn-label-success"> Semester 2019/2020 Genap</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-xl-3">
                            <!--begin:: Widgets/Daily Sales-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14" style="position: relative;">
                                    <div class="kt-widget14__header">
                                        <div style="float: left;width: 65%">
                                            <h3 class="kt-widget14__title">
                                                <span class="dot-online"></span> Mahasiswa
                                            </h3>
                                            <span class="kt-widget14__desc">
                                                Jumlah mahasiswa sedang online
                                            </span>
                                        </div>
                                        <div style="float: left;width: 35%;text-align: center;position: relative">
                                            <h1>{{$data_login['mahasiswa_online']}}</h1>
                                        </div>
                                    </div>
                                    <div style="position: absolute;bottom: 5px;right: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M18.5,6 C19.3284271,6 20,6.67157288 20,7.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 C17.6715729,20 17,19.3284271 17,18.5 L17,7.5 C17,6.67157288 17.6715729,6 18.5,6 Z M12.5,11 C13.3284271,11 14,11.6715729 14,12.5 L14,18.5 C14,19.3284271 13.3284271,20 12.5,20 C11.6715729,20 11,19.3284271 11,18.5 L11,12.5 C11,11.6715729 11.6715729,11 12.5,11 Z M6.5,15 C7.32842712,15 8,15.6715729 8,16.5 L8,18.5 C8,19.3284271 7.32842712,20 6.5,20 C5.67157288,20 5,19.3284271 5,18.5 L5,16.5 C5,15.6715729 5.67157288,15 6.5,15 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Daily Sales-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin:: Widgets/Daily Sales-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14" style="position: relative;">
                                    <div class="kt-widget14__header">
                                        <div style="float: left;width: 65%">
                                            <h3 class="kt-widget14__title">
                                                <span class="dot-online"></span> Dosen
                                            </h3>
                                            <span class="kt-widget14__desc">
                                            Jumlah dosen sedang online
                                        </span>
                                        </div>
                                        <div style="float: left;width: 35%;text-align: center">
                                            <h1>{{$data_login['dosen_online']}}</h1>
                                        </div>
                                    </div>
                                    <div style="position: absolute;bottom: 5px;right: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M18.5,6 C19.3284271,6 20,6.67157288 20,7.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 C17.6715729,20 17,19.3284271 17,18.5 L17,7.5 C17,6.67157288 17.6715729,6 18.5,6 Z M12.5,11 C13.3284271,11 14,11.6715729 14,12.5 L14,18.5 C14,19.3284271 13.3284271,20 12.5,20 C11.6715729,20 11,19.3284271 11,18.5 L11,12.5 C11,11.6715729 11.6715729,11 12.5,11 Z M6.5,15 C7.32842712,15 8,15.6715729 8,16.5 L8,18.5 C8,19.3284271 7.32842712,20 6.5,20 C5.67157288,20 5,19.3284271 5,18.5 L5,16.5 C5,15.6715729 5.67157288,15 6.5,15 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Profit Share-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin:: Widgets/Daily Sales-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14" style="position: relative;">
                                    <div class="kt-widget14__header">
                                        <div style="float: left;width: 65%">
                                            <h3 class="kt-widget14__title">
                                                <span class="dot-visitor"></span> Visitor Hari Ini
                                            </h3>
                                            <span class="kt-widget14__desc">
                                                Dosen : {{$data_login['mahasiswa_online_today']}}<br/>
                                                Mahasiswa : {{$data_login['dosen_online_today']}}
                                        </span>
                                        </div>
                                        <div style="float: left;width: 35%;text-align: center">
                                            <h1>{{$data_login['mahasiswa_online_today'] + $data_login['dosen_online_today']}}</h1>
                                        </div>
                                    </div>
                                    <div style="position: absolute;bottom: 5px;right: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="4" width="3" height="13" rx="1.5"/>
                                                <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                                                <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                                <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Revenue Change-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin:: Widgets/Daily Sales-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14" style="position: relative;">
                                    <div class="kt-widget14__header">
                                        <div style="float: left;width: 65%">
                                            <h3 class="kt-widget14__title">
                                                <span class="dot-visitor"></span> Total Visitor
                                            </h3>
                                            <span class="kt-widget14__desc">
                                                Dosen : {{$data_login['mahasiswa_total_visit']}} <br/>
                                                Mahasiswa : {{$data_login['dosen_total_visit']}}
                                        </span>
                                        </div>
                                        <div style="float: left;width: 35%;text-align: center">
                                            <h1>{{$data_login['mahasiswa_total_visit'] + $data_login['dosen_total_visit']}}</h1>
                                        </div>
                                    </div>
                                    <div style="position: absolute;bottom: 5px;right: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="4" width="3" height="13" rx="1.5"/>
                                                <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                                                <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                                <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Revenue Change-->
                        </div>
                    </div>
                </div>

            </div>

            <!--Begin::Section-->
            <div class="kt-portlet">
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Daily Sales-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Mahasiswa
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah mahasiswa
                                        </span>
                                    </div>
                                    <div class="kt-widget14__content">
                                        <div class="kt-widget14__chart">
                                            <div id="kt_chart_grafik_jumlah_mahasiswa" style="height: 150px; width: 150px;"></div>
                                        </div>
                                        <div class="kt-widget14__legends">
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-primary"></span>
                                                <span class="kt-widget14__stats" id="totalJumlahMahasiswa">0</span>
                                            </div>
                                            <div id="sectionDataJumlahMahasiswa"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Daily Sales-->
                        </div>
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Profit Share-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Program Studi
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah mahasiswa program studi
                                        </span>
                                    </div>
                                    <div class="kt-widget14__content">
                                        <div class="kt-widget14__chart">
                                            <div id="kt_chart_grafik_jumlah_mahasiswa_jurusan" style="height: 150px; width: 150px;"></div>
                                        </div>
                                        <div class="kt-widget14__legends">
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-primary"></span>
                                                <span class="kt-widget14__stats" id="totalJumlahMahasiswaJurusan"></span>
                                            </div>
                                            <div id="sectionDataJumlahMahasiswaJurusan"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Profit Share-->
                        </div>
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Revenue Change-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Status
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah mahasiswa berdasarkan status
                                        </span>
                                    </div>
                                    <div class="kt-widget14__content">
                                        <div class="kt-widget14__chart">
                                            <div id="kt_chart_grafik_jumlah_mahasiswa_status" style="height: 150px; width: 150px;"></div>
                                        </div>
                                        <div class="kt-widget14__legends">
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-primary"></span>
                                                <span class="kt-widget14__stats" id="totalJumlahMahasiswaStatus"></span>
                                            </div>
                                            <div id="sectionDataJumlahMahasiswaStatus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Revenue Change-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet">
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-xl-4">
                            <!--begin:: Widgets/Daily Sales-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Dosen
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah dosen
                                        </span>
                                    </div>
                                    <div class="kt-widget14__content">
                                        <div class="kt-widget14__chart">
                                            <div id="kt_chart_grafik_jumlah_dosen" style="height: 150px; width: 150px;"></div>
                                        </div>
                                        <div class="kt-widget14__legends">
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-primary"></span>
                                                <span class="kt-widget14__stats" id="totalJumlahDosen">0</span>
                                            </div>
                                            <div id="sectionDataJumlahDosen"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Daily Sales-->
                        </div>

                        <div class="col-xl-4">
                            <!--begin:: Widgets/Profit Share-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Jenis Dosen
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah berdasarkan jenis dosen
                                        </span>
                                    </div>
                                    <div class="kt-widget14__content">
                                        <div class="kt-widget14__chart">
                                            <div id="kt_chart_grafik_jumlah_dosen_jenis" style="height: 150px; width: 150px;"></div>
                                        </div>
                                        <div class="kt-widget14__legends">
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-primary"></span>
                                                <span class="kt-widget14__stats" id="totalJumlahDosenJenis">0</span>
                                            </div>
                                            <div id="sectionDataJumlahDosenJenis"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Profit Share-->
                        </div>
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Revenue Change-->
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-widget14">
                                    <div class="kt-widget14__header">
                                        <h3 class="kt-widget14__title">
                                            Status
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah dosen
                                        </span>
                                    </div>
                                    <div class="kt-widget14__content">
                                        <div class="kt-widget14__chart">
                                            <div id="kt_chart_grafik_jumlah_dosen_status" style="height: 150px; width: 150px;"></div>
                                        </div>
                                        <div class="kt-widget14__legends">
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-primary"></span>
                                                <span class="kt-widget14__stats" id="totalJumlahDosenStatus">0</span>
                                            </div>
                                            <div id="sectionDataJumlahDosenStatus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Revenue Change-->
                        </div>
                    </div>
                </div>
            </div>
            <!--End::Section-->

            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-widget kt-widget--project-1">
                                <div class="kt-widget__head d-flex">
                                    <div id="kt_calendar" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Portlet-->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>


    <style>
        .m-content{width:100%}
        .swal2-image{
            margin:0!important;
        }
        .dot {
            height: 12px;
            width: 12px;
            margin-right: 5px;
            background-color: #fff;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-online {
            height: 12px;
            width: 12px;
            margin-right: 5px;
            background-color: #85ff00;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-visitor {
            height: 12px;
            width: 12px;
            margin-right: 5px;
            background-color: #009688;
            border-radius: 50%;
            display: inline-block;
        }
        @keyframes blink {
            to {
                visibility: hidden;
            }
        }
        @-webkit-keyframes blink {
            to {
                visibility: hidden;
            }
        }
    </style>


@endsection

@section('js')
    <script src="{{asset('assets/js/pages/components/calendar/list-view.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/general/raphael/raphael.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/general/morris.js/morris.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/pages/admin/chart.js')}}" type="text/javascript" ></script>
@endsection


