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

<?php endif?>

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
                <span>Customer Care <i class="fa fa-phone"></i> 1500018</span>
                <label>Newslatter</label>
                <form class="form-inline">
                    <div class="form-group">
                        <input type="password" class="form-control" id="email" placeholder="Your email here...">
                    </div>
                    <button type="submit" class="cta cta-primary">SUBMIT</button>
                </form>
            </div>
            <div class="col-md-4 footer-right">
                <div class="social-media">
                    <a href="<?=$this->link('facebook')!= "" ?$this->link('facebook')->getHref():'' ?>"><span class="fa fa-facebook"></span></a>
                    <a href="<?=$this->link('twitter')!= "" ?$this->link('twitter')->getHref():'' ?>"><span class="fa fa-twitter"></span></a>
                    <a href="<?=$this->link('instagram')!= "" ?$this->link('instagram')->getHref():'' ?>"><span class="fa fa-instagram"></span></a>
                    <a href="<?=$this->link('linkedin')!= "" ?$this->link('linkedin')->getHref():'' ?>"><span class="fa fa-linkedin"></span></a>
                </div>
                <span>BFI registered and supervised by:</span>
                <img src="/static/images/ojk-logo.png" class="img-ojk">
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    <div class="container">
        <span>&copy; <?php echo date("Y"); ?> - PT BFI Finance Indonesia Tbk</span>
        <ul class="nav-footer">
            <li><a href="#">Career</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Our Branch</a></li>
            <li><a href="#">Term of Use</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
    </div>
</div>

<!-- FOOTER -->