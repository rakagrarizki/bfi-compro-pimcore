<?php
$this->headScript()->offsetSetFile(100, '/static/js/Includes/management.js');
?>



<!-- Template -->
<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h2 class="section-heading"><?= $this->input("title") ?></h2>
    </div>
  </div>
  <div class="row">
    <?php $element = $this->href("myHref")->getElement(); ?>
    <?php if ($element) : ?>
      <div class="col-lg-4 col-md-4 col-12">
        <button type="button" class="photo-frame" onclick="getDetail(<?= $element->getId(); ?>)" data-toggle="modal" data-target="#myModal">
          <img src="<?= $element->getImage() ? $element->getImage()->getFullPath() : ""; ?>" alt="">
          <div class="photo-description">
            <div class="text-box">
              <h5><?= $element->getNama(); ?></h5>
              <p><?= $element->getJabatan(); ?></p>
            </div>
          </div>
        </button>
      </div>

      <div class="col-lg-8 col-md-8 col-12">
        <?= $this->wysiwyg("text"); ?>
        <!-- <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Animi veritatis temporibus dignissimos perferendis obcaecati modi quidem non quod,
          harum perspiciatis porro fugit dolore fugiat nesciunt excepturi tenetur similique? Quis, et!
        </p> -->
        <!-- <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Animi veritatis temporibus dignissimos perferendis obcaecati modi quidem non quod,
          harum perspiciatis porro fugit dolore fugiat nesciunt excepturi tenetur similique? Quis, et!
        </p> -->
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="modal fade" id="pop-up">
  <div class="modal-dialog popup-style">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12">
            <img src="image/content-image/card-image.png" alt="" class="w-100">
          </div>
          <div class="col-lg-8 col-md-8 col-12">
            <div id="head-profile">
              <h1>Kusmayanto Kadiman</h1>
              <p>Presiden Komisaris</p>
            </div>
            <hr>
            <div id="body-profile">
              <h3>Biodata</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Soluta ex eum nam ullam. Id, quia, obcaecati corrupti delectus expedita vitae mollitia repellat vel numquam,
                voluptatum soluta praesentium minus optio officiis!
              </p>

              <h3>Riwayat Kerja</h3>
              <ul>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
              </ul>

              <h3>Riwayat Pendidikan</h3>
              <ul>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
                <li>
                  <i class="fas fa-square-full"></i>
                  <p>Pernah Bekerja di..........</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Template -->
<!-- <div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h2 class="section-heading text-uppercase"><? //= $this->input("title") 
                                                  ?></h2>
      <h3 class="section-subheading text-muted"><? //= $this->wysiwyg("text"); 
                                                ?></h3>
    </div>
  </div>
  <div class="row">
    <?php $element = $this->href("myHref")->getElement(); ?>
    <? //php if ($element) : 
    ?>

      <div class="col-lg-4 col-md-4 col-12">
        <div class="cards-type-14" onclick="getDetail(<? //= $element->getId(); 
                                                      ?>)" data-toggle="modal" data-target="#myModal" style="background-image: url('<? //= $element->getImage() ? $element->getImage()->getFullPath() : ""; 
                                                                                                                                    ?>')">
          <div class="information">
            <div class="information-name"><? //= $element->getNama(); 
                                          ?></div>
            <div class="information-position"> <? //= $element->getJabatan(); 
                                                ?></div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-12">
        <p><? //= $element->getBiodata(); 
            ?></p>
      </div>
    <? //php endif; 
    ?>
  </div>
</div> -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body modal-profile">
        <div class="button-box"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div id="userImage" style="background-image: url('');" class="image-profile"></div>
          </div>
          <div class="col-lg-8 col-md-8 col-xs-12">
            <div class="title-profile" id="profileName"></div>
            <div class="job-profile" id="profileJob"></div>
            <div class="profile-separate"></div>
            <div class="sub-info-title"><?= $this->t("biodata"); ?></div>
            <div class="sub-contain-title" id="profileBio"></div>
            <div class="sub-info-title"><?= $this->t("riwayat-kerja"); ?></div>
            <div class="sub-contain-title" id="profileHistory"></div>
            <div class="sub-info-title"><?= $this->t("riwayat-pendidikan"); ?></div>
            <div class="sub-contain-title" id="profileEducation"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>