@extends('layout.app')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Akademik </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="{{url('/data/kelasperkuliahan')}}" class="kt-subheader__breadcrumbs-link">
                            Kelas Perkuliahan</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                            Tambah </a>
                    </div>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{url('/data/kelasperkuliahan')}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <form class="kt-form form-add-mahasiswa" id="kt_form" >
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"></path>
                                        <rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"></rect>
                                    </g>
                                </svg>
                                <h3 class="kt-portlet__head-title">
                                    &nbsp;Kelas Perkuliahan
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-xl-4">
                                    <label class="select2-label">Semester</label>
                                    <div class="form-group">
                                        <select name="semester_id" id="search-semester" class="form-control kt-select2">
                                            <option value="">Select</option>
                                            @foreach ($master['semester'] as $item)
                                                <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select name="angkatan_id" id="angkatan-mahasiswa" class="form-control kt-select2 search-kurikulum search-kelas-perkuliahan">
                                            <option value="0">Select</option>
                                            @foreach ($master['angkatan'] as $item)
                                                <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label class="select2-label">Program Studi</label>
                                    <div class="form-group">
                                        <select name="program_studi_id" id="jurusan-mahasiswa" class="form-control kt-select2 search-kurikulum search-kelas-perkuliahan">
                                            <option value="0">-- Pilih Jurusan --</option>
                                            @foreach ($master['jurusan'] as $item)
                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                        <label class="select2-label">Kelas</label>
                                        <div class="form-group">
                                            <select name="kelas_id" id="kelas-mahasiswa" class="form-control search-kurikulum kt-select2">
                                                <option value="">-- Pilih Kelas --</option>

                                            </select>
                                        </div>
                                    </div>
                            </div>

                        <div class="row">
                                <div class="col-xl-4">
                                    <button type="button" id="btn-search-kurikulum" class="btn btn-success btn-sm"><i class="flaticon2-search"></i>Cari Matakuliah</button>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>
                                <div>
                                    <p> <span class="kt-invoice__subtitle">Nama Kurikulum : <b id="nama-kurikulum"></b></span></p>

                                </div>

                            <div class="row">
                                <div class="col-lg-12" id="kelasperkuliahan">
                                    <table class="dataTable table table-striped table-bordered table-hover responsive" id="table-matakuliah">
                                        <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Kode</th>
                                            <th>Matakuliah</th>
                                            <th>SKS</th>
                                            <th>Semester</th>
                                            <th>Dosen</th>
                                            <th>Asisten</th>
                                            <th>Hari</th>
                                            <th>Ruangan</th>
                                            <th>Jam</th>
                                            <th>Selesai</th>
                                            <th>Pertemuan</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>
                            <div class="root">
                                <div class="kt-form__actions">
                                    <button type="button" class="btn btn-success" id="save-kelas-perkuliahan"><i class="la la-save"></i>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end:: Content -->
</div>
<script>
        var url_action = '/kelasperkuliahan/save_kelas_perkuliahan';
    </script>
<style>
    table tr td{
        vertical-align: middle;
    }
</style>

@section('js')

@stop

@endsection


