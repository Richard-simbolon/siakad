$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('change' , '#search-semester' , function(){
        $('#jadwalperkuliahandata').DataTable().ajax.reload();
    });

    $(document).on('click' , '#search-jadwal-kuliah' , function(){
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

    $('#jadwalperkuliahandata').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'jadwalkuliah/paging',
            type:"POST",
            //data:{"_token": $('#csrf_').val(),'table':key},
            data: function ( d ) {
                data = {};
                $('.looping_class_input').each(function(){
                    if($(this).val() != '' || $(this).val() != null || $(this).val() != undefined || $(this).val() != '0' ){
                        data[$(this).attr('name')] = $(this).val();
                    }
                });
                //console.log(data);
                d.filter = data;
                d.jadwal_perkuliahan = $('#jadwal_perkuliahan').val(),
                d._token = $('#csrf_').val()
            }
        },
        order: [[6, 'asc']],
			drawCallback: function(settings) {
				var api = this.api();
				var rows = api.rows({page: 'current'}).nodes();
				var last = null;
				api.column(6, {page: 'current'}).data().each(function(group, i) {
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
            { data: 'program_studi_title', name: 'program_studi_title' },
            { data: 'bobot_mata_kuliah', name: 'bobot_mata_kuliah' },
            { data: 'nama', name: 'nama' },
            { data: 'hari_id', name: 'hari_id', render: function(data, type, full, meta) {
                    return hari[full.hari_id];
                }, 
            },
            { data: 'jam', name: 'jam' , render: function(data, type, full, meta) {
                    var t = full.jam.split(":");
                    return t[0] + ":" + t[1];
                },
            },
            { data: 'selesai', name: 'selesai', render: function(data, type, full, meta) {
                    var t = full.selesai.split(":");
                    return t[0] + ":" + t[1];
                },
            },
            { data: 'ruangan', name: 'ruangan' },
        ],
        columnDefs: [
            {
                targets: 4,
                className: "text-center"
            },
            {
                targets: 7,
                className: "text-center"
            },
            {
                targets: 8,
                className: "text-center"
            }
        ]
    });
    

});

