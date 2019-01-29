var datatableInit = $('#table-order-send').dataTable({
    "processing": true,
    "ajax": "source/order.php?action=table_order_send",
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
                return '<center><a href="#" id="sent" data-id-order="'+full.id_order+'" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> ส่งแล้ว</a>';
            }
        }
    ]
});

$(document).on('click','table[name="order_send"] tr:not(tr.tb-head)',function (e) {
    if (e.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

$(document).on('change','input#orderSelect:checkbox',function(){
    orderSelectCheck();
    orderSelectFocus(this);
    checkAllSelectIsChecked();
});

$(document).on('change','input#orderSelectAll', function(e) {
    var selectAll = $('input#orderSelectAll'),
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
                        $('table[name="order_pack"] tr#'+id_order).remove();

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