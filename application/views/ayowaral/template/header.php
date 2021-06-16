<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- START STYLES -->

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap-4/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- Sweetalert2 v10.3.5 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/dist/sweetalert2.min.css?v10.3.5">

    <!-- Bootstrap Colorpicker -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css?v2.5.2">

    <!-- END STYLES -->


    <!-- START PLUGINS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="<?= base_url(); ?>assets/bootstrap-4/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>assets/bootstrap-4/js/bootstrap.min.js"></script>
    <!-- App -->
    <script src="<?= base_url(); ?>assets/dist/js/app.min.js"></script>

    <!-- jquery migrate -->
    <script src="<?= base_url(); ?>assets/plugins/jquery.migrate/jquery.migrate.js"></script>

    <!-- ChartJS 1.0.1 -->
    <script src="<?= base_url(); ?>assets/plugins/chartjs/Chart.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

    <!-- CK Editor -->
    <script src="<?= base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>

    <!-- Input Mask -->
    <script src="<?= base_url(); ?>assets/plugins/input-mask/jquery.inputmask.bundle.js"></script>

    <!-- Bootstrap slider -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-slider/bootstrap-slider.js"></script>

    <!-- Sweetalert2 v10.3.5 -->
    <script src="<?= base_url(); ?>assets/plugins/sweetalert2/dist/sweetalert2.min.js?v10.3.5"></script>

    <!-- Bootstrap Colorpicker -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js?v2.5.2"></script>

    <!-- Lazy Size v5.3.2 -->
    <script src="<?= base_url(); ?>assets/plugins/lazysizes/lazysizes.min.js?v5.3.2"></script>

    <!-- END PLUGINS -->

    <style>
        body,
        html {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            background-color: #fafafa;
        }

        .row-carousel {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .navbar-brand {
            position: absolute;
            border: 1px solid #fff;
            padding: 0.8em 0.5em !important;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            top: -0.1em !important;
            background-color: #d02127;
            background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
            background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -o-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -ms-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: linear-gradient(to bottom, #d02127 0%, #9b0005 69%);
        }

        .navbar-brand>img {
            width: 100%;
            height: auto;
        }

        .navbar-item {
            margin-left: 13em;
        }

        .navbar {
            padding: 0.5em 9em;
            background-color: #d02127;
            background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
            background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -o-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -ms-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: linear-gradient(to bottom, #d02127 0%, #9b0005 69%);
            display: flex;
            justify-content: space-between;
        }

        .nav-link {
            color: #FFD600 !important;
        }

        .nav-link:hover {
            color: #fff !important;
        }

        .search-field {
            border: none;
            line-height: 1;
            font-size: 1vw;
        }

        .search-field:focus {
            border: none;
        }

        .search-field::placeholder {
            color: #FFD600;
        }

        .input-group-prepend,
        .input-group-append {
            padding: 0;
            line-height: 1;
            border: none;
        }

        .input-group-text {
            font-size: 1vw;
            border: none;
            color: #FFD600;
            background-color: #fff;
        }

        .main-body-home {
            margin: 0;
            padding: 0;
            margin-top: 5em;
            width: 100%;
            height: 100%;
            padding: 0 9em;
        }

        .btn-member {
            background-color: #d02127;
            background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
            background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -o-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -ms-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: linear-gradient(to bottom, #d02127 0%, #9b0005 69%);
            width: 100%;
            color: #FFD600;
            border: none;
            border-radius: 4px;
            font-size: 1vw;
            text-transform: capitalize;
            padding: 0.5em 0.7em;
        }

        .card-article-shortcut {
            margin: 0.8em 0;
            background-color: #d02127;
            background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
            background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -o-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -ms-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: linear-gradient(to bottom, #d02127 0%, #9b0005 69%);
            padding: 0;
            border-radius: 4px;
        }

        .card-article-shortcut>.card-body {
            padding: 0.4em 1em;
        }

        .card-article-shortcut>.card-body>ul {
            padding-left: 0.5em;
        }

        .card-article-shortcut>.card-body>ul>li {
            color: #FFD600;
            text-align: left;
            font-size: 1vw;
        }

        .img-left,
        .img-right {
            width: 100%;
            height: auto;
            margin: 0.8em 0;
            cursor: pointer;
        }

        iframe {
            width: 100%;
            height: 315px;
        }

        .card-welcome {
            margin-top: 0.8em;
        }

        .card-news {
            margin-top: 0.8em;
        }

        .news-title {
            color: #d02127;
            font-size: 1.1em;
            margin: 0;
            cursor: pointer;
        }

        .div-all-news {
            text-align: center;
        }

        .div-all-news>p {
            cursor: pointer;
            color: #FFD600;
            text-transform: capitalize;
            margin: 0;
        }

        .div-all-news>p:hover {
            color: orange;
        }

        .news-title:hover {
            text-decoration: underline;
        }

        .news-time {
            font-size: 0.7em;
        }

        .news-content {
            font-size: 0.9em;
        }

        .box-news {
            border-bottom: 1px solid #e6e6e6;
            margin: 0.8em 0;
            height: 8em;
        }

        .welcome-title {
            color: #d02127;
        }

        .div-back-btn {
            margin-bottom: 0.8em;
        }

        .back-btn {
            width: 100%;
            border: none;
            padding: 0.5em 0;
            text-transform: uppercase;
            border-radius: 4px;
            background: #428bca;
            box-shadow: 0px -3px 20px 1px rgba(57, 54, 54, 0.75) inset;
            -webkit-box-shadow: 0px -3px 20px 1px rgba(57, 54, 54, 0.75) inset;
            -moz-box-shadow: 0px -3px 20px 1px rgba(57, 54, 54, 0.75) inset;
            color: #fff;
            transition: ease .2s;
        }

        .back-btn:hover {
            transform: scale(1.05);
        }

        .card-navigation,
        .card-navigation-news {
            background: #f4f4f4;
            border: none;
            margin-top: 0.8em;
            display: none;
        }

        .card-navigation>.card-body>div,
        .card-navigation-news>.card-body>div {
            display: flex;
            justify-content: space-between;
        }

        .card-navigation>.card-body>div>div,
        .card-navigation-news>.card-body>div>div {
            cursor: pointer;
        }

        .card-search {
            text-align: end;
            margin-top: 0.8em;
            background: #f4f4f4;
            border: none;
            padding: 0.8em;
        }

        .btn-search {
            border: 1px solid #d02127;
            background: transparent;
            color: #d02127;
            margin-left: 1em !important;
        }

        .btn-search:focus,
        .btn-search:hover {
            background: #d02127 !important;
            color: #fff !important;
            border-radius: #d02127 !important;
        }

        .card-franchise {
            height: 20em;
            border: none;
        }

        .franchise-name {
            text-align: center;
            color: #d02127;
            font-size: 1.2em;
            font-weight: bolder;
            cursor: pointer;
        }

        .franchise-name:hover {
            text-decoration: underline;
        }

        .franchise-content {
            text-align: center;
        }

        .pagination-franchise {
            text-align: center;
            width: 100% !important;
        }

        .table-detail-franchise {
            border-right: 1px solid #e6e6e6;
            width: 100%;
        }

        .card-detail-franchise {
            border: 1px solid red;
            margin: 0.8em 0;
        }

        .detail-franchise-label,
        .detail-franchise-semicolon {
            font-size: 0.8em;
            vertical-align: top;
        }

        .detail-franchise-value {
            font-size: 0.7em;
        }

        .helper-text-detail-franchise,
        .detail-text-value {
            font-size: 0.8em;
        }

        .img-detail {
            width: 100%;
            height: auto;
        }

        .div-1,
        .div-2 {
            font-size: 0.8em;
            font-weight: bolder;
        }

        .detail-description-value>p>img {
            width: 100% !important;
            height: auto !important;
        }

        .card-detail-description {
            padding: 1em 5em;
            border: none !important;
        }

        .col-franchise-menu {
            padding: 0.4em;
        }

        .card-page-news {
            height: 22em;
            border: none;
            margin: 0.4em 0;
        }

        .page-news-title {
            color: #d02127;
            cursor: pointer;
        }

        .page-news-title:hover {
            text-decoration: underline;
        }

        .page-news-content {
            font-weight: normal;
        }

        .news-target {
            padding: 0 0.8em;
            margin-top: 0.8em;
        }

        #detail-news {
            display: none;
        }

        #right-banner-news {
            margin-top: 0.8em;
            padding: 0;
        }

        .detail-activity-news {
            display: flex;
            justify-content: flex-start;
            border-top: 1px solid #e6e6e6;
            border-bottom: 1px solid #e6e6e6;
            padding: 0.5em 0;
        }

        .detail-news-title {
            text-transform: uppercase;
            margin-bottom: 0.8em;
        }

        .content-input {
            font-size: 0.8em;
        }

        .col-footer-1,
        .col-footer-2,
        .col-footer-3 {
            width: 100%;
        }

        .div-footer {
            background-color: #d02127;
            background: -moz-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d02127), color-stop(69%, #9b0005));
            background: -webkit-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -o-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: -ms-linear-gradient(top, #d02127 0%, #9b0005 69%);
            background: linear-gradient(to bottom, #d02127 0%, #9b0005 69%);
            width: 100%;
            padding: 1em 5em;
        }

        .p-footer-navigation {
            color: #fff !important;
            border-bottom: 1px solid #fff;
            text-transform: capitalize;
            font-size: 0.9em;
        }

        .nav-item-footer {
            margin: 0.2em 0;
        }

        .nav-link-footer {
            padding: 0;
            color: #fff !important;
            text-transform: capitalize;
            font-size: 0.8em;
            font-weight: 300 !important;
        }

        .nav-link-footer:hover {
            text-decoration: underline;
        }

        .btn-twitter {
            background: #1b95e0;
            color: #fff !important;
            padding: 0.2em 0.5em;
            border-radius: 4px;
            font-size: 0.8em;
        }

        #calendar,
        #user,
        #bookmarks,
        #visit-times {
            font-size: 0.8em;
            margin: 0 0.5em;
            text-transform: capitalize;
        }

        .fa-calendar,
        .fa-bookmark-o,
        .fa-user,
        .fa-eye {
            color: red;
        }

        .p-all-news,
        .p-all-franchise {
            text-align: center;
        }

        .p-all-news>p,
        .p-all-franchise>p {
            margin: 0;
            color: #f7941d;
            cursor: pointer;
        }

        .p-all-news>p:hover,
        .p-all-franchise>p:hover {
            color: red;
        }

        @media screen and (max-width: 414px) {
            .main-body-home {
                margin-top: 3em;
            }

            .navbar-brand {
                width: 4em !important;
                top: -0.1em !important;
                padding: 0.3em 0.1em !important;
            }

            .card-news>.card-body {
                padding: 0.5em;
            }

            .navbar {
                padding: 0.1em;
            }

            .navbar-item {
                font-size: 0.4em;
                margin-left: 13em !important;
                display: -webkit-inline-box;
            }

            .img-left,
            .img-right {
                width: 100%;
                height: auto;
                margin: 0.2em 0;
            }

            .card-article-shortcut {
                margin: 0.2em 0;
            }

            .card-article-shortcut>.card-body {
                padding: 0.4em 0.5em;
            }

            .card-article-shortcut>.card-body>ul {
                padding: 0;
            }

            .welcome-title {
                font-size: 0.9em;
            }

            .welcome-para {
                font-size: 0.8em;
            }

            iframe {
                height: 200px;
            }

            .news-title {
                font-size: 0.7em;
            }

            .news-time {
                font-size: 0.3em;
            }

            .news-content {
                font-size: 0.6em;
            }

            .box-news {
                height: 8em;
            }

            .div-all-news>p {
                font-size: 0.7em;
            }

            .card-franchise {
                height: 9.5em !important;
            }

            .card-franchise>.card-body {
                padding: 0.1em !important;
            }

            .franchise-name {
                font-size: 0.5em !important;
            }

            .franchise-content {
                font-size: 0.4em !important;
            }

            .card-search>.card-body {
                padding: 0;
            }

            .card-search>.card-body>span {
                font-size: 0.6em;
            }

            .btn-search {
                font-size: 0.5em;
            }

            .daftar-franchise {
                padding: 0.5em;
                font-size: 0.4em;
            }

            .div-back-btn {
                margin-bottom: 0.2em;
            }

            .back-btn {
                font-size: 0.5em;
            }

            .col-franchise-menu {
                padding: 0.2em;
            }

            .dr-link {
                font-size: 0.6em;
            }

            .card-detail-description {
                padding: 0;
            }

            .card-detail-description>.card-body {
                padding: 0.2em;
            }

            .card-navigation>.card-body,
            .card-navigation-news>.card-body {
                padding: 0.4em;
            }

            .div-1,
            .div-2 {
                font-size: 0.5em;
            }

            .search-field {
                height: 5em !important;
            }

            .search-field:focus {
                border: none;
                box-shadow: none;
            }

            .page-news-title {
                color: #d02127;
                cursor: pointer;
                font-size: 0.7em;
            }

            .page-news-title:hover {
                text-decoration: underline;
            }

            .page-news-content {
                font-weight: normal;
                font-size: 0.6em;
            }

            .card-page-news {
                height: 12em;
                border: none;
                margin: 0.4em 0;
            }

            .card-page-news>.card-body {
                padding: 0.5em;
            }

            .btn-member-news {
                padding: 0.5em 1.5em;
                font-size: 0.4em;
            }

            .btn-member-banner-news {
                padding: 0.5em 1em;
                font-size: 0.4em;
            }

            .div-footer {
                width: 100%;
                padding: 0.5em 1em;
            }

            .p-footer-navigation {
                color: #fff !important;
                border-bottom: 1px solid #fff;
                text-transform: capitalize;
                font-size: 0.7em;
            }

            .nav-item-footer {
                margin: 0.2em 0;
            }

            .nav-link-footer {
                padding: 0;
                color: #fff !important;
                text-transform: capitalize;
                font-size: 0.6em;
                font-weight: 300 !important;
            }

            .nav-link-footer:hover {
                text-decoration: underline;
            }

            .btn-twitter {
                background: #1b95e0;
                color: #fff !important;
                padding: 0.2em 0.5em;
                border-radius: 4px;
                font-size: 0.7em;
            }

            #calendar,
            #user,
            #bookmarks,
            #visit-times {
                font-size: 0.3em;
                margin: 0 0.5em;
                text-transform: capitalize;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar {
                padding: 0.1em 1em;
            }

            .navbar-brand {
                width: 8em;
            }

            .navbar-item {
                margin-left: 10em;
                display: -webkit-inline-box;
            }

            .nav-link {
                margin: 0 0.5em;
            }

            .search-field {
                height: 3em;
            }

            .main-body-home {
                padding: 0 0.5em;
            }

            .card-franchise {
                height: 18em;
            }

            .card-franchise>.card-body {
                padding: 0.5em;
            }

            .franchise-name {
                font-size: 0.9em;
            }

            .franchise-content {
                font-size: 0.8em;
            }
        }
    </style>

    <title><?= $title; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div>
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('images/logo-navbar.jpeg'); ?>" alt="">
            </a>

            <ul class="navbar-nav navbar-item">
                <li class="nav-item main-nav active-nav" data-nav="home" onclick="navigatePage('home')">
                    <a class="nav-link">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item main-nav" data-nav="franchise" onclick="navigatePage('franchise')">
                    <a class="nav-link">Daftar franchise</a>
                </li>
                <li class="nav-item main-nav" data-nav="news" onclick="navigatePage('news')">
                    <a class="nav-link">Berita</a>
                </li>
            </ul>
        </div>

        <div>
            <form class="form-inline">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-bars"></i></span>
                    </div>
                    <input type="text" class="form-control search-field" placeholder="Pencarian" aria-label="Username" aria-describedby="basic-addon1" onchange="search_franchise()">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </form>
        </div>
    </nav>