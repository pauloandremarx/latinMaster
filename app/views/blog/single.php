

<?= $this->layout('layouts/layout') ?>

<!--Javascript-->
<?= $this->start('javascript_header') ?><?= $this->end() ?>

<?= $this->start('mainContent') ?>


<header class="uk-box-shadow-large uk-margin-bottom">
    <div class="uk-position-relative uk-height-1-1" uk-slider="autoplay: true;autoplay-interval:5000;">
        <div class="uk-position-relative">
            <div class="uk-slider-container">
                <ul class="uk-slider-items uk-child-width-1-1 slider-banner">
                    <li>
                        <div>
                            <img class="uk-width-1-1 uk-visible@m" uk-img uk-cover src="<?= $this->baseUrl() ?>/img/banner_blog_latin.png" alt="Banner 1" title="Banner 1" />
                            <img class="uk-width-1-1 uk-hidden@m" uk-img uk-cover src="<?= $this->baseUrl() ?>/img/banner_blog_latin_mobile.png" alt="Banner Mobile 1" title="Banner Mobile 1" />
                        </div>
                    </li>

                </ul>
            </div>
            <div class=" ">
                <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
            </div>
        </div>
        <ul class="uk-position-bottom uk-slider-nav uk-dotnav uk-flex-center uk-margin dotnav-slider-home"></ul>
    </div>
</header>

<section class="uk-container blog-container">

    <div class="blog-hr">
        <p>Blog</p>
        <hr />
    </div>
    <h1><?= $post->title ?> </h1>
    <h3><?= $post->description ?> </h3>

    <div class="data">
        <div> <?= $post->created_at ?> | Tempo de leitura: 8 min</div>
    </div>

    <div id="conteudo">
     <?= $post->conteudo ?>
    </div>

     
</section>




<?= $this->end() ?>

