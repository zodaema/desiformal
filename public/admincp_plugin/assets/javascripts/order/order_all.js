var datatableInit = $('#table-order-all').dataTable({
	"processing": true,
	"ajax": "source/order.php?action=table_order_all",
	"order": [[ 0, "desc" ]],
	"columns": [
		{
			"render": function ( data, type, full, meta ) {
				return '<a id="order_detail" href="source/order_detail.php?id='+full.id_order+'">'+full.id_order+'</a>';
			}
		},
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return full.product;
			}
		},
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return 'ถึงคุณ : '+full.address.name+'<br>' +
					'ที่อยู่ : '+full.address.address+'<br>' +
					'จังหวัด : '+full.address.province+' '+
					'รหัสไปรษณีย์ : '+full.address.postcode;
			}
		},
		{
			"render": function ( data, type, full, meta ) {
				return full.status;
			}
		},
		{ "data": "datetime" }
	]
});

$(document).on('click', 'tr.order_item', function(e){
	e.preventDefault();
	var item_id = $(this).attr('id');
	$.magnificPopup.open({
		items: {
			src: "source/order_detail.php?id="+item_id
		},
		type: 'ajax',
		mainClass: 'my-mfp-zoom-in'
	});
	return false;
});