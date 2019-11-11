<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/management.js');
?>

<div class="container">
    <div class="row">
        <?php foreach($this->multihref("objectPaths") as $element):
            /** @var \Pimcore\Model\Element\ElementInterface $element */
            ?>
            <div class="col-md-4">
                <div class="cards-type-14" onclick="getDetail(<?= $element->getId(); ?>)" data-toggle="modal" data-target="#myModal" style="background-image: url('<?= $element->getImage() ? $element->getImage()->getFullPath() : ""; ?>')">
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body modal-profile">
            <div class="button-box"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div class="row">
                <div class="col-sm-4">
                    <div style="background-image: url(/_default_upload_bucket/kk-2018-1.jpg);" class="image-profile"></div>
                </div>
                <div class="col-sm-8">
                    <div class="title-profile" id="profileName"></div>
                    <div class="job-profile" id="profileJob">Presiden Komisaris</div>
                    <div class="profile-separate"></div>
                    <div class="sub-info-title">Biodata</div>
                    <div class="sub-contain-title" id="profileBio">Warga negara Indonesia, lahir pada 1954, usia 64 tahun, berdomisili di Jakarta. Beliau menjabat sebagai Presiden Komisaris Perusahaan berdasarkan Akta Berita Acara RUPST No. 80 tanggal 15 Juni 2011, dan diangkat kembali sebagai Presiden Komisaris berdasarkan Akta Berita Acara RUPSLB No. 43 tanggal 25 April 2016 untuk periode 2016-2021. Beliau juga menjawab sebagai Wakil Presiden Komisaris PT Adaro Power, Komisaris PT Tamaris Hidro, Presiden Komisaris PT Setiabudi Investment Management, dan Komisaris PT Profesional Telekomunikasi Indonesia (Protelindo). </div>
                    <div class="sub-info-title">Riwayat Kerja</div>
                    <div class="sub-contain-title" id="profileHistory"></div>
                    <div class="sub-info-title">Riwayat Pendidikan</div>
                    <div class="sub-contain-title" id="profileEducation"></div>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

