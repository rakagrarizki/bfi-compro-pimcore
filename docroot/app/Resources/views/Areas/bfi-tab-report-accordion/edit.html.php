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
            <div class="col-sm-8"><?= $this->input("title");?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Tab Group</div>
            <div class="col-sm-8">
                <?=
                $this->select("group", [
                    "store" => [
                        ['sejarah', 'sejarah'],
                        ['struktur-pemegang-saham', 'Struktur Pemegang Saham'],
                        ['struktur-manajemen', 'Struktur Manajemen'],
                        ['laporan-tahunann','Laporan Tahunan'],
                        ['rups','RUPS'],
                        ['informasi-saham','Informasi Saham'],
                        ['keterbukaan-informasi','Keterbukaan Informasi']
                    ]
                ]);
                ?></div>
        </div>
        <?php while ($this->block("tab")->loop()) { ?>
        <div class="row">
            <div class="col-sm-4">Tab Title</div>
            <div class="col-sm-8"><?= $this->input("text"); ?></div>
        </div>
           

        <?php } ?>


    </div>
</div>


