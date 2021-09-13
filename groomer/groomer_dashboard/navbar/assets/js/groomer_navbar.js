
$('document').ready(function (){

    //########################### Open SubMenu When User Press Button ###########//

    document.querySelectorAll('.sidebar-submenu').forEach(e => {
        e.querySelector('.sidebar-menu-dropdown').onclick = (event) => {
            event.preventDefault()
            e.querySelector('.sidebar-menu-dropdown .dropdown-icon').classList.toggle('active')

            let dropdown_content = e.querySelector('.sidebar-menu-dropdown-content')
            let dropdown_content_lis = dropdown_content.querySelectorAll('li')

            let active_height = dropdown_content_lis[0].clientHeight * dropdown_content_lis.length; 

            dropdown_content.classList.toggle('active');
        }
    })


    var overlay = document.querySelector('.overlay');
    var sidebar = document.querySelector('.sidebar');

    $('#mobile-toggle').click(function () {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    $('#sidebar-close').click(function () {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    $('.overlay').click(function () {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    //###########################################################################################################//
    //############### Take only text before @ from groomer email and display it as username #######//
    var str = $( "#groomer" ).text();
    var name = str.match(/^([^@]*)@/)[1];
    document.getElementById("groomer").innerHTML = name;

    //##############################################################################################//
    //########################## Active Navigation Class Based on URL #############################//

    jQuery(function($) {

        var path = window.location.href;

        $('ul li a').each(function() {

            if (this.href === path) {

                $(this).toggleClass('active');

            }
            
        });

    });

/*Ανοίγει το Menu*/
$(document).ready( function(){
    var drowdownMenu = $('#dropdown_menu');
    var dropdownMenuItems = $('#dropdown_menu').children().children('a');
    if(dropdownMenuItems.hasClass('active')) 
        drowdownMenu.addClass('active');
    
});

    //##############################################################################################//
    //########################## Log out with pop up window #############################//


    $('#btn_logout').click(function () {

        Swal.fire({
            icon: 'question',
            showCancelButton: true,
            text: "Είστε σίγουρος πως θέλετε να αποσυνδεθείτε;",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Αποσύνδεση",
            cancelButtonText: "Ακύρωση"
        }).then((result) => {
            if (result.value===true) {
                window.location = '../groomer_logout.php';
            }
        });

    });

    

});