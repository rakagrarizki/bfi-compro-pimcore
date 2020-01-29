<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-credit.html.php');

?>

    <?= "MOBIL MIN PRICE: ". $this->websiteConfig("MIN_PRICE_MOBIL");?>
    <?= "MOBIL MAX PRICE: ". $this->websiteConfig("MAX_PRICE_MOBIL");?>

    <?php $arrays = explode(",",$this->websiteConfig("TENOR_MOBIL"));
        foreach ($arrays as $key => $array){
            echo "<br/>" . $array  ;
        }
    ?>

