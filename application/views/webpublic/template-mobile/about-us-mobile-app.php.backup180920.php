	

	<div class="content-wrapper">

    	<div class="container">

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

                        <div class="box-body">

                            <img src="<?php echo $franchiseThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" class="img-franchise-thumbnail" alt="Franchise thumbnail">

                        </div>

                        <div class="box-footer">
                            <?php echo $row->franchise_name;?>
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

                        <div class="box-body">

                            <img src="<?php echo $articleThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" class="img-article-thumbnail" alt="Article thumbnail">

                        </div>

                        <div class="box-footer">
                            <?php echo $row->title;?>
                        </div>

                    </div>

                </div>

                </a>

                <?php

                endforeach; ?>

            </div>

		</div>

	</div>