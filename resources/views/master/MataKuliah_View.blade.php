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
                            <a href="{{url('/master/matakuliah')}}" class="kt-subheader__breadcrumbs-link">
                                Matakuliah </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                View </a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url()->previous()}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
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
                                    {{$title}}
                                </h3>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <form class="kt-form kt-form--label-right" action="update" method="POST">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Kode Mata Kuliah *</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="kode_mata_kuliah" value="{{$data['kode_mata_kuliah']}}" placeholder="Isikan Nama Kelas" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nama Mata Kuliah *</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="nama_mata_kuliah" value="{{$data['nama_mata_kuliah']}}" placeholder="Isikan Nama Kelas" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tipe Matakuliah *</label>
                                                    <div class="form-group">
                                                        <select name="tipe_mata_kuliah" class="form-control kt-select2" disabled="disabled">
                                                            <option value="">-- Pilih Tipe Matakuliah --</option>
                                                            <option value="praktek" {{$data['tipe_mata_kuliah'] == "praktek" ? "selected" : ""}}>Praktek</option>
                                                            <option value="teori" {{$data['tipe_mata_kuliah']=="teori" ? "selected" : ""}}>Teori</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Jenis Matakuliah</label>
                                                    <div class="form-group">
                                                        <select name="id_jenis_mata_kuliah" class="form-control kt-select2"  disabled="disabled">
                                                            <option value="">-- Pilih Jenis Matakuliah --</option>
                                                            @foreach ($master['jenis_mata_kuliah'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id']==$data['id_jenis_mata_kuliah']? "selected" : ""}}>{{$item['title']}}</option>
                                                            @endforeach
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
                                                        <select name="id_prodi" class="form-control kt-select2"  disabled="disabled">
                                                            <option value="">-- Pilih Program Studi --</option>
                                                            @foreach ($master['jurusan'] as $item)
                                                                <option value="{{$item['id']}}" {{$item['id']==$data['id_prodi']? "selected" : ""}}>{{$item['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Metode Pembelajaran</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="metode_pembelajaran" value="{{$data['metode_kuliaj']}}" placeholder="Isikan Nama Metode Pembelajaran"  disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bobot Tatap Muka</label>
                                                    <div class="form-group">
                                                        <input type="number" value="0" class="form-control" name="bobot_tatap_muka" value="{{$data['sks_tatap_muka']}}" id="bobot_tatap_muka" min="0" placeholder="Isikan Bobot" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bobot Praktikum</label>
                                                    <div class="form-group">
                                                        <input type="number" value="0" class="form-control" name="bobot_praktikum" value="{{$data['sks_praktek']}}" id="bobot_praktikum" min="0" placeholder="Isikan Bobot" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bobot Praktek Lapangan</label>
                                                    <div class="form-group">
                                                        <input type="number" value="0" class="form-control" name="bobot_praktek_lapangan" value="{{$data['sks_praktek_lapangan']}}" id="bobot_praktek_lapangan" min="0" placeholder="Isikan Bobot" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bobot Simulasi</label>
                                                    <div class="form-group">
                                                        <input type="number" value="0" class="form-control" name="bobot_simulasi" value="{{$data['sks_simulasi']}}" id="bobot_simulasi" min="0" placeholder="Isikan Bobot" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bobot Mata Kuliah</label>
                                                    <div class="form-group">
                                                        <input type="number" style="background-color: #fafafa;" class="form-control form-control-sm" name="bobot_mata_kuliah" value="{{$data['sks_mata_kuliah']}}" id="bobot_mata_kuliah" value="0" readonly>
                                                        <span class="form-text text-muted">( sks Tatap Muka + sks Praktikum + sks Praktek Lapangan + sks Simulasi )</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai Efektif</label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" name="tanggal_mulai_efektif" value="{{$data['tanggal_mulai_efektif']}}" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tanggal Akhir Efektif</label>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" name="tanggal_akhir_efektif" value="{{$data['tanggal_selesai_efektif']}}"  disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="row">--}}
                                            {{--<div class="col-lg-6">--}}
                                                {{--<div class="form-group form-group-last">--}}
                                                    {{--<label>Status</label>--}}
                                                    {{--<div class="form-group form-group-last">--}}
                                                        {{--<label class="kt-radio">--}}
                                                            {{--<input type="radio" name="row_status" value="active" {{$data['row_status']=='active'? "checked" : ""}} disabled="disabled">--}}
                                                            {{--Active--}}
                                                            {{--<span></span>--}}
                                                        {{--</label>--}}
                                                        {{--&nbsp;&nbsp;--}}
                                                        {{--<label class="kt-radio">--}}
                                                            {{--<input type="radio" name="row_status" value="notactive" {{$data['row_status']=='notactive'? "checked" : ""}} disabled="disabled">--}}
                                                            {{--Not Active--}}
                                                            {{--<span></span>--}}
                                                        {{--</label>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                        <div class="kt-form__actions">
                                            <a href="{{url()->previous()}}" class="btn btn-label-success">
                                                <i class="la la-arrow-left"></i> Kembali
                                            </a>
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
