<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/management.js');
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/tabbing.js');
?>

<div class="container management-container">
    <div class="row">
        <?php 
        if($this->input('title')->isEmpty()) { ?>
        <?php } else {?>
        <h3 class=""><?= $this->input('title');?></h3>
        <?php }?>

        <?php foreach($this->multihref("objectPaths") as $element):
            /** @var \Pimcore\Model\Element\ElementInterface $element */
            ?>
        <div class="col-md-4 management-box">
            <div class="cards-type-14" onclick="getDetail('<?= $element->getId(); ?>', '<?= $this->getLocale(); ?>')"
                data-toggle="modal" data-target="#myModal"
                style="background-image: url('<?= $element->getImage() ? $element->getImage()->getFullPath() : ""; ?>')">
                <div class="information">
                    <div class="information-name"><?= $element->getNama(); ?></div>
                    <div class="information-position"> <?= $element->getJabatan(); ?></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<!-- <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> -->

<!-- Modal content-->
<!-- <div class="modal-content">
        <div class="modal-body modal-profile">
            <div class="button-box"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div class="row">
                <div class="col-sm-4">
                    <div id="userImage" style="background-image: url('');" class="image-profile"></div>
                </div>
                <div class="col-sm-8">
                    <div class="title-profile" id="profileName"></div>
                    <div class="job-profile" id="profileJob"></div>
                    <div class="profile-separate"></div>
                    <div class="sub-info-title"></?= $this->t("biodata");?></div>
                    <div class="sub-contain-title" id="profileBio"></div>
                    <div class="sub-info-title"></?= $this->t("riwayat-kerja");?></div>
                    <div class="sub-contain-title" id="profileHistory"></div>
                    <div class="sub-info-title"></?= $this->t("riwayat-pendidikan");?></div>
                    <div class="sub-contain-title" id="profileEducation"></div>
                </div>
            </div>
        </div>
    </div>

  </div>
</div> -->
