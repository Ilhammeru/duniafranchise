		

	<style>

		#franchise-detail img {
			/* width:550px; */
			height:auto;
		}

		#left-banner img, #right-banner img {
			width:200px;
			height:400px;
			margin-bottom:10px;
		}
        img {
            width: 100%;
            height: auto;
        }
        .video-content {
            width: 100%;
            height: 405px;
        }
        .video-content > input {
            display: hidden!important;
        }
        video:focus{
            outline: none !important;
        }
		video {
			width: 65%;
			height: auto;
		}
	</style>

	<script type="text/javascript">

		$(document).ready ( function() {

			$('img').removeAttr('width');

			loadContent();

			loadLeftBanner();

			loadRightBanner();

			function loadLeftBanner() {

				$.ajax({
                    url: "<?=site_url('webpublic/franchise/loadLeftbanner/');?>",
                    dataType: 'json',
                    success: function(response){

                        createElementLeftBanner(response.result);

                    }
                });

			}

			function loadRightBanner() {

				$.ajax({
                    url: "<?=site_url('webpublic/franchise/loadRightbanner/');?>",
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

			function createElementFranchiseDetail(result) {

				$('#franchise-detail').empty();

				$('#franchise-detail').append(result.description);

			}

		});

		function loadContent() {
			var franchise_id = <?=$franchise_id;?>;
            $.ajax({
                url: "<?=site_url('webpublic/franchise/get_content');?>/" + franchise_id + '/1',
                success: function (data) {
					$('#spinner').html('');
                    $('#franchise-detail').html(data);
                }
            });
        }

	</script>

	<div class="row">

		<div class="col-md-3">

			<div id="left-banner"></div>

		</div>

		<div class="col-md-6">

			<div id="spinner"><center><img src="<?=base_url();?>assets/img/spinner/spinner.gif" style="width:200px;height:200px"></center></div>
			<div id="franchise-detail"></div>

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