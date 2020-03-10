$(function(){
    // イメージを拡大
    $('.carousel-inner').mouseover(function() {
        $(this).find('.d-block').css({transform: "scale(1.1)"});
    }).mouseout(function(){
        $(this).find('.d-block').css({transform: "scale(1)"});
    })

    $('.ranking-wrapper').mouseover(function() {
        $(this).find('img').css({transform: "scale(1.1)"});
    }).mouseout(function(){
        $(this).find('img').css({transform: "scale(1)"});
    })

})