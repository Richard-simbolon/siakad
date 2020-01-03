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
                    <a href="#" class="btn btn-label-success"> Semester {{Auth::user()->semester}}</a>
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
                            <div class="kt-portlet__head-toolbar">
                                <div class="dropdown dropdown-inline show">
                                    <a href="{{url('/data/kelasperkuliahan')}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-xl-4">
                                    <label class="select2-label">Semester</label>
                                    <div class="form-group">
                                        <select name="semester_id" id="search-semester" class="form-control">
                                            <option value="{{$kurikulum->nama_semester}}">{{$kurikulum->nama_semester}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Angkatan</label>
                                        <select name="angkatan_id" id="angkatan-mahasiswa" class="form-control search-kurikulum search-kelas-perkuliahan">
                                            <option value="{{$kurikulum->nama_semester}}">{{$kurikulum->nama_angkatan}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <label class="select2-label">Program Studi</label>
                                    <div class="form-group">
                                        <select name="program_studi_id" id="jurusan-mahasiswa" class="form-control search-kurikulum search-kelas-perkuliahan">
                                            <option value="{{$kurikulum->nama_semester}}">{{$kurikulum->nama_jurusan}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                        <label class="select2-label">Kelas</label>
                                        <div class="form-group">
                                            <select name="kelas_id" id="kelas-mahasiswa" class="form-control search-kurikulum">
                                                <option value="{{$kurikulum->kelas_id}}">{{$kurikulum->nama_kelas}}</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <input type="hidden" value="{{$kurikulum->id}}" name="update"/>
                        <div class="row">
                                <div class="col-xl-4">
                                    
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>
                                <div>
                                    <p> <span class="kt-invoice__subtitle">Nama Kurikulum : <b id="nama-kurikulum">{{$kurikulum->nama_kurikulum}}</b></span></p>

                                </div>
                                
                            <div class="row">
                                <div class="col-lg-12" id="kelasperkuliahan" style="overflow-x: auto">
                                    <table class="dataTable table table-striped table-bordered table-hover" id="table-matakuliah">
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
                                            <?php
                                                foreach($matakuliah as $item){
                                                    $dosen_html = '<option value="0"> -- Pilih dosen --</option>';
                                                    foreach($master['dosen'] as $dosen_item){
                                                        $selected = $dosen_item['id'] ==  $item->dosen_id ? 'selected' :'';
                                                        $dosen_html .= '<option value="'.$dosen_item['id'].'" '.$selected.'> '.$dosen_item['nama'].'</option>';
                                                    }
                                                    $ruangan_html = '<option value="0"> -- Pilih ruangan --</option>';
                                                    foreach($master['ruangan'] as $ruangan_item){
                                                        $selected = $ruangan_item['id'] ==  $item->ruangan ? 'selected' :'';
                                                        $ruangan_html .= '<option value="'.$ruangan_item['id'].'"'.$selected.'> '.$ruangan_item['kode_ruangan'].' - '.$ruangan_item['nama_ruangan'].'</option>';
                                                    }
                                                    $checked = $item->mata_kuliah_id ? 'checked' : '';
                                                echo'
                                                    <tr>
                                                        <td align="center"><input type="checkbox" '.$checked.' name="item['.$item->matakuliah_id.'][mata_kuliah_id]" value="'.$item->matakuliah_id.'" class="form-control-sm"></td></td>
                                                        <td>'.$item->kode_mata_kuliah.'</td>
                                                        <td>'.$item->nama_mata_kuliah.'</td>
                                                        <td align="center">'.$item->sks_mata_kuliah.'</td>
                                                        <td align="center">'.$item->semester.'</td>
                                                        <td>
                                                            <select class="form-control  kt-select2" name="item['.$item->matakuliah_id.'][dosen_id]">
                                                                '.$dosen_html.'
                                                            </select>
                                                        </td>
                                                        <td align="center"><input style="min-width: 100px;" type="text" value="'.$item->asisten.'" name="item['.$item->matakuliah_id.'][asisten]" class="form-control " /> </td>
                                                        <td align="center">
                                                            <select style="min-width: 75px" class="form-control" name="item['.$item->matakuliah_id.'][hari_id]">
                                                                <option value="1" '.(($item->hari_id) == "1" ? 'selected' : '') .' >Senin</option>
                                                                <option value="2" '.(($item->hari_id) == "2" ? 'selected' : '') .' >Selasa</option>
                                                                <option value="3" '.(($item->hari_id) == "3" ? 'selected' : '') .' >Rabu</option>
                                                                <option value="4" '.(($item->hari_id) == "4" ? 'selected' : '') .' >Kamis</option>
                                                                <option value="5" '.(($item->hari_id) == "5" ? 'selected' : '') .' >Jumat</option>
                                                                <option value="6" '.(($item->hari_id) == "6" ? 'selected' : '') .' >Sabtu</option>
                                                            </select>
                                                        </td>
                                                        <td align="center">
                                                            <select class="form-control form-control kt-select2" name="item['.$item->matakuliah_id.'][ruangan]">
                                                                '.$ruangan_html.'
                                                            </select>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group timepicker">
                                                                <input style="width: 90px" type="text" name="item['.$item->matakuliah_id.'][jam]" value="'.$item->jam.'" class="form-control m-input time-picker" placeholder="Pilih Jam"/>
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <div class="input-group timepicker">
                                                                <input style="width: 90px" type="text" name="item['.$item->matakuliah_id.'][selesai]" value="'.$item->selesai.'" class="form-control m-input time-picker" placeholder="Pilih Jam"/>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input style="max-width: 75px" type="number"class="form-control" min="1" value="'.($item->pertemuan == ""? 14 : $item->pertemuan).'"  name="item['.$item->matakuliah_id.'][pertemuan]"/>
                                                        </td>
                                                    </tr>
                                            ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md kt-separator--portlet-fit"></div>
                            <div class="root">
                                <div class="kt-form__actions">
                                    <a href="{{url()->previous()}}" class="btn btn-label-success">
                                        <i class="la la-arrow-left"></i> Kembali
                                    </a>&nbsp;
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
    var url_action = '/kelasperkuliahan/update_kelas_perkuliahan';
</script>
<style>
    table tr td{
        vertical-align: middle;
    }
</style>

@section('js')

@stop

@endsection


