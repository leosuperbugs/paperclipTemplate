jQuery( document ).ready(function($) {

    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    $("h1").each(function() {
        this.onclick=function() {
            $(this).nextUntil("h1").toggle();
        //    var next = $(this).next();
        //    while (next.nodeName!='h1') {
        //     //    next.toggle();
        //     //    next = next.next();
        //     console.log('fuck');
        //     break;
        //    }
        };
        $(this).append('&nbsp;&nbsp; <img border="0" class="plus" src="' + im + '">');
    });
    $(".secedit").remove();
});

// var Paperclip = {

// }