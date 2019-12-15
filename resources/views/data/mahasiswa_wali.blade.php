@extends('layout.app')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
                            Mahasiswa </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="" class="kt-subheader__breadcrumbs-link">
                                Data Orangtua
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
                <!--Begin:: App Aside Mobile Toggle-->
                <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                    <i class="la la-close"></i>
                </button>

                <!--End:: App Aside Mobile Toggle-->

                <!--Begin:: App Aside-->
                <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

                    <!--begin:: Widgets/Applications/User/Profile1-->
                    <div class="kt-portlet kt-portlet--height-fluid-">
                        <div class="kt-portlet__head  kt-portlet__head--noborder">
                            <div class="kt-portlet__head-label"></div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit-y">

                            <!--begin::Widget -->
                            @include('layout.mahasiswa_profile')
                            <!--end::Widget -->

                        </div>
                    </div>

                    <!--end:: Widgets/Applications/User/Profile1-->
                </div>

                <!--End:: App Aside-->

                <!--Begin:: App Content-->
                <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">Alamat <small>formulir perubahan data wali mahasiswa</small></h3>
                                    </div>
                                </div>
                                <?php
                                $otw = [];
                                foreach($orangtuawali as $value){
                                    $otw[$value['kategori']] = $value;
                                }
                                ?>
                                <form class="kt-form kt-form--label-right">
                                    <input type="hidden" class="form-control" name="mahasiswa_orang_tua_wali[wali][id]" value="{{$otw['wali']['id']}}">
                                    <input type="hidden" class="form-control" name="mahasiswa_id" value="{{$otw['wali']['mahasiswa_id']}}">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nama</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[wali][nama]" placeholder="Isikan Nama" value="{{$otw['wali']['nama']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Lahir</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[wali][tanggal_lahir]" placeholder="Isikan Tanggal Lahir" value="{{$otw['wali']['tanggal_lahir']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pendidikan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select name="mahasiswa_orang_tua_wali[wali][pendidikan_id]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jenjang --</option>
                                                            @foreach ($master['pendidikan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id'] == $otw['wali']['pendidikan_id'] ? 'selected' : ''}}>{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pekerjaan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select name="mahasiswa_orang_tua_wali[wali][pekerjaan_id]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            @foreach ($master['pekerjaan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id'] == $otw['wali']['pekerjaan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Penghasilan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select name="mahasiswa_orang_tua_wali[wali][penghasilan]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Penghasilan --</option>
                                                            @foreach ($master['penghasilan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id'] == $otw['wali']['penghasilan'] ? 'selected' : ''}}>{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3">
                                                </div>
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="button" id="btn_edit_wali" class="btn btn-outline-success"><i class="fa fa-save"></i> Simpan Perubahan</button>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--End:: App Content-->
            </div>
        </div>
        <!-- end:: Content -->
    </div>

@section('js')
    <script src="{{asset('/assets/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/js/pages/profile/mahasiswa.js')}}" type="text/javascript"></script>
@stop

@endsection
