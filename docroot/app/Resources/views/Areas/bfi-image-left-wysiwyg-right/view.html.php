<?php $asset = $this->image("image"); ?>
<div class="about-us-page" id="about-us-page">
    <div class="container">
        <div class="row activities-section">
            <div class="col-md-6">
                <div class="side-image" style="background-image: url('<?= $asset->getImage() ?>')"></div>
            </div>
            <div class="col-md-6">
                <?= $this->wysiwyg("text"); ?>
                <?php if (!$this->link("link")->isEmpty()) : ?>
                    <br><br>
                    <div class="row">
                        <div class="button-area text-center no-padding">
                            <a href="<?= $this->link("link")->getHref(); ?>" class="cta cta-orange cta-see cta-big"><?= $this->link("link")->getText(); ?></a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- Template -->

<!-- <div class="container wysiwyg-list-right">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12">
            <img src="/static/images/gedung.jpg">
        </div>
        <div class="col-lg-8 col-md-8 col-12">
            <ul>
                <li>
                    <div class="number">
                        <h4>1.</h4>
                    </div>
                    <div class="content">
                        <h4>Berpikir (Think)</h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Quod vero, labore, magni modi exercitationem eaque ipsam quis explicabo nisi sed nihil accusamus,
                            laborum sunt! Voluptatum in ad tempore aspernatur eum!
                        </p>
                    </div>
                </li>
                <li>
                    <div class="number">
                        <h4>2.</h4>
                    </div>
                    <div class="content">
                        <h4>Bertindak (Act)</h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Quod vero, labore, magni modi exercitationem eaque ipsam quis explicabo nisi sed nihil accusamus,
                            laborum sunt! Voluptatum in ad tempore aspernatur eum!
                        </p>
                    </div>
                </li>
                <li>
                    <div class="number">
                        <h4>3.</h4>
                    </div>
                    <div class="content">
                        <h4>Melestarikan (Preserve)</h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Quod vero, labore, magni modi exercitationem eaque ipsam quis explicabo nisi sed nihil accusamus,
                            laborum sunt! Voluptatum in ad tempore aspernatur eum!
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div> -->

<!-- Template -->