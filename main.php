<?php
/**
 * DokuWiki Starter Template
 *
 * @link     http://dokuwiki.org/template:starter
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
$imagePrefix = 'lib/tpl/starter/images';
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>

<body>
    <?php /* with these Conditional Comments you can better address IE issues in CSS files,
             precede CSS rules by #IE8 for IE8 (div closes at the bottom) */ ?>
    <!--[if lte IE 8 ]><div id="IE8"><![endif]-->

    <?php /* the "dokuwiki__top" id is needed somewhere at the top, because that's where the "back to top" button/link links to */ ?>
    <?php /* tpl_classes() provides useful CSS classes; if you choose not to use it, the 'dokuwiki' class at least
             should always be in one of the surrounding elements (e.g. plugins and templates depend on it) */ ?>
    <div id="dokuwiki__header"><div class="pad">

            <div class="headings">
                <!--                <h1>--><?php ////tpl_link(wl(),$conf['title'],'accesskey="h" title="[H]"') ?><!--</h1>-->
                <?php /* how to insert logo instead (if no CSS image replacement technique is used):
                        upload your logo into the data/media folder (root of the media manager) and replace 'logo.png' accordingly:
                        tpl_link(wl(),'<img src="'.ml('logo.png').'" alt="'.$conf['title'].'" />','id="dokuwiki__top" accesskey="h" title="[H]"') */ ?>
                <?php if ($conf['tagline']): ?>
                    <p class="claim"><?php echo $conf['tagline'] ?></p>
                <?php endif ?>

                <ul class="a11y skip">
                    <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content'] ?></a></li>
                </ul>
                <div class="ZZer"></div>
            </div>

            <div class="tools">
                <!-- USER TOOLS -->
                <?php if ($conf['useacl'] && $showTools): ?>
                    <div id="dokuwiki__usertools">
                        <h3 class="a11y"><?php echo $lang['user_tools'] ?></h3>
                        <ul id="logo_area">
                            <li class="desktop__header">
                                <a href="/doku.php">
                                    <img id="brand" src="lib/tpl/starter/images/brand_white.png" />
                                </a>
                            </li>
                            <li class="desktop__header">
                                <a href="">
                                    <img class="social" id="wechat"  src="lib/tpl/starter/images/wechat_bw.png">
                                </a>
                                <!-- Tongyu: the position of the qrcode is wired, need to be fixed -->
                                <img id="qrcode" src="lib/tpl/starter/images/qrcode.jpg">
                            </li>
                            <li class="desktop__header">
                                <a href="https://www.weibo.com/p/1005056414205745">
                                    <img class="social"  src="lib/tpl/starter/images/weibo_bw.png"/>
                                </a>
                            </li>
                            <li class="desktop__header">
                                <a href="">
                                    <img class="social"  src="lib/tpl/starter/images/video.png">
                                </a>
                            </li>
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
                            <?php tpl_toolsevent('usertools', array(
                                'admin'     => tpl_action('admin', 1, 'li', 1),
//                                'userpage'  => _tpl_action('userpage', 1, 'li', 1),
//                                'profile'   => tpl_action('profile', 1, 'li', 1),
                                'register'  => tpl_action('register', 1, 'li', 1),
                                'login'     => tpl_action('login', 1, 'li', 1),
                            )); ?>
                        </ul>
                        <!--                        <div class="paperclip__gradient"></div>-->
                        <div class="clear"></div>
                    </div>
                <?php endif ?>

                <!-- SITE TOOLS -->
                <div id="dokuwiki__sitetools">
                    <h3 class="a11y"><?php echo $lang['site_tools'] ?></h3>
                    <!--                    --><?php //tpl_searchform() ?>
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
            <hr class="a11y" />
        </div>
    </div><!-- /header -->

    <div class="paperclip__title">
        <?php
        $entryTitle = tpl_pagetitle(null, true);
        $filename ='lib/tpl/starter/header/'.$entryTitle;
        // need some fix here
        $file = fopen($filename, "r");
        if ($file) {
            echo fread($file, filesize($filename));
            fclose($file);
        }
        ?>
        <div class="pet_warpper">
            <hr class="vertical_upper"/>
            <img id="pet_upper" src="lib/tpl/starter/images/pet_upper.png"/>
        </div>
    </div>
    <div class="pet_warpper">
        <img id="pet_lower" src="lib/tpl/starter/images/pet_lower.png"/>
        <hr class="vertical_lower"/>
    </div>
    <div class="clear"></div>

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


                <div class="page">
                    <!-- wikipage start -->
                    <?php tpl_content() /* the main content */ ?>
                    <!-- wikipage stop -->
                    <div class="clearer"></div>
                </div>

                <?php tpl_flush() ?>
                <?php tpl_includeFile('pagefooter.html') ?>
            </div></div><!-- /content -->

            <div class="clearer"></div>
            <hr class="a11y" />

            <!-- PAGE ACTIONS -->
            <?php if ($showTools): ?>
                <div id="dokuwiki__pagetools">
                    <h3 class="a11y"><?php echo $lang['page_tools'] ?></h3>
                    <ul>
                        <?php tpl_toolsevent('pagetools', array(
                            'edit'      => tpl_action('edit', 1, 'li', 1),
                            'discussion'=> _tpl_action('discussion', 1, 'li', 1),
                            'revisions' => tpl_action('revisions', 1, 'li', 1),
                            'backlink'  => tpl_action('backlink', 1, 'li', 1),
                            'subscribe' => tpl_action('subscribe', 1, 'li', 1),
                            'revert'    => tpl_action('revert', 1, 'li', 1),
                            'top'       => tpl_action('top', 1, 'li', 1),
                        )); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div><!-- /wrapper -->

        <!-- ********** FOOTER ********** -->
        <div id="dokuwiki__footer"><div class="pad">
            <div class="doc"><?php tpl_pageinfo() /* 'Last modified' etc */ ?></div>
            <?php tpl_license('button') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
        </div></div><!-- /footer -->

        <?php tpl_includeFile('footer.html') ?>
    </div></div><!-- /site -->
    <div class="paperclip__backToTop">
        <svg id="图层_1" data-name="图层 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><style>.cls-1{fill:#f7f7f7;}.cls-2{fill:#282828;}</style></defs><title>回形针手册-icons</title><circle class="cls-1" cx="50" cy="50" r="48"/><path class="cls-2" d="M66.2,45,51.4,30.2a1.79,1.79,0,0,0-.31-.25L51,29.87l-.2-.1a1.39,1.39,0,0,0-.19-.06l-.17-.05a1.71,1.71,0,0,0-.78,0l-.17.05a1.39,1.39,0,0,0-.19.06l-.2.1-.14.08a1.79,1.79,0,0,0-.31.25L33.8,45a2,2,0,0,0,2.79,2.79L48,36.35v36a2,2,0,0,0,3.94,0v-36L63.41,47.79a2,2,0,0,0,1.4.58,1.94,1.94,0,0,0,1.39-.58A2,2,0,0,0,66.2,45Z"/></svg>
    </div>

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <!--[if lte IE 8 ]></div><![endif]-->
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>
