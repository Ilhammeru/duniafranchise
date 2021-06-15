    
    <style>
        .img-banner {
            width: 100%;
            height: auto;
        }
    </style>

    <div class="row">
        <div class="col-md-12" style="text-align: center; font-size: 2rem; font-weight: 500">

            <?=$banner['franchise_name'];?>

        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
        
            <div class="col-md-4">

                Delete "<?=$banner['franchise_name'];?> banner"?
                <hr style="padding: 0; margin: 0">

            </div>
            <div class="col-md-8">
                <button class="btn btn-danger btn-sm" onclick="deleteBanner()">Delete Data</button>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-4">

                Status
                <hr style="padding: 0; margin: 0">

            </div>

            <div class="col-md-8">

                <select id="status" onchange="changeStatus()" class="form-control">
                    <?=$banner['is_active'] == 1 ? '<option disabled selected value="1">active</option>' : '<option disabled selected value="0">not active</option>';?>
                    <option value="0">not active</option>
                    <option value="1">active</option>
                </select>

            </div>

        </div>
    </div>

    <br>

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-4">
                Upload
                <hr style="padding: 0; margin: 0">
            </div>

            <div class="col-md-8">

            <form class="form-horizontal" id="formSubmitImageUpload">

            <input type="hidden" name="banner_id" value="<?=$banner['banner_id'];?>">
            <input type="hidden" name="param" value="<?=$param;?>">

            <div class="input-group">

                    <input type="file" name="file" class="form-control" id="image-source" onchange="previewImage()">

                    <span class="input-group-btn">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>

                    </span>

                </div>

                </form>

            </div>

        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-4">

                Image
                <hr style="padding: 0; margin: 0">

            </div>

            <div class="col-md-8">
                <img class="img-banner" id="img-preview" src="<?=$banner['image_banner'] != null ? base_url() . $path . $banner['image_banner'] . '?' . date('Y-m-d H:i:s') : '' ;?>" alt="Image Banner">
            </div>
        
        </div>
    </div>

    <script>

        var bannerId = <?=$banner['banner_id'];?>;
        var param = "<?=$param;?>";

        function changeStatus() {

            var status = $('#status').val();

            $.ajax({
                url: "<?=site_url('ayowaral_banner/update_status');?>",
                type: "post",
                data: {
                    id: bannerId,
                    status: status,
                    param: param
                },
                beforeSend: function () {
                    $('.modal-loading').modal('show');
                },
                success: function () {
                    $('.modal-loading').modal('hide');

                    setTimeout( function () {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved successfully',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }, 500);

                    setTimeout( function () {
                        select_banner(param);   
                    }, 1000);

                    setTimeout( function () {
                        get_banner(bannerId, param);
                    }, 1500);

                }
            });
        }

		function previewImage() {
    		// document.getElementById("image-preview").style.display = "block";
    		var oFReader = new FileReader();
     		oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
 
    		oFReader.onload = function(oFREvent) {
      			document.getElementById("img-preview").src = oFREvent.target.result;
    		};
  		}
        
        function deleteBanner() {
            Swal.fire({
            title: 'Delete data, are you sure?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Submit!'
            }).then((result) => {

                if (result.isConfirmed) {
                    
                    $.ajax({
                        url: "<?=site_url('ayowaral_banner/delete_banner');?>",
                        type: "post",
                        data: {
                            id: bannerId,
                            param: param
                        },
                        beforeSend: function () {
                            $('.modal-loading').modal('show');
                        },
                        success: function (response) {
                            $('.modal-loading').modal('hide');

                            if (response == 'success') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Delete data successfully',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something wrong!',
                                    showConfirmButton: true,
                                });
                            }

                        }
                    })

                }
            });
        }

        $('#formSubmitImageUpload').submit(function(e){
            e.preventDefault(); 

            var inputFile = document.getElementById('image-source').value;

            if (inputFile == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please select image!',
                    showConfirmButton: true,
                });

                return false;
            }

            $.ajax({
                url:'<?=site_url('ayowaral_banner/upload_banner');?>',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                beforeSend : function(data) {
                    $('.modal-loading').modal('show');
                },
                success: function(data){

                    $('.modal-loading').modal('hide');

                    if (data == 'success') {

                        setTimeout( function () {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Image upload successfully',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }, 500);

                        setTimeout( function () {
                            select_banner(param);   
                        }, 1000);

                        setTimeout( function () {
                            get_banner(bannerId, param);
                        }, 1500);

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something wrong!',
                            showConfirmButton: true,
                        });

                    }
                }
            });
        });

    </script>