<!-- HEADER -->
<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;

$lang = $this->getLocale();
$name = "";
if($_COOKIE["customer"] != "null") {
    $name = $_COOKIE["customer"];
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
                        <a href="/<?php echo $this->getLocale() ?>" class="backtohome"><?= $this->translate("backtohome") ?></a>
                    </div>
                    <div class="col-md-6 col-sm-6 right-side-top">
                    <div class="link-log">
                    <?php if (isset($_COOKIE["customer"])) { ?>
                            <!-- <div class="link-about-top">
                                <a href="</?= "/" . $lang . "/tentang-kami" ?>">
                                    </?= $this->translate("tentang-kami") ?></a>
                                <a href="<?= "/" . $lang . "/blog" ?>">
                                    </?= $this->translate("blog") ?></a>
                            </div>
                        </?php } else { ?> -->
                            <div class="user">
                                <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name"><?= $name?></a> | <a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                            </div>
                        <?php } ?>
                            <?php echo $this->template("Includes/language.html.php") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 header-bottom-logo">
                        <a href="<?php echo "/".$this->getLocale(); ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->template("Includes/mobile-navigation-credit.html.php") ?>

</nav>
<!-- HEADER -->