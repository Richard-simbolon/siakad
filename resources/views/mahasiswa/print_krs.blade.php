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
            <p><b>KARTU RENCANA STUDI (KRS)</b></p>
            <p><b>TA {{$semester_active->title}}</b></p>
        </div>
    </div>
    <?php
        if(count($data) > 0){
            $profile = $data[0];
            //print_r($profile); 
        }    
    ?>

<div style="width:100%; text-align:center" >
    <div style="">
        <table cellpadding="5"  class="table_info" style="font-size: 14px;margin-left: 75px;">
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
                    <td><b>{{$profile->angkatan_title}}</b></td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>:</td>
                    <td><b>{{$profile->program_studi_title}}</b></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><b>{{$profile->kelas_title}}</b></td>
                </tr>
                
            </tbody>
        </table>

        <br/>
        <table class="table" align="center" style="width:70%;padding-top:30px;">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle">No</th>
                    <th style="vertical-align: middle">Kode MK</th>
                    <th style="text-align: center;vertical-align: middle;width: 39%;" >Mata Kuliah</th>
                    <th style="text-align: center;vertical-align: middle;border-bottom:1px black solid; border-right:1px black solid;">Bobot MK</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;
                $sks = 0;
            ?>
            @foreach ($data as $item)
            <?php $i++;
            $sks += $item->bobot_mata_kuliah;
            ?>
                <tr>
                    <td style="text-align: center">{{$i}}</td>
                    <td style="text-align: center;border-bottom:1px black solid; border-right:1px black solid;">{{$item->kode_mata_kuliah}}</td>
                    <td style="text-align: center;border-bottom:1px black solid; border-right:1px black solid;">{{$item->matakuliah_title}}</td>
                    <td style="text-align: center;border-bottom:1px black solid; border-right:1px black solid;">{{$item->bobot_mata_kuliah}}</td>
                </tr>
            @endforeach
                <tr>
                    <td style="text-align: center;border-bottom:1px black solid; border-right:1px black solid;" colspan="3"><b>Total SKS</b></td>
                    <td style="text-align: center;border-bottom:1px black solid; border-right:1px black solid;" ><b>{{$sks}}</b></td>
                </tr>
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
    .table_info tbody td {
        
        padding: 2px;
        
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