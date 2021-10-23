 	// for GRAPHS scroll on top when click the page

 	$(document).ready(function(){
        $(this).scrollTop(0);
    });

    $(window).on('beforeunload', function() {
        $(window).scrollTop(0);
    });