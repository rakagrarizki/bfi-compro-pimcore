<!-- HEADER -->
<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
?>
<?php $pageCurrent = $this->getParam('page', 1); ?>
<?php
$site = $this->document->getProperty("site");
$lang = $this->getLocale();
$name = "";
if($_COOKIE["customer"] != "null") {
    $name = htmlspecialchars($_COOKIE["customer"]);
} else {
    $name = "Dashboard";
}
?>

<nav id="site-header">
    <div class="navbar-fixed-top hidden-xs">

        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 left-side-top">
                        <a id="" class="_personal" href="/<?php echo $this->getLocale() ?>"><?= $this->translate("personal") ?></a>
                        <a class="_grup" href="<?= $this->translate("bfiConnectUrl") ?>" target="_blank"><?= $this->translate("Bisnis") ?></a>
                    </div>
                    <div class="col-md-6 col-sm-6 right-side-top">
                            <div class="link-about-top">
                                <a id="" class="_personal" href="<?= '/' . $this->getLocale() . '/corporate' ?>"><?= $this->translate("corporate") ?></a>
                                <a id="" href="<?=$lang == "id" ? "/id/karir" : "/en/career"  ?>"><?= $this->translate("karir") ?></a>
                            </div>
                        <div class="link-log">
                            <?php if (!isset($_COOKIE["customer"])) { ?>
                                <a id="" href="<?= "/" . $lang . "/login"; ?>" class="login"><?= $this->translate("login") ?></a>
                            <?php } else { ?>
                            <div class="user">
                                <a id="" href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name"><?= $name?></a> | <a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                            </div>
                            <?php }?>
                            <?php echo $this->template("Includes/language.html.php") ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-3 header-bottom-logo">
                        <a id="" href="<?php echo "/" . $this->getLocale(); ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 header-bottom-menu">
                        <div class="row header-link-menu">
                            <div class="nav">
                                <?php

                                $listMenu = Document::getByPath("/" . $this->getLocale() . "/");
                                $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);

                                if ($subPage) {
                                    foreach ($subPage as $page) {
                                        $hasChildren = $page->hasPages();

                                        if (strpos($page->getUri(), 'branch-office') !== false) {
                                            continue;
                                        }
                                        if ($page->getHref() == "/" . $this->getLocale() . "/corporate") {
                                            break;
                                        }
                                        if ($hasChildren && (strpos($page->getUri(), '#product') !== false)) {
                                ?>

                                            <div class="dropdown col-md-3 col-sm-3" id="produk" onmouseover="hoverDropdown()" onmouseout="closeDropdown()">
                                                <a id="" href="#" class="<?php echo $page->getActive() ? 'active' : '' ?> produk"><?= $page->getLabel() ?></a>
                                                <div class="dropdown-content main">
                                                    <div class="produk-hover container">
                                                        <div class="">
                                                            <?php
                                                            foreach ($page->getPages() as $child) {
                                                            ?>
                                                                <div class="col-md-6">
                                                                    <ul>
                                                                        <li>
                                                                            <div class="label-title"><?= $child->getLabel() ?></div>
                                                                        </li>
                                                                        <?php

                                                                        $hasGrandChildren = $child->hasPages();

                                                                        if ($hasGrandChildren) {
                                                                            foreach ($child->getPages() as $grandChild) {
                                                                        ?>
                                                                                <?php if ($grandChild->getDocumentType() != "link") : ?>
                                                                                    <li>
                                                                                        <a id="" class="<?php echo $grandChild->getActive() ? 'active' : '' ?>" href="<?= $grandChild->getHref() ?>"><?= $grandChild->getLabel() ?></a>
                                                                                    </li>
                                                                                <?php else : ?>
                                                                                    <li>
                                                                                        <div class="label-title"><?= $grandChild->getLabel(); ?></div>
                                                                                    </li>
                                                                                <?php endif ?>
                                                                                <?php
                                                                                $hasGreatGrandChild = $grandChild->hasPages();
                                                                                if ($hasGreatGrandChild) {
                                                                                    foreach ($grandChild->getPages() as $greatGrandChild) {
                                                                                ?>
                                                                                        <li>
                                                                                            <a id="" class="<?php echo $greatGrandChild->getActive() ? 'active' : '' ?>" href="<?= $greatGrandChild->getHref() ?>"><?= $greatGrandChild->getLabel() ?></a>
                                                                                        </li>
                                                                        <?php }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class=" col-md-3 col-sm-3 <?php echo $page->getActive() ? 'active' : '' ?>">
                                                <a id="" href="<?= $page->getHref() ?>" target="<?= $page->getTarget() ?>">
                                                    <?= $page->getLabel() ?>
                                                </a>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 search-button-container">
                            <?php if ($site == "search") : ?>
                                <a id="" href="javascript:history.back()"><i class="fa fa-times"></i></a>
                            <?php else : ?>
                                <a id="" href="<?= "/" . $lang . "/search" ?>"><i class="fa fa-search"></i></a>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation.html.php") ?>

</nav>
<!-- HEADER -->
