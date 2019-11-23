<?php

$titleshare = $this->input("title");
$lang = $this->getLocale();
$asset = $this->image("Image");
//$fixedurl = $this->link("url")->getHref();
$fixedurl = BASEURL . $this->document->getFullPath();
$imagethumbnail = $asset->getImage();
//$urlcheck = Pimcore\Model\Asset::getByPath($imagethumbnail);
$urlFacebook = " https://www.facebook.com/sharer/sharer.php?u=" . $fixedurl . "&title=" . $titleshare . "&picture=" . $imagethumbnail;
$urlTwitter = " https://twitter.com/share?text=$titleshare&url=$fixedurl&wrap_links=true "; ?>

<div class="share">
    <span>Share:</span>
    <a href="<?= $urlFacebook;?>" class="share-fb"><i class="fa fa-facebook"></i></a>
    <a href="<?= $urlTwitter;?>" class="share-tw"><i class="fa fa-twitter"></i></a>
    <a class="share-cp" id="copy" onclick="copyURL('<?= $fixedurl ?>')"><i class="fa fa-chain"></i></a>
    <div style="display: none;padding: 0px 20px;" id="copied">Copied</div>
</div>
