<?php
/**
 *
 * The template for iPaperClip
 *
 * @link     https://ipaperclip.net
 * @author   Tongyu Nie
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
@require_once (dirname(__FILE__).'/show_check.php');

header('X-UA-Compatible: IE=edge,chrome=1');

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
$imagePrefix = 'lib/tpl/starter/images';

include 'footer.php';

?>

<!DOCTYPE html>

<html  xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130041193-1"></script>
   <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-130041193-1');
   </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <!--[if lte IE 8 ]><div id="IE8"><![endif]-->

    <div id="dokuwiki__header"><div class="pad">

            <div class="headings">
                <?php if ($conf['tagline']): ?>
                    <p class="claim"><?php echo $conf['tagline'] ?></p>
                <?php endif ?>

                <div class="ZZer"></div>
            </div>

            <div class="tools nomobile">
                <!-- USER TOOLS -->
                <?php if ($conf['useacl'] && $showTools): ?>
                    <div id="dokuwiki__usertools">
<!--                        <h3 class="a11y">--><?php //echo $lang['user_tools'] ?><!--</h3>-->
                        <ul id="logo_area">
                            <?php
                            global $ID, $conf, $ACT, $_GET;
                            $show = $_GET['show'];
                            //    if ($ID == $conf['start']) {
                            if (showHeaderLogo($show)) {
                                ?>
                                <li class="desktop__header">
                                    <a href="/doku.php">
                                        <img id="brand" src="lib/tpl/starter/images/brand_white.png" />
                                    </a>
                                </li>
                            <?php } ?>
                            <?php
                            paperclipLinks(__LINKSPOS__['header']);
                            ?>
                            <div class="clear"></div>
                        </ul>
                        <ul id="tag_area">
                            <?php
                            if (!empty($_SERVER['REMOTE_USER'])) {
                                echo '<li class="user">';
                                tpl_userinfo(); /* 'Logged in as ...' */
                                echo '</li>';
                            }
                            ?>
                            <?php /* the optional second parameter of tpl_action() switches between a link and a button,
                                     e.g. a button inside a <li> would be: tpl_action('edit', 0, 'li') */
                            ?>
                            <?php
                            $test =  (new \dokuwiki\Menu\UserMenu());
                            echo $test->getlistitems();
                            ?>
                        </ul>
                        <!--                        <div class="paperclip__gradient"></div>-->
                        <div class="clear"></div>
                <?php endif ?>

                <!-- SITE TOOLS -->
                <div id="dokuwiki__sitetools">
<!--                    <h3 class="a11y">--><?php //echo $lang['site_tools'] ?><!--</h3>-->
                    <ul>
                        <?php tpl_toolsevent('sitetools', array(
                            'recent'    => tpl_action('recent', 1, 'li', 1),
                            'media'     => tpl_action('media', 1, 'li', 1),
                            'index'     => tpl_action('index', 1, 'li', 1),
                        )); ?>
                    </ul>
                </div>

            </div>
            <div class="clearer"></div>

            <!-- BREADCRUMBS -->
            <?php if($conf['breadcrumbs']){ ?>
                <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
            <?php } ?>
            <?php if($conf['youarehere']){ ?>
                <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
            <?php } ?>

            <div class="clearer"></div>
<!--            <hr class="a11y" />-->
        </div>
    </div><!-- /header -->

    <!--   Paperclip: this part is for the customization of the start page -->
    <?php
