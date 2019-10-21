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
                <h3 class="kt-subheader__title">Dashboard</h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
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
                                                <span>1</span> Informasi Dasar
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span>2</span> Alamat
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span>3</span> Orangtua
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span>4</span> Wali
                                            </div>
                                            <div class="kt-wizard-v3__nav-bar"></div>
                                        </div>
                                    </div>
                                    <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v3__nav-body">
                                            <div class="kt-wizard-v3__nav-label">
                                                <span>5</span> Kebutuhan Khusus
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
                            <form class="kt-form" id="kt_form">
                                <!--begin: Form Wizard Step 1 - Data Informasi Dasar-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Formulir Informasi Dasar Mahasiwa</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
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
                                                        <label>Jenis Kelamin</label>
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[jk]" checked> Laki-laki
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[jk]"> Perempuan
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                                        <label>Agama:</label>
                                                        <select name="mahasiswa[agama]" class="form-control kt-select2">
                                                            <option value="">Select</option>
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
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1  - Data Informasi Dasar-->

                                <!--begin: Form Wizard Step 2  - Data Alamat-->
                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Formulir Data Alamat Mahasiswa</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group">
                                                <label>NIK *</label>
                                                <input type="text" class="form-control" name="mahasiswa[nik]" placeholder="Isikan NIK">
                                                <span class="form-text text-muted">Nomor KTP tanpa tanda baca, Isikan Nomor Paspor untuk Warga Negara Asing</span>
                                            </div>
                                            <div class="form-group">
                                                <label>NISN</label>
                                                <input type="text" class="form-control" name="mahasiswa[nisn]" placeholder="Isikan NISN">
                                            </div>
                                            <div class="form-group">
                                                <label>Kewarganegaraan *</label>
                                                <input type="text" class="form-control" name="mahasiswa[kewarganegaraan]" placeholder="Isikan Kewarganegaraan">
                                            </div>
                                            <div class="form-group">
                                                <label>Jalan *</label>
                                                <textarea type="text" class="form-control" name="mahasiswa[alamat]" placeholder="Isikan Alamat"></textarea>
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
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Kelurahan</label>
                                                        <input type="text" class="form-control" name="mahasiswa[kelurahan]" placeholder="Isikan Kelurahan">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Kode Pos</label>
                                                        <input type="text" class="form-control" name="mahasiswa[kode_pos]" placeholder="Isikan Kode Pos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <textarea type="text" class="form-control" name="mahasiswa[kecamatan]" placeholder="Isikan Kecamatan"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Tinggal</label>
                                                <select name="mahasiswa[jenis_tingal]" class="form-control kt-select2">
                                                    <option value="">Select</option>
                                                    <option value="1">Bersama Orangtua</option>
                                                    <option value="2">Wali</option>
                                                    <option value="3">Kost</option>
                                                    <option value="4">Asrama</option>
                                                    <option value="5">Panti Asuhan</option>
                                                    <option value="0">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Alat Transpostrasi</label>
                                                <select name="mahasiswa[jenis_tingal]" class="form-control kt-select2">
                                                    <option value="">-- Pilih Alat Transportasi --</option>
                                                    <option value="1">Jalan kaki</option>
                                                    <option value="3">Angkutan umum/bus/pete-pete</option>
                                                    <option value="4">Mobil/bus antar jemput</option>
                                                    <option value="5">Kereta api</option>
                                                    <option value="6">Ojek</option>
                                                    <option value="7">Andong/bendi/sado/dokar/delman/becak</option>
                                                    <option value="8">Perahu penyeberangan/rakit/getek</option>
                                                    <option value="11">Kuda</option>
                                                    <option value="12">Sepeda</option>
                                                    <option value="13">Sepeda motor</option>
                                                    <option value="14">Mobil pribadi</option>
                                                    <option value="99">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <input type="text" class="form-control" name="mahasiswa[telepon]" placeholder="Isikan Nomor Telepon">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Kode Pos</label>
                                                        <input type="text" class="form-control" name="mahasiswa[no_hp]" placeholder="Isikan Nomor HP">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="mahasiswa[email]" placeholder="Isikan Email">
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Penerima KPS? *</label>
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[kps]" checked> Ya
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mahasiswa[kps]"> Tidak
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
                                    <div class="kt-heading kt-heading--md">Formulir Data Orangtua Mahasiswa</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>NIK Ayah</label>
                                                        <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ayah][nik_ayah]" placeholder="Isikan NIK">
                                                        <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Ayah</label>
                                                        <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ayah][nama_ayah]" placeholder="Isikan Nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir Ayah</label>
                                                        <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[ayah][tanggal_lahir_ayah]" placeholder="Isikan Tanggal Lahir">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Ayah</label>
                                                        <select name="mahasiswa_orang_tua_wali[ayah][pendidikan_ayah]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jenjang --</option>
                                                            <option value="0">Tidak sekolah</option>
                                                            <option value="1">PAUD</option>
                                                            <option value="2">TK / sederajat</option>
                                                            <option value="3">Putus SD</option>
                                                            <option value="4">SD / sederajat</option>
                                                            <option value="5">SMP / sederajat</option>
                                                            <option value="6">SMA / sederajat</option>
                                                            <option value="7">Paket A</option>
                                                            <option value="8">Paket B</option>
                                                            <option value="9">Paket C</option>
                                                            <option value="20">D1</option>
                                                            <option value="21">D2</option>
                                                            <option value="22">D3</option>
                                                            <option value="23">D4</option>
                                                            <option value="30">S1</option>
                                                            <option value="31">Profesi</option>
                                                            <option value="32">Sp-1</option>
                                                            <option value="35">S2</option>
                                                            <option value="36">S2 Terapan</option>
                                                            <option value="37">Sp-2</option>
                                                            <option value="40">S3</option>
                                                            <option value="41">S3 Terapan</option>
                                                            <option value="90">Non formal</option>
                                                            <option value="91">Informal</option>
                                                            <option value="99">Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan Ayah</label>
                                                        <select name="mahasiswa_orang_tua_wali[ayah][pekerjaan_ayah]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            <option value="1">Tidak bekerja</option>
                                                            <option value="2">Nelayan</option>
                                                            <option value="3">Petani</option>
                                                            <option value="4">Peternak</option>
                                                            <option value="5">PNS/TNI/Polri</option>
                                                            <option value="6">Karyawan Swasta</option>
                                                            <option value="7">Pedagang Kecil</option>
                                                            <option value="8">Pedagang Besar</option>
                                                            <option value="9">Wiraswasta</option>
                                                            <option value="10">Wirausaha</option>
                                                            <option value="11">Buruh</option>
                                                            <option value="12">Pensiunan</option>
                                                            <option value="98">Sudah Meninggal</option>
                                                            <option value="99">Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Penghasilan Ayah</label>
                                                        <select name="mahasiswa_orang_tua_wali[ayah][penghasilan_ayah]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Penghasilan --</option>
                                                            <option value="0"> </option>
                                                            <option value="11">Kurang dari Rp. 500,000</option>
                                                            <option value="12">Rp. 500,000 - Rp. 999,999</option>
                                                            <option value="13">Rp. 1,000,000 - Rp. 1,999,999</option>
                                                            <option value="14">Rp. 2,000,000 - Rp. 4,999,999</option>
                                                            <option value="15">Rp. 5,000,000 - Rp. 20,000,000</option>
                                                            <option value="16">Lebih dari Rp. 20,000,000</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>NIK Ibu</label>
                                                        <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[ibu][nik_ibu]" placeholder="Isikan NIK">
                                                        <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                    </div>
                                                    <!--<div class="form-group">
                                                        <label>Nama Ibu</label>
                                                        <input type="text" class="form-control" name="nama_ibu" placeholder="Isikan Nama">
                                                    </div>-->
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir Ibu</label>
                                                        <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[ibu][tanggal_lahir_ibu]" placeholder="Isikan Tanggal Lahir">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Ibu</label>
                                                        <select name="mahasiswa_orang_tua_wali[ibu][pendidikan_ibu]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jenjang --</option>
                                                            <option value="0">Tidak sekolah</option>
                                                            <option value="1">PAUD</option>
                                                            <option value="2">TK / sederajat</option>
                                                            <option value="3">Putus SD</option>
                                                            <option value="4">SD / sederajat</option>
                                                            <option value="5">SMP / sederajat</option>
                                                            <option value="6">SMA / sederajat</option>
                                                            <option value="7">Paket A</option>
                                                            <option value="8">Paket B</option>
                                                            <option value="9">Paket C</option>
                                                            <option value="20">D1</option>
                                                            <option value="21">D2</option>
                                                            <option value="22">D3</option>
                                                            <option value="23">D4</option>
                                                            <option value="30">S1</option>
                                                            <option value="31">Profesi</option>
                                                            <option value="32">Sp-1</option>
                                                            <option value="35">S2</option>
                                                            <option value="36">S2 Terapan</option>
                                                            <option value="37">Sp-2</option>
                                                            <option value="40">S3</option>
                                                            <option value="41">S3 Terapan</option>
                                                            <option value="90">Non formal</option>
                                                            <option value="91">Informal</option>
                                                            <option value="99">Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan Ibu</label>
                                                        <select name="mahasiswa_orang_tua_wali[ibu][pekerjaan_ibu]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            <option value="1">Tidak bekerja</option>
                                                            <option value="2">Nelayan</option>
                                                            <option value="3">Petani</option>
                                                            <option value="4">Peternak</option>
                                                            <option value="5">PNS/TNI/Polri</option>
                                                            <option value="6">Karyawan Swasta</option>
                                                            <option value="7">Pedagang Kecil</option>
                                                            <option value="8">Pedagang Besar</option>
                                                            <option value="9">Wiraswasta</option>
                                                            <option value="10">Wirausaha</option>
                                                            <option value="11">Buruh</option>
                                                            <option value="12">Pensiunan</option>
                                                            <option value="98">Sudah Meninggal</option>
                                                            <option value="99">Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Penghasilan Ibu</label>
                                                        <select name="mahasiswa_orang_tua_wali[ibu][penghasilan_ibu]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Penghasilan --</option>
                                                            <option value="0"> </option>
                                                            <option value="11">Kurang dari Rp. 500,000</option>
                                                            <option value="12">Rp. 500,000 - Rp. 999,999</option>
                                                            <option value="13">Rp. 1,000,000 - Rp. 1,999,999</option>
                                                            <option value="14">Rp. 2,000,000 - Rp. 4,999,999</option>
                                                            <option value="15">Rp. 5,000,000 - Rp. 20,000,000</option>
                                                            <option value="16">Lebih dari Rp. 20,000,000</option>
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
                                    <div class="kt-heading kt-heading--md">Formulir Data Wali Mahasiswa</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control" name="mahasiswa_orang_tua_wali[wali][nama_wali]" placeholder="Isikan Nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir </label>
                                                        <input type="date" class="form-control" name="mahasiswa_orang_tua_wali[wali][tanggal_lahir_wali]" placeholder="Isikan Tanggal Lahir">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan</label>
                                                        <select name="mahasiswa_orang_tua_wali[wali][pendidikan_wali]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jenjang --</option>
                                                            <option value="0">Tidak sekolah</option>
                                                            <option value="1">PAUD</option>
                                                            <option value="2">TK / sederajat</option>
                                                            <option value="3">Putus SD</option>
                                                            <option value="4">SD / sederajat</option>
                                                            <option value="5">SMP / sederajat</option>
                                                            <option value="6">SMA / sederajat</option>
                                                            <option value="7">Paket A</option>
                                                            <option value="8">Paket B</option>
                                                            <option value="9">Paket C</option>
                                                            <option value="20">D1</option>
                                                            <option value="21">D2</option>
                                                            <option value="22">D3</option>
                                                            <option value="23">D4</option>
                                                            <option value="30">S1</option>
                                                            <option value="31">Profesi</option>
                                                            <option value="32">Sp-1</option>
                                                            <option value="35">S2</option>
                                                            <option value="36">S2 Terapan</option>
                                                            <option value="37">Sp-2</option>
                                                            <option value="40">S3</option>
                                                            <option value="41">S3 Terapan</option>
                                                            <option value="90">Non formal</option>
                                                            <option value="91">Informal</option>
                                                            <option value="99">Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <select name="mahasiswa_orang_tua_wali[wali][pekerjaan_wali]" class="form-control">
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            <option value="1">Tidak bekerja</option>
                                                            <option value="2">Nelayan</option>
                                                            <option value="3">Petani</option>
                                                            <option value="4">Peternak</option>
                                                            <option value="5">PNS/TNI/Polri</option>
                                                            <option value="6">Karyawan Swasta</option>
                                                            <option value="7">Pedagang Kecil</option>
                                                            <option value="8">Pedagang Besar</option>
                                                            <option value="9">Wiraswasta</option>
                                                            <option value="10">Wirausaha</option>
                                                            <option value="11">Buruh</option>
                                                            <option value="12">Pensiunan</option>
                                                            <option value="98">Sudah Meninggal</option>
                                                            <option value="99">Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Penghasilan</label>
                                                        <select name="mahasiswa_orang_tua_wali[wali][penghasilan_wali]" class="form-control kt-select2">
                                                            <option value="">-- Pilih Penghasilan --</option>
                                                            <option value="0"> </option>
                                                            <option value="11">Kurang dari Rp. 500,000</option>
                                                            <option value="12">Rp. 500,000 - Rp. 999,999</option>
                                                            <option value="13">Rp. 1,000,000 - Rp. 1,999,999</option>
                                                            <option value="14">Rp. 2,000,000 - Rp. 4,999,999</option>
                                                            <option value="15">Rp. 5,000,000 - Rp. 20,000,000</option>
                                                            <option value="16">Lebih dari Rp. 20,000,000</option>
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
                                    <div class="kt-heading kt-heading--md">Daftar Kebutuhan Khusus</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__review">
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Mahasiswa
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input type="checkbox"> A - Tuna netra
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> B - Tuna rungu
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> C - Tuna grahita ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> C1 - Tuna grahita ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> D - Tuna daksa ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> D1 - Tuna daksa sedang
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> E - Tuna laras
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> F - Tuna wicara
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> H - Hiperaktif
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> I - Cerdas Istimewa
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> J - Bakat Istimewa
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> K - Kesulitan Belajar
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> N - Narkoba
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> O - Indigo
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> P - Down Syndrome
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> Q - Autis
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Ayah
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input type="checkbox"> A - Tuna netra
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> B - Tuna rungu
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> C - Tuna grahita ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> C1 - Tuna grahita ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> D - Tuna daksa ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> D1 - Tuna daksa sedang
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> E - Tuna laras
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> F - Tuna wicara
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> H - Hiperaktif
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> I - Cerdas Istimewa
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> J - Bakat Istimewa
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> K - Kesulitan Belajar
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> N - Narkoba
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> O - Indigo
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> P - Down Syndrome
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ayah_kh[]" type="checkbox"> Q - Autis
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v3__review-item">
                                                <div class="kt-wizard-v3__review-title">
                                                    Ibu
                                                </div>
                                                <div class="kt-wizard-v3__review-content">
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input type="checkbox"> A - Tuna netra
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> B - Tuna rungu
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> C - Tuna grahita ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> C1 - Tuna grahita ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> D - Tuna daksa ringan
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> D1 - Tuna daksa sedang
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> E - Tuna laras
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> F - Tuna wicara
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> H - Hiperaktif
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> I - Cerdas Istimewa
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> J - Bakat Istimewa
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="ibu_kh[]" type="checkbox"> K - Kesulitan Belajar
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> N - Narkoba
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> O - Indigo
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> P - Down Syndrome
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                    <input name="mahasiswa_kh[]" type="checkbox"> Q - Autis
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
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
                                        Sebelumnya
                                    </button>
                                    <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                        Simpan
                                    </button>
                                    <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                        Selanjutnya
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

@section('js')

@stop

@endsection
