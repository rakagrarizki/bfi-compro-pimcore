<?= $this->input("title")?>

<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");

?>
<?php foreach($reports as $data):?>
<?= $data->getFilename();?>
<?= $data->getUrl();?>
<?= $data->get?>


<?php endforeach;?>
