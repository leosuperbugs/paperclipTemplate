jQuery( document ).ready(function($) {

    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    var screenMode = $('#screen__mode').css('z-index') + '';

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
    // don't cut at start
    let home = $('.paperclip__home');
    if (home == null)  {
        let firsth1 = $('h1:first');
        firsth1.remove();
    }
    $(".intro").append(intro);
    $(".intro").append(editbtn);
    console.log($('.page > p:first'));
    // fold all the h1 and it's children
    $("h1").each(function() {
        this.onclick=function() {
            $(this).nextUntil("h1").toggle();
        };
        // add icons for images
        if (screenMode == 1) {
            $(this).append('&nbsp;&nbsp; <img border="0" class="plus" src="' + im + '"><div class="clear"></div>');
            $(this).nextUntil("h1").toggle();
        }
        else {
            $(this).prepend('<span style="color:#e0ab7e; font-size: 0.5em">▋</span>  ');
        }
    });
    // fold all the firstlv divs and add click action
    $(".firstlv").each(function () {
        this.onclick=function () {
            if ($(this).next().hasClass("noshow"))  {
                $(this).nextUntil(".firstlv").removeClass("noshow");
                $(this).find('img').css({'transform': 'rotate(90deg)'});
            }
            else {
                $(this).nextUntil(".firstlv").addClass("noshow");
                $(this).find('img').css({'transform': 'rotate(0deg)'});
                    // style.transform = "rotate(90deg)";
            }
        };
        $(this).nextUntil(".firstlv").addClass("noshow");
    });
    // set the width of paperclip__title to document.body.clientWidth
    // let widthOfScreen = document.body.clientWidth;
    // let marginValue = (widthOfScreen - $('.paperclip__title').width()) / 2;
    // $('.paperclip__title').css('margin-left', -marginValue);
    // $('.paperclip__title').css('margin-right', -marginValue);
    // $('.paperclip__title').css('padding-left', 0.05 * widthOfScreen);
    // $('.paperclip__title').css('padding-right', 0.05 * widthOfScreen);
    // console.log(document.body.clientWidth)

    // cut the toc and paste it to the side
    let toc = $('.dw__toc');
    $('.dw__toc').remove();
    $('#dokuwiki__site').append(toc);

    // scroll to the top
    $('.paperclip__backToTop').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 500);
    });

    // remove the text in search button
    let btn  = $("[title='搜索']");
    btn.text('');


});

// var Paperclip = {

// }