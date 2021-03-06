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
                                Nilai</a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="{{url()->current()}}" class="kt-subheader__breadcrumbs-link">
                                Input </a>
                        </div>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{url('dosen/inputnilai')}}" class="btn btn-success"><i class="la la-bars"></i> Daftar</a>
                    </div>
                </div>
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
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    </g>
                                </svg>
                                <h3 class="kt-portlet__head-title">
                                    &nbsp;Input Nilai Mahasiswa
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="kt-form">
                            <div class="kt-portlet__body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <table cellpadding="5">
                                                    <tbody>
                                                    <tr>
                                                        <td width="137px">Matakuliah</td>
                                                        <td>:</td>
                                                        <td><b>{{$data->kode_mata_kuliah}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dosen</td>
                                                        <td>:</td>
                                                        <td><b>{{$data->nama_dosen}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Program Studi</td>
                                                        <td>:</td>
                                                        <td><b>{{$data->nama_jurusan}}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Mahasiswa</td>
                                                        <td>:</td>
                                                        <td><b>{{count($mahasiswa)}}</b></td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <table cellpadding="5">
                                                    <tbody>
                                                    <tr>
                                                        <td width="127px">Matakuliah</td>
                                                        <td>:</td>
                                                        <td><b>{{$data->nama_mata_kuliah}}</b></td>
                                                    </tr>
                                                    <tr>
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
                                                        <td>Bobot Matakuliah</td>
                                                        <td>:</td>
                                                        <td><b>{{$data->sks}}</b></td>
                                                    </tr>
                                                </tbody></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <div class="row">
                                    <input type="hidden" name="kelas_perkuliahan_detail_id" value="{{$data->id}}" />
                                    <input type="hidden" name="semester_id" value="{{$data->semester_id}}" />
                                    
                                    <input type="hidden" name="mata_kuliah_id" value="{{$data->mata_kuliah_id}}" />
                                    <input type="hidden" name="jurusan_id" value="{{$data->jurusan_id}}" />
                                    <input type="hidden" name="angkatan_id" value="{{$data->angkatan_id}}" />
                                    <input type="hidden" name="kelas_perkuliahan_id" value="{{$data->kelas_perkuliahan_id}}" />
                                    <div class="col-lg-12">
                                            <table class="table table-striped table-bordered table-hover dataTable responsive">
                                                    <thead>
                                                            <tr>
                                                                    <th style="vertical-align: middle" rowspan="2">NO</th>
                                                                    <th style="vertical-align: middle" rowspan="2">Nama Mahasiswa</th>
                                                                    <th style="vertical-align: middle" rowspan="2">NIRM</th>
                                                                    <th style="vertical-align: middle" rowspan="2">Jenis Kelamin</th>
                                                                    <?php
                                                                        if($data->tipe_mata_kuliah != '' || $data->tipe_mata_kuliah != null){
                                                                            //print_r(config('global.tipe_matakuliah.'.$data->tipe_mata_kuliah));
                                                                                foreach (config('global.tipe_matakuliah.'.$data->tipe_mata_kuliah) as $key => $value) {
                                                                                   echo '<th style="vertical-align: middle" rowspan="2">'.$value.'</th>';
                                                                                }
                                                                        }else{
                                                                            echo '
                                                                            <th style="vertical-align: middle" rowspan="2">UTS</th>
                                                                            <th style="vertical-align: middle" rowspan="2">Nilai Tugas</th>
                                                                            <th style="vertical-align: middle" rowspan="2">UAS</th>';
                                                                        }
                                                                    ?>
                                                                    
                                                                    
                                                                    <th style="text-align: center" colspan="2">Nilai Akhir</th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: center">Angka</th>
                                                                    <th style="text-align: center">Huruf</th>
                                                                    
                                                                </tr>
                                                                
                                                    
                                                    </thead>
                                                    <tbody>
                                                            <?$i = 0?>
                                                            @foreach ($mahasiswa as $item)
                                                            <? 
                                                            // NILAI UTS = Pelaksanaan praktik = penyusunan makalah = proposal = proposal
                                                            // NILAI UAS = Unjuk kerja/portofolio = penyajian = pelaksanaan = seminar proposal
                                                            // Nilai TUGAS = Hasil/Laporan = penugasan materi = ujian = pelaksanaan
                                                            // Laporan PKL = seminar hasil
                                                            // Ujian
                                                            // Laporan
                                                            $nangka = 0;
                                                            $nhuruf = 'E';
                                                            $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                                                            $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                                                            $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                                                            $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                                                            $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                                                            $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;

                                                            if($data->tipe_mata_kuliah == 'praktek'){
                                                                $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                                                            }elseif ($data->tipe_mata_kuliah == 'teori') {
                                                                $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                                                            }elseif ($data->tipe_mata_kuliah == 'seminar') {
                                                                $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                                                            }elseif ($data->tipe_mata_kuliah == 'pkl') {
                                                                $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                                                            }elseif ($data->tipe_mata_kuliah == 'skripsi') {
                                                                $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                                                            }

                                                            if($nangka < 45){
                                                                $nhuruf = 'E';
                                                            }elseif($nangka > 44 && $nangka<= 59){
                                                                $nhuruf = 'D';
                                                            }elseif($nangka > 59 && $nangka<= 69){
                                                                $nhuruf = 'C';
                                                            }elseif($nangka > 69 && $nangka<= 79){
                                                                $nhuruf = 'B';
                                                            }elseif($nangka > 79 && $nangka<= 100){
                                                                $nhuruf = 'A';
                                                            }else{
                                                                $nhuruf = 'E';
                                                            }
                                                            $i++; ?>
        
                                                            <tr>
                                                                <td style="vertical-align: middle" align="center">{{$i}}</td>
                                                                <td style="vertical-align: middle">{{ucfirst($item->nama)}}</td>
                                                                <td style="vertical-align: middle" align="center">{{ucfirst($item->nim)}}</td>
                                                                <td style="vertical-align: middle">{{ucfirst($item->jk)}}</td>
                                                                <?php
                                                                    if($data->tipe_mata_kuliah != '' || $data->tipe_mata_kuliah != null){
                                                                        //print_r(config('global.tipe_matakuliah.'.$data->tipe_mata_kuliah));
                                                                        foreach (config('global.tipe_matakuliah.'.$data->tipe_mata_kuliah) as $key => $value) {
                                                                            echo '<td style="vertical-align: middle"><input type="text" value="'.$item->$key.'" class="form-control nilai_realtime n_'.$key.'_'.$item->id.'" attr="'.$item->id.'" char="'.$data->tipe_mata_kuliah.'" name="mahasiswa['.$item->id.']['.$key.']" placeholder="0"></td>';
                                                                        }
                                                                    }else{
                                                                        echo '
                                                                            <td style="vertical-align: middle"><input type="text" value="'.$item->nilai_uts.'" class="form-control nilai_realtime n_uts_'.$item->id.'" attr="'.$item->id.'" char="'.$data->tipe_mata_kuliah.'" name="mahasiswa['.$item->id.'][nilai_uts]" placeholder="0"></td>
                                                                            <td style="vertical-align: middle"><input type="text" value="'.$item->nilai_tugas.'" class="form-control nilai_realtime n_tgs_'.$item->id.'" attr="'.$item->id.'" char="'.$data->tipe_mata_kuliah.'" name="mahasiswa['.$item->id.'][nilai_tugas]" placeholder="0"></td>
                                                                            <td style="vertical-align: middle"><input type="text" value="'.$item->nilai_uas.'" class="form-control nilai_realtime n_uas_'.$item->id.'"  attr="'.$item->id.'" char="'.$data->tipe_mata_kuliah.'" name="mahasiswa['.$item->id.'][nilai_uas]" placeholder="0"></td>
                                                                        ';
                                                                    }
                                                                ?>
                                                                <td style="text-align: center;vertical-align: middle;"> <b class="nangka n_angka_{{$item->id}}">{{$nangka}}</b></td>
                                                                <td style="text-align: center;vertical-align: middle;"><b class="nuruf n_huruf_{{$item->id}}">{{$nhuruf}}</b></td>
                                                            </tr>
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                                <div class="root">
                                    <div class="kt-form__actions">
                                        <a href="{{url()->previous()}}" class="btn btn-label-success">
                                            <i class="la la-arrow-left"></i> Kembali
                                        </a>&nbsp;
                                        <button type="button" class="btn btn-success" id="save-nilai-perkuliahan"><i class="la la-save"></i>Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script src="{{asset('assets/js/pages/dosen/inputnilai.js')}}" type="text/javascript"></script>
@endsection

