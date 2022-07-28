<!-- START Mobille -->
<?php

use Pimcore\Model\Document;

?>
<?php $name = "";
if($_COOKIE["customer"] != "null") {
    $name = htmlspecialchars($_COOKIE["customer"]);
} else {
    $name = "Dashboard";
} ?>
<div class="top-nav--mobille hidden-md">
    <div class="container">
        <div class="row top-nav">
            <div class="col-xs-6 left-side-top">
                <a href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>" class="text-btn"><?= $this->translate("backtohome") ?></a>
            </div>
            <div class="col-xs-6 text-right">
                <div class="lang">
                    <?php echo $this->template("Includes/mobile-language.html.php") ?>
                </div>
            </div>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>">
                <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive">
            </a>
            <div class="header-button-wrapper">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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

        $listMenu = Document::getByPath("/" . $this->getLocale() . "/user");
        $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);

        if ($subPage) {
            foreach ($subPage as $page) {
                $hasChildren = $page->hasPages();

                if (strpos($page->getUri(), 'branch-office') !== false) {
                    continue;
                }
        ?>
                <li class="dropdown">
                    <a href="<?= $page->getHref(); ?>" class="<?= $page->getActive() ? "active" : "" ?>" role="button" aria-haspopup="true" aria-expanded="false">
                        <?= $page->getLabel() ?>
                    </a>
                </li>
        <?php
            }
        }
        ?>
        <li role="separator" class="divider"></li>
        <div class="link-log">
            <?php if (!isset($_COOKIE["customer"])) { ?>
                <a href="<?= "/" . $lang . "/login"; ?>" class="login"><?= $this->translate("login") ?></a>
            <?php } else { ?>
            <div class="user">
                <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name"><?= strlen($name) > 5 ? substr($name,0,4) . ".." : $name ?></a> | <a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
            </div>
            <?php } ?>
        </div>
    </ul>
</div>
<!-- END Mobile -->