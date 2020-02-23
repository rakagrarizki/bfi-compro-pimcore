<!-- START Mobille -->
<?php

use Pimcore\Model\Document;

?>
<?php $lang = $this->getLocale();
$site = $this->document->getProperty("site");
$name = "";
if($_COOKIE["customer"] != "null") {
    $name = $_COOKIE["customer"];
} else {
    $name = "Dashboard";
}
?>
<div class="top-nav--mobille hidden-md">
    <div class="container">
        <div class="row top-nav">

            <?= $this->inc("/" . $this->getLocale() . "/shared/includes/sub-navigation-mobile") ?>
            <div class="col-xs-6 text-right no-padding-mobile">
                <div class="link-log">
                    <?php if (!isset($_COOKIE["customer"])) { ?>
                        <a href="<?= "/" . $lang . "/login"; ?>" class="login"><?= $this->translate("login") ?></a>
                    <?php } else { ?>
                    <div class="user">
                        <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name"><?= $name; ?></a> | <a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo "/" . $this->getLocale(); ?>">
                <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive">
            </a>
            <div class="header-button-wrapper">
                <div class="button-area--nav" id="btn-credit">
                    <?php $credit = Document::getByPath("/" . $this->getLocale() . "/credit/"); ?>
                    <a href="<?php echo $credit->getHref(); ?>" class="cta cta-orange"><?php echo $credit->getTitle(); ?>
                    </a>
                </div>
                <div class="search-button">
                    <?php if ($site == "search") : ?>
                        <a href="javascript:history.back()"><i class="fa fa-times"></i></a>
                    <?php else : ?>
                        <a href="<?= "/" . $lang . "/search" ?>"><i class="fa fa-search"></i></a>
                    <?php endif; ?>
                </div>
                <button type="button" id="btn-burger" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="close-bar">x</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div id="navbar" class="navbar-collapse collapse collapse-mobile" aria-expanded="false">
    <ul class="nav navbar-nav">
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
                if ($hasChildren && strpos($page->getUri(), '#product') !== false) {
        ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?= $page->getLabel() ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($page->getPages() as $child) {
                            ?>
                                <li><a href="#" class="title-dropdown"><?= $child->getLabel() ?></a></li>
                                <?php
                                $hasGrandChildren = $child->hasPages();
                                if ($hasGrandChildren) {
                                    foreach ($child->getPages() as $grandChild) {
                                ?>
                                        <?php if ($grandChild->getDocumentType() != "link") : ?>
                                            <li><a href="<?= $grandChild->getHref() ?>"><?= $grandChild->getLabel() ?></a>
                                            </li>
                                        <?php else : ?>
                                            <li><a href="#" class="title-dropdown"><?= $grandChild->getLabel() ?></a></li>
                                        <?php endif; ?>
                                        <?php
                                        $hasGreatGrandChild = $grandChild->hasPages();
                                        if ($hasGreatGrandChild) {
                                            foreach ($grandChild->getPages() as $greatGrandChild) { ?>
                                                <li>
                                                    <a class="<?php echo $greatGrandChild->getActive() ? 'active' : '' ?>" href="<?= $greatGrandChild->getHref() ?>"><?= $greatGrandChild->getLabel() ?></a>
                                                </li>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="<?php echo $page->getActive() ? 'active' : '' ?>">
                        <a href="<?= $page->getHref() ?>">
                            <?= $page->getLabel() ?>
                        </a>
                    </li>
        <?php
                }
            }
        }
        ?>
        <li role="separator" class="divider"></li>
        <?= $this->inc("/" . $this->getLocale() . "/shared/includes/sub-navigation-burger") ?>
        <li role="separator" class="divider"></li>
        <div class="lang">
            <?php echo $this->template("Includes/mobile-language.html.php") ?>
        </div>
    </ul>
</div>
<!-- END Mobile -->