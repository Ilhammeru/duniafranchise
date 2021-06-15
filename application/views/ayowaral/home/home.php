<style>
    @keyframes moveright {
        from {
            left: 0;
        }

        to {
            left: 95%;
        }
    }

    body {
        background-color: #fafafa;
    }

    .btn-member-banner {
        background: #d02127;
        background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
        background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
        border-radius: 5px;
        border: none;
        width: 100%;
        padding: 0.3em 1em;
        text-transform: capitalize;
        color: #FFD600;
    }

    .template-left-banner {
        width: 100%;
        height: 18em;
        background: #e6e6e6;
        border-radius: 5px;
        margin-top: 0.8em;
        transition: ease .5s;
        z-index: 10;
    }

    .template-right-banner,
    .template-center-banner {
        width: 100%;
        height: 12em;
        background-color: #e6e6e6;
        border-radius: 5px;
        transition: ease .5s;
        margin-top: 0.8em;
    }

    .template-top-banner {
        width: 100%;
        height: 14em;
        background-color: #e6e6e6;
        transition: ease .5s;
        margin-top: 5em;
        border-radius: 4px;
    }

    .template-button-member {
        width: 100%;
        height: 2em;
        background: #e6e6e6;
        border-radius: 5px;
    }

    .movement {
        background-color: #e6e6e6;
        box-shadow: -1px 2px 52px 0px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: -1px 2px 52px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -1px 2px 52px 0px rgba(0, 0, 0, 0.75);
        width: 2%;
        height: 100%;
        z-index: 1001;
        animation: moveright 1s infinite;
        position: relative;
    }

    .movement-top-banner,
    .movement-right-banner {
        background-color: #e6e6e6;
        box-shadow: -1px 2px 52px 0px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: -1px 2px 52px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -1px 2px 52px 0px rgba(0, 0, 0, 0.75);
        width: 3px;
        height: 100%;
        z-index: 1001;
        animation: moveright 1s infinite;
        position: relative;
    }


    .img-center-banner {
        width: 100%;
        height: auto;
    }

    .main-panel,
    .panel-news {
        margin-top: 0.8em;
        background-color: #F4F4F4;
        margin-bottom: 0;
    }

    .main-panel-title {
        color: #d02127;
    }

    .main-youtube-panel {
        margin-top: 0.8em;
    }

    .btn-welcome,
    .btn-berita {
        background: #d02127;
        background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
        background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
        border-radius: 5px;
        border: none;
        width: 100%;
        padding: 0.3em 1.5em;
        text-transform: capitalize;
        color: #FFD600;
        margin-top: 0.8em;
    }

    .main-article-title {
        color: #d02127;
        margin: 0;
        cursor: pointer;
    }

    .main-article-title:hover {
        color: #fa525e;
    }

    .main-article-update {
        font-size: 0.7em;
        color: #9d9d9d;
    }

    .main-article-content {
        margin: 1em 0;
        text-align: justify;
        font-weight: normal;
    }

    .border-article {
        border-bottom: 1px solid #d4d4d4;
        margin: 1em 0;
    }

    .p-all-news,
    .p-all-franchise {
        margin: 0.5em 0;
        color: #f7941d;
        text-transform: capitalize;
        font-size: 0.9em;
        cursor: pointer;
        transition: ease .2s;
    }

    .p-all-news:hover,
    .p-all-franchise:hover {
        color: #fadc6e;
    }

    .thumbnail {
        padding: 0;
        border: none;
        cursor: pointer;
    }

    .thumbnail > img {
        border-radius: 4px;
        transition: ease .5s;
    }

    .thumbnail > img:hover {
        transform: scale(1.1);
    }
</style>

