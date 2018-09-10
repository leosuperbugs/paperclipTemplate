jQuery( document ).ready(function($) {

    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    $("h1").each(function() {
        this.onclick=function() {
            $(this).nextUntil("h1").toggle();
        };
        $(this).append('&nbsp;&nbsp; <img border="0" class="plus" src="' + im + '"><div class="clear"></div>');
    });
    $(".secedit").remove();
});

// var Paperclip = {

// }