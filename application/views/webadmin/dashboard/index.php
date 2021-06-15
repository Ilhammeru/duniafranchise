<!DOCTYPE html>

    <div class="row">

        <div class="col-lg-4 col-xs-4">

          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3><?php echo $countFranchise;?></h3>

              		<p>Franchise</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-cube"></i>
            	</div>
            	<a href="<?=site_url('franchise');?>" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>

        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-4">

          	<div class="small-box bg-orange">
            	<div class="inner">
              		<h3><?php echo $countArticle;?></h3>

              		<p>Article</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-newspaper-o"></i>
            	</div>
            	<a href="<?=site_url('article');?>" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>

        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-4">

          	<div class="small-box bg-red">

	            <div class="inner">
	            	<h3><?php echo $countVisitor;?></h3>

	            	<p>Unique Visitors</p>
	            </div>
	            <div class="icon">
	            	<i class="fa fa-users"></i>
	            </div>
	            <a href="<?=site_url('log_visitor');?>" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>

        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->

    <h2 class="page-header">Quick Access</h2>

	<div class="row">

		<?php

		if ($sessionData['pFranchiseReport'] == 1) {

		?>

		<div class="col-md-3 col-xs-3">

			<a href="<?=site_url('franchise');?>" class="btn btn-default btn-lg btn-block">
				Franchise
			</a>

		</div>

		<?php } ?>

		<?php

		if ($sessionData['pArticleReport'] == 1) {

		?>

		<div class="col-md-3 col-xs-3">

			<a href="<?=site_url('article');?>" class="btn btn-default btn-lg btn-block">
				Article
			</a>

		</div>

		<?php } ?>

		<?php

		if ($sessionData['pBannerView'] == 1) {

		?>

		<div class="col-md-3 col-xs-3">

			<a href="<?=site_url('banner');?>" class="btn btn-default btn-lg btn-block">
				Banner
			</a>

		</div>

		<?php } ?>

		<?php

		if ($sessionData['pAboutUsView'] == 1) {

		?>

		<div class="col-md-3 col-xs-3">

			<a href="<?=site_url('about_us');?>" class="btn btn-default btn-lg btn-block">
				About Us
			</a>

		</div>

		<?php } ?>

	</div>



<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/dashboard/index.php
-->