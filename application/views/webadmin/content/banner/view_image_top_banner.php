	
	<script type="text/javascript">

        var newDate = new Date().getTime();

		function previewImage() {
    		document.getElementById("image-preview").style.display = "block";
    		var oFReader = new FileReader();
     		oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
 
    		oFReader.onload = function(oFREvent) {
      			document.getElementById("image-preview").src = oFREvent.target.result;
    		};
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
                    url:'<?=site_url('banner/upload_top_banner');?>',
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

        function changeStatus() {

            var topBannerId = "<?php echo $topBanner['id'];?>";
            var status = $("#status").val();
            var inputUrl = $('#inputUrl').val();

            $.ajax({
                url:'<?=site_url('banner/change_status_top_banner');?>',
                type:"post",
                data: {
                    topBannerId : topBannerId,
                    status : status,
                    inputUrl : inputUrl
                },
                success: function(data){

                    alert("Updated Successfully");

                }
            });

        }

        function changeUrl() {

            var topBannerId = "<?php echo $topBanner['id'];?>";
            var status = $("#status").val();
            var inputUrl = $('#inputUrl').val();

            $.ajax({
                url:'<?=site_url('banner/change_status_top_banner');?>',
                type:"post",
                data: {
                    topBannerId : topBannerId,
                    status : status,
                    inputUrl : inputUrl
                },
                success: function(data){

                    alert("Updated Successfully");

                }
            });

        }

	</script>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <h2><?php echo $topBanner['name'];?></h2>

    </div>

    <br>

    <?php

    if (! empty($img_url)) {

    ?>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <div class="col-md-4">

            Status

        </div>

        <div class="col-md-8">

            <select id="status" onchange="changeStatus()" class="form-control">

                    <?php 

                    if ($topBanner['status'] == 1) {

                        echo '<option value="1">Active</option>';

                    } else {

                        echo '<option value="0">Not Active</option>';

                    }

                    ?>

                </option>
                <option value="1">Active</option>
                <option value="0">Not Active</option>

            </select>

        </div>

    </div>

    <br>

    <?php } ?>

	<?php

	if ($sessionData['pBannerEdit'] == 1){

	?>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <div class="col-md-4">

            Url (link)

        </div>

        <div class="col-md-8">

            <select id="inputUrl" class="form-control" onchange="changeUrl()">

                <?php

                if (! empty($topBannerUrl)) {

                    echo '<option value="' . $topBannerUrl . '" selected>' . $topBannerUrlName . '</option>';

                } else {

                    echo '<option value="" selected>-</option>';

                }

                foreach ($franchise as $row) :

                    echo '<option value="' . $row->id . '">' . $row->franchise_name . '</option>';

                endforeach;

                ?>

            </select>

        </div>

    </div>

    <br>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <div class="col-md-4">

            Upload

        </div>

        <div class="col-md-8">

        	<form class="form-horizontal" id="formSubmitImageUpload">

        	<input type="hidden" name="inputTopBannerId" id="inputTopBannerId" value="<?php echo $topBanner['id'];?>">

            <div class="input-group">

                <input type="file" name="file" class="form-control" id="image-source" onchange="previewImage()">

                <span class="input-group-btn">

                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>

                </span>

            </div>

            <p>Ukuran gambar (rekomendasi) : 1200x400</p>

        	</form>

        </div>

    </div>

	<?php } ?>

    <div class="col-md-12 table-responsive" style="margin-top:10px!important">

	   <img style="width:600px;height:200px" src="<?php if (! empty($img_url)) { echo $img_url . '?' . date('YmdHis'); } ?>" id="image-preview">

    </div>

<!--
    This is a conte`nt
    End of file view.php
    Location: ./application/views/webadmin/content/banner/view_image_top_banner.php
-->