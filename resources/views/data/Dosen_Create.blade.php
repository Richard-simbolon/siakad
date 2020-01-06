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
                    Dosen </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{url('data/dosen')}}" class="kt-subheader__breadcrumbs-link">
                        Daftar </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Tambah </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{url('data/dosen')}}" class="btn btn-success">
                        <i class="la la-bars"></i> Daftar Dosen &nbsp;
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="between">
                        <div class="kt-grid__item">

                            <!--begin: Form Wizard Nav -->
                            <div class="kt-wizard-v3__nav">
                                <div class="kt-wizard-v3__nav-items kt-wizard-v3__nav-items--clickable">

                                    <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon-rotate"></i></span> Informasi Dasar
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon2-file"></i> </span> Biodata
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span><i class="flaticon2-avatar"></i></span> Keluarga
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="done">
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
                            <form class="kt-form dosen-form" id="kt_form" novalidate="novalidate">

                                <!--begin: Form Wizard Step 1 - Data Informasi Dasar-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"  data-ktwizard-state="current">
                                    {{--<div class="kt-heading kt-heading--md">Formulir Informasi Dasar Dosen</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="dosen[nama]" placeholder="Isikan nama lengkap">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>NIDN / NUP / NIDK</label>
                                                        <input type="text" class="form-control" name="dosen[nidn_nup_nidk]" placeholder="Isikan NIDN / NUP / NIDK">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="dosen[email]" placeholder="Isikan Email">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>No Handphone</label>
                                                        <input type="text" class="form-control" name="dosen[no_hp]" placeholder="Isikan Nomor HP">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tempat lahir</label>
                                                        <input type="text" class="form-control" name="dosen[tempat_lahir]" placeholder="Isikan tempat lahir">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tanggal lahir</label>
                                                        <input type="date" class="form-control" name="dosen[tanggal_lahir]" placeholder="Isikan nama ibu">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <div class="kt-radio-inline" style="padding-top: 9px;">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="dosen[jenis_kelamin]" value="laki-laki" checked=""> Laki-laki
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="dosen[jenis_kelamin]" value="perempuan"> Perempuan
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Agama:</label>
                                                        <select name="dosen[agama]" class="form-control kt-select2">
                                                            <option value="">Select</option>
                                                            @foreach ($master['agama'] as $item)
                                                                <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1  - Data Informasi Dasar-->

                                <!--begin: Form Wizard Step 2  - Data Alamat-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md">Formulir Biodata Dosen</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NIK </label>
                                                        <input type="text" class="form-control" name="dosen[nik]" placeholder="Isikan NIK">
                                                        <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Ibu</label>
                                                        <input type="text" class="form-control" name="dosen[nama_ibu]" placeholder="Isikan Nama Ibu">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NIP </label>
                                                        <input type="text" class="form-control" name="dosen[nip]" placeholder="Isikan NIP">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NPWP </label>
                                                        <input type="text" class="form-control" name="dosen[npwp]" placeholder="Isikan NPWP">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Ikatan Kerja </label>
                                                        <select name="dosen[ikatan_kerja]" class="form-control kt-select2">
                                                            <option value="">--Pilih Status--</option>
                                                            @foreach ($master['ikatan_kerja_sdm'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['id']}} - {{$item['nama_ikatan_kerja']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Status Pegawai </label>
                                                        <select name="dosen[status_pegawai]" class="form-control kt-select2">
                                                            <option value="">--Pilih Status--</option>
                                                            @foreach ($master['status_pegawai'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>No SK CPNS</label>
                                                        <input type="text" class="form-control" name="dosen[no_sk_cpns]" placeholder="Isikan No SK PNS">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK CPNS</label>
                                                        <input type="date" class="form-control" name="dosen[tanggal_sk_cpns]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>No SK Pengangkatan</label>
                                                        <input type="text" class="form-control" name="dosen[no_sk_cpns]" placeholder="Isikan No SK Pengangkatan">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Tanggal SK Pengangkatan</label>
                                                        <input type="date" class="form-control" name="dosen[tgl_sk_pengangkatan]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Lembaga Pengangkatan </label>
                                                        <input type="text" class="form-control" name="dosen[lembaga_pengangkatan]" placeholder="Isikan Lembaga Pengangkatan">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Pangkat Golongan </label>
                                                        <input type="text" class="form-control" name="dosen[pangkat_golongan]" placeholder="Isikan Pangkat Golongan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Sumber Gaji </label>
                                                        {{--<input type="text" class="form-control" name="dosen[sumber_gaji]" placeholder="Isikan Sumber Gaji">--}}
                                                        <select name="dosen[sumber_gaji]" class="form-control kt-select2">
                                                            <option value="">--Pilih Sumber Gaji--</option>
                                                            @foreach ($master['sumber_gaji'] as $item)
                                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Jalan *</label>
                                                        <textarea type="text" class="form-control" name="dosen[alamat]" placeholder="Isikan Alamat"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Dusun</label>
                                                        <input type="text" class="form-control" name="dosen[dusun]" placeholder="Isikan Dusun">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>RT</label>
                                                        <input type="text" class="form-control" name="dosen[rt]" placeholder="Isikan  RT">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>RW</label>
                                                        <input type="text" class="form-control" name="dosen[rw]" placeholder="Isikan RW">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Kecamatan</label>
                                                        <input type="text" class="form-control" name="dosen[kecamatan]" placeholder="Isikan Kecamatan">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Kelurahan</label>
                                                        <input type="text" class="form-control" name="dosen[kelurahan]" placeholder="Isikan Kelurahan">
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-group">
                                                        <label>Kode Pos</label>
                                                        <input type="text" class="form-control" name="dosen[kode_pos]" placeholder="Isikan Kode Pos">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" class="form-control" name="dosen[telepon]" placeholder="Isikan Nomor Telepon">
                                                    </div>
                                                </div>
                                                {{--<div class="col-xl-6">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Kode Pos</label>--}}
                                                        {{--<input type="text" class="form-control" name="dosen[no_hp]" placeholder="Isikan Nomor HP">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                            {{--<div class="form-group">--}}
                                                {{--<label>Email</label>--}}
                                                {{--<input type="text" class="form-control" name="dosen[email]" placeholder="Isikan Email">--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2 - Data Biodata-->

                                <!--begin: Form Wizard Step 3 - Data Keluarga-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md">Formulir Data Keluarga Dosen</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Status Pernikahan</label>
                                                        <select name="keluarga[status_pernikahan]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Status Pernikahan --</option>
                                                            <option value="1">Belum Menikah</option>
                                                            <option value="2">Sudah Menikah</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nama Suami / Istri</label>
                                                        <input type="text" class="form-control" name="keluarga[nama_pasangan]" placeholder="Isikan Nama Suami / Istri">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>NIP Suami / Istri</label>
                                                        <input type="text" class="form-control" name="keluarga[nip_pasangan]" placeholder="Isikan Nama Suami / Istri">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>TMT PNS</label>
                                                        <input type="date" class="form-control" name="keluarga[tmt_pns]" placeholder="Isikan Tanggal Lahir">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <select name="keluarga[pekerjaan]" class="form-control">
                                                            @foreach ($master['pekerjaan'] as $item)
                                                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--</div>--}}

                                <!--end: Form Wizard Step 3 - Data Orangtua -->

                                <!--begin: Form Wizard Step 4 - Data wali-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    {{--<div class="kt-heading kt-heading--md">Daftar Kebutuhan Khusus</div>--}}
                                    <div class="kt-form__section kt-form__section--first">
                                        <br/><br/>
                                        <div class="kt-wizard-v3__review">
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Mampu Menghandle Kebutuhan Khusus :
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
                                                                            <input type="checkbox" name="dosen_kh[]" value="{{$value['id']}}" > {{$value['title']}}
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
                                                    Mampu Menghandle Braile ?
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio" name="braile" value="ya"> Ya
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio" name="braile" value="tidak" checked> Tidak
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Mampu Menghandle Bahasa Isyarat ?
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio" name="isyarat" value="ya" > Ya
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio" name="isyarat" value="tidak" checked> Tidak
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 4-->

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
    var url = '/data/dosen';
    var form = 'dosen-form';
</script>

@section('js')
    <script src="{{asset('assets/js/pages/custom/wizard/wizard-3.js')}}" type="text/javascript"></script>
@stop

@endsection
