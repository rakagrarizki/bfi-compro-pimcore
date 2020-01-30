<?php if($this->editmode) : ?>
<div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Corporate</div>
                <div class="col-lg-8"><?=$this->link('corporate');?></div>
            </div>
          
        </div>
    </div>
<?php endif; ?>

<div class="col-xs-8">
    <a class="_personal" href="/<?php echo $this->getLocale() ?>"
        class="cta-top-nav active"><?= $this->translate("personal") ?></a>
    <a class="_grup" href="<?= $this->link('corporate')!= "" ?$this->link('corporate')->getHref() :'#';?>" class="cta-top-nav"><?= $this->translate("corporate") ?></a>
</div>