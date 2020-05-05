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

<div class="container">
    <div class="row">
        <div class="share">
            <div class="share-text">
                <span>Share :</span>
            </div>
            <div class="icon-share">
                <a href="<?= $urlFacebook;?>" class="share-fb" target="_blank"><span class="fa fa-facebook"></span></a>
            </div>
            <div class="icon-share" >
                <a href="<?= $urlTwitter;?>" class="share-tw" target="_blank"><span class="fa fa-twitter"></span></a>
            </div>
            <div class="icon-share">
                <a class="share-cp" id="copy" onclick="copyURL('<?= $fixedurl ?>')"><span class="fa fa-chain"></span></a>
            </div>
            <div style="display: none;padding: 0px 20px;" id="copied">Copied</div>
        </div>
    </div> 
</div> 

