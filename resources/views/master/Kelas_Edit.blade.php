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
                            <a href="{{url('/master/kelas')}}" class="kt-subheader__breadcrumbs-link">
                                Kelas </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                Edit </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-12 order-lg-1 order-xl-1">
                    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
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
                                </span> &nbsp;
                                <h3 class="kt-portlet__head-title">
                                    Edit {{$title}}
                                </h3>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <form class="kt-form kt-form--label-right" action="/master/kelas/edit" method="POST">
                                {{ csrf_field() }}
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nama Kelas</label>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="{{$data['id']}}">
                                                        <input type="text" class="form-control" name="title" placeholder="Isikan Nama Kelas" value="{{$data['title']}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Angkatan</label>
                                                    <div class="form-group">
                                                        <select name="angkatan_id" class="form-control kt-select2">
                                                            <option value="">-- Pilih Angkatan --</option>
                                                            @foreach ($master['angkatan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id']==$data['angkatan_id']? "selected" : ""}}>{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Kurikulum</label>
                                                    <div class="form-group">
                                                        <select name="kurikulum_id" class="form-control kt-select2">
                                                            <option value="">-- Pilih Kurikulum --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Program Studi</label>
                                                    <div class="form-group">
                                                        <select name="jurusan_id" class="form-control kt-select2">
                                                            <option value="">-- Pilih Program Studi --</option>
                                                            @foreach ($master['jurusan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id']==$data['jurusan_id']? "selected" : ""}}>{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="form-group">
                                                        <label class="kt-radio">
                                                            <input type="radio" name="row_status" value="active" {{$data['row_status']=="active"? "checked" : ""}}>
                                                            Active
                                                            <span></span>
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label class="kt-radio">
                                                            <input type="radio" name="row_status" value="notactive" {{$data['row_status']=="notactive"? "checked" : ""}}>
                                                            Not Active
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-form__actions">
                                            <a href="{{url()->previous()}}" class="btn btn-label-success">
                                                <i class="la la-arrow-left"></i> Kembali
                                            </a>&nbsp;
                                            <button type="submit" class="btn btn-success"><i class="la la-save"></i> Simpan Perubahan</button>
                                            <button type="button" class="btn btn-danger" id="btn_delete_kelas"><i class="flaticon-delete"></i> Hapus</button>
                                        </div>
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



@section('js')

@stop

@endsection


