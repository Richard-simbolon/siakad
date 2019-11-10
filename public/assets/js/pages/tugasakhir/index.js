$(document).ready(function() {
    $(document).on('click' , '#btn_cari' , function(){
        var nim = $("#nim").val();
        if(nim != ''){
            $.ajax({
                type:'GET',
                dataType:'json',
                url:"/data/tugasakhir/get/"+nim,
                success:function(result) {
                    if(result.status){
                        $("#nama").val(result.data['nama']);
                        $("#jurusan").val(result.data['jurusan']);
                        $("#mahasiswa_id").val(result.data['id']);
                    }
                    else{
                        Swal.fire(
                            'Not Found!',
                            'Data tidak ditemukan.',
                            'warning'
                        )
                    }
                }
            });
        }
    });

    $(document).on('click' , '#update_tugas_akhir' , function(){
        var prev_url = $(this).attr("data-prev-url");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'/data/tugasakhir/update',
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

    $(document).on('click' , '#delete_tugas_akhir' , function(){
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
                    url: "/data/tugasakhir/delete",
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        if(result.status==='success'){
                            Swal.fire(
                                'Deleted!',
                                'Data sudah dihapus.',
                                'success'
                            )
                            window.location="/data/tugasakhir";
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

function addrow() {
    var size = jQuery('table >tbody >tr').length + 1;
    var markup = "<tr id=\"rec-"+size+"\">\n" +
        "                                                    <td>\n" +
        "                                                        <select name=\"detail["+size+"\][dosen]\" class=\"form-control form-control-sm kt-select2 kt-select2-dosen\">\n" +
        "                                                            <option></option>\n" +
        "                                                        </select>\n" +
        "                                                    </td>\n" +
        "                                                    <td>\n" +
        "                                                        <input type=\"hidden\" name=\"detail["+size+"\][row_status_detail]\" value=\"active\">\n" +
        "                                                        <input type=\"hidden\" name=\"detail["+size+"\][detail_id]\" value=\"0\">\n" +
        "                                                        <select name=\"detail["+size+"][status_dosen]\" class=\"form-control form-control-sm kt-select2 kt-select2-dosen-status\">\n" +
        "                                                            <option value=\"\"></option>\n" +
        "                                                            <option value=\"Pembimbing 1\">Pembimbing 1</option>\n" +
        "                                                            <option value=\"Pembimbing 2\">Pembimbing 2</option>\n" +
        "                                                            <option value=\"Pembimbing 3\">Pembimbing 3</option>\n" +
        "                                                            <option value=\"Pembimbing 4\">Pembimbing 4</option>\n" +
        "                                                            <option value=\"Penguji 1\">Penguji 1</option>\n" +
        "                                                            <option value=\"Penguji 2\">Penguji 2</option>\n" +
        "                                                            <option value=\"Penguji 3\">Penguji 3</option>\n" +
        "                                                            <option value=\"Penguji 4\">Penguji 4</option>\n" +
        "                                                        </select>\n" +
        "                                                    </td>\n" +
        "                                                    <td width=\"150px\" align=\"center\" style=\"vertical-align: middle\">\n" +
        "                                                        <a href=\"javascript:void(0)\" onclick=\"addrow()\"><i class=\"la la-plus\" style=\"font-size: 16px;\"></i> </a> &nbsp;\n" +
        "                                                        <a href=\"javascript:void(0)\" onclick=\"deleterow("+size+")\"><i class=\"la la-trash\" style=\"font-size: 16px;\"></i> </a>\n" +
        "                                                    </td>\n" +
        "                                                </tr>";

    $("table tbody").append(markup);

    var newSelect = $("#rec-"+size).find('.kt-select2-dosen');
    initializeSelect2(newSelect);

    var newSelect = $("#rec-"+size).find('.kt-select2-dosen-status');
    initializeSelect3(newSelect);
}

function deleterow(id) {
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
            jQuery('#rec-' + id).remove();
        }
    })
}

function deleterow_exist(id) {
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
            $("#row_status_"+id).val("deleted");
            jQuery('#' + id).css("display", "none");
        }
    })
}

function initializeSelect2(selectElementObj) {
    selectElementObj.select2({
        width: "100%",
        placeholder: " Pilih ",
        ajax: {
            url: "/data/dosen/getdosen_select2",
            dataType: "json",
            type:"GET",
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id:item.value,
                            text:item.text
                        }
                    })
                };
            },
            cache: true
        }
    });
};

function initializeSelect3(selectElementObj) {
    selectElementObj.select2({
        width: "100%",
        placeholder: " Pilih "
    });
};