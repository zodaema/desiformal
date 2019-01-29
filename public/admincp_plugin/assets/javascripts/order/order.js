(function( $ ) {

    'use strict';

    /*
     Modal Dismiss
     */
    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

    /*
     Modal Confirm
     */
    $(document).on('submit', 'form#order_detail', function (e) {
        e.preventDefault();
        var data = $('form#order_detail').serialize();
        var jc = $.confirm({
            theme: 'hario',
            keyboardEnabled: true,
            title: 'ยืนยันอีกครั้ง!',
            content: 'คุณต้องการทำรายการ จริงๆใช่ไหม?',
            confirm: function () {
                $.ajax({
                    url: "source/order.php",
                    type: "POST",
                    data: data + "&action=edit_order",
                    dataType: 'json',
                    success: function (data) {
                        jc.close();
                        console.log(data);
                        if (data[0] == 'success') {
                            datatableInit.api().ajax.reload();
                            $.magnificPopup.close();
                            new PNotify({
                                title: 'Success!',
                                text: 'แก้ไขออเดอร์แล้ว.',
                                type: 'success'
                            });
                        }
                        else if (data[0] == 'no permission') {
                            $.magnificPopup.close();
                            new PNotify({
                                title: 'Error!',
                                text: 'คุณไม่มีสิทธิ์แก้ไขออเดอร์.',
                                type: 'error'
                            });
                        }
                    }
                });
            },
            confirmButton: 'ใช่',
            confirmButtonClass: 'btn-primary',
            cancelButton: 'ไม่ใช่',
            cancelButtonClass: 'btn-danger'
        });
    });
    $(document).on('click', 'a#order_detail', function(e){
        e.preventDefault();
        $.magnificPopup.open({
            items: {
                src: this
            },
            type: 'ajax',
            mainClass: 'my-mfp-zoom-in'
        });
        return false;
    });

}).apply( this, [ jQuery ]);

function orderSelectCheck(){
    var numberOfChecked = $('input#orderSelect:checked').length;

    if( numberOfChecked < 1){
        $("div[name=action]").fadeOut('fast');
    }
    else{
        if($("div[name=action]:hidden")){
            $("div[name=action]").fadeIn('fast');
        }
        $("span[name=numofselect]").html("เลือก "+numberOfChecked+" รายการ");
    }
}

function orderSelectFocus(select){
    if ($(select).prop('checked') === true) {
        $(select).closest('tr').addClass("order_selected");
    }
    else {
        $(select).closest('tr').removeClass("order_selected");
    }
}

function checkAllSelectIsChecked(){
    var selectAll = $('input#orderSelectAll'),
        CountSelect = $('input#orderSelect').length,
        CountSelected = $('input#orderSelect:checked').length;

    if(CountSelect != CountSelected && CountSelected != 0){
        selectAll.prop({
            checked: false,
            indeterminate: true
        });
    }

    else if(CountSelect == CountSelected && CountSelect != 0){
        selectAll.prop({
            checked: true,
            indeterminate: false
        });
    }
    else{
        selectAll.prop({
            checked: false,
            indeterminate: false
        });
    }
}

$(document).on('click', '#refresh_button', function(){
    datatableInit.api().ajax.reload();
});