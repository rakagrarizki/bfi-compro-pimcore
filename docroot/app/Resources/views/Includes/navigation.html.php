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
<?php $pageCurrent = $this->getParam('page', 1); ?>
<nav id="site-header">
    <div class="navbar-fixed-top hidden-xs">
        <?= $this->inc("/" . $this->getLocale() . "/shared/includes/sub-navigation") ?>

        <div class="header-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 col-sm-4 header-bottom-logo">
                        <a href="<?php echo "/" . $this->getLocale(); ?>">
                            <img src="/static/images/logo-bfi.png" class="img-responsive" alt="">
                        </a>
                    </div>
                    <div class="col-md-9 col-sm-8 header-bottom-menu">
                        <div class="header-link-menu">
                            <ul class="nav">
                                <?php

                                $listMenu = Document::getByPath("/" . $this->getLocale() . "/");
                                $subPage = $this->navigation()->buildNavigation($this->document, $listMenu);

                                if ($subPage) {
                                    foreach ($subPage as $page) {
                                        $hasChildren = $page->hasPages();

                                        if (strpos($page->getUri(), 'branch-office') !== false) {
                                            continue;
                                        }
                                        if ($hasChildren && strpos($page->getUri(), '#product') !== false) {
                                            ?>
                                            <li class="dropdown"
                                                id="produk">
                                                <a href="#"
                                                   class="<?php echo $page->getActive() ? 'active' : '' ?> produk"><?= $page->getLabel() ?></a>
                                                <div class="dropdown-content main">
                                                    <div class="produk-hover container">
                                                        <div class="col-md-12">
                                                            <?php
                                                            foreach ($page->getPages() as $child) {
                                                                ?>
                                                                <div class="col-md-6">
                                                                    <ul>
                                                                        <li>
                                                                            <div class="label-title"><?= $child->getLabel() ?></div>
                                                                        </li>
                                                                        <?php
                                                                        $hasGrandChildren = $child->hasPages();
                                                                        if ($hasGrandChildren) {
                                                                            foreach ($child->getPages() as $grandChild) {
                                                                                ?>
                                                                                <li>
                                                                                    <a class="<?php echo $grandChild->getActive() ? 'active' : '' ?>" href="<?= $grandChild->getHref() ?>"><?= $grandChild->getLabel() ?></a>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        } else {
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