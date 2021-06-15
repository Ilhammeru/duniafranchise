    
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
                    url: "<?=site_url('webpublic/franchise/loadRecord/');?>" + pagno,
                    type: 'post',
                    data :{
                        sort : sort,
                        rowperpage : 12
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

                    var franchiseName = result[index].franchise_name;

                    var thumbnail = result[index].thumbnail;

                    var text = result[index].text;

                    if (text.length >= 90) {

                        text = text.substr(0, 90) + '..';

                    }

                    var franchiseThumbnailImgPath = "<?php echo $franchiseThumbnailImgPath;?>";

                    var siteUrl = "<?php echo site_url('franchises');?>/" + result[index].slug;

                    var getDate = "<?php echo date('YmdHis');?>";

                    var colmd = '<a href="' + siteUrl + '" class="franchise-link"><div class="col-md-4" style="padding: 0; height: 300px; margin-bottom: 20px">';

                    colmd += '<img src="' + franchiseThumbnailImgPath + thumbnail + '?' + getDate + '" alt="Franchise thumbnail" class="img-franchise-thumbnail">';
 
                    colmd += '<h3>' + franchiseName + '</h3>';

                    colmd += '<p style="width:90%; text-align:justify;">' + text + '</p>';

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

        	<h1>Daftar Franchise</h1>

        </div>

        <div class="row">

            <span class="pull-right">

                <select id="selectSorting">

                    <option disabled selected value="">Urutkan berdasarkan</option>

                    <option value="alfabet-asc">A-Z</option>
                    <option value="alfabet-desc">Z-A</option>
                    <option value="populer">Populer</option>

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
 