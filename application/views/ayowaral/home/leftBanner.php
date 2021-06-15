<!-- row start left banner - right banner -->
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