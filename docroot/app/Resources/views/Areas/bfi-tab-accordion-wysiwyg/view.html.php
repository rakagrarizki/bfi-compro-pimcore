<?= $this->input("title");?>
<?php
// while ($this->block("tab")->loop()) {
//     echo $this->input("text");
//     while ($this->block("accordion")->loop()) {
//         echo $this->input("text1");
//         echo $this->wysiwyg("value");
//     }
// }
?>
<div class="tabs-accor">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input('title');?></h2>
        </article>
        <div>
            <ul class="nav nav-tabs" role="tablist" id="tabsAccor">
                <li role="presentation">
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                <li role="presentation">
                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                <li role="presentation">
                    <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                <li role="presentation">
                    <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="home">
                    <div class="accordion">
                        <div class="accordion__wrap produk">
                            <div class="container">
                                <div class="row">
                                    <div class="panel-group" id="accA">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accA" href="#a1">
                                                        Title A 01
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="a1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content A 01
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accA" href="#a2">
                                                        Title A 02
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="a2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content A 02
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="accordion">
                        <div class="accordion__wrap produk">
                            <div class="container">
                                <div class="row">
                                    <div class="panel-group" id="accB">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accB" href="#b1">
                                                        Title B 01
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="b1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content B 01
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accB" href="#b2">
                                                        Title B 02
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="b2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content B 02
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <div class="accordion">
                        <div class="accordion__wrap produk">
                            <div class="container">
                                <div class="row">
                                    <div class="panel-group" id="accC">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accC" href="#c1">
                                                        Title C 01
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="c1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content C 01
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accC" href="#c2">
                                                        Title C 02
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="c2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content C 02
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <div class="accordion">
                        <div class="accordion__wrap produk">
                            <div class="container">
                                <div class="row">
                                    <div class="panel-group" id="accD">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accD" href="#d1">
                                                        Title D 01
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="d1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content D 01
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="a-panelheading" data-toggle="collapse" data-parent="#accD" href="#d2">
                                                        Title D 02
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="d2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Content D 02
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>