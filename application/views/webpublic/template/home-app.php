

        <div class="row">

        	<h1>Tentang Kami</h1>
        	<?php 
			echo '<div style="text-align: justify">';
			if (strlen($aboutUs['content']) >= 340) {
				echo substr($aboutUs['content'], 0, 340) . '..';
			} else {
				echo $aboutUs['content'];
			} 
			echo '</div>'; ?>    

        	<p><a href="<?=site_url('home/about_us');?>" class="btn btn-warning pull-right"><i>Selanjutnya ></i></a></p>

        </div>

        <div class="row">

        	<h1>Daftar Franchise</h1>

        </div>

        <div id="daftar-franchise">

        <div class="row">

        	<?php

        	$i = 0;

        	foreach ($franchiseRand as $row) :
        		$i++;
			?>

				<div class="col-md-6" style="padding: 0; height: 350px; max-height: 350px; margin-bottom: 20px;">   
        		<a href="<?=site_url('franchises/' . $row->slug);?>"><img src="<?php echo $franchiseThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" alt="Franchise thumbnail" class="img-franchise-thumbnail" style="border-radius: 5px"></a>

        		<h3>
                    <a href="<?=site_url('franchises/' . $row->slug);?>" class="franchise-link"><?php echo $row->franchise_name;?></a>
                </h3>

        		<p style="width:350px; text-align:left;">
                    <?php 
                        if (strlen($row->text) >= 90) { 
                            echo rtrim(substr($row->text, 0, 90)) . '..'; 
                        } else { 
                            echo $row->text; 
                        } 
                    ?>
                </p>

        	</div>

        	<?php 

        	for ($x = 0; $x < 8; $x = $x + 2) :

        		if ($x == $i) {

        			echo '</div><div class="row">';

        		}

        	endfor;

        	if ($i == 6) {

        	?>

        		<div class="row">

        			<div class="col-md-8" style="margin-bottom: 20px">
        				
        				<div class="embed-responsive embed-responsive-16by9">
  							
  							<iframe class="embed-responsive-item" style="width:750px; height:400px" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
						
						</div>

        			</div>
        			<div class="col-md-4" style="padding:0">

        				<h1>Update Artikel</h1>

        				<?php

        				echo '<ul style="margin-top:50px">';

        				foreach ($article as $row) :

        					echo '<li style="text-align:justify"><i><u><a href="'. site_url('news/' . $row->slug . '/') . '" class="article-link">' . $row->title . '</a></u></i></li>';

        				endforeach;

        				echo '</ul>';

        				?>

        				<p style="margin-top:50px">
                            <a href="<?=site_url('news');?>" class="btn btn-warning"><i>Selanjutnya ></i></a>
                        </p>
        				
        			</div>

        		</div>

        	<?php

        	}

        	endforeach;?>

        </div>

    	</div>

    	<div class="row" style="margin-bottom:30px">

        	<p><a href="<?=site_url('franchises-list');?>" class="btn btn-warning pull-right"><i>Lihat Semua ></i></a></p>

    	</div>
