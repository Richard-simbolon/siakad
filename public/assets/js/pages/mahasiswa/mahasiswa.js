$(document).ready(function(){
    $('#prestasimahasiswa').DataTable();
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

    $(document).on('click' , '#save_prestasi' , function(){
        Swal.fire({
           title: 'Tambah Prestasi Mahasiswa',
           text: "Anda Yakin akan menambah data ?",
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
                       url:'/data/mahasiswa/save_prestasi',
                       data:$(this).closest('form').serialize(),
                       success:function(result) {
                            var res = JSON.parse(result);
                            //console.log(res);
                            if(res.status == 'error'){
                                var text = '';
                                $.each(res.message, function( index, value ) {
                                    console.log(value);
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
                            }
                       }
                    });
               }
           
         })
   });
});

