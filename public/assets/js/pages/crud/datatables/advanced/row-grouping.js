"use strict";
var KTDatatablesAdvancedRowGrouping = function() {

	var initTable1 = function() {
		var table = $('#jadwalperkuliahandata');

		// begin first table
		table.DataTable({
			responsive: true,
			pageLength: 25,
			order: [[5, 'desc']],
			language:{
				url: '/assets/lang/id.json'
			},
			drawCallback: function(settings) {
				var api = this.api();
				var rows = api.rows({page: 'current'}).nodes();
				var last = null;
				api.column(5, {page: 'current'}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group"><td colspan="10">' + group + '</td></tr>',
						);
						last = group;
					}
				});
			}
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesAdvancedRowGrouping.init();
});