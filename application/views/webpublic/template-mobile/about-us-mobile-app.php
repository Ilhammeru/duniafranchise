    	    
    <style>

        #home-left-banner img {
            width:100%;
            height:auto;
            margin-bottom:10px;
        }
    </style>
    
    <script>

        $(document).ready( function () {
            loadLeftBanner();
        });

        function loadLeftBanner() {

            $.ajax({
                url: "<?=site_url('webpublic/franchise/loadLeftbanner/');?>",
                dataType: 'json',
                success: function(response){
                    createElementLeftBanner(response.result);
                }
            });
        }

        function createElementLeftBanner(result) {

            $('#home-left-banner').empty();

            for (index in result) {
                
                var imageSource = result[index].image_source;

                var slug = result[index].slug;

                var franchiseBannerImgPath = "<?php echo $franchiseBannerImgPath;?>";

                var colmd = '<a href="<?=site_url('franchises');?>/' + slug + '"><img src="' + franchiseBannerImgPath + imageSource + '" alt="Franchise banner" class="img-franchise-banner"></a>';

                $('#home-left-banner').append(colmd);

            }

        }

    </script>

    <div class="content-wrapper">

        <section class="content">

            <div class="row">

                <div class="col-xs-3">
                    <div id="home-left-banner"></div>
                </div>

                <div class="col-xs-9" style="padding-left: 0">

                    <div class="row">

                        <div class="col-xs-12">

                            <img src="<?php echo $aboutUsBanner . '?' . date('YmdHis');?>" id="top-banner">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box box-widget">
                                
                                <div class="box-header with-border">
                                    
                                    Tentang Kami

                                </div>

                                <div class="box-body">

                                    <h6><?php echo $aboutUs['content'];?></h6>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12">

                        <?php

                        foreach ($franchiseRand as $row) :

                        ?>

                        <a href="<?=site_url('franchises/' . $row->slug);?>">

                        <div class="col-sm-3 col-xs-6" style="padding: 3px">

                            <div class="box box-widget">

                                <div class="box-header with-border">
                                    <?php echo $row->franchise_name;?>
                                </div>

                                <div class="box-body">

                                    <img src="<?php echo $franchiseThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" class="img-franchise-thumbnail" alt="Franchise thumbnail">

                                </div>

                                <div class="box-footer">
                                    <label class="label label-warning">franchise</label>
                                </div>

                            </div>

                        </div>

                        </a>

                        <?php

                        endforeach; ?>

                        </div>

                    </div>

                    <div class="row">

                        <?php

                        foreach ($articleRand as $row) :

                        ?>

                        <a href="<?=site_url('news/' . $row->slug);?>">

                        <div class="col-xs-12">

                            <div class="box box-widget">

                                <div class="box-header with-border">
                                    <?php echo $row->title;?>
                                </div>

                                <div class="box-body">

                                    <img src="<?php echo $articleThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" class="img-article-thumbnail" alt="Article thumbnail">

                                </div>

                                <div class="box-footer">
                                    <label class="label label-warning">artikel</label>
                                </div>

                            </div>

                        </div>

                        </a>

                        <?php

                        endforeach; ?>

                    </div>

                </div>

            </div>

		</section>

	</div>