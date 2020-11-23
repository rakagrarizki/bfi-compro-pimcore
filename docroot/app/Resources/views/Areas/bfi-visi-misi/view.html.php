

<div class="visi-misi">
    <div class="container">
        <div class="visi">
            <div class="col-md-3">
                <h2><?= $this->translate("visi"); ?></h2> 
            </div>
            <div class="col-md-9">
                <h4>
                    <?= $this->input("visi"); ?>
                </h4>
            </div>
        </div>
        <div class="misi">
            <div class="col-md-3">
                <h2><?= $this->translate("misi"); ?></h2>
            </div>
            <div class="col-md-9">

                <div class="vm-slide" id=vm-slide-misi>
                    <!-- loop disini -->
                    <?php while($this->block("contentblock")->loop()) { ?>
                    <div>
                        <h4><?= $this->input("input-misi"); ?></h4>
                    </div>
                    <?php } ?>
                    <!--  -->
                </div>

            </div>
        </div>
        <div class="counter">
            <button type="button" class="prev cta cta-orange"><i class="fa fa-angle-left"></i></button>
            <div class="pagingInfo"></div>
            <button type="button" class="next cta cta-orange"><i class="fa fa-angle-right"></i></button>
        </div>
    </div>
</div>
