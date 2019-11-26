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
                                Profil Saya
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
                                        <h3 class="kt-portlet__head-title">Informasi Pribadi <small>formulir perubahan data dosen</small></h3>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right" enctype="multipart/form-data">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                    <div class="form-group row">
                                                        <input type="hidden" name="id" value="{{$data['id']}}">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                                                <div class="kt-avatar__holder" style="background-image: url({{asset('assets/images/dosen').'/'.Auth::user()->id.'.jpg'}})"></div>
                                                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ganti photo">
                                                                    <i class="fa fa-pen"></i>
                                                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                                                    <input type="hidden" name="file_upload" id="profile_mhs">
                                                                </label>
                                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Batalkan">
                                                                    <i class="fa fa-times"></i>
                                                                </span>
    
                                                                
                                                            </div>
                                                            <div class="kt-widget__action">
                                                                <button type="button" id="button_upload" style="display:none;" class="btn btn-success btn-sm">upload</button>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">NIK</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="nik" value="{{$data['nik']}}">
                                                        <span class="form-text text-muted">Isi sesuai dengan KTP</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nama Lengkap</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="nama" value="{{$data['nama']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nama Ibu</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="nama_ibu" value="{{$data['nama_ibu']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tempat lahir</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="tempat_lahir" value="{{$data['tempat_lahir']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Lahir</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="date" name="tanggal_lahir" value="{{$data['tanggal_lahir']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Agama</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <select name="agama" class="form-control kt-select2">
                                                                <option value="">Select</option>
                                                                @foreach ($master['agama'] as $item)
                                                                    <option value="{{$item['id']}}" {{$item['id'] == $data['agama'] ? "selected" : ""}}> {{$item['title']}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="jenis_kelamin" value="{{$data['jenis_kelamin']}}" {{$data['jenis_kelamin']=='laki-laki' ? 'checked':''}}> Laki-laki
                                                                <span></span>
                                                            </label> &nbsp;
                                                            <label class="kt-radio">
                                                                <input type="radio" name="jenis_kelamin" value="{{$data['jenis_kelamin']}}" {{$data['jenis_kelamin']=='perempuan' ? 'checked' :''}}> Perempuan
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">No Handphone</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                            <input type="text" class="form-control" name="no_hp" value="{{$data['no_hp']}}" placeholder="Isi Nomor Handphone" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Alamat Email</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                            <input type="text" class="form-control" name="email" value="{{$data['email']}}" placeholder="Email" aria-describedby="basic-addon1">
                                                        </div>
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
