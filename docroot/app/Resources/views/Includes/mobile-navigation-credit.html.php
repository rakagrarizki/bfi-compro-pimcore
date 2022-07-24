<!-- START Mobille -->
<?php
use Pimcore\Model\Document;
$page = $_SERVER['REQUEST_URI'];
$site = $this->document->getProperty("site");
?>
<div class="top-nav--mobille hidden-md">
    <div class="container">
        <div class="row top-nav">
            <div class="col-xs-8">
                <?php if ($site == "corporate") : ?>
                    <?php if (preg_match("/.\/program-csr/", $page) || preg_match("/.\/CSR-Program/", $page)) { ?>
                        <a href="/<?php echo $this->getLocale() ?>/corporate" class="backtohome"><?= $this->translate("backtohome") ?></a>
                    <?php } ?>
                <?php else : ?>
                    <a href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>" class="backtohome"><?= $this->translate("backtohome") ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="navbar-header row">
            <?php if ($site == "corporate") : ?>
            <a class="navbar-brand col-xs-12" href="<?php echo "/".$this->getLocale()."/corporate"; ?>">
                <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive header-image-product">
            </a>
            <?php else : ?>
            <a class="navbar-brand col-xs-12" href="/<?= $this->getLocale() == 'en' ? $this->getLocale() : ''; ?>">
                <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive header-image-product">
            </a>
            <?php endif; ?>
            <div>
                &nbsp;
            </div>
        </div>
    </div>
</div>
<!-- END Mobile -->
