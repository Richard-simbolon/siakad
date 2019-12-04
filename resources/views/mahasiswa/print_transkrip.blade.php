<div style="width:100%; border-bottom: 1px black solid;text-align: center;">
    <div>
        <p><b>KEMENTRIAN PERTANIAN</b></p>
        <p><b>BADAN PENYULUHAN PENGEMBAGAN SUMBERDAYA MANUSIA DAN PERTANIAN</b></p>
        <p><b>POLITEKNIK PENGEMBANGAN PERTANIAN MEDAN</b></p>
        <p style="font-size: 14px;">JL. Binjain KM.10 TromolPos 18 Medan - 2002 / Fax   : 061 8451544 / 061-8446669</p>
        <p style="font-size: 14px;">Email  : polbangtanmedan@gmail.com   Website   : www.polbangtanmedan.ac.id</p>

    </div>
    
</div>
<div style="border-bottom:1px black solid; padding-top:2px"></div>
<div style="width:100%;text-align: center;">
        <div>
            <br/>
            <p><b>TRANSKRIP AKADEMIK</b></p>
            <p><b>No.</b></p>
        </div>
        
    </div>
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
<br/>

<table class="table" style="    width: 100%;
padding-top: 30px;">
        <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle" rowspan="2">No</th>
            <th style="text-align: center ; vertical-align: middle" rowspan="2">Kode MK</th>
            <th style="text-align: center;vertical-align: middle; width:30%;" rowspan="2">Mata Kuliah</th>
            <th style="text-align: center;vertical-align: middle" rowspan="2">Semester</th>
            <th style="text-align: center;vertical-align: middle" rowspan="2">Bobot SKS</th>
            <th style="text-align: center" colspan="3">Nilai akhir</th>
            <th style="text-align: center; border-bottom:1px black solid; border-right:1px black solid;" rowspan="2">SKS * Index</th>
        </tr>
        <tr>
            <th style="text-align: center">Angka</th>
            <th style="text-align: center">Huruf</th>
            <th style="text-align: center">Index</th>
        </tr>
        </thead>
            <tbody id="body-khs">
            <?php
                $data_group = [];
                foreach ($data as $key => $value) {
                    $data_group[$value->semester_id][] = $value;
                }
                $i = 0;
                $j = 0;
                $nipg =[];
                foreach ($data_group as $g) {
                    $j++;
                    $sks = 0;
                    $nipk = 0;
                       
                    foreach ($g as $key => $item) {

                        //echo $item->nama_mata_kuliah.'-';
                        $i++;
                        $semester_id = 
                        $sks += $item->bobot_mata_kuliah;

                        $nangka = 0;
                        $nhuruf = 'E';
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
                            $indexvsks = 0 * $item->bobot_mata_kuliah;
                            $index = 0;
                        }

                        echo '<tr>
                            <td style="text-align: center">'.$i.'</td>
                            <td style="text-align: center">'.$item->kode_mata_kuliah.'</td>
                            <td style="text-align: center">'.$item->nama_mata_kuliah.'</td>
                            <td style="text-align: center">'.$j.'</td>
                            <td style="text-align: center">'.$item->bobot_mata_kuliah .'</td>
                            <!--<td style="text-align: center">'.($item->nilai_uts ? $item->nilai_uts : 0).'</td>
                            <td style="text-align: center">'. ($item->nilai_tugas ? $item->nilai_tugas: 0).'</td>
                            <td style="text-align: center">'. ($item->nilai_uas ? $item->nilai_uas : 0).'</td>-->
                            <td style="text-align: center">'.$index.'</td>
                            <td style="text-align: center">'.$nangka.'</td>
                            <td style="text-align: center">'.$nhuruf.'</td>
                            <td style="text-align: center; border-bottom:1px black solid; border-right:1px black solid;">'.$indexvsks.'</td>
                        </tr>';
                    }

                    echo '<tr>
                            <td colspan="4">
                                Total SKS
                            </td>
                            <td style="text-align: center;">
                                    <b>'.$sks.'</b>
                            </td>
                            <td colspan="4" style="text-align: center; border-bottom:1px black solid; border-right:1px black solid;">
                                    
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td colspan="8">
                                INDEKS PRESTASI (IP)
                            </td>
                            <td colspan="1" style="text-align: center; border-bottom:1px black solid; border-right:1px black solid;">
                                    <b>'.round($nipk / $sks ,2).'</b>
                            </td>
                        </tr>
                        ';
                        $nipg[] = $nipk / $sks;
                }

                echo '  <tr>
                            <td colspan="8" style=" border-bottom:1px black solid; border-right:1px black solid;">
                                <b>INDEKS PRESTASI KUMULATIF (IPK)</b>
                            </td>
                            <td colspan="1" style="text-align: center; border-bottom:1px black solid; border-right:1px black solid;">
                                    <b>'.round(array_sum($nipg) / count($nipg) ,2).'</b>
                            </td>
                        </tr>';
                
            ?>
            </tbody>
</table>
 
    </div>
</div>
<style>
    p {
        margin: 4px;
    }
    .table thead th {
        border-top: 1px black solid;
    padding: 10px;
    border-left: 1px black solid;
    }
    .table tbody td {
        border-top: 1px black solid;
    padding: 10px;
    border-left: 1px black solid;
    }
    .table{
        border-collapse: collapse;
        font-size: 12px;
    }
</style>