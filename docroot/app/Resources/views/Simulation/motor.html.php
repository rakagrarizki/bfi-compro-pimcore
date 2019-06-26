<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');
?>

<?= "MOTOR MIN PRICE: ". $this->websiteConfig("MIN_PRICE_MOTOR");?>
<?= "MOTOR MAX PRICE: ". $this->websiteConfig("MAX_PRICE_MOTOR");?>

<?php $arrays = explode(",",$this->websiteConfig("TENOR_MOTOR"));
foreach ($arrays as $key => $array){
    echo "<br/>" . $array  ;
}
?>