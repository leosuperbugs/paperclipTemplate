const paperclipGold = "#e0ba7e";

jQuery( document ).ready(function($) {

    removeSearchButtonText($);

    setPageToolColor($);

//    setTOCHover($);

    appendWholeEntries($);

    resetAdminURL($);

    removal($);

    displayWXQRCode($);

    cutToTitle($);

    moveEditButton($);

    entryH1Toggle($);

    listSetToggle($);

    setBackToTop($);

    processForm($);
});

function setPageToolColor($) {
    // set the color
    $(".login a").css("color", "#e0ba7e");
    $(".logout a").css("color", "#e0ba7e");
}

function setTOCHover($) {
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

}

function removal($) {
    // remove the <strong> -
    $('#dw__toc > h3 > strong').remove();
}
function urlParam(name){
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;

};

function appendWholeEntries($) {
    $.urlParam = urlParam;
    let action = $.urlParam()["do"];
    let id = $.urlParam()["id"];

    var fullEntries;
    if ((!action || action == "show")&& (id == "start" || !id)) {
        fullEntries = '<li class="fullentries"><a href="#paperclip__list">全部条目</a></li>';
    } else {
        fullEntries = '<li class="fullentries"><a href="/doku.php?id=start#paperclip__list">全部条目</a></li>';
    }
    // append full entries after user name at tag area
    $('.profile').after(fullEntries);
}

function resetAdminURL($) {
    $('.admin a').attr('href','/doku.php?show=alledit');
    $('.profile a').attr('href', '/doku.php?show=editlog');
}

function displayWXQRCode($) {
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
}

function cutToTitle($) {
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
}

function moveEditButton($) {
    // move the editbutton next to the h1
    let clear = '<div class="clear"></div>';

    $("h1").each(function () {
        var editbtn_wrapper = document.createElement("div");
        var leftBrkt = document.createElement('span');
        var rightBrkt = document.createElement('span');
        leftBrkt.innerHTML = '[';
        rightBrkt.innerHTML = ']';
        editbtn_wrapper.className = 'paperclip__editbtn__wrapper';

        let editbutton = $(this).nextAll().filter(".editbutton_section").first();
        if (editbutton.length != 0) {
            editbutton.remove();
            editbutton.addClass("editbutton_lower");
            editbtn_wrapper.append(leftBrkt);
            editbtn_wrapper.innerHTML += editbutton.html();
            editbtn_wrapper.append(rightBrkt);
            $(this).append(editbtn_wrapper);
        }
        $('<hr class="paperclip__h1hr">').insertAfter(this);
    });

}

function setBackToTop($) {
    // back to top
    $('.paperclip__backToTop').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 500);
    });
}

function removeSearchButtonText($) {
    // remove the text in search button
    let btn  = $("[title='搜索']");
    btn.text('');
    // remove the text in search button in search result
    let btn2 = $(".paperclip__floatright [type='submit']");
    btn2.text('');
}

function processForm($) {
    // remove the br and put them behind p
    $('.paperclip__login br').remove();
    $('.paperclip__login p').append('<br>');

    $('.paperclip__register br').remove();
    $('.paperclip__register p').append('<br>');
}

function needToggle(id, doparam) {
    if (doparam == 'admin' ||
        doparam == 'preview' ||
        doparam == 'diff' ||
        doparam == 'profile' ||
        !id) {
        return false;
    } else {
        return true;
    }
}

function entryH1Toggle($) {
    var screenMode = $('#screen__mode').css('z-index') + '';
    var im = DOKU_BASE+"lib/tpl/starter/images/plus.png";
    var doparam = $.urlParam()['do'];
    var id = $.urlParam()['id'];
    if (!needToggle(id, doparam)) {
        return;
    }


    // Wrap the content under h1
    // And then add buttons to fold and unfold the content
    $("h1").each(function () {
        var content;
        var h1Length = $(this).nextUntil("h1").length;
        var commentLength = $(this).nextUntil(".comment_wrapper").length;
        var clearLength = $(this).nextUntil(".clearer").length;

        if (h1Length > commentLength) {
            if (commentLength > clearLength) {
                content = $(this).nextUntil(".clearer");
            } else {
                content = $(this).nextUntil(".comment_wrapper");
            }
        } else {
            if (h1Length > clearLength) {
                content = $(this).nextUntil(".clearer");
            } else {
                content = $(this).nextUntil("h1");
            }
        }

        content.wrapAll("<div class='paperclip__h1content'/>");
        if (screenMode == 1) {
            $(this).append('<img border="0" class="plus" src="' + im + '"><div class="clear"></div>');
            // $(this).nextUntil("h1").toggle();
        }
        else {
            $(this).prepend('<span style="color:#e0ab7e; font-size: 0.5em">▋</span>  ');
        }
    });

    $('.paperclip__h1content').wrap('<div class="paperclip__h1"></div>');

    // Fold the content
    // Desktop Only
    if (screenMode != 1) {
        $(".paperclip__h1content").each(function () {

            // Hide the content over 200px at the init
            // Only apply the toggle buttons to content long enough (>200px)
            var h1MaxHeight = 200;

            if ($(this).height() > h1MaxHeight) {
                let showbtn = document.createElement("BUTTON");
                let hidebtn = document.createElement("BUTTON");
                let show_curtain = document.createElement("div");
                let hide_curtain = document.createElement("div");

                // Hide the overflowed part
                $(this).addClass("paperclip__h1content__wrapped");

                // Set the curtains' properties
                show_curtain.className = 'paperclip__showcurtain';
                hide_curtain.className = 'paperclip__hidecurtain noshow';

                // Set button properties
                showbtn.innerHTML = '点击查看完整内容';
                showbtn.className = 'paperclip__showbtn paperclip__btn';
                showbtn.onclick = function () {
                    // Unwrap the h1 content
                    $(this).parent().siblings(".paperclip__h1content").removeClass("paperclip__h1content__wrapped");
                    // Show the counterpart
                    $(this).parent().siblings('.paperclip__hidecurtain').removeClass("noshow");
                    // Hide self and the curtain
                    $(this).parent().addClass("noshow");
                };

                hidebtn.className = 'paperclip__hidebtn paperclip__btn';
                hidebtn.innerHTML = '收起';
                hidebtn.onclick = function () {
                    // Wrap the h1 content
                    $(this).parent().siblings(".paperclip__h1content").addClass("paperclip__h1content__wrapped");
                    // Show the counterpart button
                    $(this).parent().siblings(".paperclip__showcurtain").removeClass("noshow");
                    // Hide self and the curtain
                    $(this).parent().addClass("noshow");
                };

                // Assemble the elements
                show_curtain.append(showbtn);
                hide_curtain.append(hidebtn);
                $(this).parent().append(show_curtain);
                $(this).parent().append(hide_curtain);
            }

        });
    }

    // Section toggle
    // Mobile only.
    if (screenMode == 1) {
        $("h1").each(function () {
            $(this).next().toggle();
            this.onclick = function () {
                $(this).next().toggle();
                $(this).toggleClass("launched");

                if ($(this).hasClass("launched")) {
                    // set the img to minus
                    $(this).children('img').attr("src", "/lib/tpl/starter/images/minus.png");
                } else {
                    // set the img to plus
                    $(this).children('img').attr("src", "/lib/tpl/starter/images/plus.png");
                }
            };
        })
    }
}

function listSetToggle($) {
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
}
