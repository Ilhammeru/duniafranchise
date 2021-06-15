
    
    <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('article');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

            <a href="<?=site_url('article/add_content/' . $articleId . '/edit');?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $articleTitle;?></h2></center>

        </div>

    </div>

	<div class="row">

		<div class="col-md-12">

            <div class="box-body table-responsive">

                <div class="row">

                    <div class="col-md-12">

                        <?php echo $articleContent;?>

                    </div>

                </div>

            </div>

		</div>
		
	</div>
	
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/article/detail_article.php
-->