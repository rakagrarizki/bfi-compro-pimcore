<!-- START Mobille -->
<?php
use Pimcore\Model\Document;
?>
<div class="top-nav--mobille hidden-md">
    <div class="container">
        <div class="row top-nav">
            <div class="col-xs-8">
                <a href="/<?php echo $this->getLocale() ?>" class="backtohome"><?= $this->translate("backtohome
                ") ?></a>
            </div>
            <div class="col-xs-4 text-right">
                <?php echo $this->template("Includes/mobile-language.html.php") ?>
            </div>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo "/".$this->getLocale(); ?>">
                <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive">
            </a>
        </div>
    </div>
</div>
<!-- END Mobile -->