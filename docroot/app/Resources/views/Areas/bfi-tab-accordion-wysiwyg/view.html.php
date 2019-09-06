<?php
while ($this->block("tab")->loop()) {
    echo $this->input("text");
    while ($this->block("contentblock1")->loop()) {
        echo $this->input("text1");
        echo $this->wysiwyg("value");
    }

}
