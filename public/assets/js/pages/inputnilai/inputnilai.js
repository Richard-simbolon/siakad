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
            url:'nilaimahasiswa/paging',
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
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah'},
            { data: 'nama_angkatan', name: 'nama_angkatan' },
            { data: 'nama_semester', name: 'nama_semester' },
            { data: 'nama_jurusan', name: 'nama_jurusan' },
            { data: 'nama_kelas', name: 'nama_kelas' },
            { data: 'nama_dosen', name: 'nama_dosen' },
           
        ],
        columnDefs: [
            {
                targets: 7,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return `<a class="btn" href="nilaimahasiswa/edit/`+full.id+`"><i class="la la-edit"></i> Isi Nilai</a>`;
                },
            },{
                targets: 0,
                className: "text-center"
            }

        ],
    });

    $(document).on('click' , '#save-nilai-perkuliahan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        Swal.fire({
            title: 'Simpan Nilai',
            text: "Apakah anda yakin menyimpan data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0abb87',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:'POST',
                    //dataType:'json',
                    url:'/data/nilaimahasiswa/save',
                    data:$(this).closest('form').serialize(),
                    success:function(result) {
                        //console.log(result);
                        var res = JSON.parse(result);
                        if(res.status == 'error'){
                            var text = '';
                            $.each(res.message, function( index, value ) {
                               // console.log(value);
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
        });
    });


    $(document).on('change' , '.nilai_realtime' , function(){
        var this_ = $(this).attr('attr');
        var tipe = $(this).attr('char');

        var nuts = $('.n_nilai_uts_'+this_).val() > 0 ? $('.n_nilai_uts_'+this_).val() : 0;
        var nuas = $('.n_nilai_uas_'+this_).val() > 0 ? $('.n_nilai_uas_'+this_).val() : 0;
        var ntgs = $('.n_nilai_tugas_'+this_).val() > 0 ? $('.n_nilai_tugas_'+this_).val() : 0;
        var nlapopkl = $('.n_nilai_laporan_pkl_'+this_).val() > 0 ? $('.n_nilai_laporan_pkl_'+this_).val() : 0;
        var nlapo = $('.n_nilai_laporan_'+this_).val() > 0 ? $('.n_nilai_laporan_'+this_).val() : 0;
        var nujian = $('.n_nilai_ujian_'+this_).val() > 0 ? $('.n_nilai_ujian_'+this_).val() : 0;
        //console.log(nuts+'-'+nuas+'-'+ntgs+'-'+nlapopkl+'-'+nlapo+'-'+nujian);
        var nangka = 0;
        var nhuruf = 'E';
        if(tipe == 'praktek'){
            nangka = ( ((parseInt(ntgs) * 20) / 100) + ((parseInt(nuts) * 40) / 100) + ((parseInt(nuas) * 40)/100));
        }else if (tipe == 'teori') {
            nangka = ( ((parseInt(ntgs) * 40) / 100) + ((parseInt(nuts) * 40) / 100) + ((parseInt(nuas) * 20)/100));
        }else if (tipe == 'seminar') {
            nangka = ( ((parseInt(ntgs) * 40) / 100) + ((parseInt(nuts) * 30) / 100) + ((parseInt(nuas) * 30)/100));
        }else if (tipe == 'pkl') {
            nangka = ( ((parseInt(ntgs) * 20) / 100) + ((parseInt(nuts) * 20) / 100) + ((parseInt(nuas) * 40)/100) + ((parseInt(nlapopkl) * 20) / 100));
        }else if (tipe == 'skripsi') {
            nangka = ( ((parseInt(ntgs) * 30) / 100) + ((parseInt(nuts) * 20) / 100) + ((parseInt(nuas) * 10)/100) + ((parseInt(nlapopkl) * 10) / 100) + ((parseInt(nujian) * 20) / 100) + ((parseInt(nlapo) * 10) / 100));
        }

        //console.log(nangka);
        if(nangka < 45){
            nhuruf = 'E';
        }else if(nangka > 44 && nangka<= 59){
            nhuruf = 'D';
        }else if(nangka > 59 && nangka<= 69){
            nhuruf = 'C';
        }else if(nangka > 69 && nangka<= 79){
            nhuruf = 'B';
        }else if(nangka > 79 && nangka<= 100){
            nhuruf = 'A';
        }else{
            nhuruf = 'E';
        }

        $('.n_angka_'+this_).html((Math.round(nangka * 100) / 100).toFixed(2));
        $('.n_huruf_'+this_).html(nhuruf);
    });

});

