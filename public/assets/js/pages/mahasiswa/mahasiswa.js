$(document).ready(function(){

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
});

