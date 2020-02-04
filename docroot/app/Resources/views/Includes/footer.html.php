<?php
//use AppBundle\Model\DataObject\BlogArticle;

if ($this->editmode) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Facebook</div>
                <div class="col-lg-8"><?= $this->link('facebook'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Twitter</div>
                <div class="col-lg-8"><?= $this->link('twitter'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Instagram</div>
                <div class="col-lg-8"><?= $this->link('instagram'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Youtube</div>
                <div class="col-lg-8"><?= $this->link('youtube'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">LinkedIn</div>
                <div class="col-lg-8"><?= $this->link('linkedin'); ?></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">Career</div>
                <div class="col-lg-8"><?= $this->link('career'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Peluang Bisnis</div>
                <div class="col-lg-8"><?= $this->link('peluang-bisnis'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Contact Us</div>
                <div class="col-lg-8"><?= $this->link('contact'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Our Branch</div>
                <div class="col-lg-8"><?= $this->link('branch'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Term of Use</div>
                <div class="col-lg-8"><?= $this->link('term'); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4">Privacy Policy</div>
                <div class="col-lg-8"><?= $this->link('privacy'); ?></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">Image OJK</div>
        <div class="col-sm-8"><?= $this->image('ojk-image'); ?></div>
    </div>

<?php endif ?>

<!-- Modal-branch -->
<div class="modal fade" id="errorNewsletter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content newsletter">
    <div class="modal-body">
                <div class="body-text"></div>
                <button type="button" id="button-klik" class="cta cta-orange news-ok" data-dismiss="modal">Ok</button>
        </div>
    </div>
  </div>
</div>
<!-- end Modal branch -->


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
                <p>
                    Phone +62 21 2965 0300, 2965 0500 <br>
                    Fax +62 21 2965 0757, 2965 0758
                </p>
            </div>
            <div class="col-md-4 footer-center">
                <span><a href="tel:1500018"><?= $this->translate("customer-care") ?> <img src="/static/images/icon/telephone.png" alt=""> 1500018</a></span>
                <label><?= $this->translate("Newsletter") ?></label>
                <form class="form-inline" id="sendNewsletter" action="<?= BASEURL . '/newsletter' ?>" method="POST">

                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="<?= $this->translate("email-input") ?>">
                        <input type="hidden" name="lang" id="lang" value="<?= $this->getLocale(); ?>">

                    </div>
                    <div id="ajax-loading"></div>
                    <button type="submit" class="cta cta-primary submitfoot"><?= $this->translate("submit") ?></button>
                </form>
            </div>
            <div class="col-md-4 footer-right">
                <div class="social-media">
                    <a target="<?= $this->link('facebook') != "" ? $this->link('facebook')->getTarget() : '' ?>" href="<?= $this->link('facebook') != "" ? $this->link('facebook')->getHref() : '' ?>"><span class="fa fa-facebook"></span></a>
                    <a target="<?= $this->link('twitter') != "" ? $this->link('twitter')->getTarget() : '' ?>" href="<?= $this->link('twitter') != "" ? $this->link('twitter')->getHref() : '' ?>"><span class="fa fa-twitter"></span></a>
                    <a target="<?= $this->link('instagram') != "" ? $this->link('instagram')->getTarget() : '' ?>" href="<?= $this->link('instagram') != "" ? $this->link('instagram')->getHref() : '' ?>"><span class="fa fa-instagram"></span></a>
                    <a target="<?= $this->link('youtube') != "" ? $this->link('youtube')->getTarget() : '' ?>" href="<?= $this->link('youtube') != "" ? $this->link('youtube')->getHref() : '' ?>"><span class="fa fa-youtube-play"></span></a>
                    <a target="<?= $this->link('linkedin') != "" ? $this->link('linkedin')->getTarget() : '' ?>" href="<?= $this->link('linkedin') != "" ? $this->link('linkedin')->getHref() : '' ?>"><span class="fa fa-linkedin"></span></a>
                </div>
                <span><?= $this->translate("text-pengawasan") ?>:</span>
                <?php $asset = $this->image("ojk-image"); ?>
                <img src="<?= $asset->getImage() ?>" class="img-ojk">
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <span>&copy; <?php echo date("Y"); ?> - PT BFI Finance Indonesia Tbk</span>
            </div>
            <div class="col-sm-8">
                <ul class="nav-footer">
                    <li><a href="<?= $this->link('career')->getHref(); ?>"><?= $this->translate("career"); ?></a></li>
                    <li><a href="<?= $this->link('peluang-bisnis')->getHref(); ?>"><?= $this->translate("peluang-bisnis"); ?></a></li>
                    <li><a href="<?= $this->link('contact')->getHref(); ?>"><?= $this->translate("contact"); ?></a></li>
                    <li><a href="<?= $this->link('branch')->getHref(); ?>"><?= $this->translate("branch"); ?></a></li>
                    <li><a href="<?= $this->link('term')->getHref(); ?>"><?= $this->translate("term"); ?></a></li>
                    <li><a href="<?= $this->link('privacy')->getHref(); ?>"><?= $this->translate("privacy"); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->