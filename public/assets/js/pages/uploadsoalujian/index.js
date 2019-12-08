$(document).ready(function() {
    $('#form_upload_soal').on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            url:"/dosen/uploadsoal/save",
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success:function(result)
            {
                var res = JSON.parse(result);
                if(res.status == 'false'){
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
                        "title": "Berhasil",
                        "text": "Soal Ujian berhasil di upload",
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    window.location ="/dosen/uploadsoal";
                }
            }
        })
    });

    $('#form_upload_soal_update').on('submit', function(event){
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            url:"/dosen/uploadsoal/update",
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success:function(result)
            {
                var res = JSON.parse(result);
                if(res.status == 'false'){
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
                        "title": "Berhasil",
                        "text": "Soal Ujian berhasil di upload",
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    window.location ="/dosen/uploadsoal"
                }
            }
        })
    });

    $(document).on('click' , '#btn_hapus_data' , function(){
        event.preventDefault();
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin hapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    dataType:'json',
                    url:"/dosen/uploadsoal/delete",
                    method:"POST",
                    data:$(this).closest('form').serialize(),
                    success:function(res)
                    {
                        //var res = JSON.parse(result);
                        if(res.status == 'false'){
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
                                "title": "Berhasil",
                                "text": "Soal ujian sudah dihapus",
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                            window.location ="/dosen/uploadsoal"
                        }
                    }
                })
            }
        })
    });

    $('#search-button-soal').on('click', function(e) {
        var tables = $('#daftarsoalujian').DataTable();

        var jurusan = $('#jurusan-mahasiswa').val() != ' ' ? $('#jurusan-mahasiswa option:selected').text() :'';
        var angkatan = $('#angkatan-mahasiswa').val() != ' ' ? $('#angkatan-mahasiswa option:selected').text() :'';
        var semester = $('#semester-ujian').val() != ' ' ? $('#semester-ujian option:selected').text() :'';
        var kelas = $('#kelas-mahasiswa').val() != ' '? $('#kelas-mahasiswa option:selected').text() :'';

        tables.column(3).search(jurusan)
            .column(4).search(angkatan)
            .column(5).search(semester)
            .column(6).search(kelas)
            .column(7).search($('#jenis_ujian').val())
            .draw();
    });

    $('#search-button-soal-admin').on('click', function(e) {
        var tables = $('#daftarsoalujian_admin').DataTable();


        var jurusan = $('#jurusan-mahasiswa-admin').val() != ' ' ? $('#jurusan-mahasiswa-admin option:selected').text() :'';
        var angkatan = $('#angkatan-mahasiswa-admin').val() != ' ' ? $('#angkatan-mahasiswa-admin option:selected').text() :'';
        var semester = $('#semester-ujian-admin').val() != ' ' ? $('#semester-ujian-admin option:selected').text() :'';
        var kelas = $('#kelas-mahasiswa-admin').val() != ' '? $('#kelas-mahasiswa-admin option:selected').text() :'';

        console.log(jurusan);
        tables.column(4).search(jurusan)
            .column(5).search(angkatan)
            .column(6).search(semester)
            .column(7).search(kelas)
            .column(8).search($('#jenis_ujian-admin').val())
            .draw();
    });
    
    $('#daftarsoalujian').DataTable({
        pageLength: 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/uploadsoal/paging',
            type:"POST",
            data: function ( d ) {
                d.id = $('#id_mahasiswa').val();
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah' },
            { data: 'jurusan', name: 'jurusan' },
            { data: 'angkatan', name: 'angkatan' },
            { data: 'semester', name: 'semester' },
            { data: 'kelas', name: 'kelas' },
            { data: 'jenis_ujian', name: 'jenis_ujian' },
            { data: 'nama_file', name: 'nama_file' },
            { defaultContent : '<td></td>'}
        ],
        columnDefs: [
            {
                targets: 9,
                title: 'Actions',
                orderable: false,
                className: "text-center",
                render: function(data, type, full, meta) {
                    return `
                       <a style="color: #607D8B;font-size: 14pt;" target="_blank" href="/assets/images/soalujian/`+full.id+"/"+full.nama_file+`"><i class="la la-download"></i></a>
                       <a style="color: #607D8B;font-size: 14pt;" href="/dosen/uploadsoal/edit/`+full.id+`"><i class="la la-edit"></i></a>
                       `;
                },
            },
            {
                targets: 0,
                className: "text-center"
            }

        ],
    });

    $('#daftarsoalujian_admin').DataTable({
        pageLength: 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'/dosen/paging_soal',
            type:"POST",
            data: function ( d ) {
                d.id = $('#id_mahasiswa').val();
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah' },
            { data: 'nama', name: 'nama' },
            { data: 'jurusan', name: 'jurusan' },
            { data: 'angkatan', name: 'angkatan' },
            { data: 'semester', name: 'semester' },
            { data: 'kelas', name: 'kelas' },
            { data: 'jenis_ujian', name: 'jenis_ujian' },
            { defaultContent : '<td></td>'}
        ],
        columnDefs: [
            {
                targets: 9,
                title: 'Actions',
                orderable: false,
                className: "text-center",
                render: function(data, type, full, meta) {
                    return `
                       <a style="color: #607D8B;font-size: 14pt;" target="_blank" href="/assets/images/soalujian/`+full.id+"/"+full.nama_file+`"><i class="la la-download"></i></a>
                       `;
                },
            },
            {
                targets: 0,
                className: "text-center"
            }

        ],
    });

});