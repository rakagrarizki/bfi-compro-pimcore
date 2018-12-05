<!-- HEADER -->

<nav id="site-header" class="navbar-fixed-top">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-7 left-side-top no-padding">
                    <a href="#">Personal</a>
                    <a href="#">Corporate</a>
                </div>
                <div class="col-md-5 right-side-top">
                    <div class="link-about-top">
                        <a href="#">Tentang BFI</a>
                        <a href="#">Blog</a>
                    </div>

                    <div class="link-log">
                        <a href="#" class="login">Masuk</a>
                        <a href="#" class="register">Daftar</a>
                    </div>

                    <div class="lang">
                        <a href="#" class="idn">ID</a>
                        <a href="#" class="eng">EN</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <div class="row">

                <div class="col-md-4 header-bottom-logo">
                    <a href="#">
                        <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                    </a>

                </div>
                <div class="col-md-8 header-bottom-menu">
                    <div class="header-link-menu">
                        <ul class="nav">
                            <?php
                            use Pimcore\Model\Document;

                            $listMenu = Document::getByPath("/".$this->getLocale()."/");
                            $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);

                            if ($subPage) {
                                foreach ($subPage as $page) {
                                    $hasChildren = $page->hasPages();
                                    if($hasChildren && strpos($page->getUri(), 'product') !== false){
                                        ?>
                                        <li class="dropdown <?php echo $page->getActive() ? 'active' : '' ?>" id="produk">
                                            <a href="<?= $page->getHref() ?>" class="produk"><?= $page->getLabel() ?></a>
                                            <ul class="dropdown-content">
                                                <div class="produk-hover container">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <li>
                                                                <div class="label-title">Produk</div>
                                                            </li>
                                                            <?php foreach ($page->getPages() as $child) {  ?>
                                                                <?php if(!$child->isVisible()) { continue; } ?>
                                                                <?php if(!$child->getClass() == "product"){ continue; } ?>
                                                                <li><a href="<?= $child->getHref() ?>"><?= $child->getLabel() ?></a></li>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <li>
                                                                <div class="label-title">Layanan</div>
                                                            </li>
                                                            <?php foreach ($page->getPages() as $child) {  ?>
                                                                <?php if(!$child->isVisible()) { continue; } ?>
                                                                <?php if(!$child->getClass() == "service"){ continue; } ?>
                                                                <li><a href="<?= $child->getHref() ?>"><?= $child->getLabel() ?></a></li>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                        <?php
                                    }else{
                                        ?>
                                        <li class="<?php echo $page->getActive() ? 'active' : '' ?>">
                                            <a href="<?= $page->getHref() ?>">
                                                <?= $page->getLabel() ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</nav>
<!-- HEADER -->