
    <style>
        .carousel-item {
            /* margin: 0 10px 0 10px !important; */
        }
        .content > .row > .carousel {
            padding: 0;
        }
        .carousel-slide {
            position: absolute;
            top: 50%;
            font-size: 2.5em;
        }
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

                    <?php if (! empty ($topBanner)) { ?>

                    <div class="row" style="padding: 0 15px; margin-bottom: 15px">

                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            
                            <ol class="carousel-indicators">

                                <?php

                                for ($i = 0; $i < count($topBanner); $i++) {

                                    echo '<li data-target="#carousel-example-generic" class="carousel-item" data-slide-to="' . $i . '"';

                                    if ($i == 0 ) {

                                        echo 'class="active"></li>';

                                    } else {

                                        echo '</li>';

                                    }

                                }

                                ?>

                            </ol>
                                
                            <div class="carousel-inner">

                                <?php 

                                $i = 1;

                                foreach ($topBanner as $row) :

                                    if ($i == 1) {

                                        echo '<div class="item active">';

                                    } else {

                                        echo '<div class="item">';

                                    }

                                    if ($row->image_source != '') {

                                        if (! empty($row->franchise_id)) {

                                            if (! empty($row->slug)) {

                                                echo '<a href="' . site_url('franchises/' . $row->slug) . '">';

                                            }

                                        }

                                        echo '<img src="' . base_url() . substr($topBannerImgPath, 2) . $row->image_source . '?' . date('YmdHis') . '" style="width: 1200px; height: auto">';

                                        if (! empty($row->slug)) {

                                            echo '</a>';

                                        }
                                        echo '</div>';

                                    } else {

                                        echo '<img src="">
                                        </div>';

                                    }

                                    $i++;

                                endforeach;

                                ?>

                            </div>

                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="fa fa-angle-left carousel-slide"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="fa fa-angle-right carousel-slide"></span>
                            </a>
                        </div>

                    </div>

                    <?php } ?>

                    <div class="row">

                        <div class="col-xs-12">

                            <a href="<?=site_url('home/about_us');?>">

                            <div class="box box-widget">
                                
                                <div class="box-header with-border">
                                    
                                    Tentang Kami

                                </div>

                                <div class="box-body">
                            
                                    <h6><p>
                                        <?php 
                                        if (strlen($aboutUs['content']) >= 260) {

                                            echo substr($aboutUs['content'], 0, 260) . '..';

                                        } else {

                                            echo $aboutUs['content'];

                                        } ?>    
                                    </p></h6>

                                </div>

                            </div>

                            </a>

                        </div>
                        <!-- /.col-xs-12 -->

                    </div>
                    <!-- /.row -->

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box box-widget">
                                
                                <div class="box-header with-border">

                                    Daftar Franchise
                                    
                                    <div class="box-tools">
                                        <a href="<?=site_url('franchises-list');?>" class="btn btn-xs btn-warning float-right"><i>Franchise Lainnya</i></a>
                                    </div>

                                </div>

                                <div class="box-body">

                                    <?php

                                    foreach ($franchiseRand as $row) :

                                    ?>

                                    <a href="<?=site_url('franchises/' . $row->slug);?>">

                                        <div class="col-xs-6" style="padding: 0 5px; max-height: 300px">

                                            <img src="<?php echo $franchiseThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" alt="Franchise thumbnail" class="img-franchise-thumbnail">

                                            <h6>
                                                <?php echo $row->franchise_name;?>
                                            </h6>

                                        </div>

                                    </a>

                                    <?php

                                    endforeach; ?>

                                </div>

                            </div>

                        </div>
                        <!-- /.col-xs-12 -->

                    </div>
                    <!-- /.row -->

                    <div class="row">

                        <div class="col-sm-6 col-xs-12" style="margin-bottom: 20px">
                                
                            <div class="embed-responsive embed-responsive-16by9">
                                    
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/dRFTP3TPQmw" allowfullscreen></iframe>
                                
                            </div>

                        </div>
                        <!-- /.col-xs-12 -->

                        <div class="col-sm-6 col-xs-12">


                            <div class="box box-widget">
                                
                                <div class="box-header with-border">

                                Update Artikel

                                </div>

                                <div class="box-body">

                                    <?php

                                    echo '<ul>';

                                    foreach ($article as $row) :

                                        echo '<li style="text-align: justify;"><i><u><a href="'. site_url('news/' . $row->slug . '/') . '"><h5 style="margin: 5px 0">' . $row->title . '</h5></a></u></i></li>';

                                    endforeach;

                                    echo '</ul>';

                                    ?>

                                </div>

                                <div class="box-footer">

                                    <a href="<?=site_url('news');?>" class="btn btn-xs btn-warning"><i>Lihat semua</i></a>
                                
                                </div>

                            </div>

                        </div>
                        <!-- /.col-xs-12 -->

                    </div>
                    <!-- /.row -->

                </div>

            </div>

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->