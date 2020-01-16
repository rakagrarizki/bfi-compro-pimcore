<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<section id="search">
    <div class="container">
        <div class="search-wrapper">
            <input id="search-input" class="input-search" type="text" placeholder="Search Here...">
            <button id="search-on" onclick="search(this.id)">
                <img id="button-search" src="/static/images/icon/search.png" widht="36" height="36">
            </button>
        </div>
        <p id="search-result"></p>

        <ul id="result-list" class="hide">
            <a href="">
                <li id="result-wrapper">
                    <h6>Produk</h6>
                    <h3>Pembiayaan dengan Jaminan BPKB <span class="highlight">Motor</span></h3>
                    <p><span class="highlight">Kredit Motor</span> kini lebih mudah dengan pembiayaan BFI hingga 4 tahun. Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum excepturi dolor voluptate sint magnam! Officiis eaque totam aspernatur quam neque dicta, maiores iure, voluptatum quidem molestiae aperiam, tenetur placeat. Ipsa!</p>
                </li>
            </a>
            <a href="">
                <li id="result-wrapper">
                    <h6>Produk</h6>
                    <h3>Pembiayaan dengan Jaminan BPKB <span class="highlight">Motor</span></h3>
                    <p><span class="highlight">Kredit Motor</span> kini lebih mudah dengan pembiayaan BFI hingga 4 tahun. Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum excepturi dolor voluptate sint magnam! Officiis eaque totam aspernatur quam neque dicta, maiores iure, voluptatum quidem molestiae aperiam, tenetur placeat. Ipsa!</p>
                </li>
            </a>
            <a href="">
                <li id="result-wrapper">
                    <h6>Produk</h6>
                    <h3>Pembiayaan dengan Jaminan BPKB <span class="highlight">Motor</span></h3>
                    <p><span class="highlight">Kredit Motor</span> kini lebih mudah dengan pembiayaan BFI hingga 4 tahun. Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum excepturi dolor voluptate sint magnam! Officiis eaque totam aspernatur quam neque dicta, maiores iure, voluptatum quidem molestiae aperiam, tenetur placeat. Ipsa!</p>
                </li>
            </a>
        </ul>
    </div>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/search.js'); ?>