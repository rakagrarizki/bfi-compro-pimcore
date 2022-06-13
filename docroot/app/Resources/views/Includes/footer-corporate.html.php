<?php
//use AppBundle\Model\DataObject\BlogArticle;
if ($this->editmode) : ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">Whatsapp</div>
                <div class="col-sm-8"><?= $this->link('whatsapp'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">E-mail</div>
                <div class="col-sm-8"><?= $this->link('email'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Facebook</div>
                <div class="col-sm-8"><?= $this->link('facebook'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Twitter</div>
                <div class="col-sm-8"><?= $this->link('twitter'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Instagram</div>
                <div class="col-sm-8"><?= $this->link('instagram'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Youtube</div>
                <div class="col-sm-8"><?= $this->link('youtube'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">LinkedIn</div>
                <div class="col-sm-8"><?= $this->link('linkedin'); ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-4">Peluang Bisnis</div>
                <div class="col-sm-8"><?= $this->link('peluang-bisnis'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Career</div>
                <div class="col-sm-8"><?= $this->link('career'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Contact Us</div>
                <div class="col-sm-8"><?= $this->link('contact'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Our Branch</div>
                <div class="col-sm-8"><?= $this->link('branch'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Term of Use</div>
                <div class="col-sm-8"><?= $this->link('term'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Privacy Policy</div>
                <div class="col-sm-8"><?= $this->link('privacy'); ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-sm-4">Image OJK</div>
                <div class="col-sm-8"><?= $this->image('ojk-image'); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Alt Text Image</div>
                <div class="col-sm-8"><?= $this->input('alt-text-image'); ?></div>
            </div>
        </div>
    </div>
<?php endif ?>

<div id="errorNewsletter" class="modal modal--failed fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content text-center">
            <div class="modal-body">
                <div class="body-text"></div>
                <button type="button" class="cta cta-orange news-ok" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<?= $this->template('Includes/modal.html.php'); ?>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-left">
                <p>PT BFI Finance Indonesia Tbk</p>
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
                <form class="form-inline" id="sendNewsletter" action="/register/newsletter" method="POST">

                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="<?= $this->translate("email-input") ?>">
                        <input type="hidden" name="lang" id="lang" value="<?= $this->getLocale(); ?>">

                    </div>
                    <div id="ajax-loading"></div>
                    <button type="submit" id="button-klik" class="cta cta-primary submitfoot"><?= $this->translate("submit") ?></button>
                </form>
            </div>
            <div class="col-md-4 footer-right">
                <div class="social-media">
                    <a target="<?= $this->link('facebook') != "" ? $this->link('facebook')->getTarget() : '' ?>" href="<?= $this->link('facebook') != "" ? $this->link('facebook')->getHref() : '' ?>"><span><i class="fab fa-facebook-f fa-lg" aria-hidden="true"></i></span></a>
                    <a target="<?= $this->link('instagram') != "" ? $this->link('instagram')->getTarget() : '' ?>" href="<?= $this->link('instagram') != "" ? $this->link('instagram')->getHref() : '' ?>"><span><i class="fab fa-instagram fa-lg" aria-hidden="true"></i></span></a>
                    <a target="<?= $this->link('youtube') != "" ? $this->link('youtube')->getTarget() : '' ?>" href="<?= $this->link('youtube') != "" ? $this->link('youtube')->getHref() : '' ?>"><span><i class="fab fa-youtube fa-lg" aria-hidden="true"></i></span></a>
                    <a target="<?= $this->link('twitter') != "" ? $this->link('twitter')->getTarget() : '' ?>" href="<?= $this->link('twitter') != "" ? $this->link('twitter')->getHref() : '' ?>"><span> <i class="fab fa-twitter fa-lg" aria-hidden="true"></i></span></a>
                    <a target="<?= $this->link('linkedin') != "" ? $this->link('linkedin')->getTarget() : '' ?>" href="<?= $this->link('linkedin') != "" ? $this->link('linkedin')->getHref() : '' ?>"><span><i class="fab fa-linkedin-in fa-lg" aria-hidden="true"></i></span></a>
                    <a target="<?= $this->link('whatsapp') != "" ? $this->link('whatsapp')->getTarget() : '' ?>" href="<?= $this->link('whatsapp') != "" ? $this->link('whatsapp')->getHref() : '' ?>"><span><i class="fab fa-whatsapp fa-lg" aria-hidden="true"></i></span></a>
                    <a target="<?= $this->link('email') != "" ? $this->link('email')->getTarget() : '' ?>" href="<?= $this->link('email') != "" ? $this->link('email')->getHref() : '' ?>"><span><i class="fas fa-envelope fa-lg" aria-hidden="true"></i></span></a>
                </div>
                <span><?= $this->translate("text-pengawasan") ?></span>
                <?php
                    $asset = $this->image("ojk-image");
                    if($asset) :
                ?>
                    <img src="<?= $asset->getImage() ?>" class="img-ojk" alt="<?= $this->input('alt-text-image') ?>">
                <?php endif; ?>
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
                    <li><a href="<?= $this->link('career')->getHref(); ?>"><?= $this->translate("career") ?></a></li>
                    <li><a href="<?= $this->link('peluang-bisnis')->getHref(); ?>"><?= $this->translate("peluang-bisnis") ?></a></li>
                    <li><a href="<?= $this->link('contact')->getHref(); ?>"><?= $this->translate("contact") ?></a></li>
                    <li><a href="<?= $this->link('branch')->getHref(); ?>"><?= $this->translate("branch") ?></a></li>
                    <li><a href="<?= $this->link('term')->getHref(); ?>"><?= $this->translate("term") ?></a></li>
                    <li><a href="<?= $this->link('privacy')->getHref(); ?>"><?= $this->translate("privacy") ?></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->