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
                                            Jurusan
                                        </h3>
                                        <span class="kt-widget14__desc">
                                            Grafik jumlah mahasiswa perjurusan
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
    </style>


@endsection

@section('js')
    <script src="{{asset('assets/js/pages/components/calendar/list-view.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/general/raphael/raphael.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/general/morris.js/morris.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/pages/admin/chart.js')}}" type="text/javascript" ></script>
@endsection


