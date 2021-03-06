$(document).ready(function() {
    $(document).on('click' , '#btn_ganti_password' , function(){
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin mengubah password?",
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
                    url:'/data/mahasiswa/submit_gantipassword',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Password sudah diubah.',
                                'success'
                            )
                            document.getElementById('logout-form').submit();
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

    $(document).on('click' , '#btn_edit_prestasi' , function(){
        Swal.fire({
            title: 'Hapus',
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
                    url:'/data/mahasiswa/edit_prestasi',
                    data:$("#form_prestasi_edit").serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Password sudah diubah.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
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

    $(document).on('click' , '#btn_hapus_prestasi' , function(){
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin hapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus sekarang!'
        }).then((result) => {
            if (result.value) {
                var id = $("#id_prestasi").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'GET',
                    dataType:'json',
                    url:'/data/mahasiswa/delete_prestasi/'+id,
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah dihapus.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
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

    $(document).on('click' , '#btn_add_prestasi' , function(){
        $("#kt_modal_prestasi").modal();
    });

    $(document).on('click' , '#btn_simpan_prestasi' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'/data/mahasiswa/submitprestasi',
            data:$('#form_prestasi').serialize(),
            success:function(result) {
                if(result.status){
                    Swal.fire(
                        'Berhasil!',
                        'Prestasi sudah ditambah.',
                        'success'
                    )
                    window.location="/data/mahasiswa/prestasi"
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
    });

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
                    url:'/data/mahasiswa/submitprofile',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/mahasiswa/profile'
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

    $(document).on('click', "#btn_edit_alamat", function () {
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
                    url:'/data/mahasiswa/submitalamat',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/mahasiswa/alamat'
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

    $(document).on('click', "#btn_edit_orangtua", function () {
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
                    url:'/data/mahasiswa/submitorangtua',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/mahasiswa/orangtua'
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

    $(document).on('click', "#btn_edit_wali", function () {
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
                    url:'/data/mahasiswa/submitwali',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            );
                            window.location='/data/mahasiswa/wali'
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
                    url:'/data/mahasiswa/submitkebutuhankhusus',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Berhasil!',
                                'Data sudah diubah.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location='/data/mahasiswa/kebutuhankhusus'
                                }
                            });
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
            url:'/data/mahasiswa/upload_profile',
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

function editPrestasi(id){
    $.ajax({
        url:'/data/mahasiswa/get_prestasi/'+id,
        data: {base64:$('#profile_mhs').val()},
        type:"GET",
        error:function(err){
            console.error(err);
        },
        success:function(result){
            var res = JSON.parse(result);
            if(res.status){
                console.log(res.data);
                $("#id_prestasi").val(id);
                $("#jenis_prestasi").val(res.data['jenis_prestasi']);
                $("#tingkat_prestasi").val(res.data['tingkat_prestasi']);
                $("#penyelenggara").val(res.data['penyelenggara']);
                $("#nama_prestasi").html(res.data['nama_prestasi']);
                $("#peringkat").val(res.data['peringkat']);
                $("#tahun").val(res.data['tahun']);
            }else{
                swal.fire({
                    "title": "",
                    "text": res.message,
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
                location.reload();
            }
        },
        complete:function(){
            console.log("Request finished.");
        }
    });
    $("#kt_modal_edit_prestasi").modal();
}

