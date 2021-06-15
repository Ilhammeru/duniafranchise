<!DOCTYPE html>
	
	<style>
		.lockscreen-item, .lockscreen-image, .lockscreen-credentials {
			background-color: #ecf0f5
		}
	</style>

	<!-- Automatic element centering -->
	<div class="lockscreen-wrapper">

        <div class="login-box">

        	<div class="login-box-body">
	 	
	 			<div class="lockscreen-logo">
					<a href="<?=base_url();?>" target="_blank"><img src="<?=base_url() . $logoDir;?>" width="300" height="225" alt="Company Logo"></img></a>
	  			</div>

	  			<!-- User name -->
	  			<div class="lockscreen-name text-center"><?php echo $users['name'];?></div>

	  			<!-- START LOCK SCREEN ITEM -->
	  			<div class="lockscreen-item">
	    		
	    			<!-- lockscreen image -->
	    			<div class="lockscreen-image">

	    				<?php
	    				if (empty($users['images'])) {

                            echo '<img src="' . base_url() . 'assets/img/no-image.jpg" alt="User Image" width="128" height="128">';                                    

                        } else {
	    					
	    					echo '<img src="' . base_url() . $users['images'] . '" alt="User Image" width="128" height="128">';

	    				}
	    				?>
	    				
	    			</div>
	    			<!-- /.lockscreen-image -->

	    			<!-- lockscreen credentials (contains the form) -->
	    			<form action="" method="post" class="lockscreen-credentials">

	      				<div class="input-group">
	        				<input type="password" name="inputPassword" class="form-control" placeholder="Password" id="focus" style="background-color: #ecf0f5" required>
	        				<div class="input-group-btn">
	        					<button type="submit" class="btn" style="background-color: #ecf0f5"><i class="fa fa-arrow-right text-muted"></i></button>
	        				</div>
	      				</div>
	      				
	    			</form>
	    			<!-- /.lockscreen credentials -->

	  			</div>
	  			<!-- /.lockscreen-item -->

		      	<div class="help-block text-center">
		      		<label class="label label-info">
		        		Enter your password to retrieve your session
		        	</label>
		      	</div>

		      	<div class="help-block text-center">
	  					<p>
	  						<center>
		  						<?php echo $this->session->flashdata('message');?>
		  						<?php echo validation_errors();?>
	  						</center>
	  					</p>
		      	</div>

	  			<div class="text-center">
		    		<a href="<?=site_url('lockscreen/session/destroy');?>" class="btn btn-info btn-xs">Sign in as a different user</a>
	  			</div>

				<div class="social-auth-links text-center">
					<br>
					<p>
						<img src="<?=base_url();?>assets/img/sl-logo.svg" style="width: 4rem">
						<br>
						<br>
						All right reserved © 2021 <b>Sosial Lab</b>
						<br>
						<small>
							Version <?php echo $webApplication['version'];?>
						</small>
					</p>
				</div>
				<!-- /.social-auth-links -->
	
            </div>
        	<!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
	</div>
	<!-- /.center -->	

<!--
	This is a content
	End of file login-wrong-password.php
	Location: ./application/views/webadmin/login/login-wrong-password.php
-->