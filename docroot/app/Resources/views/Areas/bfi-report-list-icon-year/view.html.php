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
            <img src="/static/images/people.jpg" alt="">
            <div class="card-content">
                <h6>2018</h6>
                <h3>Embracing a New Normal</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>2017</h6>
                <h3>Grow Leads, Create Value</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>2016</h6>
                <h3>Innovate to Serve</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
        <li class="card-list">
            <img src="image/content-image/card-image.png" alt="">
            <div class="card-content">
                <h6>2015</h6>
                <h3>Optimize - Grow - Lead</h3>
                <a href="#">
                    <img src="image/logo/download.png" alt="">
                    <span><u>Unduh Document</u></span>
                </a>
            </div>
        </li>
    </ul>
</div>
<!-- Template -->