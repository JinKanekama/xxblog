$(function(){
    // イメージを拡大
    $('.carousel-inner').mouseover(function() {
        $('.carousel-inner').find('.d-block').css({transform: "scale(1.1)"});
    }).mouseout(function(){
        $('.d-block').css({transform: "scale(1)"});
    })

})