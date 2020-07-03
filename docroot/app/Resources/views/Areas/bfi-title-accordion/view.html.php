<div class="container">
    <div id="accordion-pembiayaan" class="accordion pembiayaan">
        <div class="sect-title text-center">
            <h2 class=""><?= $this->input('title');?></h2>
            <p><?= $this->textarea('text'); ?></p>
        </div>

        <div class="accordion__wrap produk">
            <div class="container"> 
                <div class="">
                    <?php $a=1;?>
                    <?php
                    $unik = uniqid();
                    ?>
                    <div class="panel-group" id="<?php echo $unik;?>">

                        <?php while($this->block('accord')->loop()){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"  data-toggle="collapse" data-parent="#<?php echo $unik;?>" href="#<?php echo $unik."-".$a;?>">
                                    <h3 class="panel-title">
                                        <a class="a-panelheading">
                                            <?= $this->input('title-accord');?></a>
                                    </h3>
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