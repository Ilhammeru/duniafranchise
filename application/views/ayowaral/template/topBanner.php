<!-- top banner -->

<div class="row" style="padding: 0 4em;">
    <div class="col-xl-12 col-lg 12 col-md-12 col-sm-12 col-12">
        <!-- template top banner -->
        <div class="template-top-banner template-img">
            <div class="movement-top-banner"></div>
        </div>
        <!-- end template top banner -->

        <!-- carousel -->

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-top: 5em;">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php for ($i = 0; $i < count($topBanner); $i++) { ?>
                    <div class="item <?= ($topBanner[$i] == $firstBanner) ? 'active' : ''; ?>">
                        <img class="lazyload" src="<?= $topBanner[$i]; ?>" style="width: 100%; height: auto;">
                    </div>
                <?php } ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- end carousel -->
    </div>
</div>

<!-- end top banner -->