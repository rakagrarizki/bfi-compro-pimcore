<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>
<div class="container">
    <div class="page-title"><?= $this->t("award-title")?></div>
    <div class="row">
        <?php foreach($this->paginator as $key => $award) :?>
            <a href = "<?= '/'. $this->getLocale(). '/award/'.$award->getYear(); ?>">
                <div class="button-type-17 col-md-12">
                    Tahun <?php echo $award->getYear();?>
                    <span class="arrow-right"><i class="icon-next"></i></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
