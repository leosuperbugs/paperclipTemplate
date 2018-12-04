<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 2018/11/7
 * Time: 4:49 PM
 */

if (!defined('DOKU_INC')) die();

/**
 * @param $show
 *
 * Logic: The logo of PaperClip should not be displayed at index
 */
function showHeaderLogo($show) {
    global $ID, $conf, $ACT;
    return (!($ID === $conf['start'] && $ACT === 'show' && !isset($show)));
}

/**
 * @param $show
 *
 * Logic: Show the customized part of index at the main page
 */
function showIndex() {
    global $ID, $_GET, $conf, $ACT;
    $show = $_GET['show'];
    return ($ID == $conf['start'] && $ACT === 'show' && !isset($show));
}

/**
 * Logic: Show the customized header of content pages
 */
function showContentHeader() {
    global $ACT;
    return ($ACT === 'show');
}

/**
 * Logic: Show the lower part of pet
 */
function showLowerPet($filename) {
    return (file_exists($filename));

}

/**
 * @param $showtools
 *
 * Logic: Show the page tools at show, revisions, edit, save, preview,
 */
function showPageTools($showTools) {
    global $ACT, $_GET;
    $show = $_GET['show'];
    return ($showTools &&( $ACT === 'show' || $ACT === 'admin' || $ACT === 'revisions') &&!$show);
}

/**
 * Logic: Show the table of content only at wiki entry content pages
 * Also applied to back to top icon
 *
 * ShowACT: show, admin, preview
 */
function isContentPage()
{
    global $ACT;
    return ($ACT === 'show' || $ACT === 'admin' || $ACT === 'preview');
}

/**
 * Logic: Show the paperclip footer only when necessary
 *
 * ShowACT: show, profile, editlog, comment, setting
 * Also shown at start page
 */
function showFooter() {
    global $ID, $conf, $ACT, $_GET;
    $show = $_GET['show'];
    return (($ID == $conf['start'] && $ACT === 'show') || $ACT === 'profile' || $show !== '');
}
