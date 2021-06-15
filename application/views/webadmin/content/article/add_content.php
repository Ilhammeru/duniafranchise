
	<script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	
  	<script>

        var articleId = "<?php echo $articleId;?>";

    	tinymce.init({

    		selector: "#post_content",
    		plugins: [
		       "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		       "searchreplace wordcount visualblocks visualchars code fullscreen",
		       "insertdatetime nonbreaking save table contextmenu directionality",
		       "emoticons template paste textcolor colorpicker textpattern"
		    ],
    		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager",
    		automatic_uploads: true,
    		image_advtab: true,
    		images_upload_url: "<?=site_url('article/image_upload/');?>" + articleId,
    		file_picker_types: 'image', 
    		paste_data_images:true,
    		relative_urls: false,
    		remove_script_host: false,
    		file_picker_callback: function(cb, value, meta) {
		        var input = document.createElement('input');
		        input.setAttribute('type', 'file');
		        input.setAttribute('accept', 'image/*');
		        input.onchange = function() {
		            var file = this.files[0];
		            var reader = new FileReader();
		            reader.readAsDataURL(file);
		            reader.onload = function () {
            			var id = 'post-image-' + (new Date()).getTime();
			            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
			            var blobInfo = blobCache.create(id, file, reader.result);
			            blobCache.add(blobInfo);
			            cb(blobInfo.blobUri(), { title: file.name });
          			};
       			};
      			 input.click();
    		}

   		});

        function previewImage() {
            document.getElementById("image-preview").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
 
            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").src = oFREvent.target.result;
            };
        };

        function updateArticle() {

            var inputArticleStatus = document.getElementById('inputArticleStatus').value;

            $.ajax({

                url: "<?=site_url('article/update_article/' . $articleId);?>",
                type: "post",
                data: {
                    inputArticleStatus : inputArticleStatus
                },
                cache: false,
                success: function(data) {

                    alert('Saved Successfully');
                    
                }

            });

        };

        $(document).ready(function (){

            $('#formSubmitImageUpload').submit(function(e){
                e.preventDefault(); 

                var inputFile = document.getElementById('image-source').value;

                if (inputFile == '') {

                    alert('Choose file');

                    return false;

                }

                $.ajax({
                    url:'<?=site_url('article/upload_thumbnail');?>',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    beforeSend : function() {
                        $('#modalLoading').modal('show');
                    },
                    complete: function(data){

                        $('#modalLoading').modal('hide');

                        setTimeout(function(){
                            document.getElementById('image-source').value = null;

                            alert("Upload Image Successfully");
                        }, 1000);

                    }
                });
            });

        });
        
  </script>

   

   <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('article');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $articleTitle;?></h2></center>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-4">

            Status

            <hr style="padding:0; margin:0">

        </div>

        <div class="col-md-8">

            <select class="form-control select2" id="inputArticleStatus" onchange="updateArticle()">

                <?php

                if ($articleStatus == 1) {

                    echo '<option value="1" selected>Active</option>'; 
                    echo '<option value="0">Not Active</option>';

                } else {

                    echo '<option value="0" selected>Not Active</option>';
                    echo '<option value="1">Active</option>'; 

                }

                ?>

            </select>

        </div>

    </div>

    <br>

    <div class="row">

        <form class="form-horizontal" id="formSubmitImageUpload">

        <input type="hidden" name="inputArticleId" value="<?php echo $articleId;?>">

        <div class="col-md-4">

            Upload Thumbnail

            <hr style="padding:0; margin:0">

        </div>

        <div class="col-md-8">

            <div class="input-group">

                <input type="file" name="file" id="image-source" onchange="previewImage()" class="form-control">

                <div class="input-group-btn">

                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Upload</button>

                </div>

            </div>

            <br>

            <img style="width:550px;height:250px" id="image-preview" src="<?php if (! empty($thumbnailUrl)) { echo $thumbnailUrl . '?' . date('YmdHis'); } ?>">

        </div>

        </form>

    </div>

    <br>

	<div class="row">
        
        <form class="form-horizontal" action="<?=site_url('article/save_content/' . $articleId);?>" method="post" enctype="multipart/form-data">

		  <div class="col-md-12">

                <p>Sisipkan iklan dengan __IKLAN__</p>

                <div class="row">

                    <div class="col-md-12">
                        
                        <textarea rows="25" id="post_content" name="post_content" class="form-control"><?php if ($mode == 'edit') { echo $articleContent; } ;?></textarea>

                    </div>

                </div>

                <br>

                <div class="row">

                    <div class="col-md-12">

                        <button type="submit" class="btn btn-primary btn-block btn-cm">
                            <i class="fa fa-floppy-o"></i> Save
                        </button>

                    </div>

                </div>

            </div>

        </form>
		
	</div>
	
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/article/add_content.php
-->