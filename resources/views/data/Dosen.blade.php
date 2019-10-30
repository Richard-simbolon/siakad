@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
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
                    <a href="dosen/create" class="btn btn-primary">
                        <i class="flaticon-user-add"></i> Tambah Dosen &nbsp;
                    </a>
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
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"></path>
                                            <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"></rect>
                                        </g>
                                    </svg>
                                </span> &nbsp;
                                <h3 class="kt-portlet__head-title">
                                    Daftar Dosen
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <select name="status" class="form-control">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="1">AKTIF</option>
                                                <option value="2">Tidak Aktif</option>
                                                <option value="3">CUTI</option>
                                                <option value="4">KELUAR</option>
                                                <option value="5">ALMARHUM</option>
                                                <option value="6">PENSIUN</option>
                                                <option value="7">IJIN BELAJAR</option>
                                                <option value="8">TUGAS DI INSTANSI LAIN</option>
                                                <option value="9">GANTI NIDN</option>
                                                <option value="10">TUGAS BELAJAR</option>
                                                <option value="11">HAPUS NIDN</option>
                                                <option value="0">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="laki-laki">Laki - laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <select name="agama" id="search-agama" class="form-control">
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="islam">Islam</option>
                                                <option value="protestan">Protestan</option>
                                                <option value="katolik">Katolik</option>
                                                <option value="hindu">Hindu</option>
                                                <option value="budha">Budha</option>
                                                <option value="konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputdata" name="keyword" placeholder="Cari berdasarkan nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-form__actions">
                                    <button type="button" class="btn btn-primary" id="search-button"><i class="flaticon-search"></i>Cari</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                            <div>
                                <table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap" id="TableDosen">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIDN/NUP/NDIK</th>
                                        <th>NIP</th>
                                        <th>JK</th>
                                        <th>Agama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<style>
    .m-content{width:100%};
    </style>

@section('js')

@stop

@endsection
