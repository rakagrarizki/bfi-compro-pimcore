<?phpimage
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:04
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Description</div>
            <div class="col-sm-8"><?php echo $this->wysiwyg("description", [
                    "placeholder" => "description",
                ]); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link</div>
            <div class="col-sm-8"><?= $this->link("url"); ?></div>
        </div>
    </div>
</div>


