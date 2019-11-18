@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Flaticon </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Components </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Icons </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Flaticon </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <div class="kt-portlet__head-toolbar">
                        <a href="#" class="btn btn-label-success btn-sm btn-bold dropdown-toggle" data-toggle="dropdown">
                            <i class="kt-nav__link-icon flaticon2-layers-2"></i> Menu Lainnya
                        </a>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-user"></i>
                                        <span class="kt-nav__link-text">Detail Mahasiswa</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-digital-marketing"></i>
                                        <span class="kt-nav__link-text">KRS</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                        <span class="kt-nav__link-text">History Nilai</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-cardiogram"></i>
                                        <span class="kt-nav__link-text">Aktivitas Perkuliahan</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-indent-dots"></i>
                                        <span class="kt-nav__link-text">Prestasi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <span class="kt-menu__link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                            </span> &nbsp;
                            <h3 class="kt-portlet__head-title">
                                Data Mahasiswa
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Pilihan Aksi
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                    <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                                    <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                </g>
                                            </svg>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link" id="editmahasiswa">
                                                <i class="kt-nav__link-icon flaticon-edit"></i>
                                                <span class="kt-nav__link-text">Ubah Data</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_ubah_status">
                                                <i class="kt-nav__link-icon flaticon2-contract"></i>
                                                <span class="kt-nav__link-text">Ubah Status</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_reset_password">
                                                <i class="kt-nav__link-icon flaticon2-refresh"></i>
                                                <span class="kt-nav__link-text">Reset Password</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link"  data-toggle="modal" data-target="#kt_modal_hapus_data">
                                                <i class="kt-nav__link-icon flaticon-delete"></i>
                                                <span class="kt-nav__link-text">Hapus</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="fkt-form" >
                        <div class="kt-portlet__body">
                            <div class="kt-portlet kt-portlet--tabs">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active kt-font-bold" data-toggle="tab" href="#info_dasar" role="tab">
                                                    <i class="flaticon2-information"></i> Informasi Dasar
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-pane">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <table cellpadding="5">
                                                    <tr>
                                                        <td width="107px">Nama</td>
                                                        <td>:</td>
                                                        <td><b>{{$data['nama']}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td><b>{{ucfirst($data['jk'])}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>:</td>
                                                        <td><b>{{$data['status_mhs']}}</b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-lg-3">
                                                <table cellpadding="5">
                                                    <tr>
                                                        <td>NIM</td>
                                                        <td>:</td>
                                                        <td><b>{{$data['nim']}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Lahir</td>
                                                        <td>:</td>
                                                        <td><b>{{$data['tempat_lahir']}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Angkatan</td>
                                                        <td>:</td>
                                                        <td><b>{{$data['angkatan_title']}}</b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-lg-5">
                                                <table cellpadding="5">
                                                    <tr>
                                                        <td>Jurusan</td>
                                                        <td>:</td>
                                                        <td><b>{{$data['title']}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>:</td>
                                                        <td><b>{{ date_format (new DateTime($data['tanggal_lahir']), 'd-m-Y')}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelas</td>
                                                        <td>:</td>
                                                        <td><b>{{ $data['kelas_title']}}</b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>Jenis Prestasi</label>
                                                <select name="jenis_peringkat" class="form-control">
                                                    <option value="">-- Pilih Jenis Prestasi --</option>
                                                    <option value="1">Sains</option>
                                                    <option value="2">Seni</option>
                                                    <option value="3">Olahraga</option>
                                                    <option value="0">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tingkat Prestasi</label>
                                                <select name="tingkat_prestasi" class="form-control">
                                                    <option value="">-- Pilih Tingkat Prestasi --</option>
                                                    <option value="1">Sekolah</option>
                                                    <option value="2">Kecamatan</option>
                                                    <option value="3">Kabupaten / Kota</option>
                                                    <option value="4">Propinsi</option>
                                                    <option value="5">Nasional</option>
                                                    <option value="6">International</option>
                                                    <option value="0">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Prestasi:</label>
                                                <textarea class="form-control" name="nama_prestasi" placeholder="Enter full name"></textarea>
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
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="mahasiswa[id]" value="{{$data['id']}}">
                            </div>
                            
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <!--end::Portlet-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .m-content{width:100%;}
</style>

@endsection

@section('js')
    <script src="{{asset('assets/js/pages/mahasiswa/mahasiswa.js')}}" type="text/javascript"></script>
@endsection