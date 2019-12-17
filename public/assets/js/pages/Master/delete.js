$(document).ready(function() {
    $(document).on('click' , '#btn_delete_general' , function(){
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
                Swal.fire({
                    title: "Mohon menunggu",
                    imageUrl: "/assets/media/ajaxloader.gif",
                    html:"Data sedang diproses...",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                var url = $(this).attr("data-url");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf_').val()
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    url:url + "delete",
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status){
                            Swal.fire(
                                'Deleted!',
                                'Data sudah dihapus.',
                                'success'
                            )
                            window.location=url;
                        }
                        else{
                            alert(result.msg);
                        }
                    }
                });

            }
        })
    });
});

