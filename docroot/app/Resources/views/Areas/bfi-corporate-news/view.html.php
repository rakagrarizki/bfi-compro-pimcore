<?php  $category = $this->document->getProperty("category")->getId();
$news = new Pimcore\Model\DataObject\News\Listing();
$news->addConditionParam("Category__id = ?", $category);
$news->load();
?>

<section id="informasi-inspiratif">
    <div class="container">
        <h2 class="title-wrapper text-center" style="padding: 0;margin-bottom: 2rem">
            <?= $this->input('title');?>
        </h2>
        <p class="text-center paragraf-title" style="margin-bottom: 2rem;">
            <?= $this->textarea('text');?>
        </p>
        <div class="row content-bfi" style="padding: 0; width: 100%; margin-bottom: 3rem;">
            <?php
            $i = 0;
            foreach ($news as $data){

                if($i>2){
                    break;
                }
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
                            $date = date("d.m.y", $dateUnix);
                            ?>
                            <p><?= $data->getCategory()->getName(); ?></p>
                            <h3><a href="/<?= $lang; ?>/news/<?= $data->getSlug(); ?>"><?= $data->getTitle();?></a></h3>
                            <p class="date"><?= $date; ?> | <i class="fa fa-eye"></i> <?= $data->getViews(); ?></p>
                        </div>
                    </div>
                </div>
                <?php
                
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
