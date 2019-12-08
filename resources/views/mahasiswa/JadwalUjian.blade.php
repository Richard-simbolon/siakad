@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Mahasiswa </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Jadwal Ujian </a>
                </div>
                
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
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
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000" />
                                    <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Jadwal Perkuliahan
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="dropdown dropdown-inline show">
                            <a href="{{url('/data/mahasiswa/kartuujian')}}" class="btn btn-outline-success"><i class="la la-print"></i> Cetak Kartu Ujian</a>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <div class="kt-portlet__body">
                    <div class="col-lg-12">
                        <?php
                            if(count($data) > 0){
                                $profile = $data[0];
                                //print_r($profile); 
                            }    
                        ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <table cellpadding="5">
                                        <tbody>
                                        <tr>
                                            <td width="107px">Nirm</td>
                                            <td>:</td>
                                            <td><b>{{Auth::user()->login}}</b></td>
                                        </tr>
                                        <tr>
                                            <td width="107px">Nama</td>
                                            <td>:</td>
                                            <td><b>{{Auth::user()->nama}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Angkatan</td>
                                            <td>:</td>
                                            <td><b>{{$profile->angkatan_title}}</b></td>
                                        </tr>
                                        
                                    </tbody></table>
                                </div>
                                <div class="col-lg-6">
                                    <table cellpadding="5">
                                        <tbody>
                                        <tr>
                                            <td>Jurusan</td>
                                            <td>:</td>
                                            <td><b>{{$profile->jurusan_title}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>:</td>
                                            <td><b>{{$profile->kelas_title}}</b></td>
                                        </tr>
                                    </tbody></table>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Tahun Akademik</label>
                                        <select id="jadwal_ujian" name="angkatan_id" class="form-control kt-select2">
                                            <option value="">Select</option>
                                            @foreach ($select2 as $item)
                                                <option value="{{$item['semester_id']}}" > {{$item['semseter_title']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table class=" table table-striped- table-bordered table-hover table-checkable" id="jadwalujiandata">
                            <thead>
                            <tr>
                                <th style="text-align: center">Kode MK</th>
                                <th style="text-align: center">Mata Kuliah</th>
                                <th style="text-align: center">Bobot SKS</th>
                                <th style="text-align: center">Jam</th>
                                <th style="text-align: center">Tanggal Ujian</th>
                                <th style="text-align: center">Hari</th>
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
    <!-- end:: Content -->
</div>

<style>
    .m-content{width:100%};
    </style>
@endsection

@section('js')
    <script src="{{asset('assets/js/pages/jadwalmahasiswa/jadwalmahasiswa.js')}}" type="text/javascript"></script>
@endsection