//    global $ID, $_GET, $conf, $ACT, $INFO;
//    $show = $_GET['show'];
    if (showIndex()) { ?>

        <!--   Paperclip's start page     -->
        <div class="paperclip__homewarpper" >
            <div class="paperclip__home">
                <div class="paperclip__doddle">
                    <div class="paperclip__logo">
                        <?php
                        include 'images/home/logo-pet.svg'
                        ?>
                    </div>
                    <p><?php echo tpl_getLang('slogan') ?></p>
                </div>
                <div class="paperclip__search__recommend">
                    <?php tpl_searchform()?>
                    <p><?php echo tpl_getLang('recommend') ?><a href=<?php echo tpl_getconf("recommendLink") ?> target="_blank"><?php echo tpl_getconf('recommendTitle') ?></a></p>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="paperclip__list gridbackground" id="paperclip__list">
            <div class="paperclip__listtitle">
                <?php echo tpl_getLang('fullEntries') ?>
                <div class="paperclip__syntax">
                    <a href="/doku.php?id=wiki:syntax" target="_blank"><?php echo tpl_getLang('editguide') ?></a>
                </div>
            </div>
            <div class="paperclip__listwarpper" id="paperclip__fullentries" >
                <?php include 'header/listForHome' ?>
            </div>
        </div>

    <?php
    } elseif (explode(':', $ID, 1)[0] === 'user') { ?>


    <?php } else { ?>
    <!--   Normal content page     -->
        <?php
        global $ACT;
        if (showContentHeader()) {
            $entryTitle = tpl_pagetitle(null, true);
            $idname = explode(':', $ID);
            $idname = end($idname);
            $filename ='lib/tpl/starter/header/'.$idname;
            include $filename;
            if (showLowerPet($filename)) {
                ?>
                <div class="pet_warpper">
                    <img id="pet_lower" src="lib/tpl/starter/images/pet_lower.png"/>
                    <hr class="vertical_lower"/>
                </div>
                <div class="clear"></div>
                <?php
            }
        }
        ?>

        <div id="dokuwiki__site"><div id="dokuwiki__top" class="site <?php echo tpl_classes(); ?> <?php
            echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
                <?php html_msgarea() /* occasional error and info messages on top of the page */ ?>
                <?php tpl_includeFile('header.html') ?>

                <!-- ********** HEADER ********** -->


                <div class="wrapper">
                    <!-- the cover of entry -->
                    <div class="dokuwiki_overture">
                        <div class='dokuwiki_decoration'></div>
                        <!--                --><?php //tpl_searchform() ?>
                    </div>

                    <!-- ********** ASIDE ********** -->
                    <?php if ($showSidebar): ?>
                        <div id="dokuwiki__aside"><div class="pad aside include group">
                                <?php tpl_includeFile('sidebarheader.html') ?>
                                <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                                <?php tpl_includeFile('sidebarfooter.html') ?>
                                <div class="clearer"></div>
                            </div></div><!-- /aside -->
                    <?php endif; ?>

                    <!-- ********** CONTENT ********** -->
                    <div id="dokuwiki__content"><div class="pad">
                            <?php tpl_flush() /* flush the output buffer */ ?>
                            <?php tpl_includeFile('pageheader.html') ?>


                            <div class="page <?php if (isContentPage()) {echo 'paperclip__content';} ?>">
                                <!-- wikipage start -->
                                <?php tpl_content(false) /* the main content */ ?>
                                <!-- wikipage stop -->
                                <div class="clearer"></div>
                            </div>

                            <?php tpl_flush() ?>
                            <?php tpl_includeFile('pagefooter.html') ?>
                        </div></div><!-- /content -->
                    <?php if (isContentPage()){?>
                        <div class="paperclip__toc">
                            <?php tpl_toc() ?>

                        </div>
                    <?php } ?>

                    <div class="clearer"></div>
                </div><!-- /wrapper -->
                <!-- ********** FOOTER ********** -->
            </div>
        </div></div><!-- /site -->
        <?php if (isContentPage()){?>
            <div class="paperclip__backToTop">
                <svg id="图层_1" data-name="图层 1" viewBox="0 0 100 100"><defs><style>.cls-1{fill:#f7f7f7;}.cls-2{fill:#282828;}</style></defs><title>回形针手册-icons</title><circle class="cls-1" cx="50" cy="50" r="48"/><path class="cls-2" d="M66.2,45,51.4,30.2a1.79,1.79,0,0,0-.31-.25L51,29.87l-.2-.1a1.39,1.39,0,0,0-.19-.06l-.17-.05a1.71,1.71,0,0,0-.78,0l-.17.05a1.39,1.39,0,0,0-.19.06l-.2.1-.14.08a1.79,1.79,0,0,0-.31.25L33.8,45a2,2,0,0,0,2.79,2.79L48,36.35v36a2,2,0,0,0,3.94,0v-36L63.41,47.79a2,2,0,0,0,1.4.58,1.94,1.94,0,0,0,1.39-.58A2,2,0,0,0,66.2,45Z"/></svg>
            </div>
        <?php } ?>
        <div class="no noshow"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
        <!--[if lte IE 8 ]></div><![endif]-->
        <div id="screen__mode" class="no noshow"></div><?php /* helper to detect CSS media query in script.js */ ?>
        <!--    end of the difference-->
    <?php } ?>
        <?php
        if (showFooter()) {
            paperclipFooter();
        }?>
</body>
</html>
