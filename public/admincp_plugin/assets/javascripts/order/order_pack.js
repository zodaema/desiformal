var datatableInit = $('#table-order-pack').dataTable({
    "processing": true,
    "ajax": "source/order.php?action=table_order_pack",
    "order": [[ 1, "asc" ]],
    "columns": [
        {
            "render": function ( data, type, full, meta ) {
                return '<a id="order_detail" href="source/order_detail.php?id='+full.id_order+'">'+full.id_order+'</a>';
            }
        },
        { "data": "lastupdate" },
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
            sortable: false,
            "render": function ( data, type, full, meta ) {
                return '<form id="tracking" class="form-inline text-center" data-id-order="'+full.id_order+'">' +
                            '<div class="form-group">' +
                                '<input id="tracking" type="text" name="tracking" class="form-control" size="13" pattern=".{13,}" required aria-required="true"> ' +
                                '<button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></button>' +
                            '</div>' +
                        '</form>';
            }
        }
    ]
});

$(document).on('submit','form#tracking',function(e){
    e.preventDefault();
    var id_order = $(this).attr('data-id-order');
    var tracking = $(this).find('input#tracking').val();
    var jc = $.confirm({
        theme: 'hario',
        keyboardEnabled: true,
        title: 'ยืนยันอีกครั้ง!',
        content: 'คุณต้องการทำรายการ จริงๆใช่ไหม?',
        confirm: function () {
            $.ajax({
                url: "source/order.php",
                type: "POST",
                data: {'action': 'tracking_order', 'id_order': id_order, 'tracking': tracking},
                dataType: 'json',
                success: function (data) {
                    if(data.status == 'success'){
                        jc.close();
                        datatableInit.api().ajax.reload();

                        new PNotify({
                            title: 'ยืนยันออเดอร์แล้ว',
                            text: 'ยืนยันออเดอร์ว่าแพคสินค้าเรียบร้อยแล้ว',
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
                    console.log(data);
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

$(document).on('click', 'tr.order_item', function(){
    $(this).find('input#tracking').focus();
});

$(document).on('keyup','tr.order_item',function(e) {
    e.preventDefault();
    var code = e.keyCode || e.which;
    if (code == '9') {
        var next_input = $(this).closest('tr').next('tr');
        if(next_input.find('input#tracking').length > 0){
            $(this).closest('tr.order_item').next('tr.order_item').find('input#tracking').focus();
        }
        else{
            $('table[name="order_pack"]').find('input#tracking').first().focus();
        }
    }
});