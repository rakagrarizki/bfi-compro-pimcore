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
            <h2 class="margin-top-10"><?= $this->t("blog-title");?></h2>
            <p><?= $this->t("blog-text1");?></p>
            <p><?= $this->t("blog-text2");?></p>
        </article>
        <div class="pengajuan">
            <div class="cek-pengajuan">
                <form action="#">
                    <div class="_parentboxkirikanan">
                        <div class="_boxkiri">
                            <div class="input-group">
                                <div class="plaintext-cekpengajuan"><?= $this->t("blog-category");?></div>
                            </div>
                        </div>
                        <div class="_boxkanan">
                            <div class="_boxkananchild1">
                                <div class="input-group inputform">
                                    <select class="c-custom-select-home form-control bp-select" id="category"  onchange="this.form.submit()" name="category">
                                        <option value="" <?php echo ($this->getParam("category") == "") ? "selected" : ""; ?>><?= $this->t("all-blog");?></option>
                                        <?php foreach ($this->blogCategories as $category):?>
                                        <option value="<?= $category->getId()?>" <?php echo ($this->getParam("category") == $category->getId()) ? "selected" : ""; ?>><?= $category->getName();?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="list-card">
        <?php foreach($this->blogs as $blog) : ?>
            <a href="<?= '/'.$lang.'/blog/'.$blog->getSlug();?>" class="card-item">
                <picture>
                    <img src="<?= $blog->getImage();?>" alt="">
                </picture>
                <div class="caption">
                    <h3 class="tag">Enterpreneur</h3>
                    <h2 class="title"><?= $blog->getTitle();?></h2>
                    <div class="dateview">
                        <span class="date"><?= $blog->getDate();?></span>
                        <span class="view"><i class="fa fa-eye"></i> 1.234</span>
                    </div>
                </div>
            </a>
        <?php endforeach;?>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li>
                    <a href="javascript:void(0)" aria-label="Previous">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                <li class="active"><a href="javascript:void(0)">1</a></li>
                <li><a href="javascript:void(0)">2</a></li>
                <li><a href="javascript:void(0)">3</a></li>
                <li>
                    <a href="javascript:void(0)" aria-label="Next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
