var datatableInit = $('#table-order-confirm').dataTable({
	"processing": true,
	"ajax": "source/order.php?action=table_order_confirm",
	"order": [[ 2, "asc" ]],
	"columns": [
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return '<div class="checkbox-custom checkbox-default">' +
							'<input type="checkbox" id="orderSelect" name="orderSelect" value="'+full.id_order+'">' +
							'<label for="orderSelectAll"></label>' +
						'</div>';
			}
		},
		{
			"render": function ( data, type, full, meta ) {
				return '<a id="order_detail" href="source/order_detail.php?id='+full.id_order+'">'+full.id_order+'</a></label>';
			}
		},
		{ "data": "datetime" },
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return full.detail.price + ' (ค่าจัดส่ง : '+full.detail.postprice+') (ส่วนลด : '+full.detail.discount+') <br>' +
						'<u>รวม : '+full.detail.totalprice+'</u>';
			}
		},
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return 'ธนาคาร : '+full.payment.bank+'<br>' +
						'วัน เวลา : '+full.payment.date+' '+full.payment.time+'<br>' +
						'<b><u>จำนวนเงิน : '+full.payment.price+' (ราคา '+full.detail.totalprice+')</u>';
			}
		},
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return '<a id="slip" href="../img/paymentslip/'+full.paymentslip+'">' +
							'<img src="../img/paymentslip/'+full.paymentslip+'" width="50px" height="50px">' +
							'<div id="slip-caption" style="display:none;">' +
								'ธนาคาร : '+full.payment.bank+'<br>' +
								'วัน เวลา : '+full.payment.date+' '+full.payment.time+'<br>' +
								'<b><u>จำนวนเงิน : '+full.payment.price+' (ราคา '+full.detail.totalprice+')</u>' +
							'</div>' +
						'</a>';
			}
		},
		{
			sortable: false,
			"render": function ( data, type, full, meta ) {
				return '<center><a href="#" id="approve" data-orderid="'+full.id_order+'" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> ผ่าน</a> ' +
					   '<a href="#" id="disapprove" data-orderid="'+full.id_order+'" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> ไม่ผ่าน</a></center>';
			}
		}
	]
});

$(document).on('mousedown','a#slip',function(e){
	e.preventDefault();
	$(this).lightGallery({
		dynamic: true,
		dynamicEl: [{
			"src": $(this).attr('href'),
			'subHtml': $(this).children('div#slip-caption').html()}]
	});
	return false;
});

$(document).on('click','table[name="order_confirm"] tr:not(tr.tb-head)',function (e) {
	if (e.target.type !== 'checkbox') {
		$(':checkbox', this).trigger('click');
	}
});

$(document).on('change','input#orderSelect:checkbox',function(e){
	e.preventDefault();
	orderSelectCheck();
	orderSelectFocus(this);
	checkAllSelectIsChecked();
});

$(document).on('change','input#orderSelectAll', function(e) {
	e.preventDefault();
	var selectAll = $(this),
		select = $('input#orderSelect');

	if(selectAll.prop('checked') === true && selectAll.prop('indeterminate') === false){
		select.prop({checked: true});
	}
	else if(selectAll.prop('indeterminate') === true){
		selectAll.prop({checked: true});
		select.prop({checked: true});
	}
	else{
		select.prop({checked: false});
	}

	orderSelectCheck();
	orderSelectFocus(select);
	checkAllSelectIsChecked();
});

$(document).on('mousedown','a#approve',function(e){
	e.preventDefault();
	var id_order = $(this).attr('data-orderid');
	var jc = $.confirm({
		theme: 'hario',
		keyboardEnabled: true,
		title: 'ยืนยันอีกครั้ง!',
		content: 'คุณต้องการทำรายการ จริงๆใช่ไหม?',
		confirm: function () {
			$.ajax({
				url: "source/order.php",
				type: "POST",
				data: {'action':'confirm_order1','confirm':'approve','id_order':id_order},
				success: function (data) {
					if(data == 'success'){
						jc.close();

						datatableInit.api().ajax.reload();
						orderSelectCheck();

						new PNotify({
							title: 'ยืนยันออเดอร์แล้ว',
							text: 'ยืนยันออเดอร์ว่า "ผ่าน"',
							addclass: 'notification-success',
							icon: 'fa fa-check',
							nonblock: {
								nonblock: true,
								nonblock_opacity: .2
							},
							delay: 1000
						});
					}

					else if(data == 'no permission'){
						jc.close();
						new PNotify({
							title: 'Error!',
							text: 'คุณไม่มีสิทธิ์ยืนยันออเดอร์.',
							type: 'error'
						});
					}
				}
			});
			return false;
		},
		confirmButton: 'ใช่',
		confirmButtonClass: 'btn-primary',
		cancelButton: 'ไม่ใช่',
		cancelButtonClass: 'btn-danger'
	});
});

