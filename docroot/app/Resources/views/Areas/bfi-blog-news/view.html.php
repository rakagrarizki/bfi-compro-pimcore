<section id="informasi-inspiratif">
    <div class="container">
        <h2 class="title-wrapper text-center">
            <?= $this->input('title'); ?>
        </h2>
        <p class="text-center paragraf-title">
            <?= $this->textarea('text'); ?>
        </p>
        <div class="row content-bfi">
            <?php            
            $page = $_GET["pimcore_editmode"];
            $site = $this->document->getProperty("site");
            $lang = $this->getLocale();
            $i = 0;
            foreach ($this->news as $news) {
                if ($i == 0) { ?>
                    <div class="col-md-6 col-sm-12 col-xs-12 thumbnail-infor">
                        <div class="thumbnail-body--content">
                            <div class="thumbnail-image modif">
                            <?php } else { ?>
                                <div class="col-md-3 col-sm-6 col-xs-6 thumbnail-infor">
                                    <div class="thumbnail-body--content">
                                        <div class="thumbnail-image">
                                        <?php } ?>
                                        <img src="<?= $news->getImage(); ?>">
                                        </div>
                                        <div class="thumbnail-infomation">
                                            <?php
                                            $timestampDate = \Carbon\Carbon::parse($news->getDate());
                                            $dateUnix = $timestampDate->timestamp;
                                            $date = date("d.m.y", $dateUnix);
                                            ?>
                                            <?php if ($site == "corporate" || $page == "true") {
                                                $category = $news->getCategory()->getName();
                                                $link = "/news";
                                            } else {
                                                $category = $news->getBlogCategory()->getName();
                                                $link = "/blog";
                                            }
                                            dump($page);
                                            ?>
                                            <p><?= $category; ?></p>
                                            <h3><a href="/<?= $lang . $link; ?>/<?= $news->getSlug(); ?>"><?= $news->getTitle(); ?></a></h3>
                                            <p class="date"><?= $date; ?> | <i class="fa fa-eye"></i> <?= $news->getViews(); ?></p>
                                            <!-- <p class="view"><i class="fa fa-eye"></i> </?= $news->getViews(); ?></p> -->
                                        </div>
                                    </div>
                                </div>
                            <?php
                            if ($i > 3) {
                                break;
                            }
                            $i++;
                        }
                            ?>
                            </div>
                            <div class="row">
                                <div class="button-area text-center no-padding">
                                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange cta-see cta-big"><?= $this->translate('more'); ?></a>
                                </div>
                            </div>
                        </div>
</section>

<!-- <section id="blog-news">
    <div class="container">
        <h2>Informasi Inspiratif untuk <br> Kehidupan Finansial Anda</h2>
        <p class="subtitle">Artikel bermanfaat seputar pembiayaan dan modal usaha</p>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="card main-blog">
                    <a href="#">
                        <div class="img-card" style="background-image: url('/static/images/slide2.jpg');">
                        </div>
                        <div class="card-content-wrapper">
                            <p class="category">Sekilas BFI</p>
                            <h6>Mayoritas Pertumbuhan Ekonomi Provinsi Membaik Pada Q3 2018</h6>
                            <div class="date-and-seen">
                                <p class="date">03.11.18</p>
                                <p class="separator">|</p>
                                <p class="seen"><i class="fa fa-eye"></i> 1.234</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="card alt-blog">
                    <a href="#">
                        <div class="img-card" style="background-image: url('/static/images/slide2.jpg');">
                        </div>
                        <div class="card-content-wrapper">
                            <p class="category">Sekilas BFI</p>
                            <h6>Mayoritas Pertumbuhan Ekonomi Provinsi Membaik Pada Q3 2018</h6>
                            <div class="date-and-seen">
                                <p class="date">03.11.18</p>
                                <p class="separator">|</p>
                                <p class="seen"><i class="fa fa-eye"></i> 1.234</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="card alt-blog">
                    <a href="#">
                        <div class="img-card" style="background-image: url('/static/images/slide2.jpg');">
                        </div>
                        <div class="card-content-wrapper">
                            <p class="category">Sekilas BFI</p>
                            <h6>Mayoritas Pertumbuhan Ekonomi Provinsi Membaik Pada Q3 2018</h6>
                            <div class="date-and-seen">
                                <p class="date">03.11.18</p>
                                <p class="separator">|</p>
                                <p class="seen"><i class="fa fa-eye"></i> 1.234</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="btn-wrap">
            <a href="" class="cta cta-orange cta-see cta-big">SELENGKAPNYA</a>
        </div>
        
    </div>
</section> -->