
	<script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	
  	<script>

        var franchiseId = "<?php echo $franchiseId;?>";

    	tinymce.init({

    		selector: "#post_content",
    		plugins: [
		       "advlist autolink lists link image charmap print preview hr anchor pagebreak media",
		       "searchreplace wordcount visualblocks visualchars code fullscreen",
		       "insertdatetime nonbreaking save table contextmenu directionality",
		       "emoticons template paste textcolor colorpicker textpattern"
		    ],
    		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | media",
    		automatic_uploads: true,
    		image_advtab: true,
    		images_upload_url: "<?=site_url('franchise/image_upload/');?>" + franchiseId,
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

        function updateFranchise() {

            var inputFranchiseText = document.getElementById('inputFranchiseText').value;
            var inputFranchiseHits = document.getElementById('inputFranchiseHits').value;

            $.ajax({

                url: "<?=site_url('franchise/update_franchise/' . $franchiseId);?>",
                type: "post",
                data: {
                    inputFranchiseText : inputFranchiseText,
                    inputFranchiseHits : inputFranchiseHits
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
                $.ajax({
                    url:'<?=site_url('franchise/upload_thumbnail');?>',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data) {

                        document.getElementById('image-source').value = null;

                        alert("Upload Image Successfully");

                    }
                });
            });

        });
        
  </script>

   <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('franchise');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $franchiseName;?></h2></center>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-4">

            Decsription

            <hr style="padding:0; margin:0">

        </div>

        <div class="col-md-8">
 
            <input type="text" class="form-control" value="<?php echo $franchiseText;?>" id="inputFranchiseText" onchange="updateFranchise()">

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-4">

            Hits

            <hr style="padding:0; margin:0">

        </div>

        <div class="col-md-8">
 
            <input type="text" class="form-control" value="<?php echo $franchiseHits;?>" id="inputFranchiseHits" onchange="updateFranchise()">

        </div>

    </div>

    <br>

    <div class="row">

        <form class="form-horizontal" id="formSubmitImageUpload">

        <input type="hidden" name="inputFranchiseId" value="<?php echo $franchiseId;?>">

        <div class="col-md-4">

            Upload Thumbnail

            <hr style="padding:0; margin:0">

        </div>

        <div class="col-md-8">

            <div class="input-group">

                <input type="file" name="file" id="image-source" onchange="previewImage()" class="form-control">

                <span class="input-group-btn">

                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Upload</button>

                </span>

            </div>

            <br>

            <img style="width:350px;height:200px" id="image-preview" src="<?php if (! empty($thumbnailUrl)) { echo $thumbnailUrl; } ?>">

        </div>

        </form>

    </div>

    <br>

	<div class="row">

        <form class="form-horizontal" action="<?=site_url('franchise/save_content/' . $franchiseId);?>" method="post" enctype="multipart/form-data">

		    <div class="col-md-12">

                <div class="row">

                    <div class="col-md-12">
                        
                        <textarea rows="25" id="post_content" name="post_content" class="form-control"><?php if ($mode == 'edit') { echo $franchiseDescription; } ;?></textarea>

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
    Location: ./application/views/webadmin/content/franchise/add_content.php
-->