<!-- section middle -->
<div class="<?= $centerSize; ?>">
    <!-- template main center -->
    <div class="template-center-banner template-img">
        <div class="movement-center-banner"></div>
    </div>
    <!-- end template main center -->
    <div class="main-center-banner">
        <img data-src="<?= base_url('ayowaral-images/topbanner/main-center-banner.jpeg'); ?>" class="lazyload img-center-banner" alt="">
    </div>

    <!-- button welcome -->
    <button class="btn-welcome">Selamat Datang</button>
    <!-- end button welcome -->

    <!-- card / panel -->
    <div class="panel panel-default main-panel">
        <div class="panel-body">
            <h4 class="main-panel-title">Selamat Datang di Ayo Waralaba</h4>
            <p>Ayo Waralaba merupakan portal yang bertujuan untuk membantu para calon franchisee (penerima waralaba) mendapatkan informasi mengenai bisnis franchise yang diinginkan sebelum memutuskan untuk memulai bisnis. </p>
            <p>Ayo Waralaba tidak hanya menampilkan direktori Franchise (Waralaba) tapi juga Peluang Usaha, Peluang Bisnis, Lisensi, dan Keagenan.</p>
        </div>
    </div>
    <!-- end card / panel -->

    <!-- youtube panel / card -->
    <iframe class="main-youtube-panel" width="100%" height="315" src="https://www.youtube.com/embed/AFGaUyHq0-0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
    <!-- end youtube panel / card -->

    <!-- portal waralaba -->
    <div style="margin-top: 0.6em;">
        <img class="lazyload" data-src="<?= base_url('ayowaral-images/portal-waralaba.jpeg'); ?>" alt="" style="width: 100%; height: auto;">
    </div>
    <!-- end portal waralaba -->

    <!-- center banner 1 -->
    <div style="margin-top: 0.8em;">
        <img class="lazyload" data-src="<?= $centerImg1; ?>" alt="" style="width: 100%; height: auto;">
    </div>
    <!-- end center banner 1 -->

    <!-- berita waralaba -->
    <button class="btn-berita">Berita Waralaba</button>

    <div class="panel panel-default panel-news">
        <div class="panel-body">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <?php for ($m = 0; $m < 3; $m++) : ?>
                        <h4 class="main-article-title"><?= $mainTitle[$m]; ?></h4>
                        <span class="main-article-update">(<?= $mainUpdated[$m]; ?>)</span>
                        <div class="main-article-content">
                            <?= $mainContent[$m]; ?>
                        </div>
                        <div class="<?= ($m == 2) ? '' : 'border-article'; ?>"></div>
                    <?php endfor; ?>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <?php for ($mm = 3; $mm < 6; $mm++) : ?>
                        <h4 class="main-article-title"><?= $mainTitle[$mm]; ?></h4>
                        <span class="main-article-update">(<?= $mainUpdated[$mm]; ?>)</span>
                        <div class="main-article-content">
                            <?= $mainContent[$mm]; ?>
                        </div>
                        <div class="<?= ($mm == 5) ? '' : 'border-article'; ?>"></div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="row" style="padding: 0 3em;">
                <div class="text-center col-12" style="border-top: 1px solid #d4d4d4 !important;">
                    <p class="p-all-news">Lihat semua berita</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end berita waralaba -->

    <!-- center banner 2 -->
    <div style="margin-top: 0.4em;">
        <?php for ($cm2 = 0; $cm2 < count($centerImg2); $cm2++) : ?>
            <img class="lazyload" data-src="<?= $centerImg2[$cm2]; ?>" alt="" style="width: 100%; height: auto; margin: 0.4em 0;">
        <?php endfor; ?>
    </div>
    <!-- end center banner 2 -->

    <!-- button welcome -->
    <button class="btn-welcome">Daftar Franchise</button>
    <!-- end button welcome -->

    <!-- thumbnail franchise -->
    <div class="row" style="margin-top: 0.8em;">
        <?php for ($tb = 0; $tb < count($thumbImg); $tb++) : ?>
            <div class="col-xs-3 col-xl-3 col-lg-3 col-md-3">
                <a href="" class="thumbnail">
                    <img src="<?= $thumbImg[$tb]; ?>" alt="">
                </a>
            </div>
        <?php endfor; ?>

        <div class="col-12 text-center">
            <p class="p-all-franchise">Lihat semua franchise</p>
        </div>
    </div>
    <!-- end thumbnail franchise -->

    <!-- last center banner -->
    <div>
        <?php for ($lb = 0; $lb < count($centerImg3); $lb++) : ?>
            <img class="lazyload" data-src="<?= $centerImg3[$lb]; ?>" alt="" style="margin-top: 0.8em; width: 100%; height: auto;">
        <?php endfor; ?>
    </div>
    <!-- end last center banner -->
</div>
<!-- end section middle -->

<!-- section right banner -->
<div class="<?= $rightSize; ?>" style="text-align: center;">

    <!-- template button member -->
    <div class="template-button-member template-img">
        <div class="movement-button-member"></div>
    </div>
    <!-- end template button member -->

    <!-- button member -->
    <button class="btn-member-banner">member banner</button>
    <!-- end button member -->

    <?php for ($tempr = 0; $tempr < count($rightBanner); $tempr++) { ?>
        <!-- template right banner -->
        <div class="template-right-banner template-img">
            <div class="movement-right-banner"></div>
        </div>
        <!-- end template right banner -->
    <?php } ?>

    <?php for ($r = 0; $r < count($rightBanner); $r++) { ?>

        <img class="lazyload img-right-banner" data-src="<?= $rightBanner[$r]; ?>" alt="" style="margin: 0.8em 0; width: 100%; height: auto;">

    <?php } ?>
</div>
<!-- end section right banner -->

</div>

<script>
    $(document).ready(function() {
        var image = document.images;

        var classlist = new Array();
        var imagesrc = new Array()
        for (var i = 0; i < image.length; i++) {
            classlist[i] = image[i].classList
            imagesrc[i] = image[i].dataset
        }

        for (var x = 0; x < classlist.length; x++) {
            var img = image[x]
            var downloadimg = new Image()
            downloadimg.onload = () => {
                img.src = this.src

                //hide all template image
                $('.template-img').hide()
            }
            downloadimg.src = imagesrc[x].src
        }
    })
</script>