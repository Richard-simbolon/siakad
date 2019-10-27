$(document).ready(function(){

    $('.kt-select2').select2({
        placeholder: " Pilih ",
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

    
});

