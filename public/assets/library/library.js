(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.changeStatus = () => {
        if ($('.status').length) {
            $(document).on('change', '.status', function (e) {
                let _this = $(this)
                let option = {
                    'value': _this.val(),
                    'modelid': _this.attr('data-modelid'),
                    'model': _this.attr('data-model'),
                    'field': _this.attr('data-field'),
                    '_token': _token
                }
                $.ajax({
                    url: 'ajax/dashboard/changeStatus',
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function (res) {
                        console.log(res);



                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);

                    }
                })

                e.preventDefault
            })
        }
    }

    HT.checkAll = () => {
        if ($('#checkAll').length) {
            $(document).on('click', '#checkAll', function () {
                let isChecked = $(this).prop('checked')

                $('.checkbox-item').prop('checked', isChecked)
                $('.checkbox-item').each(function () {
                    let _this = $(this)
                    if (_this.prop('checked')) {
                        _this.closest('tr').addClass('active-bg')
                    } else {
                        _this.closest('tr').removeClass('active-bg')
                    }
                })

                e.preventDefault()
            })
        }
    }

    HT.checkboxItem = () => {
        if ($('.checkbox-item').length) {
            $(document).on('click', '.checkbox-item', function () {
                let _this = $(this)
                HT.changeBackground(_this);
            })
        }
    }

    HT.changeBackground = (object) => {
        let isChecked = object.prop('checked')
        if (isChecked) {
            object.closest('tr').addClass('active-bg')
        } else {
            object.closest('tr').removeClass('active-bg')
        }
    }

    $(document).ready(function () {
        HT.changeStatus();
        HT.checkAll();
        HT.checkboxItem();
    })
})(jQuery);
