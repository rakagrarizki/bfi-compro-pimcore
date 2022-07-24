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
                    <div class="col-md-4 col-sm-4 left-side-top">
                        <a id="" class="_grup" href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>"><?= $this->translate("personal") ?></a>
                        <a class="_grup" href="<?= $this->translate("bfiConnectUrl") ?>"><?= $this->translate("Bisnis") ?></a>
                        
                    </div>
                    <div class="col-md-4 col-sm-4 right-side-top">
                        <div class="link-about-top corporate-nav">
                            <a id="" class="_personal text-center" href="<?= '/' . $this->getLocale() . '/corporate' ?>"><?= $this->translate("corporate") ?></a>
                            <a id="" class="text-center" href="<?= $this->websiteConfig("career_link") ? $this->websiteConfig("career_link") : "#"; ?>">
                                <?= $this->translate("career"); ?></a>
                            <!-- <a href=""></a> -->
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 link-log">
                        <?php echo $this->template("Includes/language.html.php") ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-3 header-bottom-logo">
                        <a id="" href="<?php echo "/" . $this->getLocale() . '/corporate'; ?>">
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
                                                <a id="" href="#" class="<?php echo $page->getActive() ? 'active' : '' ?> produk has-child"><?= $page->getLabel() ?></a>
                                                <div class="dropdown-content main">
                                                    <div class="produk-hover container">
                                                        <div class="re-sort corporate-menu">
                                                            <?php
                                                            foreach ($page->getPages() as $child) {
                                                            ?>
                                                                <div class="col-md-6">
                                                                    <ul>
                                                                        <li>
                                                                            <a id="" class="<?php echo $child->getActive() ? 'active' : '' ?>" href="<?= $child->getHref() ?>"><?= $child->getLabel() ?></a>
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
                                                <a id="" href="<?= $page->getHref() ?>">
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
                    <div class="col-md-3 col-sm-3">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation-corporate.html.php") ?>

</nav>
<!-- HEADER -->