$(document).ready(function () {
    //page search
    $('.page-fixed').hide();
    $('.search-icon').click(function () {
        $('.page-fixed').fadeIn();
        $('.page-fixed .wrapper').fadeIn().addClass('fiup');
    });
    $('.close-page').click(function () {
        $('.page-fixed').fadeOut();
        $('.page-fixed .wrapper').hide().removeClass('fiup');
    });
    //tab product
    var i = 0;
    $('#category .my-tab-content').eq(i).show();
    $('#category .my-tab-item').eq(i).addClass('active');

    $('#category .my-tab-item').click(function () {
        $('#category .my-tab-item').removeClass('active');
        $(this).addClass('active');

        var prdTab_ID = $(this).attr('data-tab');
        $('#category .my-tab-content').hide();
        $('#' + prdTab_ID).fadeIn();
    });
    //quick cart
    $('.quick-cart').hide();
    $('.cart-icon').click(function() {
        $('.quick-cart').slideToggle();
    });
})
