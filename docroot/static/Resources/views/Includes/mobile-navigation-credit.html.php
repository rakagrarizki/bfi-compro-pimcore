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
            <div class="col-xs-6 text-right">
                <div class="link-log">
                    <div class="user hide">
                        <a href="/<?= $this->getLocale() ?>/user/dashboard" class="full_name">Deborah Morris</a>|<a href="#" class="logout" onclick="return logout('<?= $this->getLocale() ?>');"><?= $this->translate("logout") ?></a>
                    </div>
                </div>
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