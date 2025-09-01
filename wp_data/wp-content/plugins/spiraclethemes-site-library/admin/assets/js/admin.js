//Go Between the Tabs
( function ( $ ){
    "use strict";
    $(".ssl-settings-tabs").tabs();
    $("a.ssl-tab-list-item").on("click", function () {
        var tabHref = $(this).attr('href');
        window.location.hash = tabHref;
        $("html , body").scrollTop(tabHref);
    });
    
    $(".ssl-checkbox").on("click", function(){
       if($(this).prop("checked") == true) {
           $(".ssl-elements-table input").prop("checked", 1);
       }else if($(this).prop("checked") == false){
           $(".ssl-elements-table input").prop("checked", 0);
       }
    });
    
} )(jQuery);