<!DOCTYPE html>

	<div class="content-wrapper">

		<div class="login-box">

			<div class="login-box-body">

				<div class="login-logo">
					<a href="<?=base_url();?>"><img src="<?=base_url() . $logoDir;?>" width="300" height="225"></img></a>
				</div>
				<!-- /.login-logo -->
				
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
				
				<form action="" method="post">

					<div class="form-group has-feedback">
						<p>
							Continue and delete previous sessions?
						</p>

						<div class="row">
							<div class="col-xs-6">
								<input type="checkbox" name="inputAgree" value="agree" required style="margin: 0 5px 0 0"> I agree
							</div>
							<!-- /.col-xs-6 -->
							<div class="col-xs-6">
								<button type="submit" class="btn btn-primary btn-xs btn-block">Sign In <i class="fa fa-sign-in"></i></button>
							</div>
							<!-- /.col-xs-6 -->
						</<div>
						<!-- /.row -->

					</div>
					<!-- /.form-group -->

					<br>

					<div class="form-group has-feedback">
							
						<div class="row">
							<div class="col-xs-12">
								<center>
									<a href="<?=site_url('signin');?>" class="btn btn-info btn-xs">Or back to sign in page</a>
								</center>
							</div>
							<!-- /.col-xs-12 -->
						</div>
						<!-- /.row -->

					</div>
					<!-- /.form-group -->

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

<!--
	This is a content
	End of file login-attention.php
	Location: ./application/views/login/login-attention.php
-->

