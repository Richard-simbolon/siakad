@extends('layout.app')

@section('content')
<style>
.error{
    color: red;
}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Akademik </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{url('data/mahasiswa')}}}" class="kt-subheader__breadcrumbs-link">
                        Mahasiswa </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        KHS </a>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <div class="kt-portlet__head-toolbar">
                        <a href="#" class="btn btn-label-success btn-sm btn-bold dropdown-toggle" data-toggle="dropdown">
                            <i class="kt-nav__link-icon flaticon2-layers-2"></i> Menu Lainnya
                        </a>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a href="{{url('data/mahasiswa/view/'.$global['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-user"></i>
                                        <span class="kt-nav__link-text">Detail Mahasiswa</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('admin/mahasiswa/krs/'.$global['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-digital-marketing"></i>
                                        <span class="kt-nav__link-text">KRS</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('admin/mahasiswa/khs/'.$global['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                        <span class="kt-nav__link-text">History Nilai</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('admin/mahasiswa/transkrip/'.$global['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                        <span class="kt-nav__link-text">Transkrip</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{url('mahasiswa/prestasi/'.$global['id'])}}" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-indent-dots"></i>
                                        <span class="kt-nav__link-text">Prestasi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="global_id" value="{{$global['id']}}" />
                </div>
            </div>
        </div>
    </div>
    
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
                                &nbsp; TRANSKRIP NILAI
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline show">
                                    <button type="button" class="btn btn-outline-success" onclick="window.location.href='{{url('admin/print_transkrip/'.$mahasiswa->id)}}'"><i class="la la-print"></i> Cetak Transkrip</button>
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
                                                <td><b>{{$mahasiswa->nim}}</b></td>
                                            </tr>
                                            <tr>
                                                <td width="107px">Nama</td>
                                                <td>:</td>
                                                <td><b>{{$mahasiswa->nama}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Angkatan</td>
                                                <td>:</td>
                                                <td><b>{{$mahasiswa->angkatan}}</b></td>
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
                                                <td>Program Studi</td>
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
                        <div>
                            <table class="dataTable table table-striped table-bordered table-hover table-checkable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle" align="center" rowspan="2">No</th>
                                            <th style="text-align: center; vertical-align: middle" align="center" rowspan="2">Kode</th>
                                            <th style="text-align: center; vertical-align: middle" align="center" rowspan="2">Mata Kuliah</th>
                                            <th style="text-align: center; vertical-align: middle" align="center" colspan="3">SKS</th>
                                            <th style="text-align: center; vertical-align: middle" align="center" colspan="2">Nilai Teori</th>
                                            <th style="text-align: center; vertical-align: middle" align="center" colspan="2">Nilai Praktek</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center" width="45px" align="center">Teori</th>
                                            <th  style="text-align: center"width="45px" align="center">Praktek</th>
                                            <th style="text-align: center" width="45px" align="center">Jumlah</th>
                                            <th style="text-align: center" width="45px" align="center">Angka</th>
                                            <th style="text-align: center" width="45px" align="center">Mutu</th>
                                            <th style="text-align: center" width="45px" align="center">Angka</th>
                                            <th style="text-align: center" width="45px" align="center">Mutu</th>
                                        </tr>
                                    </thead>    
                                        <tbody id="body-khs">
                                                <?php
                                                $data_group = [];
                                                foreach ($data as $key => $value) {
                                                    $data_group[$value->semester][] = $value;
                                                }
                                                $i = 0;
                                                $j = 0;
                                                $nipg =[];
                                                foreach ($data_group as $g) {
                                                    $j++;
                                                    $sks = 0;
                                                    $nipk = 0;
                                                        echo '<tr>
                                                                <td align="center"></td>
                                                                <td colspan="2"><b>SEMESTER '.$j.'</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>';
                                                    foreach ($g as $key => $item) {
                                
                                                        $i++;
                                                        $sks += $item->sks_mata_kuliah;
                                                        $nangka = 0;
                                                        $nhuruf = 'E';
                                                        $indexvsks = 0;
                                                        $nhuruf = 'E';
                                                        $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                                                        $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                                                        $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                                                        $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                                                        $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                                                        $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;
                                
                                                        if($item->tipe_mata_kuliah == 'praktek'){
                                                            $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                                                        }elseif ($item->tipe_mata_kuliah == 'teori') {
                                                            $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                                                        }elseif ($item->tipe_mata_kuliah == 'seminar') {
                                                            $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                                                        }elseif ($item->tipe_mata_kuliah == 'pkl') {
                                                            $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                                                        }elseif ($item->tipe_mata_kuliah == 'skripsi') {
                                                            $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                                                        }
                                                        if($nangka < 45){
                                                            $nhuruf = 'E';
                                                            $nipk += 0 * $item->sks_mata_kuliah;
                                                            $indexvsks = 0 * $item->sks_mata_kuliah;
                                                            $index = 0;
                                                        }elseif($nangka > 44 && $nangka <  60){
                                                            $nhuruf = 'D';
                                                            $nipk += 1 * $item->sks_mata_kuliah;
                                                            $indexvsks = 1 * $item->sks_mata_kuliah;
                                                            $index = 1;
                                                        }elseif($nangka > 59 && $nangka< 70){
                                                            if((int)($mahasiswa->angkatan_title) < 2018 && $nangka > 65 && $nangka < 70){
                                                                $nhuruf = 'C+';
                                                            }else{
                                                                $nhuruf = 'C';
                                                            }
                                                            $nipk += 2 * $item->sks_mata_kuliah;
                                                            $indexvsks = 2 * $item->sks_mata_kuliah;
                                                            $index = 2;
                                                        }elseif($nangka > 69 && $nangka < 80){
                                                            if((int)($mahasiswa->angkatan_title) < 2018 && $nangka > 75 && $nangka < 80){
                                                                $nhuruf = 'B+';
                                                            }else{
                                                                $nhuruf = 'B';
                                                            }
                                                            $nipk += 3 * $item->sks_mata_kuliah;
                                                            $indexvsks = 3 * $item->sks_mata_kuliah;
                                                            $index = 3;
                                                        }elseif($nangka > 79 && $nangka <= 100){
                                                            $nhuruf = 'A';
                                                            $nipk += 4 * $item->sks_mata_kuliah;
                                                            $indexvsks = 4 * $item->sks_mata_kuliah;
                                                            $index = 4;
                                                        }else{
                                                            $nhuruf = 'E';
                                                            $nipk += 0 * $item->sks_mata_kuliah;
                                                            $index = 5;
                                                        }
                    
                                                        if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                                                            $sksteori = 0; 
                                                            $skspraktek = $item->sks_mata_kuliah;
                                                            $jumlahpr = $item->sks_mata_kuliah;
                                                            
                                                            $nilaiteoriangka = 0;
                                                            $nilaiteorimutu = '-';  
                                                            $nilaipraktekangka = $nangka;
                                                            $nilaipraktekmutu = $nhuruf;
                                                        }else{
                                                            $sksteori = $item->sks_mata_kuliah; 
                                                            $skspraktek = '-';
                                                            $jumlahpr = $item->sks_mata_kuliah;
                    
                                                            $nilaiteoriangka = $nangka;
                                                            $nilaiteorimutu = $nhuruf;  
                                                            $nilaipraktekangka = "-";
                                                            $nilaipraktekmutu = '-';
                                                        }
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$i.'</td>
                                                            <td>'.$item->kode_mata_kuliah.'</td>
                                                            <td>'.$item->nama_mata_kuliah.'</td>
                                                            <td align="center">'.$sksteori.'</td>
                                                            <td align="center">'.$skspraktek.'</td>
                                                            <td align="center">'.$jumlahpr.'</td>
                                                            <td align="center">'.$nilaiteoriangka.'</td>
                                                            <td align="center">'.$nilaiteorimutu.'</td>
                                                            <td align="center">'.$nilaipraktekangka.'</td>
                                                            <td align="center">'.$nilaipraktekmutu.'</td>
                                                        </tr>
                                                        ';
                                                    }
                                
                                                    echo '<tr>
                                                                <td align="center"></td>
                                                                <td></td>
                                                                <td>TOTAL SKS</td>
                                                                <td align="center" colspan="7">'.$sks.'</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"></td>
                                                                <td></td>
                                                                <td>INDEKS PRESTASI (IP)</td>
                                                                <td align="center" colspan="7">'.round($nipk / $sks ,2).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"></td>
                                                                <td style="color:#ffffff;height: 2px;font-size:9pt;">.</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        ';
                                                        
                                                        $nipg[] = $nipk / $sks;
                                                }

                                                if(array_sum($nipg) > 0){
                                                    echo '
                                                        <tr>
                                                            <td align="center"></td>
                                                            <td></td>
                                                            <td>INDEKS PRESTASI KUMULATIF (IPK)</td>
                                                            <td align="center" colspan="7">'.round(array_sum($nipg) / count($nipg) ,2) .'</td>
                                                        </tr>
                                              ';
                                                }else{
                                                    echo '
                                                        <tr>
                                                            <td align="center"></td>
                                                            <td></td>
                                                            <td>INDEKS PRESTASI KUMULATIF (IPK)</td>
                                                            <td align="center" colspan="7">0</td>
                                                        </tr>
                                              ';
                                                }

                                                
                                            ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .m-content{width:100%;}
</style>

@endsection

@section('js')

<script src="{{asset('assets/js/pages/crud/datatables/advanced/row-grouping.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/pages/mahasiswa/mahasiswa.js')}}" type="text/javascript"></script>

@endsection

