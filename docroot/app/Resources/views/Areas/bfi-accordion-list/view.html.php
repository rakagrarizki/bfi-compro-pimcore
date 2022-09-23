<section class="widget-section">
    <div class="container">
        <div class="accordion pembiayaan accordion-list">
            <div class="sect-title text-center">
                <?php if (!$this->input("title")->isEmpty()) { ?>
                    <h2 class=""><?= $this->input('title');?></h2>
                <?php } ?>
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
                            <?php while($this->block('content-list')->loop()){ ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading"  data-toggle="collapse" data-parent="#<?php echo $unik;?>" href="#<?php echo $unik."-".$a;?>">
                                        <h3 class="panel-title">
                                            <a class="a-panelheading">
                                                <?= $this->input('content-title');?></a>
                                        </h3>
                                    </div>
                                    <div id="<?php echo $unik."-".$a;?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php echo $this->wysiwyg("content"); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $a++;?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-footer">
                <p>
                    <?= $this->input("footer-text") ?>
                    <?php if(!$this->link("footer-link")->isEmpty()) : ?>
                        <a href="<?= $this->link('footer-link')->getHref() ?>"><?= $this->link("footer-link")->getText() ?></a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</section>