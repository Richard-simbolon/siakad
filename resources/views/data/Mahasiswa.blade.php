@extends('layout.app')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
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
                        Daftar </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{url()->current()}}/create" class="btn btn-success">
                        <i class="la la-plus"></i> Tambah Mahasiswa &nbsp;
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="kt-portlet ">
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
                                </span> &nbsp;
                                <h3 class="kt-portlet__head-title">
                                    Daftar Mahasiswa
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="m-portlet__body">

                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <label>NIM / Nama</label>
                                                    <div class="form-group">
                                                        <select name="jenis_peringkat" id="nimnama" class="form-control  kt-select2">
                                                            <option value="">-- Pilih Pencarian --</option>
                                                            <option value="1">NIM</option>
                                                            <option value="2">Nama</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <label>Jurusan</label>
                                                    <div class="form-group">
                                                        <select name="mahasiswa[jurusan_id]" id="jurusan" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jurusan --</option>
                                                            @foreach ($master['jurusan'] as $item)
                                                                <option value="{{$item['title']}}">{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <label>Angkatan</label>
                                                    <div class="form-group">
                                                        <select id="search-angkatan" class="form-control kt-select2">
                                                            <option value="">Select</option>
                                                            @foreach ($master['angkatan'] as $item)
                                                                <option value="{{$item['title']}}" > {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <label>Status</label>
                                                    <div class="form-group">
                                                        <select  id="search-status" class="form-control kt-select2">
                                                            <option value="">Select</option>
                                                            @foreach ($master['status_mahasiswa'] as $item)
                                                                <option value="{{$item['title']}}" > {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <label>Jenis Kelamin</label>
                                                    <div class="form-group">
                                                        <select name="jenis_kelamin" class="form-control kt-select2">
                                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <label>Agama</label>
                                                    <div class="form-group">
                                                        <select name="mahasiswa[agama]" id="search-agama" class="form-control kt-select2">
                                                            <option value="">Select</option>
                                                            @foreach ($master['agama'] as $item)
                                                                <option value="{{$item['title']}}" > {{$item['title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="keyword" id="inputdata" placeholder="Kata kunci">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-form__actions">
                                                <button class="btn btn-success btn-wide" id="search-button"><i class="flaticon-search"></i>Cari</button>
                                            </div>

                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                                <table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap general-data-table" id="{{$tableid}}">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Total SKS</th>
                                            <th>Program Studi</th>
                                            <th>Status</th>
                                            <th>Angkatan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
