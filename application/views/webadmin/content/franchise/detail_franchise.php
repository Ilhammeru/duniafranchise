    <style>
        img {
            width: 100%;
            height: auto;
        }
        .video-content {
            width: 100%;
            height: 600px;
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
    
    <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('franchise');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

            <?php

            if($sessionData['pFranchiseEdit'] == 1) {

            ?>

            <a href="<?=site_url('franchise/add_content/' . $franchiseId . '/edit');?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>

            <?php } ?>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $franchiseName;?></h2></center>

        </div>

    </div>

	<div class="row">

		<div class="col-md-12">

            <div class="box-body table-responsive">

                <div class="row">

                    <div class="col-md-12">

                        <div id="franchise-description"></div>
                        

                    </div>

                </div>

            </div>

		</div>
		
	</div>

    <script>
        var franchise_id = <?=$franchiseId;?>;
        var loading = '<div class="overlay text-center" style="font-size: 3rem"><i class="fa fa-refresh fa-spin"></i></div>';

        $(document).ready( function () {
            get_content();
            // $('label[pseudo="-internal-media-controls-overflow-menu-list-item"]').hide();
        });

        function get_content() {

            $.ajax({
                url: "<?=site_url('franchise/get_content');?>/" + franchise_id,
                beforeSend: function() {    
                    $('#franchise-description').html(loading);
                },
                success: function (data) {
                    $('#franchise-description').html(data);
                }
            });
        }

    </script>
	
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/franchise/detail_franchise.php
-->