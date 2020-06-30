<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:04
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Text</div> 
            <div class="col-sm-8"><?= $this->textarea("text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Pembiayaan Berjamin</div>
            <div class="col-sm-8"><?= $this->input("credit-jaminan-title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Pembiayaan Lainnya</div>
            <div class="col-sm-8"><?= $this->input("credit-lainnya-title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link rumah</div>
            <div class="col-sm-8"><?= $this->link("url-rumah"); ?></div>
        </div>
		    <div class="row">
            <div class="col-sm-4">title rumah</div>
            <div class="col-sm-8"><?= $this->input("title-rumah"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Image Rumah</div>
            <div class="col-sm-8"><?= $this->image('image-rumah');?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image Rumah</div>
                <div class="col-sm-8"><?= $this->input("alt-img-rumah"); ?></div>
            </div>
        <div class="row">
            <div class="col-sm-4">link mobil</div>
            <div class="col-sm-8"><?= $this->link("url-mobil"); ?></div>
        </div>
		<div class="row">
            <div class="col-sm-4">title mobil</div>
            <div class="col-sm-8"><?= $this->input("title-mobil"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Image Mobil</div>
            <div class="col-sm-8"><?= $this->image('image-mobil');?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image Mobil</div>
                <div class="col-sm-8"><?= $this->input("alt-img-mobil"); ?></div>
            </div>
        <div class="row">
            <div class="col-sm-4">link motor</div>
            <div class="col-sm-8"><?= $this->link("url-motor"); ?></div>
        </div>
		    <div class="row">
            <div class="col-sm-4">title motor</div>
            <div class="col-sm-8"><?= $this->input("title-motor"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Image Motor</div>
            <div class="col-sm-8"><?= $this->image('image-motor');?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image Motor</div>
                <div class="col-sm-8"><?= $this->input("alt-img-motor"); ?></div>
            </div>
        <div class="row">
            <div class="col-sm-4">title Education</div>
            <div class="col-sm-8"><?= $this->input("title-education"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Image Education</div>
            <div class="col-sm-8"><?= $this->image('image-education');?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image Education</div>
                <div class="col-sm-8"><?= $this->input("alt-img-education"); ?></div>
            </div>
        <div class="row">
            <div class="col-sm-4">link Education</div>
            <div class="col-sm-8"><?= $this->link("url-education"); ?></div>
        </div>

		    <div class="row">
            <div class="col-sm-4">title Travel</div>
            <div class="col-sm-8"><?= $this->input("title-travel"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Image Travel</div>
            <div class="col-sm-8"><?= $this->image('image-travel');?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image Travel</div>
                <div class="col-sm-8"><?= $this->input("alt-img-travel"); ?></div>
            </div>
        <div class="row">
            <div class="col-sm-4">link Travel</div>
            <div class="col-sm-8"><?= $this->link("url-travel"); ?></div>
        </div>

		    <div class="row">
            <div class="col-sm-4">title Mesin</div>
            <div class="col-sm-8"><?= $this->input("title-mesin"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Image Mesin</div>
            <div class="col-sm-8"><?= $this->image('image-mesin');?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image Mesin</div>
                <div class="col-sm-8"><?= $this->input("alt-img-mesin"); ?></div>
            </div>
        <div class="row">
            <div class="col-sm-4">link Mesin</div>
            <div class="col-sm-8"><?= $this->link("url-mesin"); ?></div>
        </div>
    </div>
</div>
