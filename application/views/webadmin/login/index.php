<!DOCTYPE html>

	<div class="content-wrapper">

		<div class="login-box">

			<div class="login-box-body">

				<div class="login-logo">
					<a href="<?=base_url();?>" target="_blank"><img src="<?=base_url() . $logoDir;?>" width="300" height="225" alt="Company Logo"></img></a>
				</div>
				<!-- /.login-logo -->
				
				<p class="login-box-msg">
					<label class="label label-info">Sign in to start your session</label>
				</p>
				
				<div class="row">
					<div class="col-xs-12">
						<p>
							<?php echo validation_errors();?>
						</p>
						<p>
							<?php echo $this->session->flashdata('message');?>
						</p>
					</div><!-- /.col-xs-12 -->
				</div><!-- /.row -->
				
				<form action="" method="post" accept-charset="utf-8">

					<div class="form-group has-feedback">
						<input type="text" name="inputUsername" class="form-control" placeholder="Username" required/>
						<span class="fa fa-user form-control-feedback"></span>
					</div>
					<!-- /.form-group -->
					
					<div class="form-group has-feedback">
						<input type="password" name="inputPassword" class="form-control" placeholder="Password" required />
						<span class="fa fa-lock fa-lg form-control-feedback"></span>
					</div>
					<!-- /.form-group -->
					
					<div class="row">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-primary btn-block">
								Sign In <i class="fa fa-sign-in"></i>
							</button>
						</div>
						<!-- /.col-xs-12 -->
					</div>
					<!-- /.row -->
				</form>

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
	<!-- /.content-wrapper -->

	<script>

		$(document).ready( function () {
			$('input[type="text"]').focus();
		});

	</script>
	
<!--
	This is a content
	End of file index.php
	Location: ./application/views/webadmin/login/index.php
-->


