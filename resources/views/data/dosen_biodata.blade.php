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
                            Dosen </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="" class="kt-subheader__breadcrumbs-link">
                                Biodata
                            </a>
                        </div>
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
                                @include('layout.dosen_profile')
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
                                        <h3 class="kt-portlet__head-title">Biodata <small>formulir perubahan data dosen</small></h3>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <input type="hidden" name="id" value="{{$data['id']}}">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">NIP</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="nama" value="{{$data['nip']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">NPWP</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="nama" value="{{$data['npwp']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Ikatan Kerja</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="ikatan_kerja" value="{{$data['ikatan_kerja']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Status Pegawai</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="status_pegawai" value="{{$data['status_pegawai']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Jenis Pegawai</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="jenis_pegawai" value="{{$data['jenis_pegawai']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">No SK CPNS</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="no_sk_cpns" value="{{$data['no_sk_cpns']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal SK CPNS</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="date" name="tanggal_sk_cpns" value="{{$data['tanggal_sk_cpns']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">No SK Pengangkatan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="no_sk_pengangkatan" value="{{$data['no_sk_pengangkatan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal SK Pengangkatan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="date" name="no_sk_pengangkatan" value="{{$data['no_sk_pengangkatan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Lembaga Pengangkatan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="lembaga_pengangkatan" value="{{$data['lembaga_pengangkatan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Pangkat Golongan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="pangkat_golongan" value="{{$data['pangkat_golongan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Sumber Gaji</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="sumber_gaji" value="{{$data['sumber_gaji']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Alamat</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <textarea class="form-control" type="text" name="alamat">{{$data['alamat']}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Dusun</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="dusun" value="{{$data['dusun']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">RT</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="rt" value="{{$data['rt']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">RW</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="rw" value="{{$data['rw']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kelurahan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="kelurahan" value="{{$data['kelurahan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kecamatan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="kecamatan" value="{{$data['kecamatan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kode Pos</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="kode_pos" value="{{$data['kode_pos']}}">
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
                                                    <button type="button" id="btn_edit_profile" class="btn btn-success">Ubah</button>&nbsp;
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
    <script src="{{asset('/assets/js/pages/profile/dosen.js')}}" type="text/javascript"></script>
@stop

@endsection
