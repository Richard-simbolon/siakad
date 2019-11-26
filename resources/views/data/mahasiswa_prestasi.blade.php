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
                                        <h3 class="kt-portlet__head-title">Prestasi <small>formulir perubahan data prestasi mahasiswa</small></h3>
                                    </div>
                                </div>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    {{--<label class="col-xl-3"></label>--}}
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h4 class="kt-section__title kt-section__title-sm">Daftar prestasi : </h4>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" id="id" value="{{$data['id']}}">
                                                <table class="dataTable table table-striped table-bordered table-sm responsive no-wrap general-data-table" id="tbl_mhs_prestasi">
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Prestasi</th>
                                                        <th>Nama</th>
                                                        <th>Tahun</th>
                                                        <th>Penyelenggara</th>
                                                        <th>Peringkat</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                {{--<div class="col-lg-3 col-xl-3">--}}
                                                {{--</div>--}}
                                                <div class="col-lg-9 col-xl-9">
                                                    <button type="button" id="btn_add_prestasi" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--modal : add prestasi-->
                    <div class="modal fade" id="kt_modal_prestasi" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Prestasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form_prestasi">
                                        <div class="row">
                                            <input type="hidden" name="mahasiswa_id" value="{{$data['id']}}">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Jenis Prestasi</label>
                                                    <select name="jenis_prestasi" class="form-control">
                                                        <option value="">-- Pilih Jenis Prestasi --</option>
                                                        <option value="Sains">Sains</option>
                                                        <option value="Seni">Seni</option>
                                                        <option value="Olahraga">Olahraga</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tingkat Prestasi</label>
                                                    <select name="tingkat_prestasi" class="form-control">
                                                        <option value="">-- Pilih Tingkat Prestasi --</option>
                                                        <option value="Sekolah">Sekolah</option>
                                                        <option value="Kecamatan">Kecamatan</option>
                                                        <option value="Kabupaten / Kota">Kabupaten / Kota</option>
                                                        <option value="Propinsi">Propinsi</option>
                                                        <option value="Nasional">Nasional</option>
                                                        <option value="International">International</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Prestasi:</label>
                                                    <textarea class="form-control" name="nama_prestasi" placeholder="Isi nama prestasi"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Tahun</label>
                                                    <input type="text" class="form-control" name="tahun" placeholder="Isikan Tahun">
                                                </div>
                                                <div class="form-group">
                                                    <label>Penyelenggara</label>
                                                    <input type="text" class="form-control" name="penyelenggara" placeholder="Isikan Penyelenggara">
                                                </div>
                                                <div class="form-group">
                                                    <label>Peringkat</label>
                                                    <input type="text" class="form-control" name="peringkat" placeholder="Isikan Peringkat">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="btn_simpan_prestasi">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end modal-->

                    <!--modal : add prestasi-->
                    <div class="modal fade" id="kt_modal_edit_prestasi" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Prestasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form_prestasi">
                                        <div class="row">
                                            <input type="hidden" name="id">
                                            <input type="hidden" name="mahasiswa_id" value="{{$data['id']}}">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Jenis Prestasi</label>
                                                    <select id="jenis_prestasi" name="jenis_prestasi" class="form-control">
                                                        <option value="">-- Pilih Jenis Prestasi --</option>
                                                        <option value="Sains">Sains</option>
                                                        <option value="Seni">Seni</option>
                                                        <option value="Olahraga">Olahraga</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tingkat Prestasi</label>
                                                    <select id="tingkat_prestasi" name="tingkat_prestasi" class="form-control">
                                                        <option value="">-- Pilih Tingkat Prestasi --</option>
                                                        <option value="Sekolah">Sekolah</option>
                                                        <option value="Kecamatan">Kecamatan</option>
                                                        <option value="Kabupaten / Kota">Kabupaten / Kota</option>
                                                        <option value="Propinsi">Propinsi</option>
                                                        <option value="Nasional">Nasional</option>
                                                        <option value="International">International</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Prestasi:</label>
                                                    <textarea class="form-control" id="nama_prestasi" name="nama_prestasi" placeholder="Isi nama prestasi"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Tahun</label>
                                                    <input type="text" id="tahun" class="form-control" name="tahun" placeholder="Isikan Tahun">
                                                </div>
                                                <div class="form-group">
                                                    <label>Penyelenggara</label>
                                                    <input type="text" id="penyelenggara" class="form-control" name="penyelenggara" placeholder="Isikan Penyelenggara">
                                                </div>
                                                <div class="form-group">
                                                    <label>Peringkat</label>
                                                    <input type="text" id="peringkat" class="form-control" name="peringkat" placeholder="Isikan Peringkat">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="btn_edit_prestasi">Simpan</button>
                                    <button type="button" class="btn btn-danger" id="btn_hapus_prestasi">Hapus</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end modal-->

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
