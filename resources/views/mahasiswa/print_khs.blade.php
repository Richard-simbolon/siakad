<html>
    <head>
        
        <style>
            @page { margin: 15px; }
            body { margin: 0px; 
                padding: 0px;
            }
            body{
                font-family: 'Open Sans', sans-serif;
            }
            .content{
                width: 100%;
                margin-left: auto;
                margin-right: auto;
                padding-top:50px;
                padding-bottom:50px;
                position: relative;
            }
            .logo-kementan{
                position: absolute;
                left: 0;
            }
            .logo-polbangtan{
                position: absolute;
                right: 0px;
            }
            .header{
                text-align: center;
                line-height: 8px;
                font-family: 'Libre Baskerville', serif;
            }
            .subtitle{
                font-size: 14px;
                text-align: center;
                height: 60px;
                line-height: 5px;
                font-weight: 800;
                padding-top: 15px;
            }
            .mahasiswa-biodata{
                width:100%;
            }
            .mahasiswa-biodata table{
                font-size: 9pt;
            }
            .mahasiswa-matkul{
                clear: both;
                width: 100%;
                padding-top:50px;
            }
            .mahasiswa-matkul table{
                font-size: 9pt;
                border-collapse: collapse;
            }
            .mahasiswa-matkul tr td{
                border:1px solid #827b7b;
            }
            .approval{
                clear: both;
                width: 100%;
                padding-top:30px;
                font-size: 10pt;
            }
            .logo-eqa{
                clear: both;
                width: 600px;
                margin:auto;
                text-align: right;
            }
            .table-info table{
                font-size: 9pt;
                border-collapse: collapse;
            }
            .table-info table tr td{
                border:1px solid #827b7b;
            }
            .tugas-akhir table{
                font-size: 7pt;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="logo-kementan">
                    <img src="{{public_path('assets/logo/logokementan.png')}}" width="100px" />
            </div>
            <div class="logo-polbangtan">
                    <img src="{{public_path('assets/logo/logopolbangtan.png')}}" width="100px" />
                </div>
            <div class="header">
                <p style="font-size: 9pt;"><b>KEMENTERIAN PERTANIAN</b></p>
                <p style="font-size: 9pt;"><b>BADAN PENYULUHAN DAN PENGEMBANGAN SUMBERDAYA MANUSIA PERTANIAN</b></p>
                <p style="font-size: 9pt;"><b>POLITEKNIK PEMBANGUNAN PERTANIAN MEDAN</b></p>
                <p style="font-size: 8pt;font-family: 'Open Sans', sans-serif;font-weight: 400;">Jl. Binjai Km.10  TromolPos 18  Medan – 20002/Fax    : 061 8451544/061-8446669</p>
                <p style="font-size: 8pt;font-family: 'Open Sans', sans-serif;font-weight: 400;"><strong>Email</strong>     : polbangtanmedan@gmail.com <b>Website</b> : www.polbangtanmedan.ac.id</p>
            </div>

            
            <div class="subtitle">
                    <p><b>KARTU HASIL STUDI (KHS)</b></p>
                    <p><b>TA {{$semester_aktif->title}}</b></p>
                </div>
    
                <div class="mahasiswa-biodata">
                    <div style="float:left;width:80%">
                        <table cellpadding="5px;" width="100%">
                            <tr>
                                <td width="150px;">Nama</td>
                                <td width="5px;">:</td>
                                <td style="border-bottom: 1px dotted #000000;">{{$mahasiswa->nama}}</td>
                            </tr>
                            <tr>
                                <td>NIRM</td>
                                <td>:</td>
                                <td style="border-bottom: 1px dotted #000000;">{{$mahasiswa->nim}}</td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:</td>
                                <td style="border-bottom: 1px dotted #000000;">{{count($data) > 0 ? config('global.semester.'.$data[0]['semester']) : '-'}}</td> 
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td>:</td>
                                <td style="border-bottom: 1px dotted #000000;">{{$mahasiswa->jurusan}}</td>
                            </tr>  
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td style="border-bottom: 1px dotted #000000;">{{$mahasiswa->jurusan_title}}</td>
                            </tr>
                        </table>
                    </div>
                    <div style="float:left;width:20%"></div>
                </div>
    
                <div class="mahasiswa-matkul">
                    <table width="100%" cellpadding="5px;">
                        <thead>
                            <tr>
                                <td align="center" rowspan="2">No</td>
                                <td align="center" rowspan="2">Mata Kuliah</td>
                                <td align="center" colspan="2" width="90px">K</td>
                                <td align="center" colspan="2">HM</td>
                                <td align="center" colspan="2">AM</td>
                                <td rowspan="2" align="center">M</td>
                            </tr>
                            <tr>
                                <td width="45px" align="center">T</td>
                                <td width="45px" align="center">P</td>
                                <td width="45px" align="center">T</td>
                                <td width="45px" align="center">P</td>
                                <td width="45px" align="center">T</td>
                                <td width="45px" align="center">P</td>
                            </tr>
                        </thead>
                        <tbody>
                                
                            <?php 
                            $i = 0;
                                $sks = 0;
                                $nipk = 0;
                                $t_sks_teori = 0;
                                $t_sks_praktek = 0;
                            ?>
                            @if (count($data) > 0) 
                                
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
                                
                                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                                    $sksteori = 0; 
                                    $skspraktek = $item->bobot_mata_kuliah;
                                    $jumlahpr = $item->bobot_mata_kuliah;
                                    
                                    $nilaiteoriangka = 0;
                                    $nilaiteorimutu = '-';  
                                    $nilaipraktekangka = $nangka;
                                    $nilaipraktekmutu = $nhuruf;
                                    $t_sks_praktek += $item->bobot_mata_kuliah;
                                    
                                }else{
                                    $sksteori = $item->bobot_mata_kuliah; 
                                    $skspraktek = '-';
                                    $jumlahpr = $item->bobot_mata_kuliah;

                                    $nilaiteoriangka = $nangka;
                                    $nilaiteorimutu = $nhuruf;  
                                    $nilaipraktekangka = "-";
                                    $nilaipraktekmutu = '-';
                                    $t_sks_teori += $item->bobot_mata_kuliah;
                                }

                                
                                ?>
                            <tr>
                                <td align="center">{{$i}}</td>
                                <td>{{$item->nama_mata_kuliah}}</td>
                                <td align="center">{{$sksteori}}</td>
                                <td align="center">{{$skspraktek}}</td>
                                <td align="center">{{$nilaiteorimutu}}</td>
                                <td align="center">{{$nilaipraktekmutu}}</td>
                                <td align="center">{{$nilaiteoriangka}}</td>
                                <td align="center">{{$nilaipraktekangka}}</td>
                                <td align="center">{{$nhuruf}}</td>
                            </tr>
                            
                            @endforeach


                            <tr>
                                <td align="center"></td>
                                <td>Jumlah </td>
                                <td align="center">{{$t_sks_teori}}</td>
                                <td align="center">{{$t_sks_praktek}}</td>
                                <td align="center" colspan="4" ></td>
                                <td align="center" rowspan="2"></td>
                            </tr>

                            <tr>
                                <td align="center"></td>
                                <td>Jumlah  K (T + P)</td>
                                <td align="center" colspan="2" >{{$sks}}</td>
                                <td align="center" colspan="4"></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                                <td>Indeks Prestasi (IP)</td>
                                <td align="center">-</td>
                                <td align="center">-</td>
                                <td align="center">-</td>
                                <td align="center">-</td>
                                <td align="center">-</td>
                                <td align="center">-</td>
                                <td align="center">{{ round($nipk / $sks ,2)}}</td>
                            </tr>

                            @else
                            <tr>            
                                <td style="text-align: center;center; border-bottom:1px black solid; border-right:1px black solid;" colspan="9">Tidak ada matakuliah</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <br/>
                    <p style="font-size: 10pt"><b>Nilai Kepribadian</b></p>
                    <table width="60%" cellpadding="5px;">
                        <thead>
                            <tr>
                                <td width="45px" align="center">No</td>
                                <td>Unsur yang Dinilai</td>
                                <td align="center">Huruf Mutu</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Budi Luhur</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Disiplin</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kerjasama</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Inovatif</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="approval">
                    <div style="float:left;width:50%;padding-top:5px;"></div>
                    <div style="float:left;">Medan, </div>
                    <br/>
                    <div style="float:left;width:5%;padding-top:5px;">Mengetahui</div>
                    <br/>
                    <div style="float:left;width:45%;padding-top:5px;">
                        Dosen Wali,
                        <br/><br/><br/>
                        {{$mahasiswa->nama_dosen}}
                        <div style="width: 80%;border-bottom:1px solid #000000;height: 5px;margin-bottom: 2px;"></div>
                        NIP. {{$mahasiswa->nip}}
                    </div>
                    <div style="float:left;width:50%;padding:5px;">
                        Kepala Bagian Administrasi Akademik,<br/>
                        Kemahasiswaan dan Alumni
                        <br/><br/><br/>
                        {{$report->kepala_bagian_ad_akademik}}
                        <div style="width: 80%;border-bottom:1px solid #000000;height: 5px;margin-bottom: 2px;"></div>
                        NIP. {{$report->kepala_bagian_ad_akademik_nip}}
                    </div>
    
                    <div class="table-info" style="clear: both;width:100%;text-align:center;padding-top:50px;">
                        <table width="40%" cellpadding="5px;">
                            <tbody>
                                <tr>
                                    <td colspan="2">Keterangan:</td>
                                </tr>
                                <tr>
                                    <td>K</td>
                                    <td>: Kredit</td>
                                </tr>
                                <tr>
                                    <td>HM</td>
                                    <td>: Huruf Mutu</td>
                                </tr>
                                <tr>
                                    <td>AM</td>
                                    <td>: Angka Mutu</td>
                                </tr>
                                <tr>
                                    <td>M</td>
                                    <td>: Angka Mutu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    
                <div class="logo-eqa" >
                    <br/>
                    <img src="{{public_path('assets/logo/iso.png')}}" width="75px" style="margin-top:-24px;">
                </div>
                    
        </div>
    </body>
</html>