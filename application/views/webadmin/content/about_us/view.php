
    
    <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('dashboard');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

            <?php

            if ($sessionData['pAboutUsEdit'] == 1) {

            ?>

            <a href="<?=site_url('about_us/edit');?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>

            <?php } ?>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $titleMenu;?></h2></center>

        </div>

    </div>

	<div class="row">

		<div class="col-md-12">

            <div class="box-body table-responsive">

                <div class="row">

                    <div class="col-md-12">

                        <?php echo $aboutUs['content'];?>

                    </div>

                </div>

            </div>

		</div>
		
	</div>
	
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/about_us/view.php
-->