

<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>
<?php $q = $this->queryString;
$page = $this->page;
?>
<?php $lang = $this->getLocale();?>

<!-- TEMPLATE -->

<section id="search">
    <div class="container">
        <form action="/search">
            <div class="search-wrapper">
                <input id="search-input" class="input-search" name="q" type="text" value="<?= $q;?>"placeholder=<?= $this->t("search-here")?>>

                <button type="submit" id="search-on">
                    <img id="button-search" src="/static/images/icon/search.png" widht="36" height="36">
                </button>
            </div>
        </form>

        <?php if($this->paginator): ?>
        <p id="search-result"><?= $this->paginator["items"] ? $this->paginator["totalItem"] : "0 " ?> <?= $this->t("search-found")?></p>
        <ul id="result-list">
            <?php foreach($this->paginator["items"] as $item): ?>

            <a href="<?= $item["_source"]["url"];?>">
                <li id="result-wrapper">
                    <?php
                    $arr = explode(" ",$q);
//                    $wordsCount = count($arr);
//                    for($i=0;$i<$wordsCount;$i++){
//                        $highlight = "<span class=\"highlight\">".$arr[$i]."</span>";
//                        $title = str_ireplace($arr[$i], $highlight, $item["_source"]["Title_".$lang]);
//                    }
                    $title = preg_replace('/'.implode('|', $arr).'/i', '<span class="highlight">$0</span>', $item["_source"]["Title_".$lang]);
                    $body = preg_replace('/'.implode('|', $arr).'/i', '<span class="highlight">$0</span>', $item["_source"]["Body_".$lang]);
                    //$title = preg_replace("/($arr)/i","<span class=\"highlight\">".$q."</span>",$item["_source"]["Title_".$lang]);

                    //$title = str_ireplace($q, $highlight, $item["_source"]["Title_".$lang]);
                    //$body = str_ireplace($q, $highlight, $item["_source"]["Body_".$lang]);
//                    $highlight = "<span class=\"highlight\">".$q."</span>";
//                    $title = str_ireplace($q, $highlight, $item["_source"]["Title_".$lang]);
//                    $body = str_ireplace($q, $highlight, $item["_source"]["Body_".$lang]);
                    ?>
                    <h3><?= $title?></h3>
                    <p><?=   strlen($body) == 0 ? "": substr($body, 0, 250) . ' ...';?></p>
                </li>
            </a>
            <?php endforeach;?>

        </ul>
            <?php if($this->totalPage != 0) :?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    $prev = (int)$page - 1;
                    if($prev != 0) :?>
                        <li>
                            <a href="<?= urldecode($this->pimcoreUrl(['page' => $prev])); ?>" aria-label="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php

                    for ($p = 1; $p <= $this->totalPage; $p++) :
                     ?>
                        <?php if ($p == $page): ?>
                            <li class="active"><a href="javascript:void(0)"><?= $p; ?></a></li>
                        <?php else :?>
                            <li><a href="<?= $this->pimcoreUrl(['page' => $p]); ?>"><?= $p; ?></a></li>
                        <?php endif;?>

                    <?php endfor;?>
                    <?php $next = (int)$page + 1;
                        if($next < $this->totalPage) :?>
                            <li>
                                <a href="<?= $this->pimcoreUrl(['page' => $next]); ?>" aria-label="Next">
                                <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                </ul>
            </nav>
            <?php endif;?>
        <?php endif;?>
    </div>
</section>



<!-- TEMPLATE -->
