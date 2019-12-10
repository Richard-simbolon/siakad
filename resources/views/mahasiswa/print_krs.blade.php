<html>
    <head>
            <style>
                    @page { margin: 20px; }
                    body { margin: 0px; }
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
                <b>KARTU RENCANA STUDI (KRS)</b>
            </div>
           <div class="mahasiswa-biodata">
                <div style="float:left;width:80%">
                    <table cellpadding="5px;" width="100%">
                        <tr>
                            <td width="150px;">Nama</td>
                            <td width="5px;">:</td>
                            <td style="border-bottom: 1px dotted #000000;">{{$profile->nama}}</td>
                        </tr>
                        <tr>
                            <td>NIRM</td>
                            <td>:</td>
                            <td style="border-bottom: 1px dotted #000000;">{{$profile->nim}}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td style="border-bottom: 1px dotted #000000;">{{$profile->jurusan_title}}</td>
                        </tr>
                        <tr>
                            <td>IP Semester Lalu</td>
                            <td>:</td>
                            <td style="border-bottom: 1px dotted #000000;"></td>
                        </tr>
                        <tr>
                            <td>Beban SKS</td>
                            <td>:</td>
                            <td style="border-bottom: 1px dotted #000000;"></td>
                        </tr>    
                        <tr>
                            <td>Tahun Akademik</td>
                            <td>:</td>
                            <td style="border-bottom: 1px dotted #000000;">{{$semester_active->title}}</td>
                        </tr>
                    </table>
                </div>
                <div style="float:left;width:20%">
                    <div style="width: 113px;height: 151px;border : 1px solid #000000;margin: auto;margin-top:23px;text-align: center;line-height: 151px;">
                        2x3
                    </div>
                </div>
            </div>

            <div class="mahasiswa-matkul">
                <table width="100%" cellpadding="5px;">
                    <thead>
                        <tr>
                            <td align="center">No</td>
                            <td>Kode</td>
                            <td>Mata Kuliah</td>
                            <td align="center">SKS</td>
                            <td align="center">SMT</td>
                            <td>Nama Dosen Pengampu</td>
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
                                    <td align="center">{{$i}}</td>
                                    <td>{{$item->kode_mata_kuliah}}</td>
                                    <td>{{$item->matakuliah_title}}</td>
                                    <td align="center">{{$item->bobot_mata_kuliah}}</td>
                                    <td align="center">{{$semester_active->title}}</td>
                                    <td>{{$item->nama}}</td>
                                </tr>
                            @endforeach
                        
                        <tr>
                            <td align="center"></td>
                            <td></td>
                            <td align="center">Jumlah SKS</td>
                            <td align="center">{{$sks}}</td>
                            <td align="center"></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="approval">
                <p style="margin-block-end: 0px;">Menyetujui,</p>
                <div style="float:left;width:33.33%;padding-top:5px;">
                    Ketua Jurusan
                    <br/><br/><br/>
                    Dr. Iman Arman, SP, MM
                    <div style="width: 80%;border-bottom:1px solid #000000;height: 5px;margin-bottom: 2px;"></div>
                    NIP. 19711205 200112 1 001
                </div>
                <div style="float:left;width:38.33%;padding:5px;">
                    Dosen Pembimbing Akademik (PA)
                    <br/><br/><br/>
                    Dr. Iman Arman, SP, MM
                    <div style="width: 80%;border-bottom:1px solid #000000;height: 5px;margin-bottom: 2px;"></div>
                    NIP. 19711205 200112 1 001
                </div>
                <div style="float:left;width:28.33%;padding:5px;">
                    Mahasiswa
                </div>

                <div style="clear: both;width:100%;text-align:center;padding-top:30px;">
                    <p style="margin-block-end: 0px;">Mengetahui,</p>
                    <p style="margin-block-start: 0px;">Wakil Direktur I Bidang Akademik,</p>
                    <br/><br/>
                    Nurliana Harahap, SP, M.Si<br/>
                    NIP. 19751001 200312 2 00
                </div>
            </div>

            <div class="logo-eqa" >
                <br/>
                <img src="{{public_path('assets/logo/iso.png')}}" width="75px" style="margin-top:-24px;">
            </div>
        </div>
    </body>
</html>


