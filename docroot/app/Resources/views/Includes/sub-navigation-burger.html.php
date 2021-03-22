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
<li><a href="<?=$this->link('about')!=""?$this->link('about')->getHref():"#";?>" class="about"><?= $this->translate("tentang-kami") ?></a></li>
<li><a href="<?=$this->link('karir')!=""?$this->link('karir')->getHref():"#";?>" class="about"><?= $this->translate("karir") ?></a></li>
<li><a href="<?=$this->link('blog')!=""?$this->link('blog')->getHref():"#";?>" class="about"><?= $this->translate("blog") ?></a></li>