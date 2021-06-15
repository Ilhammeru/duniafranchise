	
	<script type="text/javascript">

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
                    url:'<?=site_url('banner/upload_banner');?>',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    beforeSend : function(data) {
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

            var franchiseId = "<?php echo $franchise['id'];?>";
            var status = $("#status").val();

            $.ajax({
                url:'<?=site_url('banner/change_status_banner_franchise');?>',
                type:"post",
                data: {
                    franchiseId : franchiseId,
                    status : status
                },
                success: function(data){

                    alert("Updated Successfully");

                }
            });

        }

        function changePosition() {

            var franchiseId = "<?php echo $franchise['id'];?>";
            var position = $("#position").val();

            $.ajax({
                url:'<?=site_url('banner/change_position_banner');?>',
                type:"post",
                data: {
                    franchiseId : franchiseId,
                    position : position
                },
                success: function(data){

                    alert("Updated Successfully");

                }
            });

        }

	</script>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <h2><?php echo $franchise['franchise_name'];?></h2>

    </div>

    <br>

    <?php

    if ($countFranchiseBanner != 0) {

    ?>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <div class="col-md-4">

            Status

        </div>

        <div class="col-md-8">

            <select id="status" onchange="changeStatus()" class="form-control">

                <?php

                if ($banner_showing != '') {

                    echo '<option>';

                    if ($banner_showing == 1) {

                        echo 'Active';

                    } else {

                        echo 'Not Active';

                    }

                    echo '</option>';

                }

                ?>

                <option value="0">Not Active</option>
                <option value="1">Active</option>

            </select>

        </div>

    </div>

    <br>

    <?php } ?>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <div class="col-md-4">

            Position

        </div>

        <div class="col-md-8">

            <select id="position" onchange="changePosition()" class="form-control">

                <?php

                if (! empty($banner_position)) {

                    echo '<option>' . $banner_position . '</option>';

                }

                ?>

                <option>left</option>
                <option>right</option>

            </select>

        </div>

    </div>

	<?php

	if ($sessionData['pBannerEdit'] == 1){

	?>

    <div class="col-md-12" style="margin-bottom:10px!important">

        <div class="col-md-4">

            Upload

        </div>

        <div class="col-md-8">

	       <form class="form-horizontal" id="formSubmitImageUpload">

	       <input type="hidden" name="inputFranchiseId" value="<?php echo $franchise['id'];?>">

           <div class="input-group">

                <input type="file" name="file" class="form-control" id="image-source" onchange="previewImage()">

                <span class="input-group-btn">

                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>

                </span>

            </div>

            </form>

        </div>

    </div>

    <?php } ?>

    <div class="col-md-12" style="margin-top:10px!important">

	   <img style="width:200px;height:400px" src="<?php if (! empty($img_url)) { echo $img_url . '?' . date('YmdHis'); } ?>" id="image-preview">

    </div>

<!--
    This is a conte`nt
    End of file view.php
    Location: ./application/views/webadmin/content/banner/view_image_franchise.php
-->