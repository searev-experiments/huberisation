/**
 * Created by Bastien on 21/12/2017.
 */

$(document).ready(function(){

    function openSideNav() {
        $("#sidenav").css('left', '0');
        $("#sidenav").css('opacity', '1');
        $("#navbar-menu-trigger").css('left', '274px');
        $("#dark-panel").css('display', 'block');
    }

    function closeSideNav() {
        $("#sidenav").css('left', '-250px');
        $("#sidenav").css('opacity', '0');
        $("#navbar-menu-trigger").css('left', '24px');
        $("#dark-panel").css('display', 'none');
    }

    $( "#navbar-menu-trigger" ).click(function() {

        if($("#sidenav").css('left') == '-250px') {
            $("#sidenav").css('left', '0');
            $("#sidenav").css('opacity', '1');
            $("#navbar-menu-trigger").css('left', '274px');
            $("#dark-panel").css('display', 'block');
        } else {
            $("#sidenav").css('left', '-250px');
            $("#sidenav").css('opacity', '0');
            $("#navbar-menu-trigger").css('left', '24px');
            $("#dark-panel").css('display', 'none');
        }

    });

    $("#dark-panel").click(function() {
        closeSideNav();
    })

});

