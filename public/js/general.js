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
        //alert($(this).closest('form').attr('action'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'save',
            data:$(this).closest('form').serialize(),
            success:function(data) {
                alert(data)
            }
         });
    });


    $(document).on('click' , '#updatemahasiswa' , function(){
        //alert($(this).closest('form').attr('action'));
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
    });

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


    $(document).on('click' , '.tambah_penugasan' , function(){
        $('#kt_modal_penugasan_data').modal('show')
        
    });

    $(document).on('click' , '.savepenugasan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambahpenugasan',
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

    $(document).on('click' , '.savekepangkatan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambahkepangkatan',
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

    $(document).on('click' , '.savependidikan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_pendidikan',
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

    $(document).on('click' , '.savesertifikasi' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_sertifikasi',
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

    $(document).on('click' , '.savepenelitian' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_penelitian',
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
    $(document).on('click' , '.savefungsional' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/dosen/tambah_r_fungsional',
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
            }
         });
    });
});

