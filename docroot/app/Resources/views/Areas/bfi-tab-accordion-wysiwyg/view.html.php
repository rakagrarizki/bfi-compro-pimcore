
<?php
// while ($this->block("tab")->loop()) {
//     echo $this->input("text");
//     while ($this->block("accordion")->loop()) {
//         echo $this->input("text1");
//         echo $this->wysiwyg("value");
//     }
// }
?>
<div class="tabs-accor">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input('title');?></h2>
        </article>
        <div>
            <ul class="nav nav-tabs" role="tablist" id="tabsAccor">
                <?php while ($this->block("tab")->loop()) { ?>
                    <?php
                    $pattern = '/\W/';
                    $result = preg_replace($pattern," ", $this->input("text"));
                    $removeSpace = preg_replace('/\s+/',"-",$result);
                    $last = str_replace(" ","-",strtolower($removeSpace));


                    ?>

                <li role="presentation">
                    <a href="#<?= $last;?>" aria-controls="<?= $last;?>" role="tab" data-toggle="tab"><?= $this->input("text");?></a>
                </li>
                <?php }?>

            </ul>

            <div class="tab-content">
                <?php while ($this->block("tab")->loop()) { ?>
                    <?php
                    $pattern = '/\W/';
                    $result = preg_replace($pattern," ", $this->input("text"));
                    $removeSpace = preg_replace('/\s+/',"-",$result);
                    $last = str_replace(" ","-",strtolower($removeSpace));


                    ?>

                    <div role="tabpanel" class="tab-pane" id="<?= $last;?>">
                    <?php if($this->block("accordion")->getCount() > 0) :?>
                    <div class="accordion">

                        <div class="accordion__wrap produk">
                            <div class="">
                                <div class="">
                                    <?php $a=1;?>
                                    <?php
                                    $unik = uniqid();
                                    ?>
                                    <div class="panel-group" id="<?php echo $unik;?>">

                                        <?php while($this->block('accordion')->loop()){ ?>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" data-toggle="collapse" data-parent="#<?php echo $unik;?>" href="#<?php echo $unik."-".$a;?>">
                                                    <h4 class="panel-title">
                                                        <a class="a-panelheading" >
                                                            <?= $this->input("text1"); ?></a>
                                                    </h4>
                                                </div>
                                                <div id="<?php echo $unik."-".$a;?>" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <?php echo $this->wysiwyg("value"); ?>

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
                    <?php else : ?>
                    <div class="accordion">
                        <p>No Result</p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php }?>

            </div>
        </div>
    </div>
</div>
