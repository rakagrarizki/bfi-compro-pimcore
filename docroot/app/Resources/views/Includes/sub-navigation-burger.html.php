<?php if($this->editmode) : ?>
<div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Karir</div>
                <div class="col-lg-8"><?=$this->link('karir');?></div>
            </div>
          
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">About</div>
                <div class="col-lg-8"><?=$this->link('about');?></div>
            </div>
          
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Blog</div>
                <div class="col-lg-8"><?=$this->link('blog');?></div>
            </div>
          
        </div>
    </div>
<?php endif; ?>
<li><a href="<?= '/' . $this->getLocale() . '/corporate' ?>" class="secondary-menu"><?= $this->translate("corporate") ?></a></li>
<li><a id="" href="<?= $this->websiteConfig("career_link") ? $this->websiteConfig("career_link") : "#"; ?>" class="secondary-menu"><?= $this->translate("career"); ?></a></li>
<li><a href="<?=$this->link('blog')!=""?$this->link('blog')->getHref():"#";?>" class="secondary-menu"><?= $this->translate("blog") ?></a></li>
