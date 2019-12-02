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


<!-- Template -->
<div class="container">
    <ul class="card-list-box">
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>Januari 2018</h6>
                <h3>Mandiri Sekuritas</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>Februari 2018</h6>
                <h3>CLSA</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>Maret 2018</h6>
                <h3>DBS Vickers</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>April 2018</h6>
                <h3>CLSA</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
    </ul>
</div>
<!-- Template -->