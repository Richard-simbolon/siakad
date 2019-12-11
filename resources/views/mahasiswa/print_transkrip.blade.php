<html>
    <head>
        
        <style>
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
                padding-top:40px;
                font-size: 10pt;
            }
            .logo-eqa{
                clear: both;
                width: 700px;
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
                font-size: 8pt;
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
                <p><b>TRANSKRIP AKADEMIK</b></p>
            </div>

            <div class="mahasiswa-biodata">
                <div style="float:left;width:55%">
                    <table cellpadding="2px;" width="100%">
                        <tr>
                            <td width="40%;">Nama</td>
                            <td width="5px;">:</td>
                            <td>{{$mahasiswa->nama}}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{$mahasiswa->tempat_lahir}} , {{$mahasiswa->tanggal_lahir}}</td>
                        </tr>
                        <tr>
                            <td>NIRM</td>
                            <td>:</td>
                            <td>{{$mahasiswa->nim}}</td>
                        </tr>
                        <tr>
                            <td>No. Ijazah</td>
                            <td>:</td>
                            <td></td>
                        </tr>  
                    </table>
                </div>
                <div style="float:left;width:45%">
                    <table cellpadding="2px;" width="100%">
                        <tr>
                            <td width="50%;">Program Pendidikan</td>
                            <td width="5px;">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td>{{$mahasiswa->jurusan_title}}</td>
                        </tr>
                        <tr>
                            <td>Status Akreditasi</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tanggal Akreditasi</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mahasiswa-matkul">
                <table width="100%" cellpadding="5px;">
                    <thead>
                        <tr>
                            <td align="center" rowspan="2">No</td>
                            <td align="center" rowspan="2">Kode</td>
                            <td align="center" rowspan="2">Mata Kuliah</td>
                            <td align="center" colspan="3">SKS</td>
                            <td align="center" colspan="2">Nilai Teori</td>
                            <td align="center" colspan="2">Nilai Praktek</td>
                        </tr>
                        <tr>
                            <td width="45px" align="center">Teori</td>
                            <td width="45px" align="center">Praktek</td>
                            <td width="45px" align="center">Jumlah</td>
                            <td width="45px" align="center">Angka</td>
                            <td width="45px" align="center">Mutu</td>
                            <td width="45px" align="center">Angka</td>
                            <td width="45px" align="center">Mutu</td>
                        </tr>
                    </thead>
                    <tbody>
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
                                    $sks += $item->bobot_mata_kuliah;
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
            
                                    if($item->tipe_mata_kuliah == 'praktik'){
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
                                        $indexvsks = 0 * $item->bobot_mata_kuliah;
                                        $index = 0;
                                    }

                                    if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                                        $sksteori = 0; 
                                        $skspraktek = $item->bobot_mata_kuliah;
                                        $jumlahpr = $item->bobot_mata_kuliah;
                                        
                                        $nilaiteoriangka = 0;
                                        $nilaiteorimutu = '-';  
                                        $nilaipraktekangka = $nangka;
                                        $nilaipraktekmutu = $nhuruf;
                                    }else{
                                        $sksteori = $item->bobot_mata_kuliah; 
                                        $skspraktek = '-';
                                        $jumlahpr = $item->bobot_mata_kuliah;

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
            
                                echo '
                                
                                        <tr>
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
            
                            echo '  
                                    <tr>
                                        <td align="center"></td>
                                        <td></td>
                                        <td>INDEKS PRESTASI KUMULATIF (IPK)</td>
                                        <td align="center" colspan="7">'.round(array_sum($nipg) / count($nipg) ,2).'</td>
                                    </tr>
                          ';
                            
                        ?>

                    </tbody>
                </table>
                <br/>
            </div>

            <div class="tugas-akhir">
                <table>
                    <tr>
                        <td>Tanggal Ujian Akhir Program Pendidikan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Judul KIPA</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            
            <div class="approval" style="padding:5px;float: right;">
                <div style="padding-top:10px;"></div>
                <div style="padding:5px;padding: 5px;
                width: 80%;
                text-align: right;">Medan, </div>
                <p style="margin-block-end: 0px;"></p>
                <div style="padding-top:5px;">
                    
                </div>
                <div style="padding:5px;float: right;">
                    Direktur Polbangtan Medan, 
                    <br/><br/><br/><br/><br/>
                    {{$report->direktur}}
                    <div style="width: 200px;border-bottom:1px solid #000000;height: 5px;margin-bottom: 5px;"></div>
                    NIP. {{$report->direktur_nip}}
                </div>
            </div>

            <div class="logo-eqa">
               
            </div>
        </div>
    </body>
</html>