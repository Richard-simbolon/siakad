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
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Penugasan </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
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
                                <a href="javascript:void(0);" class="btn btn-success tambah_penugasan_dosen">
                                    <i class="la la-plus"></i> Tambah  &nbsp;
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
                                                            <td><b>{{$data['status'] ? ucfirst($data['status']) : "-"}}</b></td>
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
                                    <table class="dataTable table table-striped table-bordered table-hover responsive no-wrap" id="kt_table_1">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Progaram Studi</th>
                                            <th>No Surat Tugas</th>
                                            <th>TMT Surat Tugas</th>
                                            <th>Tanggal Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0;
                                            ?>
                                            @foreach ($penugasan as $item)
                                            <?php $i++;?>
                                                <tr>
                                                    <td style="vertical-align: middle" align="center">{{$i}}</td>
                                                    <td style="vertical-align: middle">{{$item['tahun_ajaran_title']}}</td>
                                                    <td style="vertical-align: middle">{{$item['program_studi_title']}}</td>
                                                    <td style="vertical-align: middle">{{$item['no_surat_tugas']}}</td>
                                                    <td style="vertical-align: middle">{{$item['tmt_surat_tugas']}}</td>
                                                    <td style="vertical-align: middle">{{$item['tanggal_surat_tugas']}}</td>
                                                    <td nowrap="" style="vertical-align: middle">
                                                        <a style="font-size: 18px;color: #607D8B;" class="call-modal-penugasan" href="javascript:void(0)" attr="{{$item['id']}}"><i class="la la-edit"></i> </a> &nbsp;
                                                        <a style="font-size: 18px;color: #607D8B;" class="delete_item" href="javascript:void(0)" attr="{{$item['id']}}" type="penugasan"><i class="la la-trash"></i> </a>
                                                    </td>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penugasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form class="kt-form" id="penugasanform" style="">
                <div class="modal-body">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--begin::Portlet-->
                                <input type="hidden" value="{{$data['id']}}" name="dosen_id"/>
                                <input type="hidden" name="id_penugasan" id="id_penugasan"/>
                                <div class="">
                                    <div class="kt-portlet__body">
                                        <div class="kt-portlet">
                                            <div class="kt-portlet__body">
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Tahun Ajaran</label>
                                                            <div class="form-group">
                                                                <select name="tahun_ajaran" class="form-control">
                                                                    <option value="">-- Pilih Tahun Ajaran--</option>
                                                                    @foreach ($master['tahun_ajaran'] as $item)
                                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                                    @endforeach
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
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal" >Batal</button>
                    <button type="button" class="btn btn-success dosensavepenugasan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .m-content{width:100%;}
    </style>
@endsection

@section('js')
    <script src="{{asset('assets/js/pages/dosen/absensi.js')}}" type="text/javascript"></script>
@endsection


