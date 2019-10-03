<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php
        if (isset($this->previous)) {
        ?>
        <li>
            <a href="<?= urldecode($this->pimcoreUrl(['page' => $this->previous])); ?>" aria-label="Previous">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>
        <?php
        }
        ?>
        <?php foreach ($this->pagesInRange as $page): ?>
            <?php if ($page == $this->current): ?>
            <li class="active"><a href="javascript:void(0)"><?= $page; ?></a></li>
            <?php else :?>
            <li><a href="<?= $this->pimcoreUrl(['page' => $page]); ?>"><?= $page; ?></a></li>
            <?php endif;?>
        <?php endforeach;?>
        <li>
            <a href=""<?= $this->pimcoreUrl(['page' => $this->next]); ?>" aria-label="Next">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
</nav>
