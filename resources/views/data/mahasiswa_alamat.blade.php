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
                                Alamat
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
                                        <h3 class="kt-portlet__head-title">Alamat <small>formulir perubahan data alamat mahasiswa</small></h3>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <input type="hidden" name="id" value="{{$data['id']}}">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">NISN</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="nisn" value="{{$data['nisn']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kewarganegaraan</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="kewarganegaraan" value="{{$data['kewarganegaraan']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Alamat</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <textarea class="form-control" type="text" name="alamat" rows="3">{{$data['alamat']}}</textarea>
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
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kode Pos</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="kode_pos" value="{{$data['kode_pos']}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Jenis Tinggal</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <select name="jenis_tinggal" class="form-control kt-select2">
                                                                <option value="">Select</option>
                                                                @foreach ($master['jenis_tinggal'] as $item)
                                                                    <option value="{{$item['id']}}" {{$item['id'] == $data['jenis_tinggal'] ? "selected" : ""}}> {{$item['title']}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Alat Transpostrasi</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="input-group">
                                                            <select name="alat_transportasi" class="form-control kt-select2">
                                                                <option value="">Select</option>
                                                                @foreach ($master['alat_transportasi'] as $item)
                                                                    <option value="{{$item['id']}}" {{$item['id'] == $data['alat_transportasi'] ? "selected" : ""}}> {{$item['title']}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Penerima KPS?</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <div class="kt-checkbox-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="is_penerima_kps" value="{{$data['is_penerima_kps']}}" {{$data['is_penerima_kps']=='1' ? 'checked':''}}> Ya
                                                                <span></span>
                                                            </label> &nbsp;
                                                            <label class="kt-radio">
                                                                <input type="radio" name="is_penerima_kps" value="{{$data['is_penerima_kps']}}" {{$data['is_penerima_kps']=='0' ? 'checked' :''}}> Tidak
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">NO KPS</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="no_kps" value="{{$data['no_kps']}}">
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
                                                    <button type="button" id="btn_edit_alamat" class="btn btn-outline-success"><i class="fa fa-save"></i> Simpan Perubahan</button>&nbsp;
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
