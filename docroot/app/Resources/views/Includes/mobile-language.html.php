<?php
// this is an auto-generated language switcher, of course you can create your own
$service = new \Pimcore\Model\Document\Service;
$translations = $service->getTranslations($this->document);
$links = [];
foreach (\Pimcore\Tool::getValidLanguages() as $language) {
    $target = "/" . $language;
    if (isset($translations[$language])) {
        $localizedDocument = \Pimcore\Model\Document::getById($translations[$language]);
        if ($localizedDocument) {
            $target = $localizedDocument->getFullPath();
        }
    }
    $links[$language] = $target;
}
?>

<?php foreach ($links as $lang => $target) { ?>
    <a class="cta-top-nav <?php echo $this->getLocale() === $lang ? 'active' : ''; ?> <?php echo $lang == 'en' ? '_EN' : '_ID' ?>"
       href="<?php echo $target ?>">
        <?php echo $lang == 'en' ? 'EN' : 'ID' ?>
    </a>
<?php } ?>