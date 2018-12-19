<!-- HEADER -->
<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;

?>
<nav id="site-header">
    <div class="navbar-fixed-top hidden-xs">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 left-side-top">
                        <a href="/<?php echo $this->getLocale() ?>"><?= $this->translate("personal") ?></a>
                        <a href="#"><?= $this->translate("corporate") ?></a>
                        <a href="/<?php echo $this->getLocale() ?>" class="backtohome"><?= $this->translate("backtohome") ?></a>
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

                        <?php echo $this->template("Includes/language.html.php") ?>

                    </div>

                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 header-bottom-logo">
                        <a href="<?php echo "/".$this->getLocale(); ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>

                    </div>
                    <div class="col-md-8 header-bottom-menu">
                        <div class="header-link-menu">
                            <ul class="nav">
                                <?php

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

    <?php echo $this->template("Includes/mobile-navigation.html.php") ?>

</nav>
<!-- HEADER -->