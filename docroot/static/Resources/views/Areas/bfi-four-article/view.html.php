<div>
    <div id="article" class="article">
        <div class="container">
            <div class="row">
                <div class="sect-title text-center">
                    <h2><?= $this->input('title');?></h2>
                    <p><?= $this->textarea('text');?></p>
                </div>
                <?php
                $i = 0;
                foreach ($this->blog as $blog){
                    ?>
                    <?php if($i == 0){?>
                        <div class="col-md-3 col-xs-12">
                            <article class="article__post">
                                <div class="article__post__img" style="background-image: url('https://dummyimage.com/600x400/000/ff')">
                                </div>
                                <div class="article__post__text">
                                    <?php
                                    $timestampDate = \Carbon\Carbon::parse($blog->getDate());
                                    $dateUnix = $timestampDate->timestamp;
                                    $date = date("D, d-M'Y", $dateUnix);
                                    ?>
                                    <p><?= $date;?></p>

                                    <h4><a href="#"><?= $blog->getTitle();?></a></h4>
                                </div>
                            </article>
                        </div>
                    <?php }else{?>
                        <div class="col-md-3 col-xs-6">
                            <article class="article__post">
                                <div class="article__post__img" style="background-image: url('https://dummyimage.com/600x400/000/ff')">
                                </div>
                                <div class="article__post__text">
                                    <?php
                                    $timestampDate = \Carbon\Carbon::parse($blog->getDate());
                                    $dateUnix = $timestampDate->timestamp;
                                    $date = date("D, d-M'Y", $dateUnix);
                                    ?>
                                    <p><?= $date;?></p>

                                    <h4><a href="#"><?= $blog->getTitle();?></a></h4>
                                </div>
                            </article>
                        </div>
                    <?php }?>
                    <?php
                    if($i>3){
                        break;
                    }
                    $i++;
                }
                ?>
            </div>
            <div class="row">
                <div class="btn-ajukan text-center margin-top-50 margin-bottom-50">
                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange">
                        <?= $this->link('url')->getText(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>