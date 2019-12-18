<?php $q = htmlentities($this->getParam("q"));?>

<form action="/search">
    <section id="banner-result">
        <div class="container">
            <div class="banner-title">
                <div class="heading-1"><h1><?= $this->t("search-result");?></h1></div>
                <div class="search">
                    <div class="form-group">
                        <div class="search-form">

                            <input type="text" name="q" value="<?=$q?>"><i class="flaticon-search"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php
dump($this->document["items"]);
dump($this->blog["items"]);exit;

?>
