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

<?php
$pageCurrent = $this->getParam('page', 1);
$lang = $this->getLocale();
?>

<nav id="site-header">
    <div class="navbar-fixed-top hidden-xs">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-8 left-side-top">
                        <a class="_grup" href="/<?php echo $this->getLocale() ?>"><?= $this->translate("personal") ?></a>
                        <a class="_personal" target="<?= $this->link('corporate') != "" ? $this->link('corporate')->getTarget() : '' ?>" href="<?= '/' . $this->getLocale() . '/corporate' ?>">
                            <?= $this->translate("corporate") ?></a>
                    </div>
                    <div class="col-md-3 col-sm-4 right-side-top clearfix">
                        <div class="link-about-top">

                            <a href="<?= $this->websiteConfig("career_link") ? $this->websiteConfig("career_link") : "#"; ?>">
                                <?= $this->translate("career"); ?></a>

                        </div>

                        <?php echo $this->template("Includes/language.html.php") ?>

                    </div>

                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-3 header-bottom-logo">
                        <a href="<?php echo "/" . $this->getLocale() . '/corporate'; ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 header-bottom-menu">
                        <div class="row header-link-menu">
                            <div class="nav">
                                <?php

                                $listMenu = Document::getByPath("/" . $this->getLocale() . "/corporate");
                                $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);
                                if ($subPage) {
                                    foreach ($subPage as $page) {
                                        $hasChildren = $page->hasPages();
                                        if ($hasChildren) {
                                ?>
                                            <div class="dropdown col-md-3 col-sm-3 dark-back" id="produk">
                                                <a href="#" class="<?php echo $page->getActive() ? 'active' : '' ?> produk has-child"><?= $page->getLabel() ?></a>
                                                <div class="dropdown-content main">
                                                    <div class="produk-hover container">
                                                        <div class="re-sort">
                                                            <?php
                                                            foreach ($page->getPages() as $child) {
                                                            ?>
                                                                <div class="col-md-6">
                                                                    <ul>
                                                                        <li>
                                                                            <a class="<?php echo $child->getActive() ? 'active' : '' ?>" href="<?= $child->getHref() ?>"><?= $child->getLabel() ?></a>
                                                                        </li>
                                                                        <?php


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
                                            <div class=" col-md-3 col-sm-3<?php echo $page->getActive() ? 'active' : '' ?>">
                                                <a href="<?= $page->getHref() ?>">
                                                    <?= $page->getLabel() ?>
                                                </a>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <!-- <div class="search-button">
                                <a href="<?= "/" . $lang . "/search" ?>"><i class="fa fa-search"></i></a>
                            </div> -->
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 search-button-container">
                        <?php if ($site == "search") : ?>
                            <a href="javascript:history.back()"><i class="fa fa-times"></i></a>
                        <?php else : ?>
                            <a href="<?= "/" . $lang . "/search" ?>"><i class="fa fa-search"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation-corporate.html.php") ?>

</nav>
<!-- HEADER -->