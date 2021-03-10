new WOW().init();

$(document).ready(function(){


    $('.dashboard_studend .content .btn-close').click(function(){

        $('.dashboard_studend .category ').animate({ width: 'hide' }, 250);
        $(this).hide();
        $('.btn-menu').fadeIn();
         $(this).parents('.content').removeClass('col-lg-9').addClass('col-lg-12');
    });


    $('.dashboard_studend .content .btn-menu').click(function(){
        $('.dashboard_studend .category').animate({ width: 'show' },  250);
        $(this).hide();
        $('.btn-close').delay(300).fadeIn();
        $(this).parents('.content').removeClass('col-lg-12').addClass('col-lg-9');
        $('.aside').fadeIn();
    });

});
