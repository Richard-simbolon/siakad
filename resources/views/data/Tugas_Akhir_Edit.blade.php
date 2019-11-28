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
                            <a href="{{url('data/tugasakhir')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('data/tugasakhir')}}" class="kt-subheader__breadcrumbs-link">
                                {{$title}} </a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url('data/tugasakhir/create')}}" class="kt-subheader__breadcrumbs-link">
                                Tambah </a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url('data/tugasakhir')}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
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
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                    </svg>
                                </span>&nbsp;
                                <h3 class="kt-portlet__head-title">
                                    {{$title}}
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <form class="kt-form kt-form--label-right" action="update" method="POST">
                                <input type="hidden" id="csrf_" value="{{csrf_token()}} "/>
                                <div class="m-portlet__body">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <label>NIM</label>
                                                    <div class="input-group">
                                                        <input type="text" id="nim" class="form-control" disabled="disabled" value="{{$data['nim']}}">
                                                        <input type="hidden" id="mahasiswa_id" name="mahasiswa_id" value="{{$data['mahasiswa_id']}}">
                                                        <input type="hidden" id="row_status" name="row_status" value="{{$data['row_status']}}">
                                                        <input type="hidden" name="id" value="{{$data['id']}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <label>Nama</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="nama" disabled="disabled" value="{{$data['nama']}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <label>Jurusan</label>
                                                    <div class="form-group">
                                                        <input class="form-control" id="jurusan"  disabled="disabled" value="{{$data['jurusan']}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group ">
                                                    <label>Judul Tugas Akhir</label>
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="judul" id="judul">{{$data['judul']}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm kt-separator--portlet-fit"></div>
                                                <br/>
                                                <table class="dataTable table table-striped table-bordered table-hover responsive no-wrap">
                                                    <thead>
                                                    <th width="60%">Nama Dosen</th>
                                                    <th>Status</th>
                                                    <th>Dosen Ke</th>
                                                    <th></th>
                                                    </thead>
                                                    <tbody>

                                                    @foreach ($master['detail'] as $detail)
                                                        <tr id="{{$detail['id']}}">
                                                            <td>
                                                                <input type="hidden" name="detail[{{$detail['id']}}][row_status_detail]" id="row_status_{{$detail['id']}}" value="{{$detail['row_status']}}">
                                                                <input type="hidden" name="detail[{{$detail['id']}}][detail_id]" value="{{$detail['id']}}">
                                                                <select name="detail[{{$detail['id']}}][dosen]" class="form-control form-control-sm kt-select2">
                                                                    @foreach ($master['dosen'] as $item)
                                                                        @if($detail['dosen_id'] == $item['id'])
                                                                        <option value="{{$item['id']}}" selected> {{$item['nik']. ' - ' . $item['nama']}} </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="detail[{{$detail['id']}}][status_dosen]" class="form-control form-control-sm kt-select2">
                                                                    <option value="Pembimbing" {{$detail['status_dosen'] == 'Pembimbing'? "selected": ""}}>Pembimbing</option>
                                                                    <option value="Penguji" {{$detail['status_dosen'] == 'Penguji'? "selected": ""}}>Penguji</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="detail[{{$detail['id']}}][status_dosen_ke]" class="form-control form-control-sm kt-select2">
                                                                    <option></option>
                                                                    <option value="1" {{$detail['status_dosen_ke'] == '1'? "selected": ""}}>1</option>
                                                                    <option value="2" {{$detail['status_dosen_ke'] == '2'? "selected": ""}}>2</option>
                                                                    <option value="3" {{$detail['status_dosen_ke'] == '3'? "selected": ""}}>3</option>
                                                                    <option value="4" {{$detail['status_dosen_ke'] == '4'? "selected": ""}}>4</option>
                                                                    <option value="5" {{$detail['status_dosen_ke'] == '5'? "selected": ""}}>5</option>
                                                                    <option value="6" {{$detail['status_dosen_ke'] == '6'? "selected": ""}}>6</option>
                                                                    <option value="7" {{$detail['status_dosen_ke'] == '7'? "selected": ""}}>7</option>
                                                                </select>
                                                            </td>
                                                            <td width="150px" align="center" style="vertical-align: middle">
                                                            <a href="javascript:void(0)" onclick="addrow()"><i class="la la-plus" style="font-size: 16px;"></i> </a> &nbsp;
                                                            <a href="javascript:void(0)" onclick="deleterow_exist({{$detail['id']}})"><i class="la la-trash" style="font-size: 16px;"></i> </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                        <div class="kt-form__actions">
                                            <a style="color:#ffffff;" data-prev-url="{{url()->previous()}}" class="btn btn-success" id="update_tugas_akhir">
                                                 <i class="la la-save"></i> Edit
                                            </a>
                                            <a style="color:#ffffff;" data-prev-url="{{url()->previous()}}" class="btn btn-danger" id="delete_tugas_akhir">
                                                 <i class="la la-trash"></i> Hapus
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
    </div>

    <script src="{{asset('assets/js/pages/tugasakhir/index.js')}}" type="text/javascript"></script>
@endsection

