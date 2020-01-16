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
$name = $_COOKIE["customer"]; ?>
<nav id="site-header">
    <div class="navbar-fixed-top hidden-xs">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 left-side-top">
                        <a href="<?php echo "/" . $this->getLocale() . '/user/dashboard'; ?>" class="text-btn"><?= $this->translate("back") ?></a>
                    </div>
                    <div class="col-md-6 col-sm-6 right-side-top">
                        <div class="link-log">
                            <div class="user hide">
                                <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name icon"><?= $name; ?></a> | <a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                            </div>
                            <?php echo $this->template("Includes/language.html.php") ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 col-sm-4 header-bottom-logo">
                        <a href="<?php echo "/" . $this->getLocale() . '/'; ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>
                    </div>
                    <div class="col-md-8 col-sm-8 header-bottom-menu">
                        <div class="header-link-menu">
                            <ul class="nav">
                                <?php

                                $listMenu = Document::getByPath("/" . $this->getLocale() . "/user");
                                $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);
                                //dump($listMenu);exit;
                                if ($subPage) {
                                    foreach ($subPage as $page) {
                                        //$hasChildren = $page->hasChildren();


                                ?>
                                        <li id="produk">
                                            <a href="<?= $page->getHref(); ?>" class="<?php echo $page->getActive() ? 'active' : '' ?>"><?= $page->getLabel() ?></a>

                                        </li>
                                <?php

                                    }
                                }
                                ?>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation-dashboard.html.php") ?>

</nav>
<!-- HEADER -->