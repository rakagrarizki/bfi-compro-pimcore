<section class="widget-section profile-list-img">
    <div class="container">
        <div class="sect-title text-center">
            <?php if(!$this->input('title')->isEmpty()) { ?>
                <h2 class="title"><?= $this->input('title');?></h2>
            <?php } ?>
            <?php  if(!$this->input('subtitle')->isEmpty()) { ?>
                <p class="sub-title"><?= $this->input('subtitle'); ?></p>
            <?php } ?>
        </div>
        <div class="img-list">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <div class="item-list" data-toggle="modal" data-target="#<?= $this->input('pop-selector') ?>">
                    <div class="item-img">
                        <img src="<?= $this->image('image')->getImage() ?>" alt="<?= $this->input('alt-img')?>">
                    </div>
                    <div class="item-desc">
                        <p class="desc-title"><?= $this->input('name'); ?></p>
                        <p class="desc-subtitle"><?= $this->input('position') ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php while ($this->block("contentblock")->loop()) : ?>
    <div id="<?= $this->input('pop-selector') ?>" class="modal fade modal-img-list" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-body modal-profile">
                <div class="button-box"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div id="userImage" style="background-image: url('<?= $this->image('image')->getImage() ?>');" class="image-profile"></div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="title-profile" id="profileName"><?= $this->input('name') ?></div>
                    <div class="job-profile" id="profileJob"><?= $this->input('position') ?></div>
                    <div class="profile-separate"></div>
                    <div class="sub-info-title"><?= $this->translate("biodata"); ?></div>
                    <div class="sub-contain-title" id="profileBio"><?= $this->wysiwyg('biodata') ?></div>
                    <div class="sub-info-title"><?= $this->translate("riwayat-kerja"); ?></div>
                    <div class="sub-contain-title" id="profileHistory"><?= $this->wysiwyg('job-exp') ?></div>
                    <div class="sub-info-title"><?= $this->translate("riwayat-pendidikan"); ?></div>
                    <div class="sub-contain-title" id="profileEducation"><?= $this->wysiwyg('education') ?></div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>