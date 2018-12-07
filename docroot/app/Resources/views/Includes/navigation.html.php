<!-- HEADER -->
<nav id="site-header">
    <div class="navbar-fixed-top hidden-xs">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 left-side-top no-padding">
                        <a href="/<?php echo $this->language ?>"><?= $this->translate("personal") ?></a>
                        <a href="#"><?= $this->translate("corporate") ?></a>
                    </div>
                    <div class="col-md-5 right-side-top">
                        <div class="link-about-top">
                            <a href="#"><?= $this->translate("contact-us") ?></a>
                            <a href="#"><?= $this->translate("blog") ?></a>
                        </div>

                        <div class="link-log">
                            <a href="#" class="login"><?= $this->translate("login") ?></a>
                            <a href="#" class="register"><?= $this->translate("register") ?></a>
                        </div>

                        <?php
                        // this is an auto-generated language switcher, of course you can create your own
                        $service = new \Pimcore\Model\Document\Service;
                        $translations = $service->getTranslations($this->document);
                        $links = [];
                        foreach (\Pimcore\Tool::getValidLanguages() as $language) {
                            $target = "/" . $language;
                            if (isset($translations[$language])) {
                                $localizedDocument = \Pimcore\Model\Document::getById($translations[$language]);
                                if ($localizedDocument) {
                                    $target = $localizedDocument->getFullPath();
                                }
                            }
                            $links[$language] = $target;
                        }
                        ?>

                        <div class="lang">
                            <?php foreach ($links as $lang => $target) {
                                ?>
                                <a
                                            href="<?php echo $target ?>"><?php echo $lang == 'en' ? 'EN' : 'ID' ?></a>
                            <?php } ?>
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

                                        if(strpos($page->getUri(), 'branch-office') !== false){
                                            continue;
                                        }
                                        if($hasChildren && strpos($page->getUri(), 'product') !== false){
                                            ?>
                                            <li class="dropdown <?php echo $page->getActive() ? 'active' : '' ?>" id="produk">
                                                <a href="<?= $page->getHref() ?>" class="produk"><?= $page->getLabel() ?></a>
                                                <ul class="dropdown-content">
                                                    <div class="produk-hover container">
                                                        <div class="col-md-12">
                                                            <?php
                                                            foreach ($page->getPages() as $child) {
                                                                ?>
                                                                <div class="col-md-6">
                                                                    <li>
                                                                        <div class="label-title"><?= $child->getLabel() ?></div>
                                                                    </li>
                                                                    <?php
                                                                    $hasGrandChildren = $child->hasPages();
                                                                    if($hasGrandChildren){
                                                                        foreach($child->getPages() as $grandChild){
                                                                            ?>
                                                                            <li><a href="<?= $grandChild->getHref() ?>"><?= $grandChild->getLabel() ?></a></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
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
    </div>

    <!-- START Mobille -->
    <div class="top-nav--mobille hidden-md">
        <div class="container">
            <div class="row top-nav">
                <div class="col-xs-6">
                    <a href="#" class="cta-top-nav active">Personal</a>
                    <a href="#" class="cta-top-nav">Corporate</a>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="#" class="cta-top-nav active">ID</a>
                    <a href="#" class="cta-top-nav">EN</a>
                </div>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                    aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="close-bar">x</span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="/static/images/logo-bfi.png" alt="logo-bfi" class="img-responsive">
                </a>
                <div class="button-area--nav">
                    <a href="#" class="cta cta-light cta-see">AJUKAN KREDIT</a>
                </div>
            </div>
        </div>
    </div>
    <div id="navbar" class="navbar-collapse collapse collapse-mobile" aria-expanded="false">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produk</a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="title-dropdown">Produk</a></li>
                    <li><a href="#">Pembiayaan Kendaraan Bermotor</a></li>
                    <li><a href="#">Pembiayaan Rumah dan Ruko</a></li>
                    <li><a href="#">Lainnya</a></li>
                    <li><a href="#" class="title-dropdown">Layanan</a></li>
                    <li><a href="#">Ajukan Kredit</a></li>
                    <li><a href="#">Cek Kontrak</a></li>
                    <li><a href="#">Cek Status Aplikasi</a></li>
                    <li><a href="#">Formulir Pengkinian Data Debitur</a></li>
                </ul>
            </li>
            <li class="active"><a href="#">Ajukan Kredit</a></li>
            <li><a href="#">Uber Milyaran</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" class="about">Tentang BFI</a></li>
            <li><a href="#" class="about">Blog</a></li>
        </ul>
    </div>
    <!-- END Mobile -->
</nav>
<!-- HEADER -->