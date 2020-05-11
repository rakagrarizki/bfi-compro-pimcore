<?php
// this is an auto-generated language switcher, of course you can create your own
$service = new \Pimcore\Model\Document\Service;
$translations = $service->getTranslations($this->document);
$links = [];
$site = $this->document->getProperty("site");
$page = $_SERVER['REQUEST_URI'];
foreach (\Pimcore\Tool::getValidLanguages() as $language) {
    $target = "/" . $language;
    if (preg_match("/.\/blog/", $page) || preg_match("/.\/news/", $page)) {
        if (isset($this->blog)) {
            $target = '/'.$language.'/blog/'.$this->blog->getSlug(true, $language);
        } else if (isset($this->news)) {
            $target = '/'.$language.'/news/'.$this->news->getSlug(true, $language);
        } else if (isset($translations[$language])) {
            $localizedDocument = \Pimcore\Model\Document::getById($translations[$language]);
            if ($localizedDocument) {
                $target = $localizedDocument->getFullPath();
            }
        }
    } else {
        if (isset($translations[$language])) {
            $localizedDocument = \Pimcore\Model\Document::getById($translations[$language]);
            if ($localizedDocument) {
                $target = $localizedDocument->getFullPath();
            }
        }
    }

    $links[$language] = $target;
}
?>
<div class="lang">
    <?php foreach ($links as $lang => $target) { ?>
        <a class="<?php echo $this->getLocale() === $lang ? 'active' : ''; ?> " href="<?php echo $target ?>">
            <?php echo $lang == 'en' ? 'EN' : 'ID' ?>
        </a>
    <?php } ?>
</div>
