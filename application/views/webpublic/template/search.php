	
	<style>

		#left-banner img, #right-banner img {
			width:200px;
			height:400px;
			margin-bottom:10px;
		}

	</style>

	<script type="text/javascript">

		$(document).ready ( function() {

			$('img').removeAttr('width');

			loadFranchiseDetail();

			loadLeftBanner();

			loadRightBanner()

			function loadLeftBanner() {

				$.ajax({
                    url: "<?=site_url('webpublic/franchise/loadLeftbanner/');?>",
                    type: 'get',
                    dataType: 'json',
                    success: function(response){

                        createElementLeftBanner(response.result);

                    }
                });

			}

			function loadRightBanner() {

				$.ajax({
                    url: "<?=site_url('webpublic/franchise/loadRightbanner/');?>",
                    type: 'get',
                    dataType: 'json',
                    success: function(response){

                        createElementRightBanner(response.result);

                    }
                });

			}

			function createElementLeftBanner(result) {

				$('#left-banner').empty();

                for (index in result) {
                    
                    var imageSource = result[index].image_source;

                    var slug = result[index].slug;

                    var franchiseBannerImgPath = "<?php echo $franchiseBannerImgPath;?>";

                    var siteUrl = "<?php echo site_url('franchises');?>/" + slug;

                    var colmd = '<a href="' + slug + '"><img src="' + franchiseBannerImgPath + imageSource + '" alt="Franchise banner" class="img-franchise-banner"></a>';

                    $('#left-banner').append(colmd);
  
                }

			}

			function createElementRightBanner(result) {

				$('#right-banner').empty();

                for (index in result) {
                    
                    var imageSource = result[index].image_source;

                    var slug = result[index].slug;

                    var franchiseBannerImgPath = "<?php echo $franchiseBannerImgPath;?>";

                    var siteUrl = "<?php echo site_url('franchises');?>/" + slug;

                    var colmd = '<a href="' + slug + '"><img src="' + franchiseBannerImgPath + imageSource + '" alt="Franchise banner" class="img-franchise-banner"></a>';

                    $('#right-banner').append(colmd);
  
                }

			}

		});

	</script>

	<div class="row">

		<div class="col-md-3">

			<div id="left-banner"></div>

		</div>

		<div class="col-md-6">

			<div class="row">

				Hasil Pencarian : "<?php echo $log;?>"

			</div>

			<?php

			if (empty($franchises) && empty($news)) :

				echo '<div class="row">Data tidak ditemukan</div>';

			endif;

			if (! empty($franchises)) {

				foreach ($franchises as $row) :

			?>

				<a href="<?=site_url('franchises/' . $row->slug);?>" class="franchise-link"><div class="row">

					<h3><?php echo $row->franchise_name;?></h3>
					<h5><label class="label label-warning pull-right">franchise</label></h5>	

					<p><?php if (strlen($row->text) >= 90) { 
                            echo rtrim(substr($row->text, 0, 90)) . '..'; 
                        } else { 
                            echo $row->text; 
                        } ?>
                    </p>

				</div></a>

				<hr>

			<?php endforeach; } ?>

			<?php

			if (! empty($news)) {

				foreach ($news as $row) :

			?>

				<a href="<?=site_url('news/' . $row->slug);?>" class="article-link"><div class="row">

					<h3><?php echo $row->title;?></h3>
					<h5><label class="label label-warning pull-right">artikel</label></h5>	

					<p><?php if (strlen($row->content) >= 90) { 
                            echo rtrim(substr($row->content, 0, 90)) . '..'; 
                        } else { 
                            echo $row->content; 
                        } ?>
                    </p>

				</div></a>

				<hr>

			<?php endforeach; } ?>

		</div>

		<div class="col-md-3">

			<h1>Update Artikel</h1>

        	<?php

        	echo '<ul style="margin-top:50px">';

        	foreach ($article as $row) :

        		echo '<li style="text-align:justify"><i><u><a href="'. site_url('news/' . $row->slug . '/') . '" class="article-link">' . $row->title . '</a></u></i></li>';

        	endforeach;

        	echo '</ul>';

        	?>

        	<p style="margin-top:50px"><a href="<?=site_url('news');?>" class="btn btn-warning"><i>Selengkapnya ></i></a></p>

			<center><div id="right-banner"></div></center>

		</div>

	</div>