<!DOCTYPE html>

<html class="" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $titlePageLeft . ' | ' . $titlePageRight;?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="Keywords" content="dunia franchise, franchise murah, waralaba murah, franchise minuman, franchise coklat, franchise indonesia, waralaba indonesia, waralaba dalam negeri, waralaba, waralaba minuman, bisnis waralaba, franchise minuman coklat, info franchise waralaba, kios usaha, waralaba terlaris, waralaba populer, franchise, franchise terlaris, franchise populer, franchise coklat, waralabaku" />
    <meta name="title" content="" />
    <meta name="Description" content="Kumpulan franchise / waralaba minuman dan makanan dengan modal kecil dibawah 5 juta." />
    <meta name="language" content="id" />
    <meta name="organization" content="Dunia Franchise" />
    <meta name="copyright" content="Dunia Franchise" />
    <meta name="audience" content="All People" />
    <meta name="classification" content="Dunia Franchise" />
    <meta name="rating" content="general" />
    <meta name="page-topic" content="" />
    <meta name="robots" content="index,follow" />
    <meta name="googlebot" content="index,follow,snipet" />
    <meta name="revisit-after" content="1 days" />
    <meta name="mssmarttagspreventparsing" content="true" />
    <meta property="og:title" content="Waralaba minuman dan makanan murah."/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="https://www.duniafranchise.com/"/>
    <meta property="og:site_name" content="Dunia Franchise" />
    <meta property="og:description" content="Kumpulan franchise / waralaba minuman dan makanan dengan modal kecil dibawah 5 juta." />

    <!-- START STYLES -->
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/styles/background-customize.css">
 

    <!-- END STYLES -->


    <!-- START PLUGINS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?=base_url();?>assets/dist/js/adminlte.min.js"></script>
    <!-- App -->
    <script src="<?=base_url();?>assets/dist/js/app.min.js"></script>
    <!-- slimScroll -->
    <script src="<?=base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Lazy Size v5.3.2 -->
    <script src="<?=base_url();?>assets/plugins/lazysizes/lazysizes.min.js?v5.3.2"></script>

    <!-- END PLUGINS -->

    <style>

        .swipeleft {
            background-color: red;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont !important;
            background-color: #25282b;
        }

        .content-wrapper {
            margin-top: 50px;
        }
        
        .carousel-inner {
			border-radius: 5px;
			box-shadow: 3px 3px 3px #888888;
		}

        .logo-header {
            width: 95px;
            height: auto;
            position: absolute;
            top: 0;
        }

        .skin-blue .main-header .navbar {
            background-color: rgba(34,72,156,1);
        }

        .skin-blue .main-header .navbar .sidebar-toggle:hover {
            background-color: rgb(255,183,107);
        }

        .main-header > .navbar {
            margin-left: 0;
        }

        body.sidebar-open {
            overflow-y: hidden;
        }

        body.sidebar-open > footer {
            background-color: #25282b;
            filter: blur(5px); 
            pointer-events: none;
            opacity: 0.4;
        }

        aside.main-sidebar {
            position: fixed;
        }

        a.sidebar-toggle.pull-right {
            font-size: 16px;
        }

        ul.sidebar-menu > li.active > a > span, ul.sidebar-menu > li.active > a > i {
            color: rgb(255,183,107);
        }

        ul.sidebar-menu > li.active > a {
            border-left-color: rgb(255,183,107) !important; /*#3c8dbc;*/
        }

        .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
            background-color: #25282b;
        }

        .sidebar-menu > li > a {
            font-size: 16px;
            padding: 20px 5px 20px 15px;
            display: block;
        }

        input.form-control {
            font-size: 16px;
        }

        button#search-btn.btn.btn-flat {
            font-size: 16px;
        }

        #top-banner {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 3px;
        }

        .box-body {
            padding: 5px 10px 5px 10px;
            text-align: justify;
        }

        h5, h6, h6 > p {
            color: #666;
        }

        .img-franchise-thumbnail, .img-article-thumbnail {
            width: 100%;
            height: auto;
            border-radius: 3px;
            /*-webkit-box-shadow: 0 0 7px rgba(0,0,0,0.7);
            box-shadow: 0 0 7px rgba(0,0,0,0.7);*/
        }

        #franchise-detail img {
            width: 100%;
            height: auto;
        }

        iframe {
            border-radius: 3px;
        }

        .main-footer {
            background: #25282b;
            padding: 15px;
            color: #fff;
            border-top: 1px solid #d2d6de;
        }

        .logo-footer {
            width: 75px;
            height: auto;
            position: absolute;
            bottom: 0;
        }

        ul.list-unstyled > li {
            margin-bottom: 10px;
        }

        ul.list-unstyled > li > a {
            color: #fff;
        }

        .main-footer > .container-fluid > .row > .col-xs-12 > h5 > b {
            color: #fff;
            text-decoration: underline;
        }

        .main-sidebar, .left-side {
            padding-top: 50px;    
        }

        #selectSorting {
            font-size: 12px;
            margin: 0;
            padding: 0;
            border: none;
            float: right;
        }

        .page-link {
            margin: 0 20px 0 20px;
            color: rgb(255,183,107);
        }

        .img-article-top-banner {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 3px;
            -webkit-box-shadow: 0 0 7px rgba(0,0,0,0.7);
            box-shadow: 0 0 7px rgba(0,0,0,0.7);
        }

        .iklan {
            width: 50%;
            height: auto;
        }
        
        @-webkit-keyframes blinker {
          from {opacity: 1.0;}
          to {opacity: 0.0;}
        }

        .blink {
            text-decoration: blink;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 0.6s;
            -webkit-animation-iteration-count:infinite;
            -webkit-animation-timing-function:ease-in-out;
            -webkit-animation-direction: alternate;
        }

        @media (max-width: 767px) {

            .main-sidebar, .left-side {
                padding-top: 50px;    
            }

        }

        .isDisabled {
            background-color: black;
            filter: blur(1px); 
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
            pointer-events: none;
        }

        .blur {
            background-color: black;
            filter: blur(1px); 
        }

        /*.isDisabled {
            background-color: rgba(0,0,0,0.5);
            filter: blur(5px); 
            width: 100vw;
            height: 100vh;
            display: none;
            z-index: 999;
            position: absolute;
        }*/

        .row-fixed {
            padding: 1rem;
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 1202;
            width: 100%;
        }

        .btn-blue {
            background-color: #00a2ff ;
            border-radius: 1.250rem;
            color: white;
            font-weight: 800;
        }

    </style>

    <script type="text/javascript">

        $(document).ready( function () {

            $('.sidebar-toggle').on('click', function () {

                $('div.content-wrapper section.content').addClass('isDisabled');
                $('div.content-wrapper').addClass('blue');

                $('.content-wrapper').click(function () {

                    $('div.content-wrapper section.content').removeClass('isDisabled');
        
                });

            });

        });

        $(document).on('click', function(){

            if($('body').hasClass('sidebar-open')) {
                
                $('div.content-wrapper section.content').addClass('isDisabled');

                $('div.content-wrapper section.content .box').addClass('isDisabled');

                $('div.content-wrapper section.content .box img').addClass('isDisabled');

            } else {

                $('div.content-wrapper section.content').removeClass('isDisabled');

                $('div.content-wrapper section.content .box').removeClass('isDisabled');

                $('div.content-wrapper section.content .box img').removeClass('isDisabled');

            }

        })

    </script>
    
