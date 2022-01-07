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
                    <div class="col-md-4 col-sm-4 left-side-top">
                        <a id="" class="_personal" href="/<?php echo $this->getLocale() ?>"><?= $this->translate("personal") ?></a>
                        <a class="_grup" href="<?= $this->translate("bfiConnectUrl") ?>" target="_blank"><?= $this->translate("Bisnis") ?></a>
                    </div>
                    <div class="col-md-4 col-sm-4 right-side-top">
                        <div class="link-about-top">
                            <a id="" class="_grup" href="<?= '/' . $this->getLocale() . '/corporate' ?>"><?= $this->translate("corporate") ?></a>
                            <a id="" href="<?=$lang == "id" ? "/id/karir" : "/en/career"  ?>"><?= $this->translate("career") ?></a>
                            <a id="" href="<?=$lang == "id" ? "/id/blog" : "/en/blog"  ?>"><?= $this->translate("blog") ?></a>
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
                        <a id="" href="<?php echo "/" . $this->getLocale(); ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="logo-bfi">
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
                                        if ($hasChildren && (strpos($page->getUri(), '#product') !== false || strpos($page->getUri(), '#layanan') !== false)) {
                                ?>

                                            <div class="dropdown col-md-3 col-sm-3" id="produk">
                                                <a id="" href="#" class="<?php echo $page->getActive() ? 'active' : '' ?> produk"><?= $page->getLabel() ?></a>
                                                <div class="dropdown-content main">
                                                    <div class="produk-hover container">
                                                        <div class="">
                                                            <?php
                                                            foreach ($page->getPages() as $child) {
                                                            ?>
                                                                <div class="col-md-12">
                                                                    <ul>
                                                                        <li>
                                                                            <div class="label-title"><?= $child->getLabel() ?></div>
                                                                        </li>
                                                                        <?php
                                                                            $hasGrandChildren = $child->hasPages();

                                                                            if ($hasGrandChildren) {
                                                                        ?>
                                                                        <div class="row">
                                                                            <?php
                                                                                foreach ($child->getPages() as $grandChild) {
                                                                            ?>
                                                                            <div class="<?= (strpos($page->getUri(), '#product') !== false) ? 'col-md-6' : 'col-md-4' ?>">
                                                                                <?php if ($grandChild->getDocumentType() != "link") : ?>
                                                                                    <li>
                                                                                        <a id="" class="<?php echo $grandChild->getActive() ? 'active' : '' ?>" href="<?= $grandChild->getHref() ?>">
                                                                                            <p class="sub-title"><?= $grandChild->getLabel() ?></p>
                                                                                            <p class="desc-title"><?= $grandChild->document->getProperty("description"); ?></p>
                                                                                        </a>
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
                                                                                <?php
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </div>                                                             
                                                                                <?php } ?>
                                                                        </div>
                                                                            <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            <?php } ?>
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
                    <div class="col-md-3 col-sm-3 header-bottom-login">
                            <?php if (!isset($_COOKIE["customer"])) { ?>
                                <a id="" href="<?= "/" . $lang . "/login"; ?>" class="login"><?= $this->translate("login") ?></a>
                            <?php } else { ?>
                            <div class="user">
                                <a id="" href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name login"><?= strlen($name) > 5 ? substr($name,0,4) . ".." : $name ?></a> | <a href="#" class="logout login" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                            </div>
                            <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation.html.php") ?>

</nav>
<!-- HEADER -->
