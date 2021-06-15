	
	<div class="content-wrapper">

        <section class="content">

        	<div class="row">

        		<div class="col-xs-12">

        			<div class="box">

        				<div class="box-body">

				            <div class="row">

				                <div class="col-xs-12">

				                	<h5>Hasil Pencarian : "<?php echo $log;?>"</h5>

				                </div>

				            </div>

				            <?php

				            if (empty($franchises) && empty($news)) :

								echo '<div class="row"><div class="col-xs-12"><h5>Data tidak ditemukan</h5></div></div>';

							endif;

							if (! empty($franchises)) {

								foreach ($franchises as $row) :

							?>

							<hr>

				            <div class="row">

				                <div class="col-xs-12">

								<a href="<?=site_url('franchises/' . $row->slug);?>">

									<h5><?php echo $row->franchise_name;?></h5>
									<h6><label class="label label-warning pull-right">franchise</label></h6>	

									<h6><?php if (strlen($row->text) >= 90) { 
				                            echo rtrim(substr($row->text, 0, 90)) . '..'; 
				                        } else { 
				                            echo $row->text; 
				                        } ?>
				                    </h6>

								</a>

								</div>

							</div>

							<?php endforeach; } ?>

							<?php

							if (! empty($news)) {

								foreach ($news as $row) :

							?>

							<hr>

				            <div class="row">

				                <div class="col-xs-12">

								<a href="<?=site_url('news/' . $row->slug);?>" class="article-link">

									<h5><?php echo $row->title;?></h5>
									<h6><label class="label label-warning pull-right">artikel</label></h6>	

									<h6><?php if (strlen($row->content) >= 90) { 
				                            echo rtrim(substr($row->content, 0, 90)) . '..'; 
				                        } else { 
				                            echo $row->content; 
				                        } ?>
				                    </h6>

								</a>

								</div>
								
							</div>

							<?php endforeach; } ?>

						</div>

					</div>

				</div>

			</div>

        </section>

    </div>