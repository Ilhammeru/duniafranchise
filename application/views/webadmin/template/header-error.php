<!DOCTYPE html>

<html class="" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php echo $titlePageLeft . ' | ' . $titlePageRight;?></title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- START STYLES -->
	
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/dataTables.min.css">
    
    <!-- DataTables Buttons Extensions -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">

    <!-- DataTables Responsive Extensions-->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">

    <!-- DataTables Select Extensions-->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/Select/css/select.dataTables.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/extensions/Select/css/select.bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/styles/background-customize.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/select2/select2.min.css">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datepicker/datepicker3.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css">

    <!-- bootstrap slider -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-slider/slider.css">

    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/additional-styles.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/all.css">

	<!-- END STYLES -->


    <!-- START PLUGINS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- App -->
    <script src="<?=base_url();?>assets/dist/js/app.min.js"></script>
    <!-- slimScroll -->
    <script src="<?=base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- DataTables -->
    <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- DataTables Button & Export Extensions -->
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/FixedHeader/js/fixedHeader.bootstrap.min.js"></script>

    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>

    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>

    <script src="<?=base_url();?>assets/plugins/jszip/jszip.min.js"></script>

    <script src="<?=base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>

    <!-- DataTables Responsive Extensions-->
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>

    <!-- DataTables Select Extensions-->
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Select/js/dataTables.select.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/Select/js/select.bootstrap.min.js"></script>

    <!-- DataTables RowReorder Extensions-->
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/RowReorder/js/dataTables.rowReorder.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/extensions/RowReorder/js/rowReorder.bootstrap.min.js"></script>

    <!-- Select2 -->
    <script src="<?=base_url();?>assets/plugins/select2/select2.full.min.js"></script>

    <!-- bootstrap datepicker -->
    <script src="<?=base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

    <!-- daterangepicker -->
    <script src="<?=base_url();?>assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- jquery migrate -->
    <script src="<?=base_url();?>assets/plugins/jquery.migrate/jquery.migrate.js"></script>

    <!-- ChartJS 1.0.1 -->
    <script src="<?=base_url();?>assets/plugins/chartjs/Chart.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
    
    <!-- CK Editor -->
    <script src="<?=base_url();?>assets/plugins/ckeditor/ckeditor.js"></script>
    
    <!-- Input Mask -->
    <script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.bundle.js"></script>  

    <!-- Bootstrap slider -->
    <script src="<?=base_url();?>assets/plugins/bootstrap-slider/bootstrap-slider.js"></script>

    <!-- END PLUGINS -->

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

        ul li a .sub-li-header {
            font-size: 20px!important
        }

        .dropdown-menu>li>a:hover {
            background-color: #e1e3e9;
            color: #333!important;
        }
        
        .content-wrapper{
            height: 100%;
        }
        .modal{
            height: 100%;
        }
        .breadcrumb li, .breadcrumb li a  {
            color: black;
            font-size: 10px;
        }
        .breadcrumb li a:hover {
            color: #d2d6de;
        }
        .breadcrumb li a i {
            margin: 0 5px 0 0;
        }
        h2 i {
            margin: 0 5px 0 0;
            font-size: 14px !important;
        }
        h2 small i {
            margin: 0 5px 0 0;
            font-size: 10px !important;
        }
        table {
            font-size: 11px;
        }
        table tr th i, table tr td i {
            margin: 0 5px 0 0;
        }
        a i {
            margin: 0 5px 0 0;          
        }
        .row .col-md-12 .col-xs-5 i {
            margin: 0 5px 0 0;              
        }
        .btn-group ul li a, ul .dropdown-menu a {
            margin: 0 5px 0 0;      
            font-size: 10px !important;
        }
        .modal-body i {
            margin: 0 5px 0 0;      
            font-size: 10px !important;
        }
        .modal-title i {
            margin: 0 5px 0 0;      
            font-size: 12px !important;         
        }
        .modal-footer i {
            margin: 0 5px 0 0;                  
        }
        label i {
            margin: 0 5px 0 0;          
        }
        table {
            width: 100% !important;
        }
        input[type="text"] {
            width: 100% !important;
        }
        .col-xs-2 i {
            margin: 0 5px 0 0;                  
        }
        table tbody tr td .btn {
            margin: 3px 0 0 0;
        }
    </style>
    
</head>

<link class="img-circle" href="<?=base_url() . $logoDir;?>" rel='icon' type='image/x-icon'/>

<body class="hold-transition skin-blue layout-top-nav fixed" onload="getLocation()">

	<header class="main-header">

		<nav class="navbar navbar-static-top">

			<div class="container">

				<div class="navbar-header">

                    <div id="logo">

                        <img src="<?=base_url() . $logoDir;?>" id="logo-header" alt="Company Logo">

                    </div>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
            	<div class="collapse navbar-collapse pull-left">

            		<ul class="nav navbar-nav">

            			<li>
            				<a href="<?=base_url();?>" target="_blank">
            					<span class=""><?php echo $webApplication['name'];?></span>
            				</a>
            			</li>

            			<li>
            				<a href="<?=site_url('dashboard');?>" data-toggle="tooltip" data-placement="bottom" title="Visit to Dashboard">
            					<i class="fa fa-dashboard fa-sm"></i>
            				</a>
            			</li>
                        
            		</ul>
            		<!-- /.nav -->

            	</div>
            	<!-- /.navbar -->

            </div>
            <!-- /.container-fluid -->

        </nav>

    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <ol class="breadcrumb">

            <?php echo $homeLink;?>

            <?php echo $linkMenu;?>
            
            <?php echo $sublinkMenu;?>

        </ol>

        <section class="invoice">


<!--
	This is a header
	End of file header-app.php
	Location: ./application/views/template/header-app.php
-->