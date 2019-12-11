$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('click' , '#btn-search-nilai-matakuliah' , function(){
        var tables = $('#jadwal_ujian').DataTable();

        var jurusan = $('#jurusan-mahasiswa').val() != ' ' ? $('#jurusan-mahasiswa option:selected').text() :'';
        var angkatan = $('#angkatan-mahasiswa').val() != ' ' ? $('#angkatan-mahasiswa option:selected').text() :'';
        var kelas = $('#kelas-mahasiswa').val() != ' ' ? $('#kelas-mahasiswa option:selected').text() :'';

        if(kelas == '-- Pilih Kelas --'){
            kelas = ' ';
        }

        tables.column(4).search(jurusan)
            .column(5).search(angkatan)
            .column(6).search(kelas)
            .draw();
    });


    $(document).on('change' , '.search-nilai-matakuliah' , function(){
        if($('#jurusan-mahasiswa').val() == '' || $('#angkatan-mahasiswa').val() == ''){
            return false;
        }

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

    $('#jadwal_ujian').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/data/jadwalujian/paging',
            type:"POST",
            data:{"_token": $('#csrf_').val(), 'jenis_ujian_jadwal':$('#jenis_ujian_jadwal').val()}
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah'},
            { data: 'nama_dosen', name: 'nama_dosen' },
            { data: 'nama_jurusan', name: 'nama_jurusan' },
            { data: 'nama_angkatan', name: 'nama_angkatan' },
            { data: 'nama_kelas', name: 'nama_kelas' },
            // { data: 'jenis_ujian', name: 'jenis_ujian' },
            { defaultContent : '<td></td>'}
        ],
        columnDefs: [
            {
                targets: 7,
                title: 'Actions',
                className: "text-center",
                orderable: false,
                render: function(data, type, full, meta) {
                    return `<a class="btn btn-label-success" href="/data/jadwalujian/form/`+full.id+`/`+ $('#jenis_ujian_jadwal').val() +`"><i class="la la-plus"></i></a>`;
                },
            },{
                targets: 0,
                className: "text-center"
            },{
                targets: 5,
                className: "text-center"
            }

        ],
    });

    $(document).on('click' , '#save-jadwal-ujian' , function(){
        var _this = $(this).closest('form');
        Swal.fire({
            title: 'Tambah Jadwal Ujian',
            text: "Anda yakin akan menyimpan jadwal ini ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
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
                    url:'/data/jadwalujian/save',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
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
                            window.location = '/data/jadwalujian';
                        }
                    }
                 });
            }

      })
    });

    $(document).on('click' , '#ubah-jadwal-ujian' , function(){
        var _this = $(this).closest('form');
        Swal.fire({
            title: 'Ubah Jadwal Ujian',
            text: "Anda yakin akan menyimpan jadwal ini ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
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
                    url:'/data/jadwalujian/update',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
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
                            location.reload();
                        }

                    }
                });
            }

        })
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
            url:'/data/absensimahasiswa/update',
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

    $(document).on('click' , '#hapus-jadwal-ujian' , function(){
        var _this = $(this).closest('form');
        Swal.fire({
            title: 'Hapus Jadwal Ujian',
            text: "Anda yakin akan menghapus jadwal ini ?",
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
                    url:'/data/jadwalujian/delete',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        //console.log(result);
                        var res = JSON.parse(result);
                        if(res.status == 'false'){
                            swal.fire({
                                "title": "",
                                "text": res.message,
                                "type": res.status,
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }else{
                            swal.fire({
                                "title": "",
                                "text": res.message,
                                "type": res.status,
                                "confirmButtonClass": "btn btn-secondary"
                            });
                            window.location = '/data/jadwalujian';
                        }
                    }
                });
            }

        })
    });

    $("#search-button-daftar-jadwal-ujian").on('click', function(e) {
        var tables = $('#daftar_jadwal_ujian').DataTable();

        var jurusan = $('#daftar_jadwal_jurusan').val() != ' ' ? $('#daftar_jadwal_jurusan option:selected').text() :'';
        var angkatan = $('#daftar_jadwal_angkatan').val() != ' ' ? $('#daftar_jadwal_angkatan option:selected').text() :'';
        var semester = $('#daftar_jadwal_semester').val() != ' ' ? $('#daftar_jadwal_semester option:selected').text() :'';
        var kelas = $('#daftar_jadwal_kelas').val() != ' '? $('#daftar_jadwal_kelas option:selected').text() :'';

        tables.column(4).search(jurusan)
            .column(5).search(angkatan)
            .column(6).search(semester)
            .column(7).search(kelas)
            .column(8).search($('#daftar_jadwal_jenis_ujian').val())
            .draw();
    });

    $('#daftar_jadwal_ujian').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/data/jadwalujian/paging_daftar',
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
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah'},
            { data: 'nama_dosen', name: 'nama_dosen' },
            { data: 'program_studi', name: 'program_studi' },
            { data: 'nama_angkatan', name: 'nama_angkatan' },
            { data: 'nama_semester', name: 'nama_semester' },
            { data: 'nama_kelas', name: 'nama_kelas' },
            { data: 'jenis_ujian', name: 'jenis_ujian' },
            { defaultContent : '<td></td>'}
        ],
        columnDefs: [
            {
                targets:8,
                className: "text-center",
                render:function (data, type, full, meta) {
                    return data.toUpperCase();
                }
            },
            {
                targets: 9,
                title: 'Actions',
                orderable: false,
                className: "text-center",
                render: function(data, type, full, meta) {
                    return `<a style="font-size: 20px;" href="jadwalujian/view/`+full.id+`"><i class="la la-edit"></i></a>`;
                },
            },{
                targets: 0,
                className: "text-center"
            }

        ],
    });
});

