<section class="table-tabs">
    <div class="tab-heading">
        <?php if(!$this->input("title")->isEmpty()) : ?>
            <h2><?= $this->input("title") ?></h2>
        <?php endif; ?>
        <?php while($this->block("tab-list")->loop()) : ?>
            <button type="button" id="tab-btn-<?= $this->block('tab-list')->getCurrent() ?>" class="tab-button" onclick="changeTab('content-<?= $this->block('tab-list')->getCurrent() ?>','tab-btn-<?= $this->block('tab-list')->getCurrent() ?>')"><?= $this->input("tab-title"); ?></button>
        <?php endwhile; ?>
    </div>
    <div class="tab-body">
        <?php while($this->block("tab-list")->loop()) : ?>
            <div id="content-<?= $this->block("tab-list")->getCurrent() ?>">
                <?= $this->wysiwyg("tab-content") ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>