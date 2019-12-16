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
                            <a href="{{url('dosen/uploadsoal')}}" class="kt-subheader__breadcrumbs-link">
                                Soal Ujian</a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('dosen/uploadsoal/create')}}}" class="kt-subheader__breadcrumbs-link">
                                Edit Soal Ujian</a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
                                    &nbsp;Upload Soal Ujian
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="dropdown dropdown-inline show">
                                    <a href="{{url('dosen/uploadsoal')}}" class="btn btn-success"> <i class="la la-bars"></i> Daftar</a>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <form id="form_upload_soal_update" enctype="multipart/form-data" class="kt-form kt-form--label-right" method="POST">
                                <input type="hidden" name="row_status" value="active" />
                                <input type="hidden" name="dosen_id" value="{{$data['dosen_id']}}" />
                                <input type="hidden" name="id" value="{{$data['id']}}" />
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Jenis Ujian</label>
                                            <select name="jenis_ujian" id="jenis_ujian" class="form-control kt-select2" disabled>
                                                <option value=" ">-- Pilih Jenis --</option>
                                                <option value="uts" {{$data['jenis_ujian']=='uts'? "selected" : ""}}>UTS</option>
                                                <option value="uas" {{$data['jenis_ujian']=='uas'? "selected" : ""}}>UAS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Program Studi</label>
                                            <select name="jurusan_id" id="jurusan-mahasiswa" class="form-control kt-select2" disabled>
                                                <option value=" ">-- Pilih Program Studi --</option>
                                                @foreach ($master['jurusan'] as $item)
                                                    <option value="{{$item['id']}}" {{$item['id']==$data['jurusan_id'] ? "selected" : ""}}>{{$item['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select name="semester_id" class="form-control kt-select2" disabled>
                                                @foreach ($master['semester'] as $item)
                                                    <option value="{{$item['id']}}" {{$item['id']==$data['semester_id'] ? "selected" : ""}}>{{$item['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Angkatan</label>
                                            <select name="angkatan_id" id="angkatan-mahasiswa" class="form-control kt-select2" disabled>
                                                <option value=" ">-- Pilih Angkatan --</option>
                                                @foreach ($master['angkatan'] as $item)
                                                    <option value="{{$item['id']}}" {{$item['id']==$data['angkatan_id'] ? "selected" : ""}}>{{$item['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select name="kelas_id" id="kelas-mahasiswa" class="form-control kt-select2" disabled>
                                                <option value=" ">-- Pilih Kelas --</option>
                                                @foreach ($master['kelas'] as $item)
                                                    <option value="{{$item['id']}}" {{$item['id']==$data['kelas_id'] ? "selected" : ""}}>{{$item['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Matakuliah</label>
                                            <select name="mata_kuliah_id" class="form-control kt-select2" disabled>
                                                <option value=" ">-- Pilih Matakuliah --</option>
                                                @foreach ($master['matakuliah'] as $item)
                                                    <option value="{{$item['id']}}" {{$item['id']==$data['mata_kuliah_id'] ? "selected" : ""}}>{{$item['kode'] . ' - ' .$item['nama']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-group-last">
                                            <label>Upload File</label>
                                            <input type="file" name="file_upload" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group form-group-last">
                                        <label>File</label>
                                        <a class="btn btn-label-success form-control" href="{{url('assets/images/soalujian'.$data['id'].'/'.$data['nama_file'])}}"><i class="la la-download"></i> Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm kt-separator--portlet-fit"></div>
                                <br/>
                                <div class="kt-form__actions">
                                    <a href="{{url()->previous()}}" class="btn btn-label-success">
                                        <i class="la la-arrow-left"></i> Kembali
                                    </a>&nbsp
                                    <button type="submit" class="btn btn-success"><i class="la la-save"></i> Simpan Perubahan</button>
                                    <a href="javascript:void(0)" class="btn btn-danger" id="btn_hapus_data">
                                        <i class="la la-trash"></i> Hapus
                                    </a>&nbsp
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
        .m-content{width:100%}
        
    </style>

@endsection

@section('js')
    <script src="{{asset('assets/js/pages/uploadsoalujian/index.js')}}" type="text/javascript"></script>
@endsection

