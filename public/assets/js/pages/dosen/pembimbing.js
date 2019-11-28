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
            { data: 'nim', name: 'nim'},
            { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
            { data: 'judul', name: 'judul' },
            { data: 'status_dosen', name: 'status_dosen' },
            { data: 'tanggal_awal_bimbingan', name: 'tanggal_awal_bimbingan' },
            { data: 'tanggal_akhir_bimbingan', name: 'tanggal_akhir_bimbingan' },
            { data: 'status_bimbingan', name: 'status_bimbingan' },
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
            { data: 'nim', name: 'nim'},
            { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
            { data: 'judul', name: 'judul' },
            { data: 'status_dosen', name: 'status_dosen' },
            { data: 'tanggal_awal_bimbingan', name: 'tanggal_awal_bimbingan' },
            { data: 'tanggal_akhir_bimbingan', name: 'tanggal_akhir_bimbingan' },
            { data: 'status_bimbingan', name: 'status_bimbingan' },
        ]
    });
});

