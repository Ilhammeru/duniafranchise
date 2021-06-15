<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" id="right-banner-news">
    <!-- button -->
    <button class="btn-member">member banner</button>
    <!-- end button -->

    <div>
        <?php for ($rb = 0; $rb < count($rightImg); $rb++) : ?>
            <img class="img-right" onclick="navigate(<?= $rightImg[$rb]; ?>, 'ayowaralaba/franchise/detail_brand/<?= $rightImg[$rb]; ?>')" src="<?= $rightImg[$rb]; ?>" alt="">
        <?php endfor; ?>
    </div>
</div>
</div>
</div>