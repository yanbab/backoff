

// Modal window

/*

$(function() {
    
        $('body').append('<iframe id="_blank_iframe" src="" style="display:none;background:#666; z-index: 999;position : absolute;border:solid #666 5px;-moz-border-radius:5px;top:0;left:0;margin:35px;" />');
        $().click(  
            function () {
                $('#_blank_iframe').hide();
            }  
        );
        $('a._blank').click(
            function () {
                $('#_blank_iframe').attr('src', $(this).attr('href') );
                
                $('#_blank_iframe').css(
                    {
                        'width'  :$(window).width() - 80,
                        'height' :$(window).height() - 80,
                    }
                );
                $('#_blank_iframe').toggle();
                return false;
            }
        );
        $(document).keypress(function(event){
            if (event.keyCode == 27) {
                $('#_blank_iframe').hide();
            }
        });
        
  
});


*/