$(document).on('mousedown','a#disapprove',function(e){
	e.preventDefault();
	var id_order = $(this).attr('data-orderid');
	jc = $.confirm({
		theme: 'hario',
		keyboardEnabled: true,
		title: 'ยืนยันอีกครั้ง!',
		content: 'คุณต้องการทำรายการ จริงๆใช่ไหม?',
		confirm: function () {
			$.ajax({
				url: "source/order.php",
				type: "POST",
				data: {'action':'confirm_order1','confirm':'disapprove','id_order':id_order},
				success: function (data) {
					if(data == 'success'){
						jc.close();
						datatableInit.api().ajax.reload();
						orderSelectCheck();

						new PNotify({
							title: 'ยืนยันออเดอร์แล้ว',
							text: 'ยืนยันออเดอร์ว่า "ไม่ผ่าน"',
							addclass: 'notification-success',
							icon: 'fa fa-check',
							nonblock: {
								nonblock: true,
								nonblock_opacity: .2
							},
							delay: 1000
						});
					}

					else if(data == 'no permission'){
						jc.close();
						new PNotify({
							title: 'Error!',
							text: 'คุณไม่มีสิทธิ์ยืนยันออเดอร์.',
							type: 'error'
						});
					}
				}
			});
			return false;
		},
		confirmButton: 'ใช่',
		confirmButtonClass: 'btn-primary',
		cancelButton: 'ไม่ใช่',
		cancelButtonClass: 'btn-danger'
	});
});

$(document).on('click','a#select_approve',function(e){
	e.preventDefault();
	var data = $("input#orderSelect").serializeArray();
	jc = $.confirm({
		theme: 'hario',
		keyboardEnabled: true,
		title: 'ยืนยันอีกครั้ง!',
		content: 'คุณต้องการทำรายการ จริงๆใช่ไหม?',
		confirm: function () {
			$.ajax({
				url: "source/order.php",
				type: "POST",
				data: {'action':'confirm_order2','confirm':'approve','data':data},
				dataType: 'json',
				success: function (data) {
					if(data.status == 'success'){
						jc.close();
						datatableInit.api().ajax.reload();
						orderSelectCheck();

						new PNotify({
							title: 'ยืนยันออเดอร์แล้ว',
							text: 'ยืนยันออเดอร์ว่า "ผ่าน"',
							addclass: 'notification-success',
							icon: 'fa fa-check',
							nonblock: {
								nonblock: true,
								nonblock_opacity: .2
							},
							delay: 1000
						});
					}

					else if(data.status == 'no permission'){
						jc.close();
						new PNotify({
							title: 'Error!',
							text: 'คุณไม่มีสิทธิ์ยืนยันออเดอร์.',
							type: 'error'
						});
					}
				}
			});
			return false;
		},
		confirmButton: 'ใช่',
		confirmButtonClass: 'btn-primary',
		cancelButton: 'ไม่ใช่',
		cancelButtonClass: 'btn-danger'
	});
});

$(document).on('click','a#select_disapprove',function(e){
	e.preventDefault();
	var data = $("input#orderSelect").serializeArray();
	jc = $.confirm({
		theme: 'hario',
		keyboardEnabled: true,
		title: 'ยืนยันอีกครั้ง!',
		content: 'คุณต้องการทำรายการ จริงๆใช่ไหม?',
		confirm: function () {
			$.ajax({
				url: "source/order.php",
				type: "POST",
				data: {'action':'confirm_order2','confirm':'disapprove','data':data},
				dataType: 'json',
				success: function (data) {
					if(data.status == 'success'){
						jc.close();
						datatableInit.api().ajax.reload();
						orderSelectCheck();

						new PNotify({
							title: 'ยืนยันออเดอร์แล้ว',
							text: 'ยืนยันออเดอร์ว่า "ไม่ผ่าน"',
							addclass: 'notification-success',
							icon: 'fa fa-check',
							nonblock: {
								nonblock: true,
								nonblock_opacity: .2
							},
							delay: 1000
						});
					}

					else if(data.status == 'no permission'){
						jc.close();
						new PNotify({
							title: 'Error!',
							text: 'คุณไม่มีสิทธิ์ยืนยันออเดอร์.',
							type: 'error'
						});
					}
				}
			});
			return false;
		},
		confirmButton: 'ใช่',
		confirmButtonClass: 'btn-primary',
		cancelButton: 'ไม่ใช่',
		cancelButtonClass: 'btn-danger'
	});
});