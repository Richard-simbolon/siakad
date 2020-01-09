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
                    <a href="{{url()->previous()}}" class="kt-subheader__breadcrumbs-link">
                        Detail </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        {{$page}} </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                @include('layout.dosen_detail')
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
                                &nbsp;{{$title}}}
                            </h3>
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
                                                        <td><b>{{$data['status_keaktifan']}}</b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end of info dasar-->
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
                                                Daftar Mahasiwa
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <input type="hidden" name="dosen_id" id="dosen_id" value="{{$data['id']}}" >
                                    <table class="dataTable table table-striped table-bordered table-hover responsive" id="{{$idTable}}">
                                        <thead>
                                        <tr>
                                            {{-- <th style="text-align: center">No</th> --}}
                                            <th>Nim</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Judul</th>
                                            <th>Status Pembimbing</th>
                                            <th>Tanggal Awal </th>
                                            <th style="text-align: center">Tanggal Akhir</th>
                                            <th style="text-align: center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

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

<style>
    .m-content{width:100%;}
</style>
@section('js')
    <script src="{{asset('assets/js/pages/admin/dosen.js')}}" type="text/javascript"></script>
@stop

@endsection
