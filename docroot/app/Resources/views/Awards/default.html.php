<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>
<?php foreach($this->paginator as $key => $award) :?>
    <a href = "<?= '/'. $this->getLocale(). '/award/'.$award->getYear(); ?>"><?php echo $award->getYear();?></a>
<?php endforeach; ?>
