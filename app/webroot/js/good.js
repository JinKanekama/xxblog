$(function(){
    var $good = $('.btn-good'); //いいねボタンセレクタ
    $good.on('click',function(e){
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性（postid,flag）に格納された値を取得
        goodPostId = $this.parents('.post').data('postid'); 
        recievedUserId = $this.parents('.post').data('recieveduserid'); 
        goodFlag = $this.parents('.post').data('flag');
        goods = $('.goods').html();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/goods/ajaxGood', //post送信を受けとるphpファイル
            data: { postId: goodPostId,
                    recievedUserId: recievedUserId,
                    goodFlag: goodFlag,
                    goods : goods} 
        }).done(function(data){
            console.log('Ajax Success');

            // いいねの総数を表示
            $('.goods').html(data[0]);
            //　いいねフラグ変更
            $this.parents('.post').data('flag', data[1]);
            // いいね取り消しのスタイル
            $this.children('i').toggleClass('far'); //空洞ハート
            // いいね押した時のスタイル
            $this.children('i').toggleClass('fas'); //塗りつぶしハート
            $this.children('i').toggleClass('active');
            $this.toggleClass('active');
        }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert("エラーが発生しました。");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        });
    });
});