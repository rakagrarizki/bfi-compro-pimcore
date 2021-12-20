<section id="blog-news">
    <div class="container" id="promo-article">
        <h2 class="promo-article-title text-center"><?= $this->input("title")->isEmpty() ? "Promo dan Informasi Inspiratif untuk Kehidupan Finansial Anda" : $this->input("title"); ?></h2>
        <p class="subtitle"><?= $this->input("sub-title"); ?></p>
        <div class="row card-list">
            <div class="col-md-6 col-xs-12">
                <?php
                    $lang = $this->getLocale();
                    $path = "/" . $lang . "/" . $data['category'] . "/" . $data['contents']->getSlug();
                ?>
                <div class="card main-blog card-promo">
                    <a href="<?= $path; ?>">
                        <div class="img-card" style="background-image: url('<?= $data['contents']->getImage(); ?>')">
                        </div>
                        <div class="card-content-wrapper">
                            <p class="category"><?= ($data['category'] == 'blog') ? $data['contents']->getBlogCategory()->getName() : $data['contents']->getPromoCategory()->getName(); ?></p>
                            <h6><?= substr($data['contents']->getTitle(),0,40) . '...'; ?></h6>
                            <p><?= substr($data['contents']->getContent(),0,50) . '...'; ?></p>
                            <div class="date-and-seen">
                                <p class="date"><?= $data['contentsDate']; ?></p>
                                <p class="seen"><?php if($data['category'] == 'blog') : ?><i class="fa fa-eye"></i> <?= $data['contents']->getViews(); endif; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 alt-blogs">
                <?php
                    foreach ($data['news'] as $key => $item) {
                        $path = "/" . $lang . "/blog/" . $item->getSlug();
                ?>
                <div class="row">
                    <div class="col">
                        <div class="card alt-blog">
                            <a href="<?= $path; ?>">
                                <div class="row">
                                    <div class="col-xs-5 article-img">
                                        <div class="img-card" style="background-image: url('<?= $item->getImage(); ?>')">
                                        </div>
                                    </div>
                                    <div class="col-xs-7 article-content">
                                        <div class="card-content-wrapper">
                                            <p class="category"><?= $item->getBlogCategory()->getName(); ?></p>
                                            <h6><?= substr($item->getTitle(),0,23) . '...'; ?></h6>
                                            <p><?= substr($item->getContent(),0,60) . '...'; ?></p>
                                            <div class="date-and-seen">
                                                <p class="date"><?= $data['newsDate'][$key]; ?></p> 
                                                <p class="seen"><i class="fa fa-eye"></i> <?= $item->getViews(); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="btn-ajukan">
            <a href="<?= $this->link('url')->getHref(); ?>" target="<?= $this->link("url")->getTarget(); ?>" class="cta cta-orange <?= $this->link('url')->getClass(); ?>" id="<?= $this->link('url')->getParameters()?>"><?= $this->link('url')->getText(); ?></a>
        </div>
    </div>
</section>