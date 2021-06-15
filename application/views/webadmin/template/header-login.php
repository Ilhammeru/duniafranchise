<!DOCTYPE html>

<html class="signin no-js" lang="">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php echo $titlePageLeft . ' | ' . $titlePageRight;?></title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- START STYLES -->
	
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/styles/background-customize.css">

    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/additional-styles.css">


	<style>

		#logo {
            width: 120px;
            height: 50px;
        }

        #logo-header {
            width: 110px;
            height: 65px;
            position: absolute;
            top: 0;
        }

		body {
			background-color: #ecf0f5;
			overflow-y: hidden
		}

	</style>

	<!-- END STYLES -->

    <!-- START PLUGINS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>


	<!-- END PLUGINS -->

</head>

<link class="img-circle" href="<?=base_url() . $logoDir;?>" rel='icon' type='image/x-icon'/>

<body class="hold-transition skin-blue layout-top-nav fixed">

	<header class="main-header">

		<nav class="navbar navbar-static-top">

			<div class="container">

				<div class="navbar-header">

                    <div id="logo">

                        <img src="<?=base_url() . $logoDir;?>" id="logo-header" alt="Company Logo">

                    </div>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
            	<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            		<ul class="nav navbar-nav">
            			<li>
            				<a href="<?=base_url();?>" target="_blank">
            					<span class=""><?php echo $webApplication['name'];?></span>
            				</a>
            			</li>
            		</ul>
            	</div>
            	<!-- /.navbar-collapse -->

            </div>
            <!-- /.container-fluid -->
        </nav>

    </header>

<!--
	This is a header
	End of file header-login.php
	Location: ./application/views/webadmin/template/header-login.php
-->