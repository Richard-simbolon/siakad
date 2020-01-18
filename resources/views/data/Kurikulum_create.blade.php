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
                    Akademik </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{url('/data/kurikulum')}}" class="kt-subheader__breadcrumbs-link">
                        Kurikulum </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Tambah </a>
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
            <div class="col-xl-12">
                <div class="alert alert-light alert-warning" style="background-color: #c9e4b061;border-color: #c9e4b061;" role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-warning" style="color:#000000;"></i>
                    </div>
                    <div class="alert-text">
                        <h5>Pemberitahuan</h5>
                        <p>Pada saat menyimpan kurikulum baru akan secara otomatis disinkronisasi ke Forlap Dikti. </p>
                    </div>
                </div>
            </div>
        </div>
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
                                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"></path>
                                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                            <h3 class="kt-portlet__head-title">
                                &nbsp;Kurikulum
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline show">
                                <a href="{{ url('/data/kurikulum') }}" class="btn btn-success">
                                    <i class="la la-bars"></i> Daftar &nbsp;
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->

                    <div class="kt-portlet__body">
                        <form class="kt-form">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Nama Kurikulum * </label>
                                        <input type="text" class="form-control" name="nama_kurikulum" placeholder="Isikan Nama Kurikulum">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label class="select2-label">Program Studi *</label>
                                    <div class="form-group">
                                        <select name="program_studi_id" class="form-control kt-select2 update_list_matakuliah" >
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach ($master['jurusan'] as $item)
                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <label class="select2-label">Mulai berlaku *</label>
                                    <div class="form-group">
                                        <select name="mulai_berlaku" class="form-control kt-select2">
                                            <option value=" ">-- Pilih Semester --</option>
                                            @foreach ($master['semester'] as $item)
                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Jumlah Bobot Matakuliah Wajib *</label>
                                        <input type="text" class="form-control" name="jumlah_bobot_mk_wajib" placeholder="Isikan Jumlah Bobot Matakuliah Wajib">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Jumlah Bobot Matakuliah Pilihan *</label>
                                        <input type="text" class="form-control" name="jumlah_bobot_mk_pilihan" placeholder="Isikan Jumlah Bobot Matakuliah Pilihan">
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="kt-wizard-v3__review-title">
                                        <b>Silahkan checklist matakuliah yang dimasukkan dalam kurikulum</b>
                                        <br/><p></p>
                                        <p>Jumlah SKS wajib :<b id="skswajib"></b></p>
                                        <p>Jumlah Semua SKS : <b id="semuasks"></b></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="dataTable table table-striped table-bordered table-hover responsive" >
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Pilih</th>
                                            <th rowspan="2">Kode Matakuliah</th>
                                            <th rowspan="2">Nama Matakuliah</th>
                                            <th colspan="5" style="text-align: center">Bobot Matakuliah (SKS)</th>
                                            <th rowspan="2" style="text-align: center">Semester</th>
                                            <th rowspan="2" style="text-align: center">Wajib?</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">Matakuliah</th>
                                            <th style="text-align: center">Tatap Muka</th>
                                            <th style="text-align: center">Praktikum</th>
                                            <th style="text-align: center">Praktek Lapangan</th>
                                            <th style="text-align: center">Simulasi</th>
                                        </tr>
                                        </thead>
                                        <tbody class="append_matakuliah">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>

                            <div class="root">
                                <div class="kt-form__actions">
                                    <a href="{{url('/data/kurikulum')}}" style="align:right" class="btn btn-label-success"><i class="la la-arrow-left"></i>Kembali</a>
                                    <button type="button" class="btn btn-success save-kurikulum"><i class="la la-save"></i>Simpan</button>
                                </div>
                                
                            </div>
                        </form>
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

<script>
    var url = '/data/dosen';
    var form = 'dosen-form';
</script>

@section('js')



@stop

@endsection
