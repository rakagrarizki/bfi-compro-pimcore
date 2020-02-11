<div class="document-table" style="min-height:10px">
    <div class="about-us-page">
        <div class="container">
            <?php echo $this->wysiwyg('value', ["customConfig" => "custom/ckeditor_config.js"]) ?>
        </div>
    </div>
</div>

<style>
#custom-table strong > span{
    font-size:11pt !important;
}
#custom-table  td:nth-child(2) > p:nth-child(1),
#custom-table  td:nth-child(5) > p:nth-child(1),
#custom-table  td:nth-child(7) > p:nth-child(1),
#custom-table  td:nth-child(7) > p:nth-child(2){
    margin:0;
}

</style>