

jQuery(document).ready(function($){  

    $("#keyword").on("keyup",function(){
        var keyword = $(this).val();
        jQuery.ajax({
            url:   ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'data_fetch',  
                keyword: keyword 
            },
            success: function(data) {
                jQuery('#datafetch').html( data );
            }
        });
    });

    $("#mySelection").change(function(){
        var keyword = $(this).find("option:selected").text();
        var keyword = $(this).val();

        jQuery.ajax({
            url:   ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'data_drop',  
                keyword: keyword 
            },
            success: function(data) {
            jQuery('#datafetch').html( data );
            }
        });
    });

    $('#collect_product_id').prop('required',false).parent().hide();
    if($('#checkbox').prop("checked") == true){
        $('#collect_product_id').prop('required',true).parent().show();   
    }
    $('#checkbox').click(function(){
        if($(this).prop("checked") == true){
            $('#collect_product_id').prop('required',true).parent().show();   
        }
        else if($(this).prop("checked") == false){
            $('#collect_product_id').prop('required',false).parent().hide();
        }
    });
});