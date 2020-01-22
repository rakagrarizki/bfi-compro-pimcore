<!-- START Mobille -->
<?php

use Pimcore\Model\Document;

?>
<div class="top-nav--mobille hidden-md">
    <div class="container">
        <div class="row top-nav">

            <div class="col-xs-6 left-side-top">
                <a href="<?php echo "/" . $this->getLocale() . '/user/dashboard'; ?>" class="text-btn"><?= $this->translate("back") ?></a>
            </div>

            <div class="col-xs-6 text-right">
                <div class="link-log">
                    <div class="user hide">
                        <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name icon"><?= $name; ?></a> | <a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo "/" . $this->getLocale(); ?>">
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
    </ul>
</div>
<!-- END Mobile -->