        
    <style>

        #selectSorting {
            margin:20px 0 20px 0;
            padding: none;
            border: none;
        }

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

                window.scrollTo(0, 510);

            });
 
            loadPagination(0, "");
 
            function loadPagination(pagno, sort){

                $.ajax({
                    url: "<?=site_url('webpublic/article/loadRecord/');?>" + pagno,
                    type: 'post',
                    data :{
                        sort : sort,
                        rowperpage : 10
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

                    var colmd = '<a href="' + siteUrl + '" class="article-link"><div class="col-md-6" style="padding: 0; height: 250px; margin-bottom: 20px">';

                    colmd += '<img src="' + articleThumbnailImgPath + thumbnail + '?' + getDate + '" alt="Article thumbnail" class="img-article-thumbnail">';
 
                    colmd += '<h4>' + title + '</h4>';

                    colmd += '<div style="width:90%; text-align:justify;">' + content + '</div>';

                    colmd += '</div></a>';

                    $('#postsList').append(colmd);
  
                }
            }

            $('#selectSorting').on('change', function () {

                var sortBy = $(this).val();

                loadPagination(0, sortBy);

            });
       
        });

    </script>

		<div class="row">

        	<h1>Artikel / News</h1>

            <span class="pull-right">

                <select id="selectSorting">

                    <option disabled selected value="">Urutkan berdasarkan</option>

                    <option value="alfabet-asc">A-Z</option>
                    <option value="alfabet-desc">Z-A</option>


                </select>

            </span>

        </div>

        <br>

        <div class="row">

            <div id='postsList'></div>
           
        </div>

        <div class="row">
            
            <div id='pagination'></div>

        </div>
 