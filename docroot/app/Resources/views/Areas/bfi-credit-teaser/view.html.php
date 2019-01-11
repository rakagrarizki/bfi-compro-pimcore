<div class="container">
    <div class="row">
        <div class="cont-credit">
            <h2 class="title-wrapper"><?= $this->input("title"); ?></h2>
                <p class="paragraf-title"><?= $this->textarea('text');?></p>
                <div class="list-credit">
                    <div class="list-credit--icon">
                        <div class="credit--icon col-md-3">
                            <a href="<?= $this->link('url-mobil')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src=""></img>
                                    <p>BPKB Mobil</p>
                                </div>
                            </a>
                        </div>
                        <div class="credit--icon col-md-3">
                            <a href="<?= $this->link('url-motor')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src=""></img>
                                    <p>BPKB Motor</p>
                                </div>

                            </a>
                        </div>
                        <div class="credit--icon col-md-3">
                            <a href="<?= $this->link('url-rumah')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src=""></img>
                                    <p>Sertifikat Rumah</p>
                                </div>

                            </a>
                        </div>
                        <div class="credit--icon col-md-3">
                            <a href="<?= $this->link('url-ruko')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src=""></img>
                                    <p>Sertifikat Ruko</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>