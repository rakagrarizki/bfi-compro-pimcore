<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Visi</div>
            <div class="col-sm-8"><?= $this->input("visi"); ?></div>
        </div>
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Title</div>
                <div class="col-sm-8"><?= $this->input("input-misi"); ?></div>
            </div>

        <?php } ?>
    </div>
</div>

<div class="visi-misi">
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-3">
                <h2>VISI</h2>
            </div>
            <div class="col-md-9">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor sunt earum vel vero dolorum labore consectetur reprehenderit in suscipit quisquam nostrum, assumenda deleniti consequuntur molestias accusamus voluptate nemo enim velit.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <h2>MISI</h2>
            </div>
            <div class="col-md-9">
                <div class="vm-slide">
                    <!-- loop disini -->
                    <div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sapiente necessitatibus quisquam? Quas eos autem eligendi pariatur voluptates quae similique maiores. Eaque eveniet deleniti pariatur illum velit repudiandae iste veritatis!
                        </p>
                    </div>
                    <!--  -->
                    <div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam soluta id eveniet rem dolor praesentium tempore iure pariatur, voluptatum illum. Optio laudantium eum dolorum voluptates iure, facilis nulla quis fugiat?
                        </p>
                    </div>
                    <div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ipsum dolores vero officia blanditiis voluptatum quo, consequuntur suscipit cumque veritatis. Porro illum repellendus saepe excepturi obcaecati nam, veritatis rerum eius?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="counter">
            <button type="button" class="prev cta cta-orange"><i class="fa fa-angle-left"></i></button>
            <div class="pagingInfo"></div>
            <button type="button" class="next cta cta-orange"><i class="fa fa-angle-right"></i></button>
        </div>
    </div>
</div>