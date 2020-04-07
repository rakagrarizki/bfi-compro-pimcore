<?php $asset = $this->image("image"); ?>
<div class="about-us-page" id="about-us-page">
    <div class="container">
        <div class="row activities-section" style="margin-top: 50px;">
            <!-- <div class="sect-title text-center">
                <h2><?= $this->input('title');?></h2>
            </div> -->
            <div class="col-md-6">
            <div class="side-image" >
                <a href="<?= $asset->getImage()?>" target="_blank"> 
                <img src="<?= $asset->getImage()?>"></a></div>
            </div>
            <div class="col-md-6 text">
                <?php if (!$this->input("title")->isEmpty()) : ?>
                <h3 class="activities-content-title"><?= $this->input('title');?></h3>
                <?php endif; ?>
                <?= $this->wysiwyg("text"); ?>
                <?php if (!$this->link("link")->isEmpty()) : ?>
                    <br><br>
                    <div class="row">
                        <div class="button-area text-center no-padding" style="float: left;margin-left: 1rem;">
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