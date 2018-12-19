<?php
//use AppBundle\Model\DataObject\BlogArticle;

if($this->editmode) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Facebook</div>
                <div class="col-lg-8"><?=$this->link('facebook');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Twitter</div>
                <div class="col-lg-8"><?=$this->link('twitter');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Instagram</div>
                <div class="col-lg-8"><?=$this->link('instagram');?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">LinkedIn</div>
                <div class="col-lg-8"><?=$this->link('linkedin');?></div>
            </div>
        </div>
    </div>

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

<div id="errorNewsletter" class="modal modal--failed fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content text-center">
            <div class="modal-body">
                <div class="body-text"></div>
                <button type="button" class="cta cta-orange" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-left">
                <h3>PT BFI Finance Indonesia Tbk</h3>
                <p>
                    BFI Tower <br>
                    Sunburst CBD Lot. 1.2 <br>
                    Jl. Kapt. Soebijanto Djojohadikusumo <br>
                    BSD City - Tangerang Selatan 15322
                </p>
            </div>
            <div class="col-md-4 footer-center">
                <span><?= $this->translate("customer-care") ?> <i class="fa fa-phone"></i> 1500018</span>
                <label><?= $this->translate("Newsletter") ?></label>
                <form class="form-inline" id="sendNewsletter" action="javacript:void(0)"
                      method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Your email here...">
                    </div>
                    <div id="ajax-loading"></div>
                    <button type="submit" id="button-klik" class="cta cta-primary submitfoot"><?= $this->translate("submit") ?></button>
                </form>
            </div>
            <div class="col-md-4 footer-right">
                <div class="social-media">
                    <a href="<?=$this->link('facebook')!= "" ?$this->link('facebook')->getHref():'' ?>"><span class="fa fa-facebook"></span></a>
                    <a href="<?=$this->link('twitter')!= "" ?$this->link('twitter')->getHref():'' ?>"><span class="fa fa-twitter"></span></a>
                    <a href="<?=$this->link('instagram')!= "" ?$this->link('instagram')->getHref():'' ?>"><span class="fa fa-instagram"></span></a>
                    <a href="<?=$this->link('linkedin')!= "" ?$this->link('linkedin')->getHref():'' ?>"><span class="fa fa-linkedin"></span></a>
                </div>
                <span><?= $this->translate("text-pengawasan") ?>:</span>
                <img src="/static/images/ojk-logo.png" class="img-ojk">
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    <div class="container">
        <span>&copy; <?php echo date("Y"); ?> - PT BFI Finance Indonesia Tbk</span>
        <ul class="nav-footer">
            <li><a href="<?=$this->link('career')->getHref();?>"><?= $this->translate("career") ?></a></li>
            <li><a href="<?=$this->link('contact')->getHref();?>"><?= $this->translate("contact") ?></a></li>
            <li><a href="<?=$this->link('branch')->getHref();?>"><?= $this->translate("branch") ?></a></li>
            <li><a href="<?=$this->link('term')->getHref();?>"><?= $this->translate("term") ?></a></li>
            <li><a href="<?=$this->link('privacy')->getHref();?>"><?= $this->translate("privacy") ?></a></li>
        </ul>
    </div>
</div>

<!-- FOOTER -->