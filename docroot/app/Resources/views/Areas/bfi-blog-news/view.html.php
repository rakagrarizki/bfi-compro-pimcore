<section id="informasi-inspiratif">
    <div class="container">
        <h2 class="title-wrapper text-center">
            <?= $this->input('title');?>
        </h2>
        <p class="text-center paragraf-title">
            <?= $this->textarea('text');?>
        </p>
        <div class="row content-bfi">
            <div class="col-md-6 thumbnail-infor">
                <div class="thumbnail-body--content">
                    <div class="thumbnail-image">
                        <img src="assets/images/slide.jpg">
                    </div>
                    <div class="thumbnail-infomation">
                        <p>Wed, 02-11-2018</p>
                        <h3>The Financial Advice I Would Give Every 25 Year Old</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 thumbnail-infor">
                <div class="thumbnail-body--content">
                    <div class="thumbnail-image">
                        <img src="https://www.digitalcare.org/wp-content/uploads/2016/11/Free-Desktop-Wallpaper-feature-696x465.jpg">
                    </div>
                    <div class="thumbnail-infomation">
                        <p>Wed, 02-11-2018</p>
                        <h3>The Financial Advice I Would Give Every 25 Year Old</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 thumbnail-infor">
                <div class="thumbnail-body--content">
                    <div class="thumbnail-image">
                        <img src="https://www.digitalcare.org/wp-content/uploads/2016/11/Free-Desktop-Wallpaper-feature-696x465.jpg">
                    </div>
                    <div class="thumbnail-infomation">
                        <p>Wed, 02-11-2018</p>
                        <h3>The Financial Advice I Would Give Every 25 Year Old</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="button-area text-center">
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-see cta-big">SELENGKAPNYA</a>
            </div>
        </div>
    </div>
</section>