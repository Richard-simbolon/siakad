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
                        KRS </a>
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
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"></path>
                                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                        <h3 class="kt-portlet__head-title">
                            &nbsp; KARTU RENCANA STUDI (KRS)
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="dropdown dropdown-inline show">
                                <button type="button" class="btn btn-outline-success"  onclick="window.location.href='{{url('print_krs')}}'"><i class="la la-print"></i> Cetak KRS</button>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <div class="kt-portlet__body">
                    <div class="col-lg-12">
                        
                            <div class="row">
                                <div class="col-lg-6">
                                    <table cellpadding="5">
                                        <tbody>
                                        <tr>
                                            <td width="107px">Nirm</td>
                                            <td>:</td>
                                            <td><b>{{$profile->nim}}</b></td>
                                        </tr>
                                        <tr>
                                            <td width="107px">Nama</td>
                                            <td>:</td>
                                            <td><b>{{$profile->nama}}</b></td>
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
                                        <tbody><tr>
                                            <td>Tahun Akademik</td>
                                            <td>:</td>
                                            <td><b>{{$semester_active->title}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Program Studi</td>
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
                        </div>
                        <br/><br/>
                    <div>
                            <table class="dataTable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th style="text-align: center">Bobot SKS</th>
                                <th>Nama Dosen Pengampu</th>
                                <th>Kelas</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                    $sks = 0;
                                ?>
                                @foreach ($data as $item)
                                <?php $i++;
                                $sks += $item->bobot_mata_kuliah;
                                ?>
                                    <tr>
                                        <td style="text-align: center">{{$i}}</td>
                                        <td>{{$item->kode_mata_kuliah}}</td>
                                        <td>{{$item->matakuliah_title}}</td>
                                        <td style="text-align: center">{{$item->bobot_mata_kuliah}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->kelas_title}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align: center" colspan="4"><b>Total SKS</b></td>
                                    <td style="text-align: center" ><b>{{$sks}}</b></td>
                                    <td style="text-align: center" ></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12" style="text-align:right">
                        
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

<script src="{{asset('assets/js/pages/crud/datatables/advanced/row-grouping.js')}}" type="text/javascript"></script>

@endsection