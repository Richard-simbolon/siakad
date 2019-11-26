$(document).ready(function() {
    $(document).on('click', "#btn_edit_profile", function () {
        Swal.fire({
            title: 'Ubah Data',
            text: "Apakah anda yakin mengubah data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah sekarang!'
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
                    url:'/data/dosen/submitprofile',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/dosen/profile'
                        }
                        else{
                            var text = result.message;
                            Swal.fire({
                                title: 'Gagal',
                                html: text,
                                type: 'error',
                                confirmButtonColor: '#0abb87',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', "#btn_edit_biodata", function () {
        Swal.fire({
            title: 'Ubah Data',
            text: "Apakah anda yakin mengubah data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah sekarang!'
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
                    url:'/data/dosen/submitbiodata',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/dosen/biodata'
                        }
                        else{
                            var text = result.message;
                            Swal.fire({
                                title: 'Gagal',
                                html: text,
                                type: 'error',
                                confirmButtonColor: '#0abb87',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', "#btn_edit_keluarga", function () {
        Swal.fire({
            title: 'Ubah Data',
            text: "Apakah anda yakin mengubah data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah sekarang!'
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
                    url:'/data/dosen/submitkeluarga',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/dosen/keluarga'
                        }
                        else{
                            var text = result.message;
                            Swal.fire({
                                title: 'Gagal',
                                html: text,
                                type: 'error',
                                confirmButtonColor: '#0abb87',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', "#btn_edit_kebutuhan_khusus", function () {
        Swal.fire({
            title: 'Ubah Data',
            text: "Apakah anda yakin mengubah data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah sekarang!'
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
                    url:'/data/dosen/submitkebutuhankhusus',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/dosen/kebutuhankhusus'
                        }
                        else{
                            var text = result.message;
                            Swal.fire({
                                title: 'Gagal',
                                html: text,
                                type: 'error',
                                confirmButtonColor: '#0abb87',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', "#btn_ganti_password", function () {
        Swal.fire({
            title: 'Ubah Data',
            text: "Apakah anda yakin mengubah data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah sekarang!'
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
                    url:'/data/dosen/submit_gantipassword',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            document.getElementById('logout-form').submit();
                            //window.location.reload();
                        }
                        else{
                            var text = result.message;
                            Swal.fire({
                                title: 'Gagal',
                                html: text,
                                type: 'error',
                                confirmButtonColor: '#0abb87',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            }
        })
    });

    $(document).on('click' , '#button_upload' , function(){
        //alert('asdas');
        /*var ImageURL = $('#profile_mhs').val();
        var block = ImageURL.split(";");
        var contentType = block[0].split(":")[1];
        var realData = block[1].split(",")[1];
        var blob = b64toBlob(realData, contentType);
        var formDataToUpload = new FormData(form);
        formDataToUpload.append("image", blob);*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            url:'/data/dosen/upload_profile',
            data: {base64:$('#profile_mhs').val()},
            type:"POST",
            error:function(err){
                console.error(err);
            },
            success:function(result){
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
                        "text": res.message,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    location.reload();
                }
            },
            complete:function(){
                console.log("Request finished.");
            }
        });
    });
});