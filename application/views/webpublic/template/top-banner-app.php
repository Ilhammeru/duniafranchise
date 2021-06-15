
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
	
		<style>
			.carousel-item {
				margin: 0 10px 0 10px !important;
			}
			.carousel-slide {
				position: absolute;
    			top: 45%;
    			font-size: 2.5em;
			}
			#home-left-banner img {
				width:200px;
				height:400px;
				margin-bottom:10px;
			}
			img {
				width: 100%;
				height: auto;
			}
		</style>

		<div class="row">

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<div id="home-left-banner"></div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">

    	<?php
    	if (! empty ($topBanner)) {
    	?>

    	<div class="row">

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