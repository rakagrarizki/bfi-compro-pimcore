<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */
?>

<?php
/** @var \AppBundle\Templating\Helper\LanguageSwitcher $languageSwitcher */
$languageSwitcher = $this->languageSwitcher();
?>

<div class="lang">
    <?php foreach ($languageSwitcher->getLocalizedLinks($this->document) as $link => $text) {
        ?>
        <a href="<?php echo $link; ?>"><?php echo $text; ?></a>
    <?php } ?>
</div>

