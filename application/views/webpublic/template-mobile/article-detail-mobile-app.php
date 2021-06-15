    
    <style>

        img {
            width:100%;
            height:auto;
            margin-bottom:10px;
        }
    </style>
    <script type='text/javascript'>

        $(document).ready(function(){

            loadLeftBanner();
 
            $('#pagination').on('click','a',function(e){

                e.preventDefault(); 

                var sortBy;

                sortBy = $('#selectSorting').val();

                if (sortBy == null) {

                    sortBy = "";

                }

                var pageno = $(this).attr('data-ci-pagination-page');

                loadPagination(pageno, sortBy);

            });
 
            loadPagination(0, "");
 
            function loadPagination(pagno, sort){

                $.ajax({
                    url: "<?=site_url('webpublic/article/loadRecord/');?>" + pagno,
                    type: 'post',
                    data :{
                        sort : sort,
                        rowperpage : 4
                    },
                    dataType: 'json',
                    success: function(response){

                        $('#pagination').html(response.pagination);

                        createTable(response.result, response.row);

                    }
                });

            }
 
            function createTable(result){
                
                $('#postsList').empty();

                for (index in result){

                    var title = result[index].title;

                    var thumbnail = result[index].thumbnail;

                    var content = result[index].content;

                    if (content.length >= 90) {

                        content = content.substr(0, 100) + '..';

                    }

                    var articleThumbnailImgPath = "<?php echo $articleThumbnailImgPath;?>";

                    var siteUrl = "<?php echo site_url('news');?>/" + result[index].slug;

                    var getDate = "<?php echo date('YmdHis');?>";

                    var colmd = '<a href="' + siteUrl + '"><div class="col-sm-12 col-xs-12" style="padding: 5px">';

                    colmd += '<img src="' + articleThumbnailImgPath + thumbnail + '?' + getDate + '" alt="Article thumbnail" class="img-article-thumbnail">';
 
                    colmd += '<h5><p>' + title + '</p></h5>';

                    colmd += '</div></a>';

                    $('#postsList').append(colmd);
  
                }
            }

            $('#selectSorting').on('change', function () {

                var sortBy = $(this).val();

                loadPagination(0, sortBy);

            });
       
        });

        function loadLeftBanner() {

            $.ajax({
                url: "<?=site_url('webpublic/franchise/loadLeftbanner/');?>",
                dataType: 'json',
                success: function(response){
                    createElementLeftBanner(response.result);
                }
            });
        }

        function createElementLeftBanner(result) {

            $('#home-left-banner').empty();

            for (index in result) {
                
                var imageSource = result[index].image_source;

                var slug = result[index].slug;

                var franchiseBannerImgPath = "<?php echo $franchiseBannerImgPath;?>";

                var siteUrl = "<?php echo site_url('franchises');?>/" + slug;

                var colmd = '<a href="' + slug + '"><img src="' + franchiseBannerImgPath + imageSource + '" alt="Franchise banner" class="img-franchise-banner"></a>';

                $('#home-left-banner').append(colmd);

            }

        }

    </script>

    <div class="content-wrapper">

        <section class="content">

            <div class="row">

                <div class="col-xs-3">
                    <div id="home-left-banner"></div>
                </div>

                <div class="col-xs-9" style="padding-left: 0">

                    <div class="row">

                        <div class="col-xs-12">

                            <img src="<?php echo $articleThumbnailImgPath . $article['thumbnail'];?>" class="img-article-top-banner">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box box-widget">
                                
                                <div class="box-header with-border">

                                    <?php echo $article['title'];?>

                                </div>

                                <div class="box-body">

                            <?php

                        foreach ($franchiseRand as $row) {

                            $franchiseName[] = $row->franchise_name;

                            $franchiseThumbnail[] = $row->thumbnail;

                            $franchiseSlug[] = $row->slug;

                        }

                        $explode = explode("__IKLAN__", $article['content']);

                        for ($i = 0; $i < count($explode); $i++) {

                            $j = $i + 1;

                            echo '<h6>' . $explode[$i] . '</h6>';

                            if ($j == count($explode)) {

                                echo '';

                            } else {

                            ?>

                            <a href="<?=site_url('franchises/' . $franchiseSlug[$i]);?>">

                                <div class="col-xs-12" style="margin: 20px 0 20px 0">   
                                    
                                    <center>
                                        <img src="<?php echo $franchiseThumbnailImgPath . $franchiseThumbnail[$i] . '?' . date('YmdHis');?>" alt="Franchise thumbnail" class="iklan">
                                        
                                        <div class="blink"><?php echo $franchiseName[$i];?></div>
                                    </center>

                                </div>

                            </a>

                            <?php
                            }

                        }

                        ?>

                                </div>

                            </div>


                            <div class="box box-widget">

                                <div class="box-header with-border">
                                    Artikel
                                </div>

                                <div class="box-body">

                                    <div id='postsList'></div>

                                </div>

                                <div class="box-footer" style="padding: 0">

                                    <div id='pagination'></div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /. row -->

                </div>

            </div>

        </section>

    </div>
    <!-- /. content-wrapper -->

