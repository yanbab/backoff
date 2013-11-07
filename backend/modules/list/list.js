// list.js

$(document).ready(function() {

    // Select all/none  
    $("#check_all").click(function() {
        var checked_status = this.checked;
        $("tr.row :checkbox").each(function() {
    	    (this.checked==true) ? this.checked = false : this.checked = true ; // Invert selection
            //this.checked = checked_status; // Check all/none
            (this.checked==true) ? $(this).parents('tr').addClass('selected') : $(this).parents('tr').removeClass('selected');
        });
    });

    // Edit row on click
    $('tr.row').click(function(event) {
        $("tr.row :checkbox").each(function() {
            (this.checked==true) ? $(this).parents('tr').addClass('selected') : $(this).parents('tr').removeClass('selected');
        });     
        if ( event.target.type !== 'checkbox' 
            && !$(event.target).hasClass('check') 
            && !$(event.target).is('a') 
        ) {
            var url = $(this).find('a.edit_link').attr('href');
            document.location = url;
            return true
        }
    });

    // Advanced actions
    $('tr').click(function(event) {
        if($("tr.row :checkbox:checked").length) {
            $("#adv_actions").show();
        } else {
            $("#adv_actions").hide();
        }
    });

    // Advanced search
    $('#adv_search').click( function() {
        $('#searchPanel').slideToggle('fast');
        $('#adv_search').toggleClass('open');
    });


    // Highlight search
    if($('#search').val()) {
        $('table.list td').each(function() { 
            $.highlight(this,  $('#search').val().toUpperCase() );
        });
    }

    // Remove search duplicates
    $('#search_new').duplicate_remove();


});
