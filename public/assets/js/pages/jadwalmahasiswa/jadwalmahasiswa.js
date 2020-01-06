$(document).ready(function() {
    
    $('.kt-select2').select2({
        placeholder: " Pilih ",
        width: '100%'
    });

    $(document).on('change' , '#jadwal_perkuliahan' , function(){
        $('#jadwalperkuliahandata').DataTable().ajax.reload();
    });

    $(document).on('change' , '#jadwal_ujian' , function(){
        $('#jadwalujiandata').DataTable().ajax.reload();
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
    var hari  = ['-','SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU','MINGGU'];
    //alert()
    $('#jadwalperkuliahandata').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'jadwalperkuliahan/paging',
            type:"POST",
            data: function ( d ) {
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
            { data: 'bobot_mata_kuliah', name: 'bobot_mata_kuliah' },
            { data: 'nama', name: 'nama' },
            { data: 'asisten', name: 'asisten' },
            { data: 'kelas_title', name: 'kelas_title' },
            { data: 'hari_id', name: 'hari_id', render: function(data, type, full, meta) {
                    return hari[full.hari_id];
                }, 
            },
            { data: 'jam', name: 'jam' }, 
            { data: 'selesai', name: 'selesai' },
            { data: 'ruangan', name: 'ruangan' },
        ],
        columnDefs: [
            {
                targets: 2,
                className: "text-center"
            },
            {
                targets: 7,
                className: "text-center",
                render : function (data, type, full, meta) {
                    var t = full.jam.split(":");
                    return t[0] + ":" + t[1];
                }
            },
            {
                targets: 8,
                className: "text-center",
                render : function (data, type, full, meta) {
                    var t = full.selesai.split(":");
                    return t[0] + ":" + t[1];
                }
            }
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
    });

    $('#jadwalujiandata').DataTable({
        "pageLength": 50,
        responsive: true,
        processing: true,
        serverSide: true,
        language:{
            url: '/assets/lang/id.json'
        },
        ajax: {
            url:'jadwalperkuliahan/pagingujian',
            type:"POST",
            data: function ( d ) {
                d.jadwal_perkuliahan = $('#jadwal_ujian').val(),
                d._token = $('#csrf_').val()
            }
        },
        order: [[7, 'asc']],
			drawCallback: function(settings) {
				var api = this.api();
				var rows = api.rows({page: 'current'}).nodes();
				var last = null;
				api.column(8, {page: 'current'}).data().each(function(group, i) {
                    var a = new Date(group);
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group"><td colspan="10">' + hari[a.getDay()] + '</td></tr>',
						);
						last = group;
					}
				});
			},
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah'},
            { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah' },
            { data: 'bobot_mata_kuliah', name: 'bobot_mata_kuliah' },
            { data: 'jam', name: 'jam'},
            { data: 'selesai', name: 'selesai' },
            { data: 'tanggal_ujian', name: 'tanggal_ujian' },
            { data: 'ruangan_title', name: 'ruangan_title' },
            { data: 'tanggal_ujian', name: 'tanggal_ujian', render: function(data, type, full, meta) {
                    var a = new Date(full.tanggal_ujian);
                    return hari[a.getDay()];//hari[full.hari_id];
                },
            },
            { data: 'catatan', name: 'catatan' },
        ],
        columnDefs: [
            {
                targets: 4,
                render : function (data, type, full, meta) {
                    var t = full.jam.split(":");
                    return t[0] + ":" + t[1];
                }
            },
            {
                targets: 5,
                render : function (data, type, full, meta) {
                    var t = full.selesai.split(":");
                    return t[0] + ":" + t[1];
                }
            },
            {
                targets: 0,
                className: "text-center"
            },
            {
                targets: 3,
                className: "text-center"
            },
            {
                targets: 4,
                className: "text-center"
            },
            {
                targets: 5,
                className: "text-center"
            },
            {
                targets: 6,
                className: "text-center"
            }
        ]
    });


});

