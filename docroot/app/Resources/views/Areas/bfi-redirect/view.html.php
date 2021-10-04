<div class="redirect-page">
    <div class="sect-title text-center">
        <?php $asset = $this->image("sub-image");?>
        <img src="<?= $asset->getImage();?>" />
        <h1 class="page-title"><strong><?= $this->input('title');?></strong></h1>
        <?php if (!$this->input("subtitle")->isEmpty()) { ?>
        <div class="page-sub-title"><?= $this->input('subtitle');?></div>
        <?php } else { echo "<br>";} ?>
    </div>
</div>

<?php
    echo"
    <script type=\"text/javascript\">
        var utm_campaign = 'utm_campaign=' +sessionStorage.getItem('utm_campaign')
        var utm_medium = 'utm_medium=' +sessionStorage.getItem('utm_medium')
        var utm_source = 'utm_source=' +sessionStorage.getItem('utm_source')
        var utm_term = 'utm_term=' +sessionStorage.getItem('utm_term')
        var utm_content = 'utm_content=' +sessionStorage.getItem('utm_content');

        querySearch = utm_campaign +'&'+ utm_medium +'&'+ utm_source +'&'+ utm_term +'&'+ utm_content;
        
        var URL = '".$this->input('link')."';
        if(URL != ''){ 
            setTimeout(() => {
                if(sessionStorage.getItem('utm_campaign') != 'undefined') {
                    window.location = '". $this->input('link') ."?' + querySearch;
                } else window.location = '". $this->input('link') ."';
            }, 8000);
        }
    </script>
    ";
?>