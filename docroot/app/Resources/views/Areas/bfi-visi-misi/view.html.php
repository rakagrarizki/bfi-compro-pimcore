

<div class="visi-misi">
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-3">
                <h2>VISI</h2>
            </div>
            <div class="col-md-9">
                <p>
                    <?= $this->input("visi"); ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <h2>MISI</h2>
            </div>
            <div class="col-md-9">
                <div class="vm-slide">
                    <!-- loop disini -->
                    <?php while($this->block("contentblock")->loop()) { ?>
                    <div>
                        <p>
                            <?= $this->input("input-misi"); ?>
                        </p>
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
