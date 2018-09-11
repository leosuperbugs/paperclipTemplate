jQuery( document ).ready(function($) {

    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    $("h1").each(function() {
        this.onclick=function() {
            $(this).nextUntil("h1").toggle();
        };
        $(this).append('&nbsp;&nbsp; <img border="0" class="plus" src="' + im + '"><div class="clear"></div>');
    });
    $(".secedit").remove();
    $(".login").css("color", "#e0ba7e");
    $(".logout").css("color", "#e0ba7e");
    // display of wechat qrcode
    $("#wechat").hover(function () {
       $("#qrcode").css("display", "block");
    }, function () {
       $("#qrcode").css("display", "none");
    })
});

// var Paperclip = {

// }