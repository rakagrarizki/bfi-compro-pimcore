 <div class="container st-mp">
     <div class="row">


         <div class="col-12">

             <h2 class="title-small"><?= $this->input('title'); ?></h2>

             <div class="container ">

                 <div class="row mp-list">
                     <?php while ($this->block("parent")->loop()) { ?>

                        <?php if (!$this->block("column")->isEmpty()) : ?>

                            <div class="col-md-3 col-sm-6 xs-6">
                                <h3>
                                    <?php if (!$this->link("sublink")->isEmpty()) : ?>
                                        <a href="<?= $this->link('sublink')->getHref() ?>">
                                            <span><?= $this->input('sub'); ?></span>
                                        </a>
                                    <?php else : ?>
                                        <?= $this->input('sub'); ?>
                                    <?php endif; ?>
                                </h3>
                                
                                <ul>
                                <?php while ($this->block("column")->loop()) { ?>
                                    <li> <a href="<?= $this->link('url')->getHref() ?>"><span><?= $this->input('text'); ?></span> </a></li>
                                <?php } ?>

                                </ul>

                            </div>

                        <?php else : ?>
                            <div class="col-md-3 col-sm-6 xs-6">
                                <h3>
                                    <?php if (!$this->link("sublink")->isEmpty()) : ?>
                                        <a href="<?= $this->link('sublink')->getHref() ?>">
                                            <span><?= $this->input('sub'); ?></span>
                                        </a>
                                    <?php else : ?>
                                        <?= $this->input('sub'); ?>
                                    <?php endif; ?>
                                </h3>

                            </div>
                        <?php endif; ?>

                     <?php } ?>

                 </div>


             </div>


         </div>
     </div>
 </div>
