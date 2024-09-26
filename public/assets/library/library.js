(function($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');
    
    HT.changeStatus = () => {
        if($('.status').length){
            $(document).on('change', '.status', function(e) {
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
                    success: function(res) {
                        console.log(res);
                        
                    
         
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                        
                    }
                })

                e.preventDefault                
            }) 
        }
    }

    $(document).ready(function() {
        HT.changeStatus();
    })
})(jQuery);
