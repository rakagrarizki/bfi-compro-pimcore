<!-- HEADER -->
<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;

$page = $_SERVER['REQUEST_URI'];
$site = $this->document->getProperty("site");
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
                        <?php if ($site == "corporate") : ?>
                            <?php if (preg_match("/.\/program-csr/", $page) || preg_match("/.\/CSR-Program/", $page)) { ?>
                                <a href="/<?php echo $this->getLocale() ?>/corporate" class="backtohome"><?= $this->translate("backtohome") ?></a>
                            <?php } ?>
                        <?php else : ?>
                            <a href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>" class="backtohome"><?= $this->translate("backtohome") ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-sm-6 right-side-top">
                        <div class="link-log">
                            <?php echo (strpos($this->getHref(),'form') == false) ? $this->template("Includes/language.html.php") : "" ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 header-bottom-logo">
                        <?php if ($site == "corporate") : ?>
                            <a href="<?php echo "/".$this->getLocale()."/corporate"; ?>">
                                <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                            </a>
                        <?php else : ?>
                            <a href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>">
                                <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation-credit.html.php") ?>

</nav>
<!-- HEADER -->