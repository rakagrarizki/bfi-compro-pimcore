<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$this->document->setProperty("site","Text","corporate",true );

?>

<div class="container main-card">
    <div class="page-title"><?= $data->getYear();?></div>
    <div class="page-sub-title"><?= $data->getYear();?></div>
</div>


<div class="container">
<!-- <?php $awards = $data->getAwards();
if($awards){
foreach($awards as $key => $award){
    echo $award->getTitle();
    echo $award->getDescription();
}
}

?> -->
    <div class="row">
        <div class="awards-card col-md-4">
            <div class="title">Indonesia CSR Award-II-2018</div>
            <div class="desc">Platinum Award dalam “Indonesia CSR Award-II-2018” untuk kategori Perusahaan Terbuka Multifinance oleh majalah Economic Review, pada 23 Februari 2018 di Hotel Crowne Plaza Jakarta.ndustry Marketing Champion Yogyakarta 2018Penghargaan “Industry Marketing Champion Yogyakarta 2018” untuk Sektor Multifinance kepada Rifky Kurniawan, Area Manager Yogyakarta BFI Finance, dalam acara “Indonesia Marketeers Festival 2018” oleh MarkPlus, Inc., pada 3 April 2018 di Hotel Royal Ambarrukmo, Yogyakarta.</div>
        </div>
        <div class="awards-card col-md-4">
            <div class="title">Indonesia CSR Award-II-2018</div>
            <div class="desc">ndustry Marketing Champion Yogyakarta 2018Penghargaan “Industry Marketing Champion Yogyakarta 2018” untuk Sektor Multifinance kepada Rifky Kurniawan, Area Manager Yogyakarta BFI Finance, dalam acara “Indonesia Marketeers Festival 2018” oleh MarkPlus, Inc., pada 3 April 2018 di Hotel Royal Ambarrukmo, Yogyakarta.</div>
        </div>
        <div class="awards-card col-md-4">
            <div class="title">Indonesia CSR Award-II-2018</div>
            <div class="desc">Platinum Award dalam “Indonesia CSR Award-II-2018” untuk kategori Perusahaan Terbuka Multifinance oleh majalah Economic Review, pada 23 Februari 2018 di Hotel Crowne Plaza Jakarta.ndustry Marketing Champion Yogyakarta 2018Penghargaan “Industry Marketing Champion Yogyakarta 2018” untuk Sektor Multifinance kepada Rifky Kurniawan, Area Manager Yogyakarta BFI Finance, dalam acara “Indonesia Marketeers Festival 2018” oleh MarkPlus, Inc., pada 3 April 2018 di Hotel Royal Ambarrukmo, Yogyakarta.</div>
        </div>
        <div class="awards-card col-md-4">
            <div class="title">Indonesia CSR Award-II-2018</div>
            <div class="desc">Platinum Award dalam “Indonesia CSR Award-II-2018” untuk kategori Perusahaan Terbuka Multifinance oleh majalah Economic Review, pada 23 Februari 2018 di Hotel Crowne Plaza Jakarta.ndustry Marketing Champion Yogyakarta 2018Penghargaan “Industry Marketing Champion Yogyakarta 2018” untuk Sektor Multifinance kepada Rifky Kurniawan, Area Manager Yogyakarta BFI Finance, dalam acara “Indonesia Marketeers Festival 2018” oleh MarkPlus, Inc., pada 3 April 2018 di Hotel Royal Ambarrukmo, Yogyakarta.</div>
        </div>
    </div>

</div>

<?php $past = $data->getYear()-1;
$next = $data->getYear() + 1;
?>

<div class="container">
    <div class="page-title">Penghargaan Lainnya</div>
</div>

<div class="container">
    <div class="row button-type-18">
        <div class="col-md-6">
            <div class="side-left">
                <?php
                $checkPast = \Pimcore\Model\DataObject\Penghargaan::getByYear($past,1);
                if($checkPast):?>
                <a href="<?= '/'.$this->getLocale().'/award/'.$past?>"> <span class="arrow-left"><i class="icon-next"></i></span> <?= $past ?> </a>
                <?php endif;?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="side-right">
                <?php
                $checkNext = \Pimcore\Model\DataObject\Penghargaan::getByYear($next,1);
                if($checkNext):?>
                <a href="<?= '/'.$this->getLocale().'/award/'.$next?>"> <?= $next ?> <span class="arrow-right"><i class="icon-next"></i></span> </a>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
