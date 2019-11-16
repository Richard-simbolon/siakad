$(document).ready(function() {
    $(document).on('click' , '#delete_kalender' , function(){
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
                var url = $(this).attr("data-url");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:'/data/kalenderakademik/delete',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Deleted!',
                                'Data sudah dihapus.',
                                'success'
                            )
                            window.location="/data/kalenderakademik";
                        }
                        else{
                            alert(result.msg);
                        }
                    }
                });

            }
        })
    });

    $(document).on('click' , '#update_kalender' , function(){
        var prev_url = $(this).attr("data-prev-url");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'/data/kalenderakademik/update',
            data:$(this).closest('form').serialize(),
            success:function(data) {
                if(data.status==='success'){
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Data sudah disimpan",
                        type: 'success',
                        confirmButtonColor: '#0abb87',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value){
                            window.location = "/data/kalenderakademik";
                        }
                    });
                }else {
                    var text = '';
                    $.each(data.message, function( index, value ) {
                        text += '<p class="error">'+ value[0]+'</p>';
                    });
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
    });
});