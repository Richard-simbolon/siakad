$(document).ready(function() {
    $('#absensimatakuliah').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/pembimbing/paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'nim', name: 'nim'},
            { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
            { data: 'judul', name: 'judul' },
            { data: 'status_dosen', name: 'status_dosen' },
            { data: 'tanggal_awal_bimbingan', name: 'tanggal_awal_bimbingan' },
            { data: 'tanggal_akhir_bimbingan', name: 'tanggal_akhir_bimbingan' },
            { data: 'status_bimbingan', name: 'status_bimbingan' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center"
            }

        ]
    });

    $('#daftarPenguji').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/penguji/paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'nim', name: 'nim'},
            { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
            { data: 'judul', name: 'judul' },
            { data: 'status_dosen', name: 'status_dosen' },
            { data: 'tanggal_awal_bimbingan', name: 'tanggal_awal_bimbingan' },
            { data: 'tanggal_akhir_bimbingan', name: 'tanggal_akhir_bimbingan' },
            { data: 'status_bimbingan', name: 'status_bimbingan' },
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center"
            }

        ]
    });

    $('#search_mahasiswa_bimbingan').on('click', function(e) {
        var tables = $('#tbl_pembimbing_akademik').DataTable();
        tables.column(2).search($('#search_status').val())
            .column(5).search($('#jurusan').val())
            .column(6).search($('#search_angkatan').val())
            .column(7).search($('#search_kelas').val())
            .draw();
    });
    
    $('#tbl_pembimbing_akademik').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/data/dosen/pembimbing_akademik_paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val();
                d.dosen_id = $("#dosen_id").val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'nim', name: 'nim'},
            { data: 'status', name: 'status'},
            { data: 'nama', name: 'nama' },
            { data: 'jk', name: 'jk' },
            { data: 'jurusan', name: 'jurusan' },
            { data: 'angkatan', name: 'angkatan' },
            { data: 'kelas', name: 'kelas' }
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center"
            },
            {
                targets: 6,
                className: "text-center"
            }
        ],
    });
});

