$(document).ready(function() {
    
    $('#administrator').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'/module/administrator/paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                d.id = $('#id_mahasiswa').val();
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'nama', name: 'nama'},
            { data: 'nip', name: 'nip' },
            { data: 'email', name: 'email' },
            { data: 'username', name: 'username' },
            { data: 'telp', name: 'telp' },
            { data: 'status', name: 'status' }
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
                            <a class="dropdown-item" href="/module/administrator/view/`+full.id+`"><i class="la la-edit"></i>Lihat</a>
                            <a class="dropdown-item delete_user" attr="`+full.id+`" href="javascript::void(0)" ><i class="flaticon2-rubbish-bin-delete-button"></i></i>Hapus</a>
                        </div>
                    </span>`;
                },
            },{
                targets: 0,
                className: "text-center"
            }

        ],
    });


    $(document).on('click' , '.saveadminuser' , function(){
        Swal.fire({
            title: 'Simpan',
            text: "Apakah anda yakin menyimpan data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
        }).then((result) => {
            if (result.value) {
                var url = $(this).attr("data-url");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'/module/administrator/save',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        //console.log(result.status);
                        if(result.status == 'success'){
                            Swal.fire(
                                'Berhasil!',
                                'Data telah disimpan.',
                                'success'
                            )
                        }
                        else{
                            var text = '';
                            $.each(result.message, function( index, value ) {
                                text += '<p class="error">'+ value[0]+'</p>';
                            });
                            swal.fire({
                                "title": "",
                                "html": text,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }
                    }
                });

            }
        })
    });



    $(document).on('click' , '.updateadminuser' , function(){
        Swal.fire({
            title: 'Simpan',
            text: "Apakah anda yakin menyimpan data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
        }).then((result) => {
            if (result.value) {
                var url = $(this).attr("data-url");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'/module/administrator/update',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        //console.log(result.status);
                        if(result.status == 'success'){
                            Swal.fire(
                                'Berhasil!',
                                'Data telah disimpan.',
                                'success'
                            )
                        }
                        else{
                            var text = '';
                            $.each(result.message, function( index, value ) {
                                text += '<p class="error">'+ value[0]+'</p>';
                            });
                            swal.fire({
                                "title": "",
                                "html": text,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }
                    }
                });

            }
        })
    });

    $(document).on('click' , '.delete_user' , function(){
        var id = $(this).attr('attr');
        Swal.fire({
            title: 'Hapus',
            text: "Anda yakin mau menghapus user ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#0abb87',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                var url = $(this).attr("data-url");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'/module/administrator/delete',
                    data:{id:id},
                    success:function(result) {
                        //console.log(result.status);
                        if(result.status == 'success'){
                            Swal.fire(
                                'Berhasil!',
                                'User telah dihapus.',
                                'success'
                            )
                        }
                        else{
                            swal.fire({
                                "title": "",
                                "html": result.message,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }
                    }
                });

            }
        })
    });
    

});

