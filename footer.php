<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 2018/10/22
 * Time: 12:57 PM
 */

define('__LINKSPOS__', array('header' => 0, 'footer' => 1));

function paperclipLinks($position) {
    if ($position == __LINKSPOS__['header']) {
        $wechat = 'qrcode';
        $id = 'wechat';
        $upper = 'paperclip__platform__upper';
        $upper2 = 'paperclip__links__upper';
    } else {
        $wechat = 'qrcodefooter';
        $id = 'wechatfooter';
        $upper = '';
        $upper2 = '';
    }
    echo "<ul class='paperclip__links $upper2'>
        <li>
            <a href='https://www.weibo.com/p/1005056414205745' target='_blank' class='$upper'>
                <img src='lib/tpl/starter/images/weibo.svg' class='paperclip__platform'>
            </a>
        </li>
        <li>
            <a href='' class='$upper'>
                <img src='lib/tpl/starter/images/wechat.svg' class='paperclip__platform' id=$id>
            </a>
            <img id=$wechat src='lib/tpl/starter/images/qrcode.jpg'>
        </li>
        <li>
            <a href='https://space.bilibili.com/258150656/' target='_blank' class='$upper'>
                <img src='lib/tpl/starter/images/bilibili.svg' class='paperclip__platform'>
            </a>
        </li>
    </ul>
    ";
}

function paperclipFooter() {
    echo '<div class="paperclip__footer nomobile">';
    paperclipLinks(__LINKSPOS__['footer']);
    echo'<div class="paperclip__ftlogo">
        <img src="lib/tpl/starter/images/home/logo-pet.png">
    </div>
    <div class="clear"></div>
</div>';
}


