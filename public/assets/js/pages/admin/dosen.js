$(document).ready(function() {
    $(document).on('click' , '.delete_item' , function(){
        var _this = $(this).attr('attr');
        var tr = $(this).closest('tr');
        var type = $(this).attr('type');
        Swal.fire({
            title: 'Hapus Data',
            text: "Anda Yakin ? Data akan dihapus dari tabel.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'POST',
                    //dataType:'json',
                    url:'/data/dosen/modaleditadmin',
                    data:{id:_this , type:type , 'status':'delete'},
                    success:function(response) {
                        var res = JSON.parse(response);
                        //console.log(res);
                        if(res.status == 'error'){
                            var text = '';
                            $.each(res.message, function( index, value ) {
                                text += '<p class="error">'+ value[0]+'</p>';
                            });
                            swal.fire({
                                "title": "",
                                "html": text,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": res.message,
                                "type": res.status,
                                "confirmButtonClass": "btn btn-secondary"
                            });
                            tr.remove();
                        }

                    }
                });
            }

        })

    });

    $(document).on('click' , '.tambah_penugasan' , function(){
        $('#kt_modal_penugasan_data').modal('show')

    });

    $(document).on('click' , '.tambah_fungsional' , function(){
        $('#kt_modal_fungsional_data').modal('show')

    });

    $(document).on('click' , '.tambah_kepangkatan' , function(){
        $('#kt_modal_kepangkatan_data').modal('show')

    });

    $(document).on('click' , '.tambah_pendidikan' , function(){
        $('#kt_modal_pendidikan_data').modal('show')

    });

    $(document).on('click' , '.tambah_sertifikasi' , function(){
        $('#kt_modal_sertifikasi_data').modal('show')

    });

    $(document).on('click' , '.tambah_penelitian' , function(){
        $('#kt_modal_penelitian_data').modal('show')

    });

    $(document).on('click' , '.savepenugasan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambahpenugasan',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.msg, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
                    swal.fire({
                        "title": "",
                        "html": text,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }
            }
        });
    });

    $(document).on('click' , '.call-modal-penugasan' , function(){
        $('#id_penugasan').val($(this).attr('attr'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/modaleditadmin',
            data:{id:$(this).attr('attr') , type:'penugasan', status:''},
            success:function(result) {
                $("[name='tahun_ajaran']").val(result.tahun_ajaran);
                $("[name='program_studi_id']").val(result.program_studi_id);
                $("[name='no_surat_tugas']").val(result.no_surat_tugas);
                $("[name='tanggal_surat_tugas']").val(result.tanggal_surat_tugas);
                $("[name='tmt_surat_tugas']").val(result.tmt_surat_tugas);
            }

        });
        $('#kt_modal_penugasan_data').modal('show');
    });

    $(document).on('click' , '.call-modal-fungsional' , function(){
        $('#id_fungsional').val($(this).attr('attr'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/modaleditadmin',
            data:{id:$(this).attr('attr') , type:'fungsional', status:''},
            success:function(result) {
                $("[name='jabatan']").val(result.jabatan);
                $("[name='sk_jabatan']").val(result.sk_jabatan);
                $("[name='tmt_jabatan']").val(result.tmt_jabatan);
            }

        });
        $('#kt_modal_fungsional_data').modal('show');
    });

    $(document).on('click' , '.call-modal-kepangkatan' , function(){
        $('#id_kepangkatan').val($(this).attr('attr'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/modaleditadmin',
            data:{id:$(this).attr('attr') , type:'kepangkatan', status:''},
            success:function(result) {
                //console.log(result);
                $("[name='pangkat']").val(result.pangkat);
                $("[name='sk_pangkat']").val(result.sk_pangkat);
                $("[name='tanggal_sk_pangkat']").val(result.tanggal_sk_pangkat);
                $("[name='tmt_sk_pangkat']").val(result.tmt_sk_pangkat);
                $("[name='masa_kerja']").val(result.masa_kerja);
            }

        });
        $('#kt_modal_kepangkatan_data').modal('show');
    });

    $(document).on('click' , '.call-modal-pendidikan' , function(){
        $('#id_pendidikan').val($(this).attr('attr'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/modaleditadmin',
            data:{id:$(this).attr('attr') , type:'pendidikan', status:''},
            success:function(result) {
                //console.log(result);
                $("[name='perguruan_tinggi']").val(result.perguruan_tinggi);
                $("[name='jenjang']").val(result.jenjang);
                $("[name='bidang_studi']").val(result.bidang_studi);
                $("[name='gelar']").val(result.gelar);
                $("[name='fakultas']").val(result.fakultas);
                $("[name='tahun_lulus']").val(result.tahun_lulus);
                $("[name='sks']").val(result.sks);
                $("[name='ipk']").val(result.ipk);
            }

        });
        $('#kt_modal_pendidikan_data').modal('show');
    });

    $(document).on('click' , '.call-modal-sertifikasi' , function(){
        $('#id_sertifikasi').val($(this).attr('attr'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/modaleditadmin',
            data:{id:$(this).attr('attr') , type:'sertifikasi', status:''},
            success:function(result) {
                //console.log(result);
                $("[name='nomor']").val(result.nomor);
                $("[name='bidang_studi']").val(result.bidang_studi);
                $("[name='jenis_sertifikasi']").val(result.jenis_sertifikasi);
                $("[name='tahun_sertifikasi']").val(result.tahun_sertifikasi);
                $("[name='no_sk_sertifikasi']").val(result.no_sk_sertifikasi);
            }

        });
        $('#kt_modal_sertifikasi_data').modal('show');
    });

    $(document).on('click' , '.call-modal-penelitian' , function(){
        $('#id_penelitian').val($(this).attr('attr'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/modaleditadmin',
            data:{id:$(this).attr('attr') , type:'penelitian', status:''},
            success:function(result) {
                //console.log(result);
                $("[name='judul_penelitian']").val(result.judul_penelitian);
                $("[name='bidang_ilmu']").val(result.bidang_ilmu);
                $("[name='lembaga']").val(result.lembaga);
                $("[name='tahun']").val(result.tahun);
            }

        });
        $('#kt_modal_penelitian_data').modal('show');
    });

    $(document).on('click' , '.savekepangkatan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambahkepangkatan',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.msg, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
                    swal.fire({
                        "title": "",
                        "html": text,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }

            }
        });
    });

    $(document).on('click' , '.savependidikan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_pendidikan',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.msg, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
                    swal.fire({
                        "title": "",
                        "html": text,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }

            }
        });
    });

    $(document).on('click' , '.savesertifikasi' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_sertifikasi',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.msg, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
                    swal.fire({
                        "title": "",
                        "html": text,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }

            }
        });
    });

    $(document).on('click' , '.savepenelitian' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_penelitian',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.msg, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
                    swal.fire({
                        "title": "",
                        "html": text,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }
            }
        });
    });

    $(document).on('click' , '.savefungsional' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_fungsional',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.msg, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
                    swal.fire({
                        "title": "",
                        "html": text,
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }else{
                    swal.fire({
                        "title": "",
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }

            }
        });
    });

    $('#tbl_mhs_tugas_akhir_pembimbing').DataTable({
        pageLength: 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/pembimbing_paging',
            type:"POST",
            // data:{id: $("#dosen_id").val()},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val();
                d.dosen_id =$("#dosen_id").val();
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

    $('#tbl_mhs_tugas_akhir_penguji').DataTable({
        pageLength: 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/penguji_paging',
            type:"POST",
            // data:{id: $("#dosen_id").val()},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val();
                d.dosen_id =$("#dosen_id").val();
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

    $('#tbl_dosen_aktivitas_mengajar').DataTable({
        pageLength: 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/activity_paging',
            type:"POST",
            // data:{id: $("#dosen_id").val()},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val();
                d.dosen_id =$("#dosen_id").val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'periode', name: 'periode'},
            { data: 'program_studi', name: 'program_studi' },
            { data: 'matakuliah', name: 'matakuliah' },
            { data: 'kelas', name: 'kelas' },
            { data: 'pertemuan', name: 'pertemuan' },
            { data: 'realisasi', name: 'realisasi' }
        ],
        columnDefs: [
            {
                targets: 0,
                className: "text-center"
            },
            {
                targets: 5,
                className: "text-center"
            },
            {
                targets: 6,
                className: "text-center"
            }
        ]
    });
});