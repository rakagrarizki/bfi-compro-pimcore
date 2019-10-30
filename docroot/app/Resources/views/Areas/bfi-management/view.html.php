

        <?php foreach($this->multihref("objectPaths") as $element):
            /** @var \Pimcore\Model\Element\ElementInterface $element */
            ?>
            <div class="cards-type-14" style="background-image: url('<?= $element->getImage()->getFullPath(); ?>')">
                <div class="information">
                    <div class="information-name"><?= $element->getNama(); ?></div>
                    <div class="information-position"> <?= $element->getJabatan(); ?></div>
                </div>
            </div>


        <?php endforeach; ?>


