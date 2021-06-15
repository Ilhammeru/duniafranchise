<style>
    .panel-article {
        margin-top: 0.8em;
        background: #d02127;
        background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
        background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
        background: -o-linear-gradient(top, #d02127 0%, #9b0005 69%);
        background: -ms-linear-gradient(top, #d02127 0%, #9b0005 69%);
        background: linear-gradient(to bottom, #d02127 0%, #9b0005 69%);
        padding: 0;
    }

    .panel-article>.panel-body {
        padding: 0;
    }

    ul {
        padding: 0 2em;
    }

    .list-article {
        color: #FFD600 !important;
        background: none;
        border: none;
        text-align: left;
        margin: 0.5em 0;
        cursor: pointer;
        font-size: 0.9em;
    }

    .list-article:hover {
        color: #fff !important;
    }

    .more-tips {
        text-align: right;
        padding: 0 1.5em;
        margin: 1em 0;
    }

    .border-top {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 0.5em;
    }

    .more-tips>span {
        color: #FFD600;
        font-size: 0.8em;
    }
</style>

<div class="row" style="padding: 0 4em; margin-top: 0.8em;">
    <!-- section left banner -->
    <div class="<?= $leftSize; ?>" style="text-align: center;">

        <!-- template button member -->
        <div class="template-button-member template-img">
            <div class="movement-button-member"></div>
        </div>
        <!-- end template button member -->

        <!-- button member -->
        <button class="btn-member-banner">member banner</button>
        <!-- end button member -->

        <!-- premium banner -->
        <?php for ($pr = 0; $pr < count($premiumImg); $pr++) : ?>
            <!-- template banner -->
            <div class="template-left-banner template-img">
                <div class="movement"></div>
            </div>
            <!-- end template banner -->

            <img class="lazyload img-left-banner" data-src="<?= $premiumImg[$pr]; ?>" alt="" style="margin: 0.8em 0; width: 100%; height: auto;">
        <?php endfor; ?>
        <!-- end premium banner -->

        <!-- ################################### border article ######################### -->
        <!-- button member -->
        <button class="btn-member-banner">Article</button>
        <!-- end button member -->
        <div class="panel panel-default panel-article">
            <div class="panel-body">
                <ul>
                    <?php for ($i = 0; $i < count($title); $i++) : ?>
                        <li class="list-article"><?= $title[$i]; ?></li>
                    <?php endfor; ?>
                </ul>
                <div class="more-tips">
                    <div class="border-top"></div>
                    <span>Semua tips</span>
                </div>
            </div>
        </div>
        <!-- ################################### end border article ######################### -->

        <!-- template button member -->
        <div class="template-button-member template-img">
            <div class="movement-button-member"></div>
        </div>
        <!-- end template button member -->

        <!-- button member -->
        <button class="btn-member-banner">member banner</button>
        <!-- end button member -->

        <?php for ($temp = 0; $temp < count($leftBanner); $temp++) { ?>
            <!-- template image -->
            <div class="template-left-banner template-img">
                <div class="movement"></div>
            </div>
        <?php } ?>

        <?php for ($l = 0; $l < count($leftBanner); $l++) { ?>

            <img class="lazyload img-left-banner" data-src="<?= $leftBanner[$l]; ?>" alt="" style="margin: 0.8em 0; width: 100%; height: auto;">

        <?php } ?>

    </div>
    <!-- end section left banner -->