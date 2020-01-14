$(document).ready(function(){

    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('click' , '.general_create' , function(){

    });

    $(document).on('click','.addfield', function(){
        var html = '<div class="form-group m-form__group row"> <div class="col-lg-3"> <input type="text" name="fieldname[]" class="form-control m-input" placeholder="Field Name"> </div><div class="col-lg-2">'+$('#migrationtable').html()+'</div><div class="col-lg-2"> <div class="input-group m-input-group m-input-group--square"> <input type="text" name="length[]" class="form-control m-input" placeholder="Length"> </div></div><div class="col-lg-1"> <input type="checkbox" name="ai[]"> <span class="m-form__help"> AI </span> </div></div>';
        $('.add-field').append('<div class="form-group m-form__group row">'+$('#row-append').html()+'</div>');
    });

    $(document).on('change' ,'.migration_table' , function(){
        var key = $(this).val();
        var index = $(this).index();
        var parent = $(this).parents('.row').find('.mtablemigrate');
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/setting/mtable',
            data:{"_token": $('#csrf_').val(),'table':key},
            success:function(data) {
                var html = '';
                $.each(JSON.parse(data), function( index, value ) {
                    html += '<option>'+value+'</option>';
                });
                parent.html('<select class="form-control m-input m-input--square" name="field[]">'+html+'</select>');
            }
         });
    });

    $(document).on('click' , '.generalsave' , function(){
        var prev_url = $(this).attr("data-prev-url");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        Swal.fire({
            title: "Mohon menunggu",
            imageUrl: "/assets/media/ajaxloader.gif",
            html:"Data sedang diproses...",
            showConfirmButton: false,
            allowOutsideClick: false
        });
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'save',
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
                            window.location = prev_url;
                        }
                    });
                }else {
                    // alert(data.msg);
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


    /*$(document).on('click' , '#updatemahasiswa' , function(){
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
    });*/

    $(document).on('click' , '#actionupdatedosen' , function(){
        //alert($(this).closest('form').attr('action'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/dosen/update',
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
    });

    $(document).on('change' ,'.update_list_matakuliah' ,function(){
        var _id = $(this).val();
        if(_id == ''){
            alert('Silahkan pilih jurusan');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            url:'/kurikulum/carimatakuliah',
            data:{'id':_id},
            success:function(result) {
                $('.append_matakuliah').html(result);
                $('#kurikulum_matakuliah').DataTable();
            
            }
         });

    });

    $(document).on('click' , '.save-kurikulum' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/kurikulum/save',
            data:$(this).closest('form').serialize(),
            success:function(result) {
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
                        "text": res.msg,
                        "type": res.status,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }

            }
         });
    });

    $(document).on('change','.matakuliah-chck' , function(){
        //alert('a');
        var total = 0;
        $('.matakuliah-chck').each(function(){
            if($(this).is(':checked')){
                //alert($(this).attr('attr'));
                total += parseInt($(this).attr('attr'));
            }
        })
        $('#semuasks').text(total);
    });

    $(document).on('change','.wajib-chck' , function(){
        //alert('a');
        var total = 0;
        $('.wajib-chck').each(function(){
            if($(this).is(':checked')){
                //alert($(this).attr('attr'));
                total += parseInt($(this).attr('attr'));
            }
        })
        $('#skswajib').text(total);
    });

    $(document).on('change', '.kurikulum_filter' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            url:'/kurikulum/filtering_table',
            data:{'id_p':$('#jurusan').val() , 'id_t':$('#tahun_berlaku').val()},
            success:function(result) {
                $('.kurikulum_table').html(result);
                $('#kurikulum_matakuliah').DataTable();
            
            }
         });
    });



    $(document).on('click', '.update-kurikulum' , function(){
        var _this = $(this).closest('form');
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
                        url:'/data/kurikulum/update',
                        data: _this.serialize(),
                        success:function(response) {
                            var res = JSON.parse(response);
                            console.log(res);
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
                                    "text": res.msg,
                                    "type": res.status,
                                    "confirmButtonClass": "btn btn-secondary"
                                });
                            }
            
                        }
                    });
                }
            
          })

    });
    //alert('a');
    $('#kurikulum_matakuliah').DataTable({
        "pageLength": 100
    });

    $(document).on('change','.kelas-kurikulum-select', function(){
        var _id = $(this).val();
        if(_id == ''){
            alert('Silahkan pilih jurusan');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            url:'/kelas/listkurikulum',
            data:{'id':_id},
            success:function(result) {
                $('#append_kurikulum').html(result);
            }
         });


    });

    $(document).on('click','#btn-search-kurikulum', function(){
        var error_msg = '';
        $(".search-kurikulum").each(function(){
            //alert($(this).val());
            if($(this).val() == '0'){
                error_msg += '<p>Silahkan pilih '+$(this).attr('id').replace('-', ' ')+'.</p>';
            }
        });
        if(error_msg != ''){
            swal.fire({
                "title": "",
                "html": error_msg,
                "type": "error",
                "confirmButtonClass": "btn btn-secondary"
            });
            return false;
        }

        Swal.fire({
            title: "Mohon menunggu . . .",
            imageUrl: "/../assets/media/ajaxloader.gif",
            showConfirmButton: false,
            allowOutsideClick: false
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });

        //$('#kelasperkuliahan').DataTable();
        $.ajax({
            type:'POST',
            url:'/kelasperkuliahan/listmatakuliah',
            data:{'jurusan':$('#jurusan-mahasiswa').val() , 'angkatan':$('#angkatan-mahasiswa').val(),'kelas':$('#kelas-mahasiswa option:selected').attr('attr')},
            success:function(result) {
                $('#kelasperkuliahan').html('');
                $('#kelasperkuliahan').html(result.html);
                $('#nama-kurikulum').html(result.nama);
                //$('#table-matakuliah').html(result.html);
                $('.kt-select2').select2({
                    width:'100%'
                });
                $('#table-matakuliah').DataTable(
                    {
                        responsive: false,
                        language:{
                            url: '/assets/lang/id.json'
                        },
                    }
                );
                $('.time-picker').timepicker({
                    minuteStep: 1,
                    defaultTime: '10:45',
                    showSeconds: false,
                    showMeridian: false,
                    snapToStep: true
                });
                Swal.close();
            }
         });

        // $("#table-matakuliah").parent().css({"overflow-x" : "auto"})
    });
    

    $(document).on('change' , '.search-kelas-perkuliahan' , function(){
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

    $(document).on('click' , '#save-kelas-perkuliahan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        var _this = $(this).closest('form');
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
                    $.ajax({
                        type:'POST',
                        //dataType:'json',
                        url:url_action,
                        data:$(this).closest('form').serialize(),
                        success:function(result) {
                            var res = JSON.parse(result);
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
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = '/data/kelasperkuliahan';
                                    }
                                });
                            }

                        }
                    });
                }
          })
    });

    $(document).on('click' , '#btn-search-kelas-perkuliahan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        var data = {};
        $('.looping_class').each(function(){
            if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                data[$(this).attr('name')] = $(this).val();
            }
        });
        $.ajax({
            type:'POST',
            url:'/kelasperkuliahan/filtering_kelas_perkuliahan_index',
            data:{'filter':data},
            success:function(result) {
                $('#kelasperkuliahanbody').html(result);
            }
         });

    });

});

