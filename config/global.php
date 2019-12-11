<?php

return [
    'jenis_kelamin' => ['laki-laki' => 'Laki-Laki' , 'perempuan' => 'Perempuan'],
    'status_pernikahan' => ['single' => 'Belum Menikah' , 'menikah' => 'Menikah'],
    'hari' =>   [
                    '0'=>'-',
                    '1'=>'Senin',
                    '2'=>'selasa',
                    '3'=>'Rabu',
                    '4'=>'kamis',
                    '5'=>'Jumat',
                    '6'=>'Sabtu',
                    '7'=>'Minggu' 
    ],
    'tipe_matakuliah' => [
        'teori' =>[
            'nilai_uts' => 'Nilai UTS',
            'nilai_tugas' => 'Nilai Tugas',
            'nilai_uas'=>'Nilai UAS',
        ],
        'praktek' =>[
            'nilai_uas' => 'Unjuk kerja/Portofolio',
            'nilai_uts' => 'Pelaksanaan praktik',
            'nilai_tugas' => 'Hasil/Laporan'
        ],
        'seminar' =>[
            'nilai_uas' => 'Penyajian',
            'nilai_uts' => 'Penyusunan Makalah',
            'nilai_tugas' => 'Penugasan Materi'
        ],
        'pkl' =>[
            'nilai_uas' => 'Pelaksanaan',
            'nilai_uts' => 'Proposal',
            'nilai_tugas' => 'Ujian',
            'nilai_laporan_pkl' => 'Laporan PKL'
        ],
        'skripsi' =>[
            'nilai_uas' => 'Seminar Proposal',
            'nilai_uts' => 'Proposal',
            'nilai_tugas' => 'Pelaksanaan',
            'nilai_laporan_pkl' => 'Seminar Hasil',
            'nilai_ujian' => 'Ujian',
            'nilai_laporan' => 'Laporan'
        ],
    ],
    'semester' => [
        '1'=>'I',
        '2'=>'II',
        '3'=>'III',
        '4'=>'IV',
        '5'=>'V',
        '6'=>'VI',
        '7'=>'VII',
        '8'=>'VIII'
    ]
];
// NILAI UTS = Pelaksanaan praktik = penyusunan makalah = proposal = proposal
// NILAI UAS = Unjuk kerja/portofolio = penyajian = pelaksanaan = seminar proposal
// Nilai TUGAS = Hasil/Laporan = penugasan materi = ujian = pelaksanaan
// Laporan PKL = seminar hasil
// Ujian