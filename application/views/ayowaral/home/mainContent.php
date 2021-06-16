<!-- row start left banner - right banner -->
<div class="div-search" style="display: none;"></div>

<div class="div-home">
    <div class="row" style="padding: 0 1em;">

        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" style="margin-top: 0.8em; padding: 0;">
            <!-- button -->
            <button class="btn-member">member banner</button>
            <!-- end button -->

            <div>
                <?php for ($pr = 0; $pr < count($premImg); $pr++) : ?>
                    <img class="img-left" src="<?= $premImg[$pr]; ?>" alt="..." onclick="navigate(<?= $premId[$pr]; ?>, 'ayowaralaba/franchise/detail_brand/<?= $premId[$pr]; ?>')">
                <?php endfor; ?>
            </div>

            <!-- button -->
            <button class="btn-member">article</button>
            <!-- end button -->

            <!-- article shortcut -->
            <div class="card card-article-shortcut">
                <div class="card-body">
                    <ul>
                        <?php for ($art = 0; $art < count($artTitle); $art++) : ?>
                            <li><?= $artTitle[$art]; ?></li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
            <!-- end article shortcut -->

            <!-- button -->
            <button class="btn-member">member banner</button>
            <!-- end button -->

            <div>
                <?php for ($lf = 0; $lf < count($leftImg); $lf++) : ?>
                    <img class="img-left" src="<?= $leftImg[$lf]; ?>" alt="..." onclick="navigate(<?= $leftId[$lf]; ?>, 'ayowaralaba/franchise/detail_brand/<?= $leftId[$lf]; ?>')">
                <?php endfor; ?>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8" style="margin-top: 0.8em; padding: 0 0.5em;">
            <div style="margin-bottom: 0.8em;">
                <img src="<?= base_url('ayowaral-images/ayo-mulai.jpeg'); ?>" alt="..." style="width: 100%; height: auto;">
            </div>

            <!-- button -->
            <button class="btn-member">selamat datang</button>
            <!-- end button -->

            <div class="card card-welcome">
                <div class="card-body">
                    <h4 class="welcome-title">Selamat Datang di Ayo Waralaba</h4>
                    <p class="welcome-para">Ayo Waralaba merupakan portal yang bertujuan untuk membantu para calon franchisee (penerima waralaba)
                        mendapatkan informasi mengenai bisnis franchise yang diinginkan sebelum memutuskan untuk memulai bisnis.
                    </p>
                    <p class="welcome-para">
                        Ayo Waralaba tidak hanya menampilkan direktori Franchise (Waralaba)
                        tapi juga Peluang Usaha, Peluang Bisnis, Lisensi, dan Keagenan.
                    </p>
                </div>
            </div>

            <!-- youtube video -->
            <div>
                <iframe src="https://www.youtube.com/embed/AFGaUyHq0-0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
            </div>
            <!-- end youtube video -->

            <div style="margin-top: 0.7em;">
                <img src="<?= base_url('ayowaral-images/portal-waralaba.jpeg'); ?>" alt="..." style="width: 100%; height: auto;">
            </div>

            <div>
                <img src="<?= $cImg1; ?>" alt="..." style="width: 100%; height: auto; margin: 0.8em 0;">
            </div>

            <!-- button -->
            <button class="btn-member">berita waralaba</button>
            <!-- end button -->

            <div class="card card-news">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <?php for ($nw = 0; $nw < count($nwTitle); $nw++) : ?>
                                <div class="box-news">
                                    <h5 class="news-title"><?= $nwTitle[$nw]; ?></h5>
                                    <span class="news-time">(<?= $nwTime[$nw]; ?>)</span>
                                    <p class="news-content"><?= $nwContent2[$nw]; ?></p>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <div class="col-6">
                            <?php for ($nw2 = 0; $nw2 < count($nwTitle2); $nw2++) : ?>
                                <div class="box-news">
                                    <h5 class="news-title"><?= $nwTitle2[$nw2]; ?></h5>
                                    <span class="news-time">(<?= $nwTime2[$nw2]; ?>)</span>
                                    <p class="news-content"><?= $nwContent[$nw2]; ?></p>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="div-all-news">
                        <p>Lihat Semua Berita</p>
                    </div>
                </div>
            </div>

            <div>
                <?php for ($c4 = 0; $c4 < count($cImg4); $c4++) : ?>
                    <img src="<?= $cImg4[$c4]; ?>" alt="..." style="width: 100%; height: auto; margin: 0.8em 0;">
                <?php endfor; ?>
            </div>

            <!-- thumbail franchise -->
            <!-- button -->
            <button class="btn-member">daftar franchise</button>
            <!-- end button -->

            <div class="row" style="margin-top: 0.8em;">
                <?php for ($tm = 0; $tm < count($thumbImg); $tm++) : ?>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <div class="panel panel-default panel-thumbnail-franchise">
                            <div class="panel-body">
                                <img src="<?= $thumbImg[$tm]; ?>" alt="..." style="width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
                <div class="p-all-franchise">
                    <p>lihat semua franchise</p>
                </div>
            </div>
            <!-- end thumbnail franchise -->

            <div>
                <?php for ($cl = 0; $cl < count($clImg); $cl++) : ?>
                    <img src="<?= $clImg[$cl]; ?>" alt="..." style="width: 100%; height: auto; margin: 0.8em 0;">
                <?php endfor; ?>
            </div>

            <!-- row end left banner - right banner -->
        </div>