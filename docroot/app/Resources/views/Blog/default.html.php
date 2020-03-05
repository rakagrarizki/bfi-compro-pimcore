<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$lang = $this->getLocale();
?>

<div class="blog-promo">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="title"><?= $this->t("blog-title"); ?></h2>
            <p class="subtitle"><?= $this->t("blog-text1"); ?></p>
            <p><?php //echo $this->t("blog-text2");
                ?></p>
        </article>
        <div class="pengajuan">
            <div class="cek-pengajuan">
                <form method="get">
                    <div class="_parentboxkirikanan">
                        <div class="_boxkiri">
                            <div class="input-group">
                                <div class="plaintext-cekpengajuan"><?= $this->t("blog-category"); ?></div>
                            </div>
                        </div>
                        <div class="_boxkanan">
                            <div class="_boxkananchild1">
                                <div class="input-group inputform">
                                    <select class="c-custom-select-home form-control bp-select" id="category" onchange="this.form.submit()" name="category">
                                        <option value="<?php echo ($this->getParam("category") == "") ? "selected" : ""; ?>"><?= $this->t("all-blog"); ?></option>
                                        <?php foreach ($this->blogCategories as $category) : ?>
                                            <option value="<?= $category->getId() ?>" <?php echo ($this->getParam("category") == $category->getId()) ? "selected" : ""; ?>><?= $category->getName(); ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if (count($this->paginator) > 0) { ?>
            <div class="list-card">
                <?php foreach ($this->paginator as $blog) : ?>
                    <a href="<?= '/' . $lang . '/blog/' . $blog->getSlug(); ?>" class="card-item">
                        <picture>
                            <img src="<?= $blog->getImage(); ?>" alt="">
                        </picture>
                            <?php
                                $timestampDate = \Carbon\Carbon::parse($blog->getDate());
                                $dateUnix = $timestampDate->timestamp;
                                $date = date("d.m.y", $dateUnix);
                            ?>
                        <div class="caption">
                            <h3 class="tag"><?= $blog->getBlogCategory()->getName(); ?></h3>
                            <h2 class="title"><?= $blog->getTitle(); ?></h2>
                            <div class="dateview">
                                <span class="date"><?= $date; ?></span>
                                <span class="view"><i class="fa fa-eye"></i> <?= $blog->getViews(); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php } ?>

        <?php if (count($this->paginator) > 1) : ?>
            <?= $this->render("Includes/paging.html.php", get_object_vars($this->paginator->getPages("Sliding")), [
                'urlprefix' => $this->document->getFullPath() . '?page=', // just example (this parameter could be used in paging.php to construct the URL)
                'appendQueryString' => true // just example (this parameter could be used in paging.php to construct the URL)
            ]); ?>
        <?php endif; ?>
    </div>
</div>