@extends('layout.app')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            Akademik </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="" class="kt-subheader__breadcrumbs-link">
                                Kelas Perkuliahan</a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                Daftar </a>
                        </div>
                    </div>
                </div>
                <!--<div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url()->current()}}/create" class="btn btn-success"><i class="la la-plus"></i> Tambah</a>
                    </div>
                </div>-->
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-12 order-lg-1 order-xl-1">
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
                                    &nbsp;Nilai Perkuliahan
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <div class="form-group">
                                            <select name="semester_id" id="search-semester" class="form-control kt-select2 search-nilai-matakuliah looping_class_input">
                                                <option value="">Select</option>
                                                @foreach ($master['semester'] as $item)
                                                    <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select id="angkatan-mahasiswa" name="angkatan_id" class="form-control kt-select2 search-nilai-matakuliah looping_class_input">
                                            <option value="">Select</option>
                                            @foreach ($master['angkatan'] as $item)
                                                <option value="{{$item['id']}}" > {{$item['title']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <select name="jurusan_id" id="jurusan-mahasiswa" class="form-control kt-select2 search-nilai-matakuliah looping_class_input">
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach ($master['jurusan'] as $item)
                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-xl-2">
                                    <label class="select2-label">Kelas</label>
                                    <div class="form-group">
                                        <select name="kelas_id" id="kelas-mahasiswa" class="form-control search-kurikulum kt-select2 looping_class_input">
                                            <option value="">-- Pilih Kelas --</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-form__actions">
                                <button class="btn btn-success btn-sm" id="btn-search-nilai-matakuliah"><i class="flaticon-search"></i>Tampilkan</button>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                            <div class="row">
                                <div class="col-lg-12" id="datatable_display">
                                    <table class="table table-striped table-bordered table-hover responsive" id="jadwal_ujian">
                                        <thead>
                                        <tr>
                                            {{-- <th style="text-align: center">No</th> --}}
                                            <th style="text-align: center">Mata Kuliah</th>
                                            <th style="text-align: center">Angkatan</th>
                                            <th>Semester</th>
                                            <th>Jurusan </th>
                                            <th style="text-align: center">Kelas</th>
                                            <th style="text-align: center">Ruangan</th>
                                            <th style="text-align: center">Dosen</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                {{-- < ?$i = 0?>
                                                @foreach ($data as $item)
                                                < ? $i++ ?>
                                                <tr>
                                                    <td align="center">{{$i}}</td> 
                                                    <td align="center">{{$item->nama_mata_kuliah}}</td>
                                                    <td align="center">{{$item->nama_angkatan}}</td>
                                                    <td>{{$item->nama_semester}}</td>
                                                    <td style="vertical-align: center;">{{$item->nama_jurusan}}t</td>
                                                    <td align="center">{{$item->nama_kelas}}</td>
                                                    <td align="center">{{$item->nama_dosen}}</td>
                                                    <td><a href="{{url('data/nilaimahasiswa/view/'. $item->id)}}" > edit/view </a></td>
                                                </tr>
                                                @endforeach --}}
                                        </tbody>
                                    </table>
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
        .m-content{width:100%}
        table{
            text-align: center;
        }
    </style>

@endsection


@section('js')
    <script src="{{asset('assets/js/pages/ujian/jadwal_ujian.js')}}" type="text/javascript"></script>
@endsection
