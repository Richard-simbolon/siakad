$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('click' , '#btn-search-nilai-matakuliah' , function(){
        $('#absensimatakuliah').DataTable().ajax.reload();
    });


    $(document).on('change' , '.search-nilai-matakuliah' , function(){
        if($('#jurusan-mahasiswa').val() == '' || $('#angkatan-mahasiswa').val() == ''){
            return false;
        }
        //alert('a');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            url:'/kelas/listkelas',
            data:{'jurusan':$('#jurusan-mahasiswa').val() , 'angkatan':$('#angkatan-mahasiswa').val()},
            success:function(result) {
                $('#kelas-mahasiswa').html(result);
            }
         });
    });

    $('#absensimatakuliah').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/absensi/paging',
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
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah'},
            { data: 'nama_angkatan', name: 'nama_angkatan' },
            { data: 'nama_semester', name: 'nama_semester' },
            { data: 'nama_jurusan', name: 'nama_jurusan' },
            { data: 'nama_kelas', name: 'nama_kelas' },
            { data: 'ruangan', name: 'ruangan' },
            { data: 'nama_dosen', name: 'nama_dosen' },
           
        ],
        columnDefs: [
            {
                targets: 7,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return `
                    <span class="dropdown">
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                          <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="absensi/view/`+full.id+`"><i class="la la-edit"></i>Cek Absensi</a>
                            <a class="dropdown-item" href="absensi/absensi/`+full.id+`"><i class="la la-plus"></i>Tambah</a>
                        </div>
                    </span>`;
                },
            },{
                targets: 0,
                className: "text-center"
            }

        ],
    });

    $(document).on('click' , '#save-absensi-perkuliahan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/absensi/save',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                //console.log(result);
                //console.log(result);
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.message, function( index, value ) {
                        console.log(value);
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
                }

            }
         });
    });

    $(document).on('click' , '#update-absensi-perkuliahan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/absensi/update',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                //console.log(result);
                //console.log(result);
                var res = JSON.parse(result);
                if(res.status == 'error'){
                    var text = '';
                    $.each(res.message, function( index, value ) {
                        //console.log(value);
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
                }

            }
         });
    });

    $(document).on('click' , '.tambah_penugasan_dosen' , function(){
        $('#id_penugasan').val('');
        $('#penugasanform')[0].reset();
        $('#kt_modal_penugasan_data').modal('show');
        
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
            url:'/data/dosen/modaledit',
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
    $(document).on('click' , '.dosensavepenugasan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/submitpenugasan_dosen',
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

    // END PENUGASAN

    $(document).on('click' , '.tambah_fungsional_dosen' , function(){
        $('#id_fungsional').val('');
        $('#penugasanform')[0].reset();
        $('#kt_modal_penugasan_data').modal('show');
        
    });

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
                        url:'/data/dosen/modaledit',
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
            url:'/data/dosen/modaledit',
            data:{id:$(this).attr('attr') , type:'fungsional', status:''},
            success:function(result) {
                //console.log(result);
                $("[name='jabatan']").val(result.jabatan);
                $("[name='sk_jabatan']").val(result.sk_jabatan);
                $("[name='tmt_jabatan']").val(result.tmt_jabatan);
            }
            
        });
        $('#kt_modal_penugasan_data').modal('show');
    });

    $(document).on('click' , '.dosensavefungsional' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/submitfungsional_dosen',
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

    //END FUNGSIONAL

    $(document).on('click' , '.tambah_pengangkatan_dosen' , function(){
        $('#id_pengangkatan').val('');
        $('#kepangkatanForm')[0].reset();
        $('#kt_modal_penugasan_data').modal('show');
        
    });

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
                        url:'/data/dosen/modaledit',
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
            url:'/data/dosen/modaledit',
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
        $('#kt_modal_penugasan_data').modal('show');
    });

    $(document).on('click' , '.dosensavekepangkatan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/submitpengangkatan_dosen',
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

    //pendidikan
    $(document).on('click' , '.tambah_pendidikan_dosen' , function(){
        $('#id_pendidikan').val('');
        $('#pendidikanform')[0].reset();
        $('#kt_modal_pendidikan_data').modal('show');

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
            url:'/data/dosen/modaledit',
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

    $(document).on('click' , '.savependidikandosen2' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/submitpendidikan_dosen',
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

    //sertifikasi
    $(document).on('click' , '.tambah_sertifikasi_dosen' , function(){
        $('#id_sertifikasi').val('');
        $('#sertifikasiform')[0].reset();
        $('#kt_modal_sertifikasi_data').modal('show');

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
            url:'/data/dosen/modaledit',
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

    $(document).on('click' , '.savesertifikasidosen' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/submitsertifikasi_dosen',
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

    //penelitian
    $(document).on('click' , '.tambah_penelitian_dosen' , function(){
        $('#id_penelitian').val('');
        $('#penelitianform')[0].reset();
        $('#kt_modal_penelitian_data').modal('show');

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
            url:'/data/dosen/modaledit',
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

    $(document).on('click' , '.savepenelitiandosen' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/submitpenelitian_dosen',
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

});

