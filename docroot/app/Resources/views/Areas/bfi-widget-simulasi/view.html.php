<div class="simulasi_pbf">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-6 desc-sect">
                <h1 class="desc-title"><?= $this->input("title"); ?></h1>
                <p class="desc-text"><?= $this->input("desc") ?></p>
                <div class="btn-ajukan">
                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange <?= $this->link('url')->getClass(); ?>" id="<?= $this->link('url')->getParameters()?>"><?= $this->link('url')->getText(); ?></a>
                </div>
            </div>
            <div class="col-md-6 col-md-pull-6 calc-sect">
                <h1 class="calc-title text-center">Kalkulator Pinjaman</h1>
                <div class="row">
                    <div class="col-xs-6">
                        <p>Estimasi Harga Rumah</p>
                        <p class="price">Rp 600.000.000</p>
                    </div>
                    <div class="col-xs-6">
                        <p>Jumlah Pinjaman</p>
                        <p class="price">Rp 200.000.000</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>Pilih Tenor</p>
                        <div class="tenor">
                            <div class="radio-group">
                                <input type="radio" id="option-one" name="selector">
                                <label for="option-one">2 Tahun</label>
                                <input type="radio" id="option-two" name="selector">
                                <label for="option-two">3 Tahun</label>
                                <input type="radio" id="option-three" name="selector">
                                <label for="option-three">4 Tahun</label>
                                <input type="radio" id="option-four" name="selector">
                                <label for="option-four">5 Tahun</label>
                            </div>
                        </div>
                        <div class="estimasi">
                            <p class="text-center">Estimasi Angsuran per Bulan</p>
                            <p id="result-estimasi" class="text-center">Rp 7.331.500</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>