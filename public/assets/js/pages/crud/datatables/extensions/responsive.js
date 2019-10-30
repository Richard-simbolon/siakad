"use strict";
var KTDatatablesExtensionsResponsive = function() {

	var initTable1 = function(a) {
		var table = $('#agama');
		// begin first table
		table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/agama/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
			columnDefs: [
				{
					targets: 3,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
				},

			],
        });

    };


    var initTable2 = function(a) {
		var table = $('#matakuliah');

		// begin first table
		table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/matakuliah/paging',
                type:"POST",
                data:{"_token": $('#csrf_').val()}

            },
            columns: [

                { defaultContent: '<td></td>' },
                { data: 'row_status', name: 'row_status' },
                { data: 'kode_mata_kuliah', name: 'kode_mata_kuliah' },
                { data: 'nama_mata_kuliah', name: 'nama_mata_kuliah' },
                { data: 'program_studi_id', name: 'program_studi_id' },
                { data: 'jenis_mata_kuliah_id', name: 'jenis_mata_kuliah_id' },
                { data: 'bobot_mata_kuliah', name: 'bobot_mata_kuliah' },
                { data: 'bobot_tatap_muka', name: 'bobot_tatap_muka' },
                { data: 'bobot_praktikum', name: 'bobot_praktikum' },
                { data: 'bobot_praktek_lapangan', name: 'bobot_praktek_lapangan' },
                { data: 'bobot_simulasi', name: 'bobot_simulasi' },
                { data: 'metode_pembelajaran', name: 'metode_pembelajaran' },
                { data: 'tanggal_mulai_efektif', name: 'tanggal_mulai_efektif' },
                { data: 'taggal_akhir_efektif', name: 'taggal_akhir_efektif' },
            ],
			columnDefs: [
				{
					targets: 14,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
                },
                {
					targets: 1,
					render: function(data, type, full, meta) {
						var row_status = {
							1: {'title': 'active', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						if (typeof row_status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + row_status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + row_status[data].state + '">' + row_status[data].title + '</span>';
					},
				},

			],
        });

    };

    var initTable3 = function(a) {

            var table = $('#Tinggal');

            // begin first table
            table.DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:'/master/jenis/tinggal/paging',
                    type:"POST",
                    //data:{"_token": $('#csrf_').val(),'table':key},
                    data: function ( d ) {
                        d.myKey = "myValue";
                        d._token = $('#csrf_').val()
                        // d.custom = $('#myInput').val();
                        // etc
                    }
                },
                columns: [
                    { defaultContent: '<td></td>' },
                    { data: 'title', name: 'title' },
                    { data: 'row_status', name: 'row_status' },
                ],
                columnDefs: [
                    {
                        targets: 3,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return `
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                  <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                    <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                    <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                                </div>
                            </span>
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                              <i class="la la-edit"></i>
                            </a>`;
                        },
                    },

                ],
            });


    };

    var initTable4 = function(a) {

        var table = $('#AlatTransportasi');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/alattransportasi/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });


    };

    var initTable5 = function(a) {

        var table = $('#Pendidikan');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/pendidikan/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    
    var initTable6 = function(a) {

        var table = $('#KebutuhanKhusus');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/kebutuhankhusus/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var initTable7 = function(a) {

        var table = $('#Penghasilan');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/penghasilan/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var initTable8 = function(a) {

        var table = $('#Jurusan');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/jurusan/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var initTable9 = function(a) {

        var table = $('#Jenispendaftaran');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/jenispendaftaran/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var initTable10 = function(a) {

        var table = $('#JalurPendaftaran');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/jalurpendaftaran/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var initTable11 = function(a) {

        var table = $('#JenisPembiayaan');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/jenispembiayaan/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var initTable12 = function(a) {

        var table = $('#AsalProgramStudi');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/asalprogramstudi/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }


    var initTable13 = function(a) {

        var table = $('#Pekerjaan');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/pekerjaan/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }



    var mahasiswa = function(a) {
        var table = $('#Mahasiswa');

        $('#inputdata').unbind();
        var col = 1
        $('#inputdata').bind('keyup', function(e) {
            //alert($('#nimnama').val());
            if($('#nimnama').val() == '2'){
                col = 2;
            }
            if(e.keyCode == 13) {
                tables.column(col).search($('#inputdata').val()).column(7).search($('#jurusan').val()).draw();
            }
        });
        $('#search-button').on('click', function(e) {
            //alert($('#nimnama').val());
                if($('#nimnama').val() == '2'){
                    col = 2;
                }
                tables.column(col).search($('#inputdata').val()).column(7).search($('#jurusan').val()).draw();
        });
        
        //table.column(1).search('director').column(2).search('london').draw();
		var tables = table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            "bFilter": true,
            ajax: {
                url:'/data/mahasiswa/paging',
                type:"POST",
                data:{"_token": $('#csrf_').val()}
            },
            columns: [

                { data: 'nim'},
                { data: 'nim', name: 'nim' },
                { data: 'nama', name: 'nama' },
                { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                { data: 'jk', name: 'jk' },
                { data: 't_agama', name: 't_agama' },
                { defaultContent: '-'},
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
                { defaultContent: 'angkatan' }
            ],
			columnDefs: [
				{
					targets: 9,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
                    	return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-edit"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="mahasiswa/edit/`+full.id+`"><i class="la la-edit"></i> Edit</a>
                                <a class="dropdown-item" href="mahasiswa/view/`+full.id+`""><i class="la la-leaf"></i>Lihat</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        `;
					},
                },
                {
					targets: 1,
					render: function(data, type, full, meta) {
						var row_status = {
							1: {'title': 'active', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						if (typeof row_status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + row_status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + row_status[data].state + '">' + row_status[data].title + '</span>';
					},
				},

			],
        });

    };

    var angkatan = function(a) {

        var table = $('#Angkatan');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/angkatan/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var statusmhs = function(a) {

        var table = $('#StatusMahasiswa');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/statusmahasiswa/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });

    }

    var TableDosen = function(a) {
        var table = $('#TableDosen');

        $('#inputdata').unbind();
        var col = 1
        $('#inputdata').bind('keyup', function(e) {
            
            if(e.keyCode == 13) {
                tables.column(1).search($('#inputdata').val())
                .column(4).search($('#jenis_kelamin').val())
                .column(5).search($('#search-agama').val())
                .draw();
            }
        });
        $('#search-button').on('click', function(e) {
            //alert($('#nimnama').val());
            tables.column(1).search($('#inputdata').val())
            .column(4).search($('#jenis_kelamin').val())
            .column(5).search($('#search-agama').val())
            .draw();
        });
        
        //table.column(1).search('director').column(2).search('london').draw();
		var tables = table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            "bFilter": true,
            ajax: {
                url:'/data/dosen/paging',
                type:"POST",
                data:{"_token": $('#csrf_').val()}
            },
            columns: [

                { data: 'nip'},
                { data: 'nama', name: 'nama' },
                { data: 'nidn_nup_nidk', name: 'nidn_nup_nidk' },
                { data: 'nip', name: 'nip' },
                { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                { data: 't_agama', name: 't_agama' },
                { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                { data: 'row_status', name: 'row_status' },
            ],
			columnDefs: [
				{
					targets: 7,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
                    	return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                            <i class="la la-edit"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="dosen/edit/`+full.id+`"><i class="la la-edit"></i> Edit</a>
                                <a class="dropdown-item" href="dosen/view/`+full.id+`""><i class="la la-leaf"></i>Lihat</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        `;
					},
                },
                {
					targets: 1,
					render: function(data, type, full, meta) {
						var row_status = {
							1: {'title': 'active', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						if (typeof row_status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + row_status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + row_status[data].state + '">' + row_status[data].title + '</span>';
					},
				},

			],
        });

    };

    var statuspegawai = function(a) {

        var table = $('#StatusPegawai');
        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/statuspegawai/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'title', name: 'title' },
                { data: 'row_status', name: 'row_status' },
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                    },
                },

            ],
        });


    };

    var initTableKelas = function(a) {

        var table = $('#Kelas');

        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'/master/kelas/paging',
                type:"POST",
                //data:{"_token": $('#csrf_').val(),'table':key},
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('#csrf_').val()
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'nama', name: 'nama' },
                { data: 'jurusan', name: 'jurusan' },
                { data: 'row_status', name: 'row_status' }
            ],
            columnDefs: [
                {
                    targets: 3,
                    title: 'Actions',
                    className: "text-center",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                       <a class="btn btn-" href="kelas/view/`+full.id+`"><i class="la la-edit"></i> Edit Details</a>
                       `;
                    },
                },

            ],
        });
    }

	return {

		//main function to initiate the module
		init: function(a) {
            initTable1();
            initTable2();
            initTable3();
            initTable4();
            initTable5();
            initTable6();
            initTable7();
            initTable8();
            initTable9();
            initTable10();
            initTable11();
            initTable12();
            initTable13();
            initTableKelas();
            mahasiswa();
            angkatan();
            TableDosen();
            statusmhs();
            statuspegawai();
		},

	};

}();

jQuery(document).ready(function() {
    
	KTDatatablesExtensionsResponsive.init($('.general-data-table').attr('id'));
});
