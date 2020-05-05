<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>
<div class="container">
    <div class="page-title">
        <h2 class="page-title-content"><?= $this->t("award-title")?></h2>
    </div>
    <div class="row">
        <?php foreach($this->paginator as $key => $award) :?>
            <a href = "<?= '/'. $this->getLocale(). '/award/'.$award->getYear(); ?>">
                <div class="button-type-17 col-md-12">
                    <?= $this->translate("year"); ?> <?php echo $award->getYear();?>
                    <span class="arrow-right"><i class="icon-next"></i></span>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
    <?php if (count($paginator) > 1) : ?>
        <?= $this->render("Includes/paging.html.php", get_object_vars($paginator->getPages("Sliding")), [
            'urlprefix' => $this->document->getFullPath() . '?page=', // just example (this parameter could be used in paging.php to construct the URL)
            'appendQueryString' => true // just example (this parameter could be used in paging.php to construct the URL)
        ]); ?>
    <?php endif; ?>
</div>
