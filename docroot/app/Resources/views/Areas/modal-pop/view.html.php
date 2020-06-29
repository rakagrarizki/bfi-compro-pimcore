<!-- Modal - myModal -->
<div id="ModalWidget" class="modal fade" role="dialog" style="overflow: hidden;">
  <div class="modal-dialog modal-dialog-centered" role="document" style="display: flex; justify-content: center;height: auto;">
    <!-- Modal content-->
    <div class="modal-content" style="width:70%">
        <div class="modal-body modal-profile">
            <div class="button-box"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <?php $asset = $this->image("image-pop"); ?>
                    <div class="img-step">
                        <img src="<?= $asset->getImage() ?>" class="img-responsive" alt="<?= $this->input("altimage") ?>" width="300">
                    </div>
                <h3 style="font-weight:bold;color:#04559f"><?= $this->input("title")?></h3>
                <p style="margin-bottom:32px"><?= $this->input("description"); ?></p>
                <a style="margin-bottom:32px" href="<?= $this->link('linkbutton')->getHref();?>" class="cta cta-orange cta-see cta-big"><?= $this->link('linkbutton')->getText(); ?></a>
            </div>
        </div>
    </div>

  </div>
</div>

<?php 

    if($this->checkbox("Checkbox")->isChecked()) {
        $script = "
            $(window).on('load',function(){  
                var showModal = localStorage.getItem('showModal');
                if(showModal == null){
                    $('#ModalWidget').modal('show');
                    localStorage.setItem('showModal',true);
                 }else{
                    localStorage.setItem('showModal',true);
                    $('#full_name').focus();
                 }
                
                
        });";
        $this->headScript()->appendScript($script, $type = 'text/javascript');
    } else {
        $script2 = "
            $(window).on('load',function(){  
                $('#ModalWidget').modal('show');
        });";
        $this->headScript()->appendScript($script2, $type = 'text/javascript');
    }

?>
s