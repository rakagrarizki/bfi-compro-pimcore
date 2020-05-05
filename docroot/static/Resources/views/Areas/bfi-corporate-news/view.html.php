<?php  $category = $this->document->getProperty("category")->getId();
$news = new Pimcore\Model\DataObject\News\Listing();
$news->addConditionParam("Category__id = ?", $category);
$news->load();
?>

<section id="informasi-inspiratif">
    <div class="container">
        <h2 class="title-wrapper text-center">
            <?= $this->input('title');?>
        </h2>
        <p class="paragraf-title t-p">
            <?= $this->textarea('text');?>
        </p>
        <div class="row content-bfi">
            <?php
            $i = 0;
            foreach ($news as $data){

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

                            <img src="<?= $data->getImage();?>">
                        </div>
                        <div class="thumbnail-infomation">
                            <?php
                            $timestampDate = \Carbon\Carbon::parse($data->getDate());
                            $dateUnix = $timestampDate->timestamp;
                            $date = date("D, d-M'Y", $dateUnix);
                            ?>
                            <p><?= $date;?></p>
                            <h3><a href="/blog/<?=$data->getSlug();?>"><?= $data->getTitle();?></a></h3>
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
            <div class="button-area text-center no-padding">
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange cta-see cta-big">SELENGKAPNYA</a>
            </div>
        </div>
    </div>
</section>
