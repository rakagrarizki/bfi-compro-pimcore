<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
?>
<?= "RUMAH MIN PRICE: ". $this->websiteConfig("MIN_PRICE_RUMAH");?>
<?= "RUMAH MAX PRICE: ". $this->websiteConfig("MAX_PRICE_RUMAH");?>

<?php $arrays = explode(",",$this->websiteConfig("TENOR_RUMAH"));
foreach ($arrays as $key => $array){
    echo "<br/>" . $array  ;
}
?>