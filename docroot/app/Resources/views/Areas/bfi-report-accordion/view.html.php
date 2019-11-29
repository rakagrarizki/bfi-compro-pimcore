<?= $this->input("title")?>

<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
$years = [];
foreach($reports as $year){
    $years[] = $year->getDate()->format("Y");
}

?>
<?php
    foreach($years as $y ){
        $reports->addConditionParam("YEAR(Date) = ? ", $y,"AND");
        echo $y. "__________ <br>";?>

        <?php foreach($reports as $data):?>
            <?= $data->getFilename();?>
            <?= $data->getUrl();?>
            <?= $data->get?>
            <?php echo "<br>";?>


        <?php endforeach;?>
<?php }
?>