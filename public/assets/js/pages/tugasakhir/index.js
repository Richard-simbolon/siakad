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
});

function addrow() {
    var size = jQuery('table >tbody >tr').length + 1;
    var markup = "<tr id=\"rec-"+size+"\">\n" +
        "                                                    <td>\n" +
        "                                                        <select class=\"form-control form-control-sm kt-select2 kt-select2-dosen\">\n" +
        "                                                            <option></option>\n" +
        "                                                        </select>\n" +
        "                                                    </td>\n" +
        "                                                    <td>\n" +
        "                                                        <select class=\"form-control form-control-sm kt-select2 kt-select2-dosen-status\">\n" +
        "                                                            <option>Pembimbing 1</option>\n" +
        "                                                            <option>Pembimbing 2</option>\n" +
        "                                                            <option>Pembimbing 3</option>\n" +
        "                                                            <option>Pembimbing 4</option>\n" +
        "                                                            <option>Penguji 1</option>\n" +
        "                                                            <option>Penguji 2</option>\n" +
        "                                                            <option>Penguji 3</option>\n" +
        "                                                        </select>\n" +
        "                                                    </td>\n" +
        "                                                    <td width=\"150px\" align=\"center\" style=\"vertical-align: middle\">\n" +
        "                                                        <a href=\"javascript:void(0)\" onclick=\"addrow()\"><i class=\"la la-plus\" style=\"font-size: 16px;\"></i> </a> &nbsp;\n" +
        "                                                        <a href=\"javascript:void(0)\" onclick=\"deleterow("+size+")\"><i class=\"la la-trash\" style=\"font-size: 16px;\"></i> </a>\n" +
        "                                                    </td>\n" +
        "                                                </tr>";
    //$("table tbody").append('<tr>' + $("#rec-0").html() + '</tr>');
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