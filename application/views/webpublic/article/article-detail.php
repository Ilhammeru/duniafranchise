               
    <style>

        .page-link {
            margin: 0 20px 0 20px;
            color: rgb(255,183,107);
        }

    </style>

    <script type='text/javascript'>

        $(document).ready(function(){
 
            $('#pagination').on('click','a',function(e){

                e.preventDefault(); 

                var sortBy;

                sortBy = $('#selectSorting').val();

                if (sortBy == null) {

                    sortBy = "";

                }

                var pageno = $(this).attr('data-ci-pagination-page');

                loadPagination(pageno, sortBy);

                window.scrollto(0, 0);

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

                        content = content.substr(0, 90) + '..';

                    }

                    var articleThumbnailImgPath = "<?php echo $articleThumbnailImgPath;?>";

                    var siteUrl = "<?php echo site_url('news');?>/" + result[index].slug;

                    var colmd = '<a href="' + siteUrl + '" class="article-link"><div class="col-md-6" style="padding: 0; height: 450px; margin-bottom: 20px">';

                    colmd += '<img src="' + articleThumbnailImgPath + thumbnail + '" alt="Article thumbnail" class="img-article-thumbnail">';
 
                    colmd += '<h3>' + title + '</h3>';

                    colmd += '<p style="width:550px; text-align:left;">' + content + '</p>';

                    colmd += '</div></a>';

                    $('#postsList').append(colmd);
  
                }
            }
       
        });

    </script>

        <div class="row">

            <h1><?php echo $article['title'];?></h1>
        </div>

        <div class="row">

            <p>
                <?php

                foreach ($franchiseRand as $row) {

                    $franchiseName[] = $row->franchise_name;

                    $franchiseThumbnail[] = $row->thumbnail;

                    $franchiseSlug[] = $row->slug;

                }

                $explode = explode("__IKLAN__", $article['content']);

                for ($i = 0; $i < count($explode); $i++) {

                    $j = $i + 1;

                    echo $explode[$i];

                    if ($j == count($explode)) {

                        echo '';

                    } else {

                    ?>

                    <a href="<?=site_url('franchises/' . $franchiseSlug[$i]);?>">

                        <div class="col-md-12" style="margin: 10px 0 10px 0">   
                            
                            <center><img src="<?php echo $franchiseThumbnailImgPath . $franchiseThumbnail[$i] . '?' . date('YmdHis');?>" alt="Franchise thumbnail" class="top-banner">
                                <br>

                            <div class="blink"><?php echo $franchiseName[$i];?></div></center>

                        </div>

                    </a>

                    <?php
                    }

                }

                ?>
            </p>

        </div>

        <br>

        <hr>

        <div class="row">

            <div id='postsList'></div>
           
        </div>

        <div class="row">
            
            <div id='pagination'></div>

        </div>
 
