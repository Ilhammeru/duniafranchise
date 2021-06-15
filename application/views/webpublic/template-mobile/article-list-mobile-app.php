
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

                window.scrollTo(0, 140);

            });
 
            loadPagination(0, "");
 
            function loadPagination(pagno, sort){

                $.ajax({
                    url: "<?=site_url('webpublic/article/loadRecord/');?>" + pagno,
                    type: 'post',
                    data :{
                        sort : sort,
                        rowperpage : 8
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
 
                    colmd += '<h6><p>' + title + '</p></h6>';

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

                var colmd = '<a href="<?=site_url('franchises');?>/' + slug + '"><img src="' + franchiseBannerImgPath + imageSource + '" alt="Franchise banner" class="img-franchise-banner"></a>';

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

                            <?php 

                            if (! empty($topBanner['franchise_id'])) {

                                echo '<a href="' . site_url('franchises/' . $topBanner['slug']) . '">';

                            }

                            ?>

                            <img src="<?=base_url() . substr($topBannerImgPath, 2) . $topBanner['image_source'] . '?' . date('YmdHis');?>" id="top-banner">

                            <?php echo '</a>'; ?>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box box-widget">
                                
                                <div class="box-header with-border">

                                Artikel/Berita

                                <select id="selectSorting">

                                        <option disabled selected value="">Urutkan berdasarkan</option>

                                        <option value="alfabet-asc">A-Z</option>
                                        <option value="alfabet-desc">Z-A</option>

                                    </select>

                                </div>

                                <div class="box-body">

                                    <div id='postsList'></div>
                                    
                                    <div id='pagination'></div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

