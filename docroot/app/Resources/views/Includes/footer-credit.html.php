<?php
//use AppBundle\Model\DataObject\BlogArticle;
if($this->editmode) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Career</div>
                <div class="col-lg-8"><?=$this->link('career');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Contact Us</div>
                <div class="col-lg-8"><?=$this->link('contact');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Our Branch</div>
                <div class="col-lg-8"><?=$this->link('branch');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Term of Use</div>
                <div class="col-lg-8"><?=$this->link('term');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Privacy Policy</div>
                <div class="col-lg-8"><?=$this->link('privacy');?></div>
            </div>
        </div>
    </div>

<?php endif?>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <span>&copy; <?php echo date("Y"); ?> - PT BFI Finance Indonesia Tbk</span>
            </div>
            <div class="col-sm-7">
                <ul class="nav-footer">
                    <li><a href="<?=$this->link('career')->getHref();?>"><?= $this->translate("career") ?></a></li>
                    <li><a href="<?=$this->link('contact')->getHref();?>"><?= $this->translate("contact") ?></a></li>
                    <li><a href="<?=$this->link('branch')->getHref();?>"><?= $this->translate("branch") ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->