$(document).ready(function() {
    $(document).on('click' , '#btn_cari' , function() {
        get_mahasiswa();
    });

    $(document).on('click' , '#hapus_aktivitas_perkuliahan' , function() {
        Swal.fire({
            title: 'Simpan Data',
            html: "Anda Yakin Menghapus Data Ini ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Sekarang'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: "Menghapus Data . . .",
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
                    url:'/data/aktivitasperkuliahan/delete',
                    dataType:'json',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {

                        console.log(result);

                        if(result.status == 'error'){
                            Swal.fire({
                                title: 'Hapus Data',
                                text: result.msg,
                                type: 'error'
                            })
                        }else{
                            Swal.fire({
                                title: 'Hapus Data',
                                text: "Data berhasil di hapus",
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    window.location= '/data/aktivitasperkuliahan';
                                }
                            });
                        }
                    }
                });
            }
        })
    });

    $(document).on('click' , '#ubah_aktivitas_perkuliahan' , function() {
        Swal.fire({
            title: 'Ubah Data',
            html: "Anda Yakin Mengubah Data Ini ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ubah Sekarang'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: "Mengubah Data . . .",
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
                    url:'/data/aktivitasperkuliahan/update',
                    dataType:'json',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {

                        console.log(result);

                        if(result.status == 'error'){
                            Swal.fire({
                                title: 'Ubah Data',
                                text: result.msg,
                                type: 'error'
                            })
                        }else{
                            Swal.fire({
                                title: 'Ubah Data',
                                text: "Data berhasil diubah",
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    window.location= '/data/aktivitasperkuliahan';
                                }
                            });
                        }
                    }
                });
            }
        })
    });

    $(document).on('click' , '#save_aktivitas_perkuliahan' , function() {
        Swal.fire({
            title: 'Simpan Data',
            html: "Anda Yakin Menyimpan Data Ini ?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan Sekarang'
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
                    url:'/data/aktivitasperkuliahan/save',
                    dataType:'json',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {

                        console.log(result);

                        if(result.status == 'error'){
                            Swal.fire({
                                title: 'Simpan Data',
                                text: result.msg,
                                type: 'error'
                            })
                        }else{
                            Swal.fire({
                                title: 'Simpan Data',
                                text: "Data berhasil di simpan",
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                   window.location= '/data/aktivitasperkuliahan';
                                }
                            });
                        }
                    }
                });
            }
        })
    })
});

function check_ipk(ipk) {
    if(ipk.val() >  4){
        ipk.val(0);
    }
}

function get_mahasiswa(){
    var nim = $("#nim").val();
    if (nim != '') {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: "/data/tugasakhir/get/" + nim,
            success: function (result) {
                if (result.status) {
                    $("#nama").val(result.data['nama']);
                    $("#jurusan").val(result.data['jurusan']);
                    $("#mahasiswa_id").val(result.data['id']);
                } else {
                    Swal.fire(
                        'Not Found!',
                        'Data tidak ditemukan.',
                        'warning'
                    )
                }
            }
        });
    }
}
