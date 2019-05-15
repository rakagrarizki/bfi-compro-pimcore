<!-- START Mobille -->
<?php

use Pimcore\Model\Document;

?>
<div class="top-nav--mobille hidden-md">
    <div class="container">
        <div class="row top-nav">
            
            <?= $this->inc("/" . $this->getLocale() . "/shared/includes/sub-navigation-mobile") ?>
            <div class="col-xs-4 text-right">
                <?php echo $this->template("Includes/mobile-language.html.php") ?>
            </div>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false"
                    aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="close-bar">x</span>
            </button>
            <a class="navbar-brand" href="<?php echo "/" . $this->getLocale(); ?>">
                <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive">
            </a>
            <div class="button-area--nav">
                <?php $credit = Document::getByPath("/" . $this->getLocale() . "/credit/"); ?>
                <a href="<?php echo $credit->getHref(); ?>"
                   class="cta cta-orange"><?php echo $credit->getTitle(); ?></a>
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
                if ($hasChildren && strpos($page->getUri(), '#product') !== false) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
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
                                        <li><a href="<?= $grandChild->getHref() ?>"><?= $grandChild->getLabel() ?></a>
                                        </li>
                                        <?php
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
    </ul>
</div>
<!-- END Mobile -->