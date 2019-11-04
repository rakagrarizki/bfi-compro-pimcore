<?php
//use AppBundle\Model\DataObject\BlogArticle;

if($this->editmode) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Corporate</div>
                <div class="col-lg-8"><?=$this->link('corporate');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">contact-us</div>
                <div class="col-lg-8"><?=$this->link('contact-us');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">blog</div>
                <div class="col-lg-8"><?=$this->link('blog');?></div>
            </div>
        </div>
    </div>
<?php endif?>

<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 left-side-top">
                <a class="_personal"
                   href="/<?php echo $this->getLocale() ?>"><?= $this->translate("personal") ?></a>
                <a class="_grup" target="<?=$this->link('corporate')!= "" ?$this->link('corporate')->getTarget():'' ?>" href="<?=$this->link('corporate')!= "" ?$this->link('corporate')->getHref():'' ?>">
                    <?= $this->translate("corporate") ?></a>
            </div>
            <div class="col-md-4 col-sm-6 right-side-top clearfix">
                <div class="link-about-top">
                    <a target="<?=$this->link('contact-us')!= "" ?$this->link('contact-us')->getTarget():'' ?>" href="<?=$this->link('contact-us')!= "" ?$this->link('contact-us')->getHref():'' ?>">
                        <?= $this->translate("contact-us") ?></a>
                    <a target="<?=$this->link('blog')!= "" ?$this->link('blog')->getTarget():'' ?>" href="<?=$this->link('blog')!= "" ?$this->link('blog')->getHref():'' ?>">
                        <?= $this->translate("blog") ?></a>
                </div>

                <!--<div class="link-log">
                            <a href="#" class="login"><?/*= $this->translate("login") */?></a>
                            <a href="#" class="register"><?/*= $this->translate("register") */?></a>
                        </div>-->

                <?php echo $this->template("Includes/language.html.php") ?>

            </div>

        </div>
    </div>
</div>