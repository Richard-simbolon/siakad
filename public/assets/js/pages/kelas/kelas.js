$(document).ready(function() {
    $(document).on('click' , '#btn_delete_kelas' , function(){
        var r = confirm("Apakah anda yakin hapus data ini?");
        if (r == true) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('#csrf_').val()
                }
            });
            $.ajax({
                type:'POST',
                dataType:'json',
                url:'/master/kelas/delete',
                data:$(this).closest('form').serialize(),
                success:function(result) {
                    if(result.status){
                        alert('Data Sudah di Hapus.');
                        window.location="/master/kelas";
                    }
                    else{
                        alert(result.msg);
                    }
                }
            });
        }
    });
});

