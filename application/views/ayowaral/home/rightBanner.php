        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" style="margin-top: 0.8em; padding: 0;">
            <!-- button -->
            <button class="btn-member">member banner</button>
            <!-- end button -->

            <div>
                <?php for ($rb = 0; $rb < count($rightImg); $rb++) : ?>
                    <img class="img-right" src="<?= $rightImg[$rb]; ?>" alt="...">
                <?php endfor; ?>
            </div>
        </div>

        <!-- row end left banner - right banner -->
        </div>
    </div> 
</div> 