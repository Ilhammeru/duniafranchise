
	<script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	
  	<script>

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
    		images_upload_url: "<?=site_url('about_us/image_upload');?>",
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
        
  </script>

   <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('about_us');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $titleMenu;?></h2></center>

        </div>

    </div>

    <br>

	<div class="row">

        <form class="form-horizontal" action="<?=site_url('about_us/save_content');?>" method="post" enctype="multipart/form-data">

		  <div class="col-md-12">

                <div class="row">

                    <div class="col-md-12">
                        
                        <textarea rows="25" id="post_content" name="post_content" class="form-control"><?php echo $aboutUs['content'];?></textarea>

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
    Location: ./application/views/webadmin/content/about_us/edit.php
-->