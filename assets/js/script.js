

jQuery(document).ready(function($)
{  

    $('#setting_menu').parent().hide();
    $('#setting_menu').parent().siblings().hide();

    $('#multiple_menu').parent().hide();
    $('#multiple_menu').parent().siblings().hide();

    if( $('#setting_tab_Maintance_checkbox').prop('checked') )
    {
        $('#setting_menu').parent().show();
        $('#setting_menu').parent().siblings().show();
    
        $('#multiple_menu').parent().show();
        $('#multiple_menu').parent().siblings().show();
    }
    else
    {
        $('#setting_menu').parent().hide();
        $('#setting_menu').parent().siblings().hide();
    
        $('#multiple_menu').parent().hide();
        $('#multiple_menu').parent().siblings().hide();
    }

    $('#setting_tab_Maintance_checkbox').click(function()
    {
        if( $('#setting_tab_Maintance_checkbox').prop('checked') )
        {
            $('#setting_menu').parent().show();
            $('#setting_menu').parent().siblings().show();
        
            $('#multiple_menu').parent().show();
            $('#multiple_menu').parent().siblings().show();
        }
        else
        {
            $('#setting_menu').parent().hide();
            $('#setting_menu').empty();
            $('#setting_menu').parent().siblings().hide();
        
            $('#multiple_menu').parent().hide();
            $('#multiple_menu').empty();
            $('#multiple_menu').parent().siblings().hide();
        }

    });


    // $('#setting_menu').parent().hide();
    // $('#multiple_menu').parent().hide();
    // if($('#setting_tab_Maintance_checkbox').prop("checked") == true){
    //     $('#setting_menu').parent().show();
    //     $('#multiple_menu').parent().show();   
    // }
    // $('#setting_tab_Maintance_checkbox').click(function(){
    //     if($(this).prop("checked") == true){
    //         $('#setting_menu').parent().show();
    //         $('#multiple_menu').parent().show();   
    //     }
    //     else if($(this).prop("checked") == false){
    //         $('#setting_menu').parent().hide();
    //         $('#setting_menu').remove();
    //         $('#multiple_menu').parent().hide();
    //         $('#multiple_menu').remove();
    //     }
    // });

    $('#multiple_menu').select2({});
});