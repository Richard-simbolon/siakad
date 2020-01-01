@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Mahasiswa </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{url('data/mahasiswa')}}" class="kt-subheader__breadcrumbs-link">
                        Daftar </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Tambah </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{url('data/mahasiswa')}}" class="btn btn-success">
                        <i class="la la-bars"></i> Daftar Mahasiswa &nbsp;
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
                        <div class="kt-grid__item">

                            <!--begin: Form Wizard Nav -->
                            <div class="kt-wizard-v3__nav">
                                <div class="kt-wizard-v3__nav-items kt-wizard-v3__nav-items--clickable">

                                    <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon2-user"></i> </span> Informasi Dasar
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon-placeholder-3"></i> </span> Alamat
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon2-avatar"></i></span> Orangtua
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon-businesswoman"></i> </span> Wali
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon-bell"></i> </span> Kebutuhan Khusus
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Nav -->
                        </div>
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                            <!--begin: Form Wizard Form-->
                            <form class="kt-form form-add-mahasiswa" id="kt_form" >
                                <!--begin: Form Wizard Step 1 - Data Informasi Dasar-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                    {{--<div class="kt-heading kt-heading--md"><i class="flaticon2-writing"> </i> Formulir Informasi Dasar Mahasiwa</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="row">
                                                {{--<div class="col-xl-3">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Angkatan</label>--}}
                                                        {{--<div class="form-group">--}}
                                                            {{--<select name="mahasiswa[angkatan]" class="form-control kt-select2">--}}
                                                                {{--<option value="">-- Pilih Angkatan --</option>--}}
                                                                {{--@foreach ($master['angkatan'] as $item)--}}
                                                                    {{--<option value="{{$item['id']}}">{{$item['title']}}</option>--}}
                                                                {{--@endforeach--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Periode Masuk</label>
                                                        <div class="form-group">
                                                            <select name="mahasiswa[id_periode_masuk]" class="form-control kt-select2">
                                                                <option value="">-- Pilih Periode Masuk --</option>
                                                                @foreach ($master['periode_masuk'] as $item)
                                                                    <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Program Studi</label>
                                                        <div class="form-group">
                                                            <select name="mahasiswa[jurusan_id]" class="form-control kt-select2">
                                                                <option value="">-- Pilih Jurusan --</option>
                                                                @foreach ($master['jurusan'] as $item)
                                                                    <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>NIM</label>
                                                        <input type="text" class="form-control" name="mahasiswa[nim]" placeholder="Isikan NIM">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Kelas:</label>
                                                        <select name="mahasiswa[kelas_id]" class="form-control kt-select2">
                                                            <option value="">Select</option>
                                                            @foreach ($master['kelas'] as $item)
                                                                <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="mahasiswa[email]" placeholder="Isikan Email">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>No Handphone</label>
                                                        <input type="text" class="form-control" name="mahasiswa[no_hp]" placeholder="Isikan Nomor HP">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="mahasiswa[nama]" placeholder="isikan nama lengkap">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nama Ibu</label>
                                                        <input type="text" class="form-control" name="mahasiswa[nama_ibu]" placeholder="isikan nama ibu">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tempat lahir</label>
                                                        <input type="text" class="form-control" name="mahasiswa[tempat_lahir]" placeholder="isikan tempat lahir">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tanggal lahir</label>
                                                        <input type="date" class="form-control" name="mahasiswa[tanggal_lahir]" placeholder="isikan nama ibu">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Agama:</label>
                                                        <select name="mahasiswa[agama]" class="form-control kt-select2">
                                                            <option value="">Select</option>
                                                            @foreach ($master['agama'] as $item)
                                                                <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group form-group-last">
                                                        <label>Jenis Kelamin</label>
                                                        <div class="kt-radio-inline" style="padding-top: 9px!important;">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[jk]" value="L" checked> Laki-laki
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[jk]" value="P"> Perempuan
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label>Pembimbing Akademik:</label>
                                                    <select name="mahasiswa[pembimbing_akademik]" class="form-control kt-select2">
                                                        <option value="">Select</option>
                                                        @foreach ($master['dosen'] as $item)
                                                            <option value="{{$item['id']}}" > {{$item['nidn_nup_nidk'] .' - '. $item['nama']}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{--<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>--}}

                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-12">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<div class="kt-wizard-v3__review-title">--}}
                                                            {{--<b>History Pendaftaran</b>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{----}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Jenis Pendaftaran *</label>--}}
                                                        {{--<select name="mahasiswa[jenis_pendaftaran]" class="form-control kt-select2">--}}
                                                            {{--<option value="">-- Pilih Jenis Pendaftaran --</option>--}}
                                                            {{--@foreach ($master['jenis_pendaftaran'] as $item)--}}
                                                                {{--<option value="{{$item['id']}}">{{$item['title']}}</option>--}}
                                                               {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Jalur Pendaftaran</label>--}}
                                                        {{--<select name="mahasiswa[jalur_pendaftaran]" class="form-control kt-select2">--}}
                                                            {{--<option value="">-- Pilih Jalur Pendaftaran--</option>--}}
                                                            {{--@foreach ($master['jalur_pendaftaran'] as $item)--}}
                                                            {{--<option value="{{$item['id']}}">{{$item['title']}}</option>--}}
                                                           {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Tanggal Masuk *</label>--}}
                                                        {{--<input type="date" class="form-control" name="mahasiswa[tanggal_masuk]" placeholder="Isikan nama ibu">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Pembiayaan Awal</label>--}}
                                                        {{--<select name="mahasiswa[jenis_pembiayaan]" class="form-control kt-select2">--}}
                                                            {{--<option value="">-- Pilih Jenis Pembiayaan--</option>--}}
                                                            {{--@foreach ($master['jenis_pembiayaan'] as $item)--}}
                                                            {{--<option value="{{$item['id']}}">{{$item['title']}}</option>--}}
                                                            {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Biaya Masuk </label>--}}
                                                        {{--<input type="text" class="form-control" name="mahasiswa[biaya_masuk]" placeholder="Isikan Biaya Masuk">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>--}}

                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-12">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<div class="kt-wizard-v3__review-title">--}}
                                                            {{--<b>Selain jenis pendaftaran peserta didik baru, Silahkan lengkapi data berikut</b>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Jumlah sks di akui </label>--}}
                                                        {{--<input type="text" class="form-control" name="mahasiswa[jumlah_sks_diakui]" placeholder="Isikan Jumlah sks di akui">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Asal Perguruan Tinggi</label>--}}
                                                        {{--<input type="text" class="form-control" name="mahasiswa[asal_perguruan_tinggi]" placeholder="Isikan Asal Perguruan Tinggi">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Asal Program Studi</label>--}}
                                                        {{--<select name="mahasiswa[asal_program_studi]" class="form-control kt-select2">--}}
                                                            {{--<option value="">-- Pilih PT Terlebih Dahulu --</option>--}}
                                                            {{--@foreach ($master['asal_studi'] as $item)--}}
                                                            {{--<option value="{{$item['id']}}">{{$item['title']}}</option>--}}
                                                           {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1  - Data Informasi Dasar-->

                                <!--begin: Form Wizard Step 2  - Data Alamat-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md"><i class="flaticon2-writing"> </i> Formulir Data Alamat Mahasiswa</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NIK *</label>
                                                        <input type="text" class="form-control" name="mahasiswa[nik]" placeholder="Isikan NIK">
                                                        <span class="form-text text-muted">Nomor KTP tanpa tanda baca, Isikan Nomor Paspor untuk Warga Negara Asing</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NISN</label>
                                                        <input type="text" class="form-control" name="mahasiswa[nisn]" placeholder="Isikan NISN">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label>Kewarganegaraan *</label>
                                                    <div class="form-group">
                                                        <select name="mahasiswa[kewarganegaraan]" class="form-control kt-select2">
                                                            <option value="">-- Kewarganegaraan --</option>
                                                            @foreach ($master['negara'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Jalan *</label>
                                                        <textarea type="text" class="form-control" name="mahasiswa[alamat]" placeholder="Isikan Alamat"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Dusun</label>
                                                        <input type="text" class="form-control" name="mahasiswa[dusun]" placeholder="Isikan Dusun">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>RT</label>
                                                        <input type="text" class="form-control" name="mahasiswa[rt]" placeholder="Isikan  RT">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>RW</label>
                                                        <input type="text" class="form-control" name="mahasiswa[rw]" placeholder="Isikan RW">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Kecamatan</label>
                                                        <input type="text" class="form-control" name="mahasiswa[kecamatan]" placeholder="Isikan Kecamatan">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Kelurahan</label>
                                                        <input type="text" class="form-control" name="mahasiswa[kelurahan]" placeholder="Isikan Kelurahan">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Kode Pos</label>
                                                        <input type="text" class="form-control" name="mahasiswa[kode_pos]" placeholder="Isikan Kode Pos">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Jenis Tinggal</label>
                                                        <div class="form-group">
                                                            <select name="mahasiswa[jenis_tinggal]" class="form-control kt-select2">
                                                                <option value="">Select</option>
                                                                @foreach ($master['jenis_tinggal'] as $item)
                                                                    <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="select2-label">Alat Transpostrasi</label>
                                                        <select name="mahasiswa[alat_transportasi]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Alat Transportasi --</option>
                                                            @foreach ($master['alat_transportasi'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" class="form-control" name="mahasiswa[no_telepon]" placeholder="Isikan Nomor Telepon">
                                                    </div>
                                                </div>
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Kode Pos</label>--}}
                                                        {{--<input type="text" class="form-control" name="mahasiswa[no_hp]" placeholder="Isikan Nomor HP">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>

                                            <div class="row form-group-last">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Penerima KPS? *</label>
                                                        <div class="kt-radio-inline" style="padding-top: 9px;">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[is_penerima_kps]"> Ya
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[is_penerima_kps]" checked> Tidak
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>No KPS:</label>
                                                        <input type="text" class="form-control" name="mahasiswa[no_kps]" placeholder="Isikan Nomor KPS">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2 - Data Alamat-->

                                <!--begin: Form Wizard Step 3 - Data Orangtua-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md"><i class="flaticon2-writing"> </i> Formulir Data Orangtua Mahasiswa</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>NIK Ayah</label>
                                                    <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ayah][nik]" placeholder="Isikan NIK">
                                                    <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ayah][nama]" placeholder="Isikan Nama">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir Ayah</label>
                                                    <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[ayah][tanggal_lahir]" placeholder="Isikan Tanggal Lahir">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pendidikan Ayah</label>
                                                    <select name="mahasiswa_orang_tua_wali[ayah][pendidikan_id]" class="form-control kt-select2">
                                                        <option value="">-- Pilih Jenjang --</option>
                                                        @foreach ($master['pendidikan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                           @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pekerjaan Ayah</label>
                                                    <select name="mahasiswa_orang_tua_wali[ayah][pekerjaan_id]" class="form-control kt-select2">
                                                        <option value="">-- Pilih Pekerjaan --</option>
                                                        @foreach ($master['pekerjaan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                           @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penghasilan Ayah</label>
                                                    <select name="mahasiswa_orang_tua_wali[ayah][penghasilan]" class="form-control kt-select2">
                                                        <option value="">-- Pilih Penghasilan --</option>
                                                        @foreach ($master['penghasilan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                           @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>NIK Ibu</label>
                                                    <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ibu][nik]" placeholder="Isikan NIK">
                                                    <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ibu</label>
                                                    <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ibu][nama]" placeholder="Isikan Nama">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir Ibu</label>
                                                    <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[ibu][tanggal_lahir]" placeholder="Isikan Tanggal Lahir">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pendidikan Ibu</label>
                                                    <select name="mahasiswa_orang_tua_wali[ibu][pendidikan_id]" class="form-control kt-select2">
                                                        <option value="">-- Pilih Jenjang --</option>
                                                        @foreach ($master['pendidikan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                           @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pekerjaan Ibu</label>
                                                    <select name="mahasiswa_orang_tua_wali[ibu][pekerjaan_id]" class="form-control kt-select2">
                                                        <option value="">-- Pilih Pekerjaan --</option>
                                                        @foreach ($master['pekerjaan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                           @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penghasilan Ibu</label>
                                                    <select name="mahasiswa_orang_tua_wali[ibu][penghasilan]" class="form-control kt-select2">
                                                        <option value="">-- Pilih Penghasilan --</option>
                                                        <option value="0"> </option>
                                                        @foreach ($master['penghasilan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                           @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 3 - Data Orangtua -->

                                <!--begin: Form Wizard Step 4 - Data wali-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md"><i class="flaticon2-writing"> </i> Formulir Data Wali Mahasiswa</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[wali][nama]" placeholder="Isikan Nama">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir </label>
                                                        <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[wali][tanggal_lahir]" placeholder="Isikan Tanggal Lahir">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Pendidikan</label>
                                                        <select name="mahasiswa_orang_tua_wali[wali][pendidikan_id]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jenjang --</option>
                                                            @foreach ($master['pendidikan'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                               @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <select name="mahasiswa_orang_tua_wali[wali][pekerjaan_id]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            @foreach ($master['pekerjaan'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                               @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Penghasilan</label>
                                                        <select name="mahasiswa_orang_tua_wali[wali][penghasilan]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Penghasilan --</option>
                                                            @foreach ($master['penghasilan'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                               @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                <!--end: Form Wizard Step 4-->

                                <!--begin: Form Wizard Step 5-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md"><i class="flaticon2-writing"> </i> Daftar Kebutuhan Khusus</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__review">
                                            <div class="kt-wizard-v3__review-item">
                                                <br/><br/>
                                                <div class="kt-wizard-v3__review-title">
                                                    Mahasiswa
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="row">

                                                        <?php
                                                            $kebutuhan =  array_chunk($master['kebutuhan']->toArray() , 6 , true);    
                                                        ?>
                                                        @foreach ($kebutuhan as $item)
                                                            <div class="col-xl-4">
                                                                <div class="kt-checkbox-list">
                                                                    @foreach ($item as $value)
                                                                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                            <input type="checkbox" name="mahasiswa_kh[]" value="{{$value['id']}}" > {{$value['title']}}
                                                                            <span></span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Ayah
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="row">
                                                        @foreach ($kebutuhan as $item)
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                @foreach ($item as $value)
                                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                        <input type="checkbox" name="ayah_kh[]" value="{{$value['id']}}" > {{$value['title']}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Ibu
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="row">
                                                        @foreach ($kebutuhan as $item)
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                @foreach ($item as $value)
                                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                        <input type="checkbox" name="ibu_kh[]" value="{{$value['id']}}" > {{$value['title']}}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 5-->

                                <!--begin: Form Actions -->
                                <div class="kt-form__actions">
                                    <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                        <li class="la la-angle-left"></li> Sebelumnya
                                    </button>
                                    <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                        Simpan <i class="la la-save"></i>
                                    </button>
                                    <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                        Selanjutnya <li class="la la-angle-right"></li>
                                    </button>
                                </div>

                                <!--end: Form Actions -->
                            </form>

                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<style>
    .m-content{width:100%};
    </style>
<script>
        var url = '/data/mahasiswa';
        var form = 'form-add-mahasiswa';
    </script>
@section('js')
    <script src="{{asset('assets/js/pages/custom/wizard/wizard-3.js')}}" type="text/javascript"></script>
@stop

@endsection
