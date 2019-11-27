$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('click' , '#btn-search-nilai-matakuliah' , function(){
        $('#nilaidatatable').DataTable().ajax.reload();
    });


    $(document).on('change' , '.search-nilai-matakuliah' , function(){
        if($('#jurusan-mahasiswa').val() == '' || $('#angkatan-mahasiswa').val() == ''){
            return false;
        }
        //alert('a');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            url:'/kelas/listkelas',
            data:{'jurusan':$('#jurusan-mahasiswa').val() , 'angkatan':$('#angkatan-mahasiswa').val()},
            success:function(result) {
                $('#kelas-mahasiswa').html(result);
            }
         });
    });

    $('#nilaidatatable').DataTable({
        "pageLength": 50,responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'inputnilai/paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                var data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                d.filter = data;
                d._token = $('#csrf_').val()
            }
        },
        columns: [
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah'},
            { data: 'nama_angkatan', name: 'nama_angkatan' },
            { data: 'nama_semester', name: 'nama_semester' },
            { data: 'nama_jurusan', name: 'nama_jurusan' },
            { data: 'nama_kelas', name: 'nama_kelas' },
            { data: 'nama_dosen', name: 'nama_dosen' },
           
        ],
        columnDefs: [
            {
                targets: 6,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return `
                    <a class="btn btn-sm" href="inputnilai/edit/`+full.id+`"><i class="la la-edit"></i></a>`;
                },
            },{
                targets: 0,
                className: "text-center"
            }

        ],
    });

    $(document).on('click' , '#save-nilai-perkuliahan' , function(){
         Swal.fire({
            title: 'Simpan Nilai',
            text: "Anda Yakin akan mngubah data ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08976d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
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
                        url:'/dosen/inputnilai/save',
                        data:$(this).closest('form').serialize(),
                        success:function(result) {
                            //console.log(result);
                            var res = JSON.parse(result);
                            if(res.status == 'error'){
                                var text = '';
                                $.each(res.message, function( index, value ) {
                                    //console.log(value);
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

