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
                            );
                            window.location='/data/mahasiswa/kebutuhankhusus'
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

});

function editPrestasi(){
    $("#kt_modal_edit_prestasi").modal();
}

