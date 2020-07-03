<div>
    <div id="article" class="article padding-bottom-5">
        <div class="container">
            <div class="row">
                <div class="sect-title text-center">
                    <h2><?= $this->input('title');?></h2>
                    <p><?= $this->textarea('text');?></p>
                </div>
                <?php
                $i = 0;
                foreach ($this->blog as $blog){
                    $image = "https://dummyimage.com/600x400/000/ff";
                    if($blog->getImage() != null || $blog->getImage() != "") {
                        $image = $blog->getImage();
                     } 
                    ?>
                    <?php if($i == 0){?>
                        <div class="col-md-3 col-xs-12">
                            <article class="article__post">
                                <div class="article__post__img" style="background-image: url('<?= $image; ?>')">
                                </div>
                                <div class="article__post__text">
                                    <?php
                                    $timestampDate = \Carbon\Carbon::parse($blog->getDate());
                                    $dateUnix = $timestampDate->timestamp;
                                    $date = date("d.m.y", $dateUnix);
                                    ?>
                                    <p class="tag"><?= $blog->getBlogCategory()->getName(); ?></p>
                                    <h3><a href="/<?= $this->getLocale() . "/blog"; ?>/<?= $blog->getSlug(); ?>"><?= $blog->getTitle();?></a></h4>
                                    <p class="dateview"><?= $date;?> | <i class="fa fa-eye"></i> <?= $blog->getViews(); ?></p>
                                </div>
                            </article>
                        </div>
                    <?php }else{?>
                        <div class="col-md-3 col-xs-6">
                            <article class="article__post">
                                <div class="article__post__img" style="background-image: url('<?= $image; ?>')">
                                </div>
                                <div class="article__post__text">
                                    <?php
                                    $timestampDate = \Carbon\Carbon::parse($blog->getDate());
                                    $dateUnix = $timestampDate->timestamp;
                                    $date = date("d.m.y", $dateUnix);
                                    ?>
                                    <p class="tag"><?= $blog->getBlogCategory()->getName(); ?></p>
                                    <h3><a href="/<?= $this->getLocale() . "/blog"; ?>/<?= $blog->getSlug(); ?>"><?= $blog->getTitle();?></a></h3>
                                    <p class="dateview"><?= $date;?> | <i class="fa fa-eye"></i> <?= $blog->getViews(); ?></p>
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
                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange" id="<?= $this->link('url')->getParameters()?>">
                        <?= $this->link('url')->getText(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>