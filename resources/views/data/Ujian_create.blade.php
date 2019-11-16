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
                                Edit </a>
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
                                        <div class="kt-portlet__body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <table cellpadding="7">
                                                                    <tbody><tr>
                                                                        <td width="35%">Matakuliah</td>
                                                                        <td>:</td>
                                                                        <td><b>{{$data->nama_mata_kuliah}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Dosen</td>
                                                                        <td>:</td>
                                                                        <td><b>{{$data->nama_dosen}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jurusan</td>
                                                                        <td>:</td>
                                                                        <td><b>{{$data->nama_jurusan}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jumlah Mahasiswa</td>
                                                                        <td>:</td>
                                                                        <td><b></b></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <table cellpadding="5">
                                                                    <tbody><tr>
                                                                        <td>Semester</td>
                                                                        <td>:</td>
                                                                        <td><b>{{$data->nama_semester}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Angkatan</td>
                                                                        <td>:</td>
                                                                        <td><b>{{$data->nama_angkatan}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Ruangan</td>
                                                                        <td>:</td>
                                                                        <td><b>{{$data->ruangan}}</b></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>SKS</td>
                                                                            <td>:</td>
                                                                            <td><b></b></td>
                                                                        </tr>
                                                                </tbody></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                <br/>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Ujian</label>
                                                            <div class="form-group">
                                                                <input type="date" value="{{$data->tanggal_ujian}}" name="tanggal_ujian" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Jam</label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->jam}}" name="jam" class="form-control m-input time-picker" placeholder="Pilih Jam" type="text"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Catatan</label>
                                                            <div class="form-group">
                                                            <textarea type="text" class="form-control" name="catatan" placeholder="Catatan">{{$data->catatan}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                                <div class="row">
                                                    <input type="hidden" name="kelas_perkuliahan_detail_id" value="{{$data->id}}" />
                                                    <input type="hidden" name="semester_id" value="{{$data->semester_id}}" />
                                                    <input type="hidden" name="angkatan_id" value="{{$data->angkatan_id}}" />

                                                    <div class="col-lg-12">
                                                        <table class="table table-striped table-bordered table-hover responsive">
                                                            <thead>
                                                            <tr>
                                                                <th style="text-align: center">No</th>
                                                                <th style="text-align: center">Nama Mahasiswa</th>
                                                                <th style="text-align: center">NIM</th>
                                                                <th>Jenis Kelamin</th>
                                                                <th style="text-align: center">Ruangan</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <?$i = 0?>
                                                                    @foreach ($mahasiswa as $item)
                                                                    <? $i++ ;
                                                                    //print_r($item);
                                                                    ?>
                                                                    <tr>
                                                                        <td align="center">{{$i}}</td> 
                                                                        <td align="center">{{ucfirst($item->nama)}}</td>
                                                                        <td align="center">{{ucfirst($item->nim)}}</td>
                                                                        <td align="center">{{ucfirst($item->jk)}}</td>
                                                                        <td><input type="text" value="{{$item->ruangan}}" class="form-control" name="mahasiswa[{{$item->id}}][ruangan]" placeholder="Ruangan"></td>
                                                                        
                                                                    </tr>
                                                                    @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="root">
                                                    <div class="kt-form__actions">
                                                        <button type="button" class="btn btn-success" id="save-jadwal-ujian"><i class="la la-save"></i>Simpan</button>
                                                        <a href="{{url('data/jadwalujian')}}" style="align:right" type="button" class="btn btn-metal btn-outlane-metal"><i class="la la-arrow-left"></i>Kembali</a>
                                                    </div>
                                                </div>
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

@endsection

@section('js')
    <script src="{{asset('assets/js/pages/ujian/jadwal_ujian.js')}}" type="text/javascript"></script>
@endsection