<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php
$this->headScript()->offsetSetFile(100, '/static/js/Includes/contact-us.js');
?>

<?php if (!$this->success) { ?>
    <div class="container">
        <div class="row">
            <div id="success" class="contact-us success-wrapper">
                <div class="img-wrap">
                    <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
                </div>
                <div class="text-wrap text-center">
                    <h3><?= $this->t('fail_email'); ?></h3>
                    <p><?= $this->t('fail_email_msg'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="row">
            <div id="success" class="contact-us success-wrapper">
                <div class="img-wrap">
                    <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
                </div>
                <div class="text-wrap text-center">
                    <h3><?= $this->t('success_email'); ?></h3>
                    <p><?= $this->t('success_email_msg'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>