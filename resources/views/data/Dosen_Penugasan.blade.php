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
                                    <a href="{{url('data/dosen/view/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-user"></i>
                                        <span class="kt-nav__link-text">Detail Dosen</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('dosen/penugasan/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-digital-marketing"></i>
                                        <span class="kt-nav__link-text">Penugasan Dosen</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                        <span class="kt-nav__link-text">Aktivitas Mengajar Dosen</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('dosen/fungsional/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-cardiogram"></i>
                                        <span class="kt-nav__link-text">Riwayat Fungsional</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('dosen/pengangkatan/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-indent-dots"></i>
                                        <span class="kt-nav__link-text">Riwayat Kepangkatan</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('dosen/pendidikan/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-graphic"></i>
                                        <span class="kt-nav__link-text">Riwayat Pendidikan</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('dosen/sertifikasi/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-crisp-icons"></i>
                                        <span class="kt-nav__link-text">Riwayat Sertifikasi</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('dosen/penelitian/'.$data['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-graph-2"></i>
                                        <span class="kt-nav__link-text">Riwayat Penelitian</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="layout/skins/dosen-pembimbing.html" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                        <span class="kt-nav__link-text">Pembimbing Aktivitas Mahasiswa</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="layout/skins/dosen-penguji.html" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-infographic"></i>
                                        <span class="kt-nav__link-text">Penguji Aktivitas Mahasiswa</span>
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
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"></path>
                                        <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"></rect>
                                    </g>
                                </svg>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                &nbsp;Daftar Penugasan Dosen
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-subheader__wrapper">
                                <a href="javascript:void(0);" class="btn btn-success tambah_penugasan">
                                    <i class="flaticon-plus"></i> Tambah Riwayat &nbsp;
                                </a>
                            </div>
                        </div>
                    </div>
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
                                                            <td><b>{{$data['status']}}</b></td>
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
                                                            <div class="kt-radio-inline">
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
                                                            <select name="dosen[agama]" class="form-control">
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
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-toolbar">
                                    <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#info_dasar" role="tab">
                                                Daftar Penugasan
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="kt_table_1">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Progaram Studi</th>
                                            <th>No Surat Tugas</th>
                                            <th>TMT Surat Tugas</th>
                                            <th>Tanggal Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0;?>
                                            @foreach ($penugasan as $item)
                                            <?php $i++;?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$item['tahun_ajaran_title']}}</td>
                                                    <td>{{$item['program_studi_title']}}</td>
                                                    <td>{{$item['no_surat_tugas']}}</td>
                                                    <td>{{$item['tmt_surat_tugas']}}</td>
                                                    <td>{{$item['tanggal_surat_tugas']}}</td>
                                                    <td nowrap=""><a href="layout/skins/mhs-view-edit.html">view/edit</a> </td>
                                                </tr>
                                                
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kt_modal_penugasan_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" id="penugasanform" style="">
                    <div class="modal-body">
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--begin::Portlet-->
                                    <input type="hidden" value="{{$data['id']}}" name="dosen_id"/>
                                    <div class="kt-portlet">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-label">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3"></path>
                                                        <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <h3 class="kt-portlet__head-title">
                                                    &nbsp;Tambah Penugasan Dosen
                                                </h3>
                                            </div>
                                        </div>
                                        <!--begin::Form-->
                                        <div class="kt-portlet__body">
                                            <div class="kt-portlet">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-toolbar">
                                                        <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#info_dasar" role="tab">
                                                                    <i class="flaticon-clipboard"></i> Formulir Penugasan
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Tahun Ajaran</label>
                                                                <div class="form-group">
                                                                    <select name="tahun_ajaran" class="form-control">
                                                                        <option value="">-- Pilih Tahun Ajaran--</option>
                                                                        <option value="1">2019/2010</option>
                                                                        <option value="2">2018/2019</option>
                                                                        <option value="3">2017/2018</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Program Studi</label>
                                                                <div class="form-group">
                                                                    <select name="program_studi_id" class="form-control">
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
                                                                <label>No Surat Tugas</label>
                                                                <input type="text" class="form-control" name="no_surat_tugas" placeholder="Isikan Nomor Surat Tugas">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Surat Tugas</label>
                                                                <input type="date" class="form-control" name="tanggal_surat_tugas">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label>TMT Surat Tugas</label>
                                                                <input type="date" class="form-control" name="tmt_surat_tugas" placeholder="Isikan TMT Surat Tugas">
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
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger savepenugasan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<style>
    .m-content{width:100%;}
    </style>
@section('js')

@stop

@endsection
