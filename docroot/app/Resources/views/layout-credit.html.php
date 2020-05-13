<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="<?= $this->getLocale() ?>">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=\Pimcore\Tool::getHostUrl().'/static/images/favicon/favicon.png'?>"/>
    <link rel="shortcut icon" type="image/png" href="<?=\Pimcore\Tool::getHostUrl().'/static/images/favicon/favicon.png'?>"/>

    <?php
    $site = $this->document->getProperty("site");
    if($this->document instanceof \Pimcore\Model\Document\Page){
        if ($this->document->getTitle()) {
            // use the manually set title if available
            $this->headTitle()->set($this->document->getTitle());

        }
    }
    if($this->document == '/'){
        $this->headTitle()->set($this->document->getTitle());

    }

    if ($this->document->getDescription()) {
        // use the manually set description if available
        $this->headMeta()->appendName('description', $this->document->getDescription());
    }

    echo $this->headTitle();
    echo $this->headMeta();
    ?>

    <!-- Bootstrap -->

    <?php
    $this->headLink()->appendStylesheet('/static/css/vendor.min.css');
    $this->headLink()->appendStylesheet('/static/css/plugins.min.css');
    $this->headLink()->appendStylesheet('/static/css/main.css');

    if($this->editmode){
        $this->headLink()->appendStylesheet('/static/css/editmode.css');
    }


    $this->headLink()->appendStylesheet('/static/css/pages/homepage.css');

    echo $this->headLink();
    ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- </?php if ($site == "corporate") { ?>
    </?php echo $this->template('Includes/navigation-csr.html.php', ['documentInitiator' => $this->document->getId()]) ?>
</?php } else { ?> -->
    <?php echo $this->template('Includes/navigation-credit.html.php', ['documentInitiator' => $this->document->getId()]) ?>
<!-- </?php } ?> -->

<div id="site-container">
    <?php $this->slots()->output('_content'); ?>
</div>
<!-- CONTAINER -->
<!-- FOOTER -->
<?php if ($site == "corporate") { ?>
    <?= $this->inc("/" . $this->getLocale() . "/shared/includes/footer-corporate-contact") ?>
<?php } else { ?>
    <?= $this->inc("/".$this->getLocale()."/shared/includes/footer-credit") ?>
<?php } ?>
<!-- FOOTER -->
<!-- LOADER -->
<div id="loader-container"></div>
<!-- LOADER -->

<?php $this->headScript()->appendFile('/static/js/Includes/homepage.js'); ?>
<?php $this->headScript()->prependFile('/static/js/custom.js'); ?>
<?php $this->headScript()->prependFile('/static/js/app.min.js'); ?>
<?php $this->headScript()->prependFile('/static/js/plugins.min.js'); ?>
<?php $this->headScript()->prependFile('/static/js/vendor.min.js'); ?>
<!-- <script src="https://maps.google.com/maps/api/js?libraries=places,geometry&key=AIzaSyAd5-VfeP_L4EzX9HwrFsSP9ETaaAXEC3U&region=id&language=id&libraries=geometry,places&sensor=true"></script> -->
<?php echo $this->headScript(); ?>
</body>
</html>