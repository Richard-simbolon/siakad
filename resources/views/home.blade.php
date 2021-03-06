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
                                    <img src="{{asset('assets/images/mahasiswa').'/'.Auth::user()->id.'.jpg'}}" onError="this.onerror=null;this.src='{{asset('assets/media/users/default.jpg')}}'" alt="image">
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
                                            {{--<button type="button" class="btn btn-label-success btn-sm btn-upper"><i class="fa fa-edit"></i> Ubah</button>&nbsp;--}}
                                            <a href="{{url('data/mahasiswa/profile')}}" class="btn btn-label-success btn-sm btn-upper"><i class="fa fa-edit"></i> Ubah</a>&nbsp;
                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon-user"></i>{{$data['nim']}}</a>
                                        <a href="#"><i class="flaticon2-new-email"></i>{{$data['email']}}</a>
                                        <a href="#"><i class="flaticon2-calendar-3"></i>Kelas {{$data['kelas']}}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc" style="display: inline-block!important;width: 100%;">
                                            Angkatan : {{$data['angkatan']}} <br/> {{$data['jurusan']}} <br/>

                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $ip[2] == 0 ? 0 : ($total_sks_kurikulum / $ip[2])*100 }}%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <span class="kt-widget__title">IP Kumulatif</span>
                                        <span class="kt-widget__value">{{$ip[0]}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-customer"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">IP Semester</span>
                                        <span class="kt-widget__value">{{$ip[1]}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Total SKS</span>
                                        <span class="kt-widget__value">{{$total_sks_kurikulum}}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-time"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Sisa SKS</span>
                                        <span class="kt-widget__value">{{$total_sks_kurikulum - $ip[2]}}</span>
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


<style>
    .m-content{width:100%}
    </style>


@endsection

@section('js')
    <script src="{{asset('assets/js/pages/components/calendar/list-view.js')}}" type="text/javascript"></script>
@endsection


