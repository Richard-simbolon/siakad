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
                                                    <span class="kt-nav__link-text">Edit</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
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
                        <form class="fkt-form form-mahasiswa" >
                        <div class="kt-portlet__body">
                            <div class="kt-portlet kt-portlet--tabs">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#info_dasar" role="tab">
                                                    Informasi Dasar
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="info_dasar">
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
                                                            <td><b>Aktif</b></td>
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
                                                            <td><b>2019</b></td>
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
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="informasidasar" style="display:none"> 
                                            <div class="tab-pane active" id="info_dasar">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                        <input type="text" class="form-control" name="nama_wali" value="{{$data['nama']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>NIM</label>
                                                            <input type="text" class="form-control" name="nama_wali" value="{{$data['nim']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Jurusan</label>
                                                            <input type="text" class="form-control" name="nama_wali" value="{{$data['title']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Jenis Kelamin</label>
                                                        <input type="text" class="form-control" name="nama_wali" value="{{$data['jk']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Tempat Lahir</label>
                                                            <input type="text" class="form-control" name="nama_wali" value="{{$data['tempat_lahir']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <input type="text" class="form-control" name="nama_wali" value="{{ date_format (new DateTime($data['tanggal_lahir']), 'd-m-Y')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                
                            </div>

                                <div class="kt-portlet kt-portlet--tabs">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-toolbar">
                                                <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_history_pendaftaran" role="tab">
                                                            History Pendaftaran
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_alamat" role="tab">
                                                            Alamat
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_orang_tua" role="tab">
                                                            Orangtua
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_wali" role="tab">
                                                            Wali
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_kebutuhan_khusus" role="tab">
                                                            Kebutuhan Khusus
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="kt_portlet_history_pendaftaran">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Jenis Pendaftaran *</label>
                                                                <select name="jenis_tingal" class="form-control">
                                                                        <option value="">-- Jenis Pendaftaran --</option>
                                                                        @foreach ($master['jenis_pendaftaran'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $data['jenis_pendaftaran'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Jalur Pendaftaran</label>
                                                                <select name="jalur_pendaftaran" class="form-control">
                                                                        <option value="">-- Jenis Pendaftaran --</option>
                                                                        @foreach ($master['jalur_pendaftaran'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $data['jalur_pendaftaran'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Masuk *</label>
                                                            <input type="date" class="form-control" name="tanggal_masuk" placeholder="Isikan nama ibu" value="{{$data['tanggal_masuk']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Pembiayaan Awal</label>
                                                                <select name="jalur_pendaftaran" class="form-control">
                                                                    <option value="">-- Jenis Pendaftaran --</option>
                                                                    @foreach ($master['jenis_pembiayaan'] as $item)
                                                                        <option value="{{$item['id']}}" {{$item['id'] == $data['jenis_pembiayaan'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Biaya Masuk </label>
                                                            <input type="text" class="form-control" name="biaya_masuk" placeholder="Isikan Biaya Masuk" value="{{$data['biaya_masuk']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="kt_portlet_alamat">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>NIK *</label>
                                                            <input type="text" class="form-control" name="nik" placeholder="Isikan NIK" value="{{$data['nik']}}">
                                                                <span class="form-text text-muted">Nomor KTP tanpa tanda baca, Isikan Nomor Paspor untuk Warga Negara Asing</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>NISN</label>
                                                                <input type="text" class="form-control" name="nisn" placeholder="Isikan NISN" value="{{$data['nisn']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Kewarganegaraan *</label>
                                                                <input type="text" class="form-control" name="kewarganegaraan" placeholder="Isikan Kewarganegaraan" value="{{$data['kewarganegaraan']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Jalan *</label>
                                                    <textarea type="text" class="form-control" name="alamat" placeholder="Isikan Alamat">{{$data['alamat']}}</textarea>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label>Dusun</label>
                                                                <input type="text" class="form-control" name="dusun" placeholder="Isikan Dusun" value="{{$data['dusun']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label>RT</label>
                                                                <input type="text" class="form-control" name="rt" placeholder="Isikan  RT" value="{{$data['rt']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label>RW</label>
                                                                <input type="text" class="form-control" name="rw" placeholder="Isikan RW" value="{{$data['rw']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Kelurahan</label>
                                                                <input type="text" class="form-control" name="kelurahan" placeholder="Isikan Kelurahan" value="{{$data['kelurahan']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Kode Pos</label>
                                                                <input type="text" class="form-control" name="kode_pos" placeholder="Isikan Kode Pos" value="{{$data['kode_pos']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Kecamatan</label>
                                                                <input type="text" class="form-control" name="kecamatan" placeholder="Isikan Kecamatan" value="{{$data['kecamatan']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Jenis Tinggal</label>
                                                                <select name="jenis_tingal" class="form-control">
                                                                        <option value="">-- Jenis Tinggal --</option>
                                                                        @foreach ($master['jenis_tinggal'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $data['jenis_tinggal'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Alat Transpostrasi</label>
                                                                <select name="alat_transportasi" class="form-control">
                                                                        <option value="">-- Alat Transpostrasi --</option>
                                                                        @foreach ($master['alat_transportasi'] as $item)
                                                                            
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $data['alat_transportasi'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Telepon</label>
                                                            <input type="text" class="form-control" name="telepon" placeholder="Isikan Nomor Telepon" value="{{$data['no_telepon']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="email" placeholder="Isikan Email" value="{{$data['email']}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Penerima KPS? *</label>
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="kps" {{$data['is_penerima_kps'] == 1 ? 'checked' : ''}}> Ya
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="kps" {{$data['is_penerima_kps'] == 0 ? 'checked' : ''}}> Tidak
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>No KPS:</label>
                                                            <input type="text" class="form-control" name="no_kps" placeholder="Isikan Nomor KPS" value="{{$data['no_kps']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="kt_portlet_orang_tua">
                                                    <?php
                                                        $otw = [];
                                                        foreach($orangtuawali as $value){
                                                            $otw[$value['kategori']] = $value;
                                                        }    
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>NIK Ayah</label>
                                                                <input type="text" class="form-control" name="nik_ayah" placeholder="Isikan NIK" value="{{$otw['ayah']['nik']}}">
                                                                <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Ayah</label>
                                                                <input type="text" class="form-control" name="nama_ayah" placeholder="Isikan Nama" value="{{$otw['ayah']['nama']}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir Ayah</label>
                                                                <input type="date" class="form-control" name="tanggal_lahir_ayah" placeholder="Isikan Tanggal Lahir" value="{{$otw['ayah']['tanggal_lahir']}}" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pendidikan Ayah</label>
                                                                <select name="alat_transportasi" class="form-control">
                                                                        <option value="">-- Pendidikan Ayah --</option>
                                                                        @foreach ($master['pendidikan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['ayah']['pendidikan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pekerjaan Ayah</label>
                                                                <select name="alat_transportasi" class="form-control">
                                                                        <option value="">-- Pekerjaan Ayah --</option>
                                                                        @foreach ($master['pekerjaan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['ayah']['pekerjaan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Penghasilan Ayah</label>
                                                                <select name="alat_transportasi" class="form-control">
                                                                        <option value="">-- Penghasilan Ayah --</option>
                                                                        @foreach ($master['penghasilan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['ayah']['penghasilan'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>NIK Ibu</label>
                                                                <input type="text" class="form-control" name="nik_ibu" placeholder="Isikan NIK" value="{{$otw['ibu']['nik']}}"> 
                                                                <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Ibu</label>
                                                                <input type="text" class="form-control" name="nama_ibu" placeholder="Isikan Nama" value="{{$otw['ibu']['nama']}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir Ibu</label>
                                                                <input type="date" class="form-control" name="tanggal_lahir_ibu" placeholder="Isikan Tanggal Lahir" value="{{$otw['ibu']['tanggal_lahir']}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pendidikan Ibu</label>
                                                                <select name="pendidikan_ibu" class="form-control">
                                                                    <option value="">-- Pilih Jenjang --</option>
                                                                    @foreach ($master['pendidikan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['ibu']['pendidikan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pekerjaan Ibu</label>
                                                                <select name="pekerjaan_ibu" class="form-control">
                                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                                        @foreach ($master['pekerjaan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['ibu']['pekerjaan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Penghasilan Ibu</label>
                                                                <select name="penghasilan_ibu" class="form-control">
                                                                    <option value="">-- Pilih Penghasilan --</option>
                                                                    @foreach ($master['penghasilan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['ibu']['penghasilan'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="kt_portlet_wali">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <input type="text" class="form-control" name="nama_wali" placeholder="Isikan Nama"  value="{{$otw['wali']['nama']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir </label>
                                                                <input type="date" class="form-control" name="tanggal_lahir_wali" placeholder="Isikan Tanggal Lahir"  value="{{$otw['wali']['tanggal_lahir']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Pendidikan</label>
                                                                <select name="pendidikan_wali" class="form-control">
                                                                    <option value="">-- Pilih Jenjang --</option>
                                                                    @foreach ($master['pendidikan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['wali']['pendidikan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Pekerjaan</label>
                                                                <select name="pekerjaan_wali" class="form-control">
                                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                                    @foreach ($master['pekerjaan'] as $item)
                                                                        <option value="{{$item['id']}}" {{$item['id'] == $otw['wali']['pekerjaan_id'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Penghasilan</label>
                                                                <select name="penghasilan_wali" class="form-control">
                                                                    <option value="">-- Pilih Penghasilan --</option>
                                                                        @foreach ($master['penghasilan'] as $item)
                                                                            <option value="{{$item['id']}}" {{$item['id'] == $otw['wali']['penghasilan'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="kt_portlet_kebutuhan_khusus">
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v3__review">
                                                                <div class="kt-wizard-v3__review-item">
                                                                    <div class="kt-wizard-v3__review-title"  style="padding:5px 0 5px 0;">
                                                                        <b>Mahasiswa</b>
                                                                        <?php
                                                                            $kebmahasiswa = json_decode($kebutuhan_selected['kebutuhan_mahasiswa'] , true);
                                                                        ?>
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
                                                                                                <input type="checkbox" name="mahasiswa_kh[]" {{in_array($value['id'] , $kebmahasiswa['mahasiswa']) ? 'checked' : ''}} > {{$value['title']}}
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
                                                                    <div class="kt-wizard-v3__review-title"  style="padding:5px 0 5px 0;">
                                                                        <b>Ayah</b>

                                                                        <?php
                                                                            $kebayah = json_decode($kebutuhan_selected['kebutuhan_ayah'] , true);
                                                                        ?>
                                                                    </div>
                                                                    <div class="kt-wizard-v3__review-content">
                                                                        <div class="row">
                                                                            @foreach ($kebutuhan as $item)
                                                                            <div class="col-xl-4">
                                                                                <div class="kt-checkbox-list">
                                                                                    @foreach ($item as $value)
                                                                                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                                            <input type="checkbox" name="ayah_kh[]" value="{{$value['id']}}" {{in_array($value['id'] , $kebayah['ayah']) ? 'checked' : ''}}> {{$value['title']}}
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
                                                                    <div class="kt-wizard-v3__review-title"  style="padding:5px 0 5px 0;">
                                                                        <b>Ibu</b>
                                                                        <?php
                                                                            $kebibu = json_decode($kebutuhan_selected['kebutuhan_ibu'] , true);
                                                                        ?>
                                                                    </div>
                                                                    <div class="kt-wizard-v3__review-content">
                                                                        <div class="row">
                                                                            @foreach ($kebutuhan as $item)
                                                                            <div class="col-xl-4">
                                                                                <div class="kt-checkbox-list">
                                                                                    @foreach ($item as $value)
                                                                                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                                                            <input type="checkbox" name="ibu_kh[]" value="{{$value['id']}}" {{in_array($value['id'] , $kebibu['ibu']) ? 'checked' : ''}} > {{$value['title']}}
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
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <button type="reset" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <!--end::Portlet-->
                        </div>
                    </div>
                </form>
                </div>
                
            
            </div>
        </div>


<style>
    .m-content{width:100%};
    </style>
@section('js')

@stop

@endsection
