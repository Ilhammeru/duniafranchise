<div class="row main-row">

    <!-- start div main page non footer -->
    <div class="main-body-home">
    <!-- carousel -->
    <div class="row row-carousel">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding: 0;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php for ($tp = 0; $tp < count($topImg); $tp++) : ?>
                        <div class="carousel-item <?= ($firstTopImg == $topImg[$tp]) ? 'active' : ''; ?>">
                            <img src="<?= $topImg[$tp]; ?>" alt="" style="width: 100%; height: auto;">
                        </div>
                    <?php endfor; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- end carousel -->