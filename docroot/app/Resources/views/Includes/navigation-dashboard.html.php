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
$name = "";
if ($_COOKIE["customer"] != "null") {
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
                        <a href="<?php echo "/" . $this->getLocale(); ?>" class="text-btn"><?= $this->translate("backtohome") ?></a>
                    </div>
                    <div class="col-md-6 col-sm-6 right-side-top">
                        <div class="link-log">
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
                        <a href="<?php echo "/" . $this->getLocale() . '/'; ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>
                    </div>
                    <div class="col-md-6 offset-md-3 col-sm-6 header-bottom-menu">
                        <div class="header-link-menu">
                            <div class="nav">
                                <?php

                                $listMenu = Document::getByPath("/" . $this->getLocale() . "/user");
                                $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);
                                if ($subPage) {
                                    foreach ($subPage as $page) {
                                ?>
                                        <div class="col-md-3 col-sm-3" id="produk">
                                            <a href="<?= $page->getHref(); ?>" class="<?php echo $page->getActive() ? 'active' : '' ?>"><?= $page->getLabel() ?></a>

                                        </div>
                                <?php

                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 header-bottom-login">
                        <div class="user">
                            <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name icon login"><?= strlen($name) > 5 ? substr($name,0,4) . ".." : $name ?></a> | <a href="#" class="logout login" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation-dashboard.html.php") ?>

</nav>
<!-- HEADER -->