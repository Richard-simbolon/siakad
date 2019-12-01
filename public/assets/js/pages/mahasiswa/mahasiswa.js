$(document).ready(function(){
    $('#prestasimahasiswa').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'/mahasiswa/paging_prestasi',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                d.id = $('#id_mahasiswa').val();
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'jenis_prestasi', name: 'jenis_prestasi'},
            { data: 'tahun', name: 'tahun' },
            { data: 'tingkat_prestasi', name: 'tingkat_prestasi' },
            { data: 'penyelenggara', name: 'penyelenggara' },
            { data: 'nama_prestasi', name: 'nama_prestasi' },
            { data: 'peringkat', name: 'peringkat' },
        ],
        columnDefs: [
            {
                targets: 6,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return `
                    <span class="dropdown">
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                          <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="mahasiswa/prestasi_lihat/`+full.id+`"><i class="la la-edit"></i>Lihat</a>
                            <a class="dropdown-item" href="mahasiswa/prestasi_edit/`+full.id+`"><i class="flaticon-eye"></i></i>Edit</a>
                            <a class="dropdown-item" href="mahasiswa/prestasi_hapus/`+full.id+`"><i class="flaticon2-rubbish-bin-delete-button"></i></i>Hapus</a>
                        </div>
                    </span>`;
                },
            },{
                targets: 0,
                className: "text-center"
            }

        ],
    });

    $(document).on('change' , '#search-khs' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            url:'/mahasiswa/khs_load',
            data:{id:$(this).val()},
            success:function(result) {
                var res = JSON.parse(result);
                $('#body-khs').html(res.html)
            }
         });
    });
    $(document).on('click' , '#updatemahasiswa' , function(){
         Swal.fire({
            title: 'Update data',
            text: "Anda Yakin akan mngubah data ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update'
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
                        url:'/data/mahasiswa/update',
                        data:$(this).closest('form').serialize(),
                        success:function(result) {
                            var res = JSON.parse(result);
                            if(res.status == 'false'){
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
                                    "title": "Berhasil",
                                    "text": "Data sudah diubah",
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

    $(document).on('click' , '.generate_password' , function(){
        var email = $(this).attr('attr');
        Swal.fire({
           title: 'Kata Sandi',
           text: "Password akan dikirim ke email pengguna ?",
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#08976d',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Kirim'
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
                       url:'/g_password/generate_key',
                       data:{email:email , type:'mahasiswa'},
                       success:function(result) {
                           console.log(result);
                           var res = JSON.parse(result);
                           swal.fire({
                               "title": "",
                               "text": res.msg,
                               "type": res.status,
                               "confirmButtonClass": "btn btn-secondary"
                           });
                       }
                    });
               }
           
         })
   });

    $(document).on('click' , '#save_prestasi' , function(){
        Swal.fire({
           title: 'Tambah Prestasi Mahasiswa',
           text: "Anda Yakin akan menambah data ?",
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#08976d',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Tambah'
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
                       url:'/data/mahasiswa/save_prestasi',
                       data:$(this).closest('form').serialize(),
                       success:function(result) {
                            var res = JSON.parse(result);
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
                                location.reload();
                            }
                       }
                    });
               }
           
         })
   });

    $(document).on('click' , '#btn_hapus_mahasiswa' , function(){
        Swal.fire({
            title: 'Hapus Mahasiswa',
            text: "Anda Yakin akan menghapus data ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#08976d',
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
                    url:'/data/mahasiswa/delete',
                    data:{"id":$("#id_to_delete").val()},
                    success:function(result) {
                        var res = JSON.parse(result);
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
                            window.location="/data/mahasiswa"
                        }
                    }
                });
            }

        })
    });

    $(document).on('click' , '#btn_reset_password' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/mahasiswa/resetpassword',
            data:{"id":$("#id_to_delete").val()},
            success:function(result) {
                var res = JSON.parse(result);
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
                    $("#txt_new_password").val(res.message);
                }
            }
        });
    });

});

