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
                                                <span class="kt-widget14__stats">Total 12.000</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                <span class="kt-widget14__stats">+10% Laki-laki</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                <span class="kt-widget14__stats">-7% Perempuan</span>
                                            </div>
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
                                                <span class="kt-widget14__stats">Total 12.000</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                <span class="kt-widget14__stats">+10% Laki-laki</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                <span class="kt-widget14__stats">-7% Perempuan</span>
                                            </div>
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
                                                <span class="kt-widget14__stats">Total 12.000</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                <span class="kt-widget14__stats">+10% Laki-laki</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                <span class="kt-widget14__stats">-7% Perempuan</span>
                                            </div>
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
                                                <span class="kt-widget14__stats">Total 12.000</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                <span class="kt-widget14__stats">+10% Laki-laki</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                <span class="kt-widget14__stats">-7% Perempuan</span>
                                            </div>
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
                                                <span class="kt-widget14__stats">Total 12.000</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                <span class="kt-widget14__stats">+10% Laki-laki</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                <span class="kt-widget14__stats">-7% Perempuan</span>
                                            </div>
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
                                                <span class="kt-widget14__stats">Total 12.000</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                <span class="kt-widget14__stats">+10% Laki-laki</span>
                                            </div>
                                            <div class="kt-widget14__legend">
                                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                <span class="kt-widget14__stats">-7% Perempuan</span>
                                            </div>
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

    <!--modal : ubah hapus-->
    <div class="modal fade" id="kt_modal_kalender" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kalender Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="title"></h5>
                    <small id="tanggal">

                    </small>
                    <div style="margin-top: 15px;">
                        <p>Keterangan :</p>
                        <p id="keterangan"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!--end modal-->

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


