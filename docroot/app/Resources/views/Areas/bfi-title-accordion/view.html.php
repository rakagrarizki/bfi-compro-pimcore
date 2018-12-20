<div>
    <div id="accordion-pembiayaan" class="accordion">
        <div class="sect-title text-center">
            <h2 class="margin-top-85"><?= $this->input('title');?></h2>
            <p><?= $this->textarea('text'); ?></p>
        </div>

        <div class="accordion__wrap produk">
            <div class="container">
                <div class="row">
                    <?php $a=1;?>
                    <?php
                    $unik = uniqid();
                    ?>
                    <div class="panel-group" id="<?php echo $unik;?>">

                        <?php while($this->block('accord')->loop()){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="a-panelheading" data-toggle="collapse" data-parent="#<?php echo $unik;?>" href="#<?php echo $unik."-".$a;?>">
                                            <?= $this->input('title-accord');?></a>
                                    </h4>
                                </div>
                                <div id="<?php echo $unik."-".$a;?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php echo $this->areablock("Content-accord"); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $a++;?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>