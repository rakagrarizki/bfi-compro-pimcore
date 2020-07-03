<?php
$tab = $this->getParam("tab");
$queryStr = $_GET["t"];
?>

<?php
$this->headScript()->offsetSetFile(100, '/static/js/Includes/tabbing.js');
?>

<div class="tabs-accor">
    <div class="container">
        <article class="sect-title text-center">
            <?php 
            if($this->input('title') == '') { ?>
            <?php } else {?>
            <h2 class=""><?= $this->input('title');?></h2>
            <?php }?>
        </article>
        <div id="<?= $this->select("group")->getData(); ?>" class="tabs-outer">
            <ul class="nav nav-tabs" role="tablist" id="outer-choice">
                <?php while ($this->block("tab")->loop()) { ?>
                <?php
                    $pattern = '/\W/';
                    $result = preg_replace($pattern, " ", $this->input("text"));
                    $removeSpace = preg_replace('/\s+/', "-", $result);
                    $last = str_replace(" ", "-", strtolower($removeSpace));
                    $id = $this->block("tab")->getCurrent();
                    $active = "";
                    if ($tab == "") {
                        if ($queryStr) {
                            if ($id == $queryStr) {
                                $active = "active";
                            }
                        } else {
                            if ($id == 0) {
                                $active = "active";
                            }
                        }
                    }
                    if ($tab == $last) {
                        $active = "active";
                    }
                    ?>

                <?php $tabWidth = 100 / $this->block("tab")->getCount(); ?>
                <?php $tabWidth = str_replace(",", ".", $tabWidth) ?>
                <li role="presentation" class="<?= $active ?>" id="div<?= $id; ?>" style="width:<?= $tabWidth; ?>%"
                    onclick="updateQueryStringParameter('t',<?= $id; ?>)">
                    <a href="#<?= $id; ?>" id="href<?= $id; ?>" data-prev="<?= $id == 0 ? '' : $id - 1 ?>"
                        data-next="<?= $id == ($this->block("tab")->getCount() - 1) ? "" : $id + 1; ?>"
                        aria-controls="<?= $id ?>" role="tab" data-toggle="tab"
                        onclick="setPreviewId(<?= $id == 0 ? '' : $id - 1 ?>,<?= $id == ($this->block('tab')->getCount() - 1) ? '' : $id + 1; ?>)">
                        <h2>
                            <?= $this->input("text"); ?>
                        </h2>
                    </a>
                </li>

                <?php } ?>
            </ul>
            <div class="arrow-wrapper">
                <div style="display: none" onclick="prev()" class="arrow left-arrow"
                    onclick="scrollPosition('<?= $id; ?>')" id="prevButton">
                    <a class="arrow-outer"><i class="icon-left-arrow"></i></a>
                </div>
                <div class="arrow right-arrow" onclick="next()" id="nextButton">
                    <a class="arrow-outer"><i class="icon-right-arrow"></i></a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <?php while ($this->block("tab")->loop()) { ?>
            <?php
                $pattern = '/\W/';
                $result = preg_replace($pattern, " ", $this->input("text"));
                $removeSpace = preg_replace('/\s+/', "-", $result);
                $last = str_replace(" ", "-", strtolower($removeSpace));

                $id = $this->block("tab")->getCurrent();
                $active = "";
                ?>
            <?php if ($tab == "") {
                    if ($queryStr) {
                        if ($id == $queryStr) {
                            $active = "active";
                        }
                    } else {
                        if ($id == 0) {
                            $active = "active";
                        }
                    }
                }
                if ($tab == $last) {
                    $active = "active";
                }
                ?>
            <div role="tabpanel" class="tab-pane <?= $active ?>" id="<?= $id ?>">
                <?= $this->snippet("teaserSnipet"); ?>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
