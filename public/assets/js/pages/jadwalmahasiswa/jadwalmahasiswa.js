$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('change' , '#jadwal_perkuliahan' , function(){
        $('#jadwalperkuliahandata').DataTable().ajax.reload();
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
    var hari  = ['-','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
    //alert()
    $('#jadwalperkuliahandata').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url:'jadwalperkuliahan/paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                d.jadwal_perkuliahan = $('#jadwal_perkuliahan').val(),
                d._token = $('#csrf_').val()
            }
        },
        order: [[5, 'asc']],
			drawCallback: function(settings) {
				var api = this.api();
				var rows = api.rows({page: 'current'}).nodes();
				var last = null;
				api.column(5, {page: 'current'}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group"><td colspan="10">' + hari[group] + '</td></tr>',
						);
						last = group;
					}
				});
			},
        columns: [
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'matakuliah_title', name: 'matakuliah_title' },
            { data: 'kelas_title', name: 'kelas_title' },
            { data: 'bobot_mata_kuliah', name: 'bobot_mata_kuliah' },
            { data: 'nama', name: 'nama' },
            { data: 'hari_id', name: 'hari_id', render: function(data, type, full, meta) {
                    return hari[full.hari_id];
                }, 
            },
            { data: 'jam', name: 'jam' },  
        ]
    });
    
    $(document).on('click' , '#save-nilai-perkuliahan' , function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#csrf_').val()
            }
        });
        $.ajax({
            type:'POST',
            //dataType:'json',
            url:'/data/nilaimahasiswa/save',
            data:$(this).closest('form').serialize(),
            success:function(result) {
                console.log(result);
                //var res = JSON.parse(result);
                /*if(res.status == 'error'){
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
                }*/

            }
         });
    });

});

