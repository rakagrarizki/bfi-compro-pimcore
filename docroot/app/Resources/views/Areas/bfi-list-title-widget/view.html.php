<div class="container">
    <div class="page-title"><?= $this->input("title")?>
        <?= $this->input("subtitle");?>
    </div>
    <div class="row">
        <?php while($this->block("contentblock")->loop()) { ?>
            <a href = "<?= $this->link("url")->isEmpty() ? "#" : $this->link("url")->getHref();?>">
                <div class="button-type-17 col-md-12">
                    <?= $this->date("date", [
                        "format" => "%d %B %Y"
                    ]); ?>
                    <?= $this->input("detail-title");?>
                    <span class="arrow-right"><i class="icon-next"></i></span>
                </div>
            </a>
        <?php } ?>
    </div>
</div>

 
<!-- Template -->
<div class="container">
    <ul class="list-title">
        <li>
            <a href="#">
                <div class="right-content">
                    <h6>18 April 2019</h6>
                    <h3>Pengumuman Rapat Umum Pemegang Saham Tahunan dan Luar Biasa 2019</h3>
                </div>
                <div class="left-content">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </li>
        
        <li>
            <a href="#">
                <div class="right-content">
                    <h6>10 Maret 2019</h6>
                    <h3>Pengumuman Rapat Umum Pemegang Saham Tahunan dan Luar Biasa 2019</h3>
                </div>
                <div class="left-content">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="right-content">
                    <h6>1 Februari 2019</h6>
                    <h3>Pengumuman Rapat Umum Pemegang Saham Tahunan dan Luar Biasa 2019</h3>
                </div>
                <div class="left-content">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </li>
    </ul>
</div>

<!-- Template -->