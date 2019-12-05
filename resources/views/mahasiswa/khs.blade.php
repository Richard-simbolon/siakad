@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
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
                        KHS </a>
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
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                            <span class="kt-menu__link-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"></path>
                                            <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                </span>
                        <h3 class="kt-portlet__head-title">
                            &nbsp; KARTU HASIL STUDI (KHS)
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="dropdown dropdown-inline show">
                        <button type="button" class="btn btn-outline-success" onclick="window.location.href='{{url('print_khs')}}/'+$('#search-khs').val()+''"><i class="la la-print"></i> Cetak KHS</button>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <div class="kt-portlet__body">
                    <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table cellpadding="5">
                                        <tbody>
                                        <tr>
                                            <td width="107px">Nirm</td>
                                            <td>:</td>
                                            <td><b>{{Auth::user()->login}}</b></td>
                                        </tr>
                                        <tr>
                                            <td width="107px">Nama</td>
                                            <td>:</td>
                                            <td><b>{{Auth::user()->nama}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Angkatan</td>
                                            <td>:</td>
                                            <td><b>{{$mahasiswa->angkatan_title}}</b></td>
                                        </tr>
                                        
                                    </tbody></table>
                                </div>
                                <div class="col-lg-6">
                                    <table cellpadding="5">
                                        <tbody><tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td><b>{{$mahasiswa->agama_title}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Jurusan</td>
                                            <td>:</td>
                                            <td><b>{{$mahasiswa->jurusan_title}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>:</td>
                                            <td><b>{{$mahasiswa->kelas_title}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <br/><br/>

                        <div class="row">
                            <div class="col-xl-2">
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <div class="form-group">
                                       
                                        <select name="semester_id" id="search-khs" class="form-control kt-select2 search-nilai-matakuliah looping_class_input">
                                            <option value="">Select</option>
                                            @foreach ($master as $item)
                                                <option value="{{$item['id']}}" {{$item['id'] == $semester_aktif->id ? 'selected' : ''}}> {{$item['title']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
                            <table class="dataTable table table-striped table-bordered table-hover table-checkable">
                            <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle" rowspan="2">No</th>
                                <th style="text-align: center ; vertical-align: middle" rowspan="2">Kode MK</th>
                                <th style="text-align: center;vertical-align: middle" rowspan="2">Mata Kuliah</th>
                                <th style="text-align: center;vertical-align: middle" rowspan="2">Bobot SKS</th>
                                <!--<th style="text-align: center;vertical-align: middle" rowspan="2">UTS</th>
                                <th style="text-align: center;vertical-align: middle" rowspan="2">Tugas</th>
                                <th style="text-align: center;vertical-align: middle" rowspan="2">UAS</th>-->
                                <th style="text-align: center" colspan="3">Akhir</th>
                                <th style="text-align: center;vertical-align: middle;border-right-width: 1px;" rowspan="2">SKS * Index</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Angka</th>
                                <th style="text-align: center">Huruf</th>
                                <th style="text-align: center;border-right-width: 1px;">Index</th>
                            </tr>
                            </thead>
                            <tbody id="body-khs">
                                <?php $i = 0;
                                    $sks = 0;
                                    $nipk = 0;
                                ?>
                                @if (count($data)) > 0
                                    
                                
                                
                                @foreach ($data as $item)
                                <?php $i++;
                                $sks += $item->bobot_mata_kuliah;

                                $nangka = 0;
                                $index = 0;
                                $indexvsks = 0;
                                $nhuruf = 'E';
                                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;

                                if($item->tipe_mata_kuliah == 'praktik'){
                                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 20)/100));
                                }elseif ($item->tipe_mata_kuliah == 'teori') {
                                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                                }
                                if($nangka < 45){
                                    $nhuruf = 'E';
                                    $nipk += 0 * $item->bobot_mata_kuliah;
                                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                                    $index = 0;
                                }elseif($nangka > 44 && $nangka<= 59){
                                    $nhuruf = 'D';
                                    $nipk += 1 * $item->bobot_mata_kuliah;
                                    $indexvsks = 1 * $item->bobot_mata_kuliah;
                                    $index = 1;
                                }elseif($nangka > 59 && $nangka<= 69){
                                    $nhuruf = 'C';
                                    $nipk += 2 * $item->bobot_mata_kuliah;
                                    $indexvsks = 2 * $item->bobot_mata_kuliah;
                                    $index = 2;
                                }elseif($nangka > 69 && $nangka<= 79){
                                    $nhuruf = 'B';
                                    $nipk += 3 * $item->bobot_mata_kuliah;
                                    $indexvsks = 3 * $item->bobot_mata_kuliah;
                                    $index = 3;
                                }elseif($nangka > 79 && $nangka<= 100){
                                    $nhuruf = 'A';
                                    $nipk += 4 * $item->bobot_mata_kuliah;
                                    $indexvsks = 4 * $item->bobot_mata_kuliah;
                                    $index = 4;
                                }else{
                                    $nhuruf = 'E';
                                    $nipk += 0 * $item->bobot_mata_kuliah;
                                    $index = 5;
                                }
                                ?>
                                <tr>
                                    <td style="text-align: center">{{$i}}</td>
                                    <td style="text-align: center">{{$item->kode_mata_kuliah}}</td>
                                    <td style="text-align: center">{{$item->nama_mata_kuliah}}</td>
                                    <td style="text-align: center">{{$item->bobot_mata_kuliah}}</td>
                                    <!--<td style="text-align: center">{{$item->nilai_uts ? $item->nilai_uts :0}}</td>
                                    <td style="text-align: center">{{$item->nilai_tugas ? $item->nilai_tugas :0}}</td>
                                    <td style="text-align: center">{{$item->nilai_uas ? $item->nilai_uas: 0}}</td>-->
                                    <td style="text-align: center">{{$nangka}}</td>
                                    <td style="text-align: center">{{$nhuruf}}</td>
                                    <td style="text-align: center">{{$index}}</td>
                                    <td style="text-align: center">{{$indexvsks}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align: left" colspan="3"><b>Total SKS</b></td>
                                    <td style="text-align: center" ><b>{{$sks}}</b></td>
                                    <td style="text-align: center" colspan="4"><b></b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left" colspan="7"><b>IP</b></td>
                                    <td style="text-align: center"><b>{{ round($nipk / $sks ,2)}}</b></td>
                                </tr>
                                @else
                                <tr>
                                       
                                    <td style="text-align: center" colspan="9">Tidak ada matakuliah</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12" style="text-align:right">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end:: Content -->
</div>

<style>
    .m-content{width:100%};
    </style>
@endsection

@section('js')

<script src="{{asset('assets/js/pages/crud/datatables/advanced/row-grouping.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/pages/mahasiswa/mahasiswa.js')}}" type="text/javascript"></script>
@endsection