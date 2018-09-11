jQuery( document ).ready(function($) {

    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    //$(".secedit").remove();
    $(".login").css("color", "#e0ba7e");
    $(".logout").css("color", "#e0ba7e");
    // display of wechat qrcode
    $("#wechat").hover(function () {
       $("#qrcode").css("display", "block");
    }, function () {
       $("#qrcode").css("display", "none");
    });
    // cut the first part of the page and paste it to the title
    let intro = $('p:first');
    let editbtn = $('div.editbutton_1');
    $('div.editbutton_1').remove();
    $('h1:first').remove();
    $(".intro").append(intro);
    $(".intro").append(editbtn);
    console.log($('.page > p:first'));
    // fold all the h1 and it's children
    $("h1").each(function() {
        this.onclick=function() {
            $(this).nextUntil("h1").toggle();
        };
        $(this).append('&nbsp;&nbsp; <img border="0" class="plus" src="' + im + '"><div class="clear"></div>');
        $(this).nextUntil("h1").toggle();
    });
});

// var Paperclip = {

// }