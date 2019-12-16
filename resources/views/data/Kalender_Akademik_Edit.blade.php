@extends('layout.app')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content Head -->
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            Master </h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="{{url()->previous()}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->previous()}}" class="kt-subheader__breadcrumbs-link">
                                Kalender Akademik </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                Ubah </a>
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
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-menu__link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </svg>
                                </span>&nbsp;
                                <h3 class="kt-portlet__head-title">
                                    {{$title}}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="dropdown dropdown-inline show">
                                    <a href="{{url('/data/kalenderakademik')}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
                                </div>
                            </div>
                        </div>
                        <!-- begin:: Content -->
                        <form class="kt-form form-add-mahasiswa" id="kt_form" >
                            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--begin::Portlet-->
                                        <div>
                                            <!--begin::Form-->
                                            <div class="kt-portlet__body">
                                                <input type="hidden" class="form-control" name="row_status" value="active" />
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <label class="select2-label">Judul</label>
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="id" value="{{$data['id']}}" />
                                                            <input type="text" class="form-control" name="title" placeholder="Isikan Judul" value="{{$data['title']}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <label>Tanggal</label>
                                                        <div class="form-group">
                                                            <input type="date" style="letter-spacing: 1px" class="form-control" name="start" value="{{date('Y-m-d', strtotime($data['start']))}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        <label>Jam</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control time-picker" name="time_start" value="{{$data['time_start']}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <label>Tanggal</label>
                                                        <div class="form-group">
                                                            <input type="date" style="letter-spacing: 1px" class="form-control" name="end" value="{{date('Y-m-d', strtotime($data['end']))}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        <label>Jam</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control time-picker" name="time_end" value="{{$data['time_end']}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <label class="select2-label">Warna</label>
                                                        <div class="form-group">
                                                            <select class="form-control" name="warna" >
                                                                <option value="1" {{$data['warna']=="1"?"selected" : ""}}>Biru</option>
                                                                <option value="2" {{$data['warna']=="2"?"selected" : ""}}>Jingga</option>
                                                                <option value="3" {{$data['warna']=="3"?"selected" : ""}}>Merah</option>
                                                                <option value="4" {{$data['warna']=="4"?"selected" : ""}}>Hijau</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <label class="select2-label">Tampilkan kepada</label>
                                                        <div class="form-group">
                                                            <select class="form-control" name="display" >
                                                                <option value="Semua" {{$data['display']=="Semua"?"selected" : ""}}>Semua</option>
                                                                <option value="Dosen" {{$data['display']=="Dosen"?"selected" : ""}}>Dosen</option>
                                                                <option value="Mahasiswa" {{$data['display']=="Mahasiswa"?"selected" : ""}}>Mahasiswa</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea id="summernote" name="keterangan">{{$data['keterangan']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>
                                                <div class="kt-form__actions">
                                                    <a href="{{url()->previous()}}" class="btn btn-label-success">
                                                        <i class="la la-arrow-left"></i> Kembali
                                                    </a>&nbsp;
                                                    <a style="color:#ffffff;" data-prev-url="{{url()->previous()}}" class="btn btn-success" id="update_kalender">
                                                        <i class="la la-save"></i>Simpan Perubahan
                                                    </a>
                                                    <a style="color:#ffffff;" data-prev-url="{{url()->previous()}}" class="btn btn-danger" id="delete_kalender">
                                                        <i class="la la-trash"></i>Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end:: Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
    <script src="{{asset('assets/plugins/custom/summernote/summernote.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/custom/summernote/lang/summernote-id-ID.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/pages/kalender/kalender.js')}}" type="text/javascript"></script>
@stop

@endsection


