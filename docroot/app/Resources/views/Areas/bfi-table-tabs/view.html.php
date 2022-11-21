<section class="table-tabs">
    <div class="tab-heading">
        <?php if(!$this->input("title")->isEmpty()) : ?>
            <h2><?= $this->input("title") ?></h2>
        <?php endif; ?>
        <div class="button-tab">
            <?php while($this->block("tab-list")->loop()) : ?>
                <button type="button" class="tab-button tab-btn-<?= $this->block('tab-list')->getCurrent() ?>" onclick="changeTab('content-<?= $this->block('tab-list')->getCurrent() ?>','tab-btn-<?= $this->block('tab-list')->getCurrent() ?>')"><?= $this->input("tab-title"); ?></button>
            <?php endwhile; ?>
        </div>
        <div class="form-group dropdown-tab">
            <select class="form-control inputs" id="tab-dropdown" />
                <?php while($this->block("tab-list")->loop()) : ?>
                    <option value="<?= $this->block('tab-list')->getCurrent() ?>" class="tab-button tab-btn-<?= $this->block('tab-list')->getCurrent() ?>"><?= $this->input("tab-title"); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="tab-body">
        <?php while($this->block("tab-list")->loop()) : ?>
            <div id="content-<?= $this->block("tab-list")->getCurrent() ?>">
                <?= $this->wysiwyg("tab-content") ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>