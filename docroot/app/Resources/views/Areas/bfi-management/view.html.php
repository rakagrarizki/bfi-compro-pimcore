

        <?php foreach($this->multihref("objectPaths") as $element):
            /** @var \Pimcore\Model\Element\ElementInterface $element */
            ?>
            <?= $element->getNama(); ?>
            <?= $element->getId(); ?>
            <?= $element->getJabatan(); ?>
            <?= $element->getBiodata(); ?>
            <?= $element->getRiwayatkerja(); ?>
            <?= $element->getRiwayatPendidikan(); ?>
            <?= $element->getImage()->getFullPath(); ?>
        <?php endforeach; ?>


