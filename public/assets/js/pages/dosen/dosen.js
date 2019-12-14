$(document).ready(function(){
    $(document).on('click' , '#btn_hapus_dosen' , function(){
        Swal.fire({
            title: 'Hapus Dosen',
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
                    url:'/data/dosen/delete',
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
                            window.location="/data/dosen"
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
            url:'/data/dosen/resetpassword',
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

