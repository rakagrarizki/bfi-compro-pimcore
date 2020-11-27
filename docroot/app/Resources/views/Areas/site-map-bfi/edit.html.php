<div class="row">
    <div class="col-sm-4">Title</div>
    <div class="col-sm-8"><?= $this->input("title"); ?></div>
    <div class="col-sm-12" style="border: 1px solid grey; margin-top:10px;">
    add new column:
        <?php while($this->block("parent")->loop()) { ?>
        
            <div style="border: 1px solid grey; margin-top:10px; padding:5px">
                <div class="row">
                    <div class="col-sm-4">Sub-title</div>
                    <div class="col-sm-8"><?= $this->input("sub"); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">Sub-link</div>
                    <div class="col-sm-8"><?= $this->link("sublink"); ?></div>
                </div>
                add new link:
                <?php while($this->block("column")->loop()) { ?>
                <div class="row">
                    <div class="col-sm-4">Text</div>
                    <div class="col-sm-8"><?= $this->input("text"); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">link</div>
                    <div class="col-sm-8"><?= $this->link("url"); ?></div>
                </div>

                <?php }?>
            </div>
            
            <?php }?>


    </div>
   

</div>
