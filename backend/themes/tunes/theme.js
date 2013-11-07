
  // Jquery code to show/hide navigation

  // FIXME : clean up this mess !
  // FIXME : move this js code to theme ?
  
  
  $(function() {


      if($.cookie('sidebar_closed')) {
        
          $("body").addClass("collapsed");
      }
      
   $("#close_sidebar").click(function() {
       $("body").toggleClass("collapsed");
       if($("body").is(".collapsed")) {
          $.cookie('sidebar_closed', 1, {  expires: 60, path: '/' });
       } else {
           $.cookie('sidebar_closed', null, {  expires: 60, path: '/' });
      }
       
      return false;
    });

   $("ul#menu li.group").each(
    function (i) {
      if($.cookie('group' + i)) {
        $(this).next().find("ul").hide();
        $(this).children("a").addClass('closed');
      } else {
        $(this).next().find("ul").show();
        $(this).children("a").removeClass('closed');
      
      }
    }
   );


   $("ul#menu li.group").click(function() {
      if ($(this).next().find("ul:visible").length != 0) {
        $(this).children("a").toggleClass('closed');
        name = $(this).next().find("ul").attr('id');
        $.cookie(name, '1', {  expires: 60, path: '/' });

      }
      else {
        $(this).children("a").toggleClass('closed');
        name = $(this).next().find("ul").attr('id');
        $.cookie(name, null, {  expires: 60, path: '/' });
      }

      $(this).next().find("ul").slideToggle('fast');

      $(this).children("a").blur();
      return false;
    });
    
    $("#sidebar ul ul li a").click( function() {
        $(this).addClass('active');
    });

  });

