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
                    Dosen </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{url('data/dosen')}}" class="kt-subheader__breadcrumbs-link">
                        Daftar </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        Detail </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <div class="kt-portlet__head-toolbar">
                        @include('layout.dosen_detail')
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
                                Data Dosen
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                    <input type="hidden" value="{{$data['id']}}" id="id_to_delete">
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
                                            <a href="javascript:void(0)" id="editdosen" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-edit"></i>
                                                <span class="kt-nav__link-text">Ubah Data</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" data-toggle="modal" data-target="#kt_modal_reset_password">
                                                <i class="kt-nav__link-icon flaticon2-refresh"></i>
                                                <span class="kt-nav__link-text">Reset Password</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" id="btn_hapus_dosen">
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
                    <form id="form-update-dosen" class="form-pcontrol form-update-dosen" >
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
                                            <!--info dasar-->
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <table cellpadding="5">
                                                        <tr>
                                                            <td width="107px">Nama</td>
                                                            <td>:</td>
                                                            <td><b>{{$data['nama']}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tempat Lahir</td>
                                                            <td>:</td>
                                                            <td><b>{{$data['tempat_lahir']}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Kelamin</td>
                                                            <td>:</td>
                                                            <td><b>{{$master['jenis_kelamin'][$data['jenis_kelamin']]}}</b></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4">
                                                    <table cellpadding="5">
                                                        <tr>
                                                            <td>NIDN / NUP / NIDK</td>
                                                            <td>:</td>
                                                            <td><b>{{$data['nidn_nup_nidk']}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Lahir</td>
                                                            <td>:</td>
                                                            <td><b>{{$data['tanggal_lahir']}}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Agama</td>
                                                            <td>:</td>
                                                            <td><b>{{$data['title']}}</b></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-4">
                                                    <table cellpadding="5">
                                                        <tr>
                                                            <td width="107px">Status</td>
                                                            <td>:</td>
                                                            <td><b>{{$data['status_keaktifan']}}</b></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--end of info dasar-->
                                        </div>
                                        <div class="tab-content" id="informasidasar" style="display:none">
                                            <div class="kt-wizard-v3__form">
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label>Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="dosen[nama]" value="{{$data['nama']}}" placeholder="Isikan nama lengkap">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label>NIDN / NUP / NIDK</label>
                                                                <input type="text" class="form-control" name="dosen[nidn_nup_nidk]" value="{{$data['nidn_nup_nidk']}}"  placeholder="Isikan NIDN / NUP / NIDK">
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="dosen[id]" value="{{$data['id']}}" />
                                                    
                                                   
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label>Tempat lahir</label>
                                                                <input type="text" class="form-control" name="dosen[tempat_lahir]" value="{{$data['tempat_lahir']}}" placeholder="Isikan tempat lahir">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Jenis Kelamin</label>
                                                            <div class="kt-radio-inline" style="padding-top: 9px;">
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="dosen[jenis_kelamin]" value="laki-laki" {{$data['jenis_kelamin'] == 'laki-laki' ? 'checked' :''}}> Laki-laki
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="dosen[jenis_kelamin]" value="perempuan" {{$data['jenis_kelamin'] == 'perempuan' ? 'checked' :''}}> Perempuan
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Agama:</label>
                                                            <select name="dosen[agama]" class="form-control kt-select2">
                                                                <option value="">Select</option>
                                                                @foreach ($master['agama'] as $item)
                                                                    <option value="{{$item['id']}}" {{$item['id'] == $data['agama'] ? 'selected' : ''}} > {{$item['title']}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Tanggal lahir</label>
                                                            <input type="date" class="form-control" name="dosen[tanggal_lahir]" value="{{$data['tanggal_lahir']}}" placeholder="Isikan nama ibu">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Portlet-->
                            <div class="kt-portlet kt-portlet--tabs">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_biodata" role="tab">
                                                    Biodata
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_keluarga" role="tab">
                                                    Keluarga
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
                                        <div class="tab-pane active" id="kt_portlet_biodata">
                                            <div class="kt-wizard-v3__form">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Nama Ibu</label>
                                                            <input type="text" class="form-control" name="dosen[nama_ibu]" value="{{$data['nama_ibu']}}" placeholder="Isikan Nama Ibu">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>NIK </label>
                                                            <input type="text" class="form-control" name="dosen[nik]" value="{{$data['nik']}}" placeholder="Isikan NIK">
                                                            <span class="form-text text-muted">Nomor KTP tanpa tanda baca</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>NIP </label>
                                                            <input type="text" class="form-control" name="dosen[nip]" value="{{$data['nip']}}" placeholder="Isikan NIP">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>NPWP </label>
                                                            <input type="text" class="form-control" name="dosen[npwp]" value="{{$data['npwp']}}" placeholder="Isikan Ikatan Kerja">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Jenis Pegawai </label>
                                                            <select name="dosen[jenis_pegawai]" class="form-control kt-select2">
                                                                <option value="">--Pilih Status--</option>
                                                                @foreach ($master['jenis_pegawai'] as $item)
                                                                    <option value="{{$item['id']}}" {{$item['id'] == $data['jenis_pegawai'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="block" style="display: block">Status Keaktifan Pegawai</label>
                                                            <select name="dosen[status_pegawai]" class="form-control kt-select2">
                                                                <option value="">--Pilih Status--</option>
                                                                @foreach ($master['status_keaktifan'] as $item)
                                                                    <option value="{{$item['id']}}" {{$item['id'] == $data['status_pegawai'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>No SK CPNS</label>
                                                            <input type="text" class="form-control" name="dosen[no_sk_cpns]" value="{{$data['no_sk_cpns']}}" placeholder="Isikan No SK PNS">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SK CPNS</label>
                                                            <input type="date" class="form-control" name="dosen[tanggal_sk_cpns]" value="{{$data['tanggal_sk_cpns']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>No SK Pengangkatan</label>
                                                            <input type="text" class="form-control" name="dosen[no_sk_pengangkatan]" value="{{$data['no_sk_pengangkatan']}}" placeholder="Isikan No SK Pengangkatan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Tanggal SK Pengangkatan</label>
                                                            <input type="date" class="form-control" name="dosen[tgl_sk_pengangkatan]" value="{{$data['tgl_sk_pengangkatan']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Lembaga Pengangkatan </label>
                                                            <input type="text" class="form-control" name="dosen[lembaga_pengangkatan]" value="{{$data['lembaga_pengangkatan']}}" placeholder="Isikan Lembaga Pengangkatan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Pangkat Golongan </label>
                                                            <input type="text" class="form-control" name="dosen[pangkat_golongan]" value="{{$data['pangkat_golongan']}}" placeholder="Isikan Pangkat Golongan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Sumber Gaji </label>
                                                            <input type="text" class="form-control" name="dosen[sumber_gaji]" value="{{$data['sumber_gaji']}}" placeholder="Isikan Sumber Gaji">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Alamat *</label>
                                                            <textarea type="text" class="form-control" name="dosen[alamat]" value="{{$data['alamat']}}" placeholder="Isikan Alamat"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Dusun</label>
                                                            <input type="text" class="form-control" name="dosen[dusun]" value="{{$data['dusun']}}" placeholder="Isikan Dusun">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>RT</label>
                                                            <input type="text" class="form-control" name="dosen[rt]" value="{{$data['rt']}}"  placeholder="Isikan  RT">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>RW</label>
                                                            <input type="text" class="form-control" name="dosen[rw]" value="{{$data['rw']}}"  placeholder="Isikan RW">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Kecamatan</label>
                                                            <input type="text" class="form-control" name="dosen[kecamatan]" value="{{$data['kecamatan']}}" placeholder="Isikan Kecamatan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Kelurahan</label>
                                                            <input type="text" class="form-control" name="dosen[kelurahan]" value="{{$data['kelurahan']}}"  placeholder="Isikan Kelurahan">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Kode Pos</label>
                                                            <input type="text" class="form-control" name="dosen[kode_pos]" value="{{$data['kode_pos']}}"  placeholder="Isikan Kode Pos">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>No Handphone</label>
                                                            <input type="text" class="form-control" name="dosen[no_hp]" value="{{$data['no_hp']}}"  placeholder="Isikan Nomor Telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Telepon</label>
                                                            <input type="text" class="form-control" name="dosen[telepon]" value="{{$data['telepon']}}"  placeholder="Isikan Nomor Telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" class="form-control" name="dosen[email]" value="{{$data['email']}}"  placeholder="Isikan Email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="kt_portlet_keluarga">
                                            <div class="kt-wizard-v3__form">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Status Pernikahan</label>
                                                            <select name="keluarga[status_pernikahan]" class="form-control">
                                                                <option value="">-- Pilih Status Pernikahan --</option>
                                                                @foreach (config('global.status_pernikahan') as $key=>$item)
                                                                    <option value="{{$key}}" {{$key == $data['status_pernikahan'] ? 'selected' : ''}}> {{$item}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Nama Suami / Istri</label>
                                                            <input type="text" class="form-control" name="keluarga[nama_pasangan]" value="{{$data['nama_pasangan']}}"  placeholder="Isikan Nama Suami / Istri">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>NIP Suami / Istri</label>
                                                            <input type="text" class="form-control" name="keluarga[nip_pasangan]" value="{{$data['nip_pasangan']}}"  placeholder="Isikan Nama Suami / Istri">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>TMT PNS</label>
                                                            <input type="date" class="form-control" name="keluarga[tmt_pns]" value="{{$data['tmt_pns']}}"  placeholder="Isikan Tanggal Lahir">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="block" style="display: block">Pekerjaan</label>
                                                            <select name="keluarga[pekerjaan]" class="form-control">
                                                                @foreach ($master['pekerjaan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id'] == $data['pekerjaan'] ? 'selected' : ''}} >{{$item['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="kt_portlet_kebutuhan_khusus">
                                            <div class="kt-wizard-v3__content">
                                                <div class="kt-form__section kt-form__section--first">
                                                    <div class="kt-wizard-v3__review">
                                                        <div class="kt-wizard-v3__review-item">
                                                            <div class="kt-wizard-v3__review-title">
                                                                <p><b>Mampu Menghandle Kebutuhan Khusus : </b></p>
                                                                <?php
                                                                    $kebdosen = json_decode($data['kebutuhan_khusus'] , true);
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
                                                                                        @if($kebdosen)
                                                                                            <input type="checkbox" name="dosen_kh[]" value="{{$value['id']}}" {{in_array($value['id'] , $kebdosen['dosen']) ? 'checked' : ''}} > {{$value['title']}}
                                                                                        @else
                                                                                            <input type="checkbox" name="dosen_kh[]" value="{{$value['id']}}"  > {{$value['title']}}
                                                                                        @endif
                                                                                        <span></span>
                                                                                    </label>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="kt-wizard-v3__review-item">
                                                            <div class="kt-wizard-v3__review-title">
                                                                Mampu Menghandle Braile ?
                                                            </div>
                                                            <div class="kt-wizard-v3__review-content">
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="braile" value="ya" {{$data['braile'] == 'ya' ? 'checked' : ''}}> Ya
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="braile" value="tidak" {{$data['braile'] == 'tidak' ? 'checked' : ''}}> Tidak
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="kt-wizard-v3__review-item">
                                                            <div class="kt-wizard-v3__review-title">
                                                                Mampu Menghandle Bahasa Isyarat ?
                                                            </div>
                                                            <div class="kt-wizard-v3__review-content">
                                                                <div class="kt-radio-inline">
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="isyarat" value="ya" {{$data['isyarat'] == 'ya' ? 'checked' : ''}}> Ya
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="isyarat" value="tidak" {{$data['isyarat'] == 'tidak' ? 'checked' : ''}}> Tidak
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
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <button type="button" id="actionupdatedosen" class="btn btn-success pull-right">Submit</button>
                                </div>
                            </div>
                            <!--end::Portlet-->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal : ubah status-->
<div class="modal fade" id="kt_modal_ubah_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Form perubahan status</p>
                <div class="form-group">
                    <div class="form-group">
                        <label>Status sekarang: </label>
                        <input type="text" class="form-control" value="Aktif" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label>Ubah Status ke: </label>
                        <select name="status_change" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="1">AKTIF</option>
                            <option value="2">Lulus</option>
                            <option value="3">Mutasi</option>
                            <option value="4">Dikeluarkan</option>
                            <option value="5">Mengundurkan Diri</option>
                            <option value="6">Putus Sekolah</option>
                            <option value="7">Wafat</option>
                            <option value="8">Hilang</option>
                            <option value="3">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Ubah Sekarang</button>
            </div>
        </div>
    </div>
</div>
<!--end modal-->

<!--modal : ubah reset password-->
<div class="modal fade" id="kt_modal_reset_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Klik button "Atur Ulang" untuk membuat password baru</p>
                <div class="form-group">
                    <input type="text" class="form-control" id="txt_new_password" style="font-size: 20px;">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success pull-right" id="btn_reset_password">Atur Ulang</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end modal-->

<!--modal : ubah hapus-->
<div class="modal fade" id="kt_modal_hapus_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
<!--end modal-->

<style>
    .m-content{width:100%;}
    </style>
@section('js')
    <script src="{{asset('assets/js/pages/dosen/dosen.js')}}" type="text/javascript"></script>
@stop

@endsection
