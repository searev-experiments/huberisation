/**
 * Created by Bastien on 21/12/2017.
 */

$(document).ready(function(){

    let screen_size = $(window).width();

    if (screen_size < 768) {

    }

    $( "#navbar-menu-trigger" ).click(function() {

        if($("#sidenav").css('left') == '-250px') {
            $("#sidenav").css('left', '0');
            $("#sidenav").css('opacity', '1');
            $("#navbar-menu-trigger").css('left', '274px');
        } else {
            $("#sidenav").css('left', '-250px');
            $("#sidenav").css('opacity', '0');
            $("#navbar-menu-trigger").css('left', '24px');
        }

    });

});

