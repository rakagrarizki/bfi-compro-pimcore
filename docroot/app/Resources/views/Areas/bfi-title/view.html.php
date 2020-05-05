<div class="about-us-page">
    <div class="container">
        <h1 class="page-title"><strong><?= $this->input('title');?></strong></h1>
        <?php if (!$this->input("subtitle")->isEmpty()) { ?>
            <div class="page-sub-title"><?= $this->input('subtitle');?></div>
        <?php } else { echo "<br>";} ?>
    </div>
</div>