</head>

<link class="img-circle" href="<?=base_url() . $logoDir . '?' . date('YmdHis');?>" rel='icon' type='image/x-icon'/>

<body class="hold-transition skin-blue sidebar-collapse">
    
    <header class="main-header">

        <nav class="navbar navbar-fixed-top">

            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle pull-right" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu pull-left">

                <ul class="nav navbar-nav">

                    <li><a href="<?=base_url();?>"><img src="<?=base_url() . $logoDir . '?' . date('YmdHis');?>;?>" class="logo-header"></a></li>

                </ul>

            </div>

    </header>

    <aside class="main-sidebar">

        <section class="sidebar">

            <!-- search form -->
            <form action="<?=site_url('home/search');?>" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="key" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->

            <ul class="sidebar-menu" data-widget="tree">
                <li class="<?=$this->uri->segment(1) == '' || ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') ? 'active' : '';?>">
                    <a href="<?=site_url('home');?>">
                        <i class="fa fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="<?=$this->uri->segment(1) == 'franchises-list' || $this->uri->segment(1) == 'franchises' ? 'active' : '';?>">
                    <a href="<?=site_url('franchises-list');?>">
                        <i class="fa fa-archive"></i> <span>Daftar Franchise</span>
                    </a>
                </li>
                <li class="<?=$this->uri->segment(1) == 'news' ? 'active' : '';?>">
                    <a href="<?=site_url('news');?>">
                        <i class="fa fa-newspaper-o"></i> <span>Artikel</span>
                    </a>
                </li>
                <li class="<?=$this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'about_us' ? 'active' : '';?>">
                    <a href="<?=site_url('home/about_us');?>">
                        <i class="fa fa-info-circle"></i> <span>Tentang Kami</span>
                    </a>
                </li>
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="isDisabled"></div>