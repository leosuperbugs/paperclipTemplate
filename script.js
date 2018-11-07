jQuery( document ).ready(function($) {

    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    var screenMode = $('#screen__mode').css('z-index') + '';

    // remove the text in search button
    let btn  = $("[title='搜索']");
    btn.text('');
    // set the color
    $(".login a").css("color", "#e0ba7e");
    $(".logout a").css("color", "#e0ba7e");
    // cut the toc and paste it to the side
    let toc = $('.dw__toc');
    $('.dw__toc').remove();
    $('.paperclip__tocwarpper').append(toc);
    toc.addClass('noshow');
    // mouse move to the paperclip__toc to show the toc
    let sider = $('.paperclip__toc');

    if (sider) {

        sider.hover(
            function() {
                toc.removeClass('noshow');
                sider.addClass('noshow');
            },
            function() {
            }
        );

        toc.hover(
            function () {

            },
            function () {
                sider.removeClass('noshow');
                toc.addClass('noshow');
            }
        )
    }

    // remove the <strong> -
    $('#dw__toc > h3 > strong').remove();
    // display of wechat qrcode
    $("#wechat").hover(function () {
       $("#qrcode").css("display", "block");
    }, function () {
       $("#qrcode").css("display", "none");
    });
    $("#wechatfooter").hover(function () {
       $("#qrcodefooter").css("display", "block");
    }, function () {
       $("#qrcodefooter").css("display", "none");
    });



    // cut the first part of the page and paste it to the title
    let intro = $('p:first');
    let editbtn = $('div.editbutton_1');
    $('div.editbutton_1').remove();
    // don't cut at start
    let home = $('.paperclip__home');
    if (home.length == 0)  {
        let firsth1 = $('h1:first');
        firsth1.remove();
    }
    $(".intro").append(intro);
    $(".desktop__title").append(editbtn);
    console.log($('.page > p:first'));

    // move the editbutto next to the h1
    let clear = '<div class="clear"></div>';
    $("h1, h2, h3, h4, h5, h6").each(function () {
        let editbutton = $(this).nextAll().filter(".editbutton_section").first();
        if (editbutton) {
            editbutton.remove();
            editbutton.addClass("editbutton_lower");
            $(this).append(editbutton);
            // $(this).append(clear);
        }
    });

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
    // add click action for firstlv div
    $(".firstlv").each(function () {
        this.onclick=function () {
            if ($(this).next().hasClass("noshow"))  {
                $(this).nextUntil(".firstlv").filter('.firstlv_warpper').removeClass("noshow");
                $(this).find('img').css({'transform': 'rotate(90deg)'});
            }
            else {
                $(this).nextUntil(".firstlv").filter('.firstlv_warpper').addClass("noshow");
                $(this).find('img').css({'transform': 'rotate(0deg)'});
            }
        };
    });
    // add click action for secondlv div
    $(".secondlv").each(
        function () {
            this.onclick=function () {
                if ($(this).next().hasClass("noshow"))  {
                    $(this).nextUntil(".secondlv").filter('.secondlv_warpper').removeClass("noshow");
                }
                else {
                    $(this).nextUntil(".secondlv").filter('.secondlv_warpper').addClass("noshow");
                }
            };
        }
    );
    // add clilck action for thirdlv div
    $(".thirdlv").each(
        function () {
            this.onclick=function () {
                if ($(this).next().hasClass("noshow"))  {
                    $(this).nextUntil(".thirdlv").filter('.lowestgrp').removeClass("noshow");
                }
                else {
                    $(this).nextUntil(".thirdlv").filter('.lowestgrp').addClass("noshow");
                }
            }
        }
    );

    // move the edit buttons



    // set the width of paperclip__title to document.body.clientWidth
    // let widthOfScreen = document.body.clientWidth;
    // let marginValue = (widthOfScreen - $('.paperclip__title').width()) / 2;
    // $('.paperclip__title').css('margin-left', -marginValue);
    // $('.paperclip__title').css('margin-right', -marginValue);
    // $('.paperclip__title').css('padding-left', 0.05 * widthOfScreen);
    // $('.paperclip__title').css('padding-right', 0.05 * widthOfScreen);
    // console.log(document.body.clientWidth)

    // scroll to the top
    $('.paperclip__backToTop').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 500);
    });


    // remove the br and put them behind p
    $('.paperclip__login br').remove();
    $('.paperclip__login p').append('<br>');

    $('.paperclip__register br').remove();
    $('.paperclip__register p').append('<br>');
});

// var Paperclip = {

// }