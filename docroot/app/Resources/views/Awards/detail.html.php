<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$this->document->setProperty("site","Text","corporate",true );

?>
<?= $data->getYear();?>
<?php $awards = $data->getAwards();
if($awards){
foreach($awards as $key => $award){
    echo $award->getTitle();
    echo $award->getDescription();
}
}

?>

<?php $past = $data->getYear()-1;
$next = $data->getYear() + 1;
?>

<?php
$checkPast = \Pimcore\Model\DataObject\Penghargaan::getByYear($past,1);
if($checkPast):?>
<a href="<?= '/'.$this->getLocale().'/award/'.$past?>"> <?= $past ?> </a>
<?php endif;?>
<?php
$checkNext = \Pimcore\Model\DataObject\Penghargaan::getByYear($next,1);
if($checkNext):?>
<a href="<?= '/'.$this->getLocale().'/award/'.$next?>"> <?= $next ?> </a>
<?php endif;?>
