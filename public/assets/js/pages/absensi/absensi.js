$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('click' , '#btn-search-nilai-matakuliah' , function(){
        $('#nilaidatatable').DataTable().ajax.reload();
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

    $('#nilaidatatable').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'nilaimahasiswa/paging',
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
            { data: 'nama_angkatan', name: 'nama_angkatan' },
            { data: 'nama_semester', name: 'nama_semester' },
            { data: 'nama_jurusan', name: 'nama_jurusan' },
            { data: 'nama_kelas', name: 'nama_kelas' },
            { data: 'ruangan', name: 'ruangan' },
            { data: 'nama_dosen', name: 'nama_dosen' },
            { data: 'jumlah', name: 'jumlah' },
        ],
        columnDefs: [
            {
                targets: 10,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return `
                    <span class="dropdown">
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                          <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="absensimahasiswa/view/`+full.id+`"><i class="la la-edit"></i>Lihat Absensi</a>
                            <a class="dropdown-item" href="absensimahasiswa/absensi/`+full.id+`"><i class="la la-plus"></i>Tambah</a>
                        </div>
                    </span>`;
                },
            },{
                targets: 0,
                className: "text-center"
            },{
                targets: 1,
                className: "text-center"
            },{
                targets: 9,
                className: "text-center"
            }

        ],
    });

    $(document).on('click' , '#save-absensi-perkuliahan' , function(){
        Swal.fire({
            title: 'Simpan Data',
            html: "Anda Yakin Meyimpan Data Absensi ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan Sekarang'
        }).then((result) => {
            Swal.fire({
                title: "Menyimpan Data . . .",
                imageUrl: "../assets/media/ajaxloader.gif",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf_').val()
                }
            });
            $.ajax({
                type:'POST',
                url:'/data/absensimahasiswa/save',
                data:$(this).closest('form').serialize(),
                success:function(result) {
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
                        }).then((result) => {
                            if (result.value) {
                                window.location = '/data/absensimahasiswa';
                            }
                        });
                    }

                }
            });
        });
    });


    $(document).on('click' , '#update-absensi-perkuliahan' , function() {
        Swal.fire({
            title: 'Ubah Data',
            html: "Anda Yakin Melakukan Perubahan Data Absensi?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ubah Sekarang'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: "Menyimpan Data . . .",
                    imageUrl: "../assets/media/ajaxloader.gif",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
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
                            }).then((result) => {
                                if (result.value) {
                                    window.location='/data/absensimahasiswa';
                                }
                            });
                        }

                    }
                });
            }
        });
    });

});

