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
                    <a href="#" class="btn btn-label-success"> Semester {{$semester['title']}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__media kt-hidden-">
                                    <img src="{{asset('assets/images/dosen').'/'.Auth::user()->id.'.jpg'}}" onError="this.onerror=null;this.src='{{asset('assets/media/users/default.jpg')}}'" alt="image">
                                </div>
                                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                                    JM
                                </div>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" class="kt-widget__username">
                                                {{ Auth::user()->nama }}
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                        <div class="kt-widget__action">
                                            <a href="{{url('data/dosen/profile')}}" class="btn btn-label-success btn-sm btn-upper"><i class="fa fa-edit"></i> Ubah</a>&nbsp;
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon-user"></i>{{$data['nidn_nup_nidk']}}</a>
                                        <a href="#"><i class="flaticon2-new-email"></i>{{$data['email']}}</a>
                                        <a href="#"><i class="flaticon2-calendar-3"></i>Status {{$data['status']}}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc" style="display: inline-block!important;width: 100%;">
                                            {{$data['tempat_lahir']}}, &nbsp; {{$data['tanggal_lahir']}} <br/> <br/>

                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 100%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-medal"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Jumlah Matakuliah</span>
                                        <span class="kt-widget__value">{{$matakuliah}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Jumlah SKS</span>
                                        <span class="kt-widget__value">{{$jumlah_sks}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-customer"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Jumlah Kelas</span>
                                        <span class="kt-widget__value">{{$kelas}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-time"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Jenis Pegawai</span>
                                        <span class="kt-widget__value">{{$data['nama_jenis_pegawai']}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile3-->
            </div>
        </div>

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
@endsection


