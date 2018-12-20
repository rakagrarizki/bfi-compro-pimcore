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

                if($i == 0){
                    ?>
                    <div class="col-md-6 col-sm-12 col-xs-12 thumbnail-infor">
                        <div class="thumbnail-body--content">
                        <div class="thumbnail-image modif">
                    <?php
                }else{
                    ?>
                        <div class="col-md-3 col-sm-6 col-xs-6 thumbnail-infor">
                            <div class="thumbnail-body--content">
                            <div class="thumbnail-image">
                    <?php
                }
                ?>
                    
                            <img src="<?= $blog->getImage();?>">
                        </div>
                        <div class="thumbnail-infomation">
                            <?php
                            $timestampDate = \Carbon\Carbon::parse($blog->getDate());
                            $dateUnix = $timestampDate->timestamp;
                            $date = date("D, d-M'Y", $dateUnix);
                            ?>
                            <p><?= $date;?></p>
                            <h3><a href="#"><?= $blog->getTitle();?></a></h3>
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