<section id="informasi-inspiratif">
    <div class="container">
        <h2 class="title-wrapper text-center">
            <?= $this->input('title');?>
        </h2>
        <p class="text-center paragraf-title">
            <?= $this->textarea('text');?>
        </p>
        <div class="row content-bfi">
            <?php
            $i = 0;
            foreach ($this->blog as $blog){

                if($i = 0){
                    ?>
                    <div class="col-md-6 thumbnail-infor">
                    <?php
                }else{
                    ?>
                        <div class="col-md-3 thumbnail-infor">
                    <?php
                }
                ?>
                    <div class="thumbnail-body--content">
                        <div class="thumbnail-image">
                            <img src="/assets/images/slide.jpg">
                        </div>
                        <div class="thumbnail-infomation">
                            <p><?= $blog->getDate();?></p>
                            <h3><?= $blog->getTitle();?></h3>
                        </div>
                    </div>
                </div>
                <?php
                if($i>3){
                    break;
                }
                $i++;
            }
            ?>
        </div>
        <div class="row">
            <div class="button-area text-center">
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-see cta-big">SELENGKAPNYA</a>
            </div>
        </div>
    </div>
</section>