
    <script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <style>
        .p-1 {
            padding-right: 5px;
            padding-top: 5px;
        }
        #image-preview {
            width: 100%;
            height: auto;
        }
    </style>

    <script>

        var franchiseId = "<?php echo $franchise['id'];?>";

        $(document).ready(function (){

            get_phone(franchiseId);

            get_data_videos(franchiseId);

            $('#formSubmitImageUpload').submit(function(e){
                e.preventDefault(); 

                var inputFile = document.getElementById('image-source').value;

                if (inputFile == '') {

                    alert('Choose file');

                    return false;

                }

                $.ajax({
                    url:'<?=site_url('franchise/upload_thumbnail');?>',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    beforeSend : function() {
                        $('#modalLoading').modal('show');
                    },
                    complete: function () {
                        $('#modalLoading').modal('hide');
                        setTimeout(function(){
                            document.getElementById('image-source').value = null;

                            alert("Upload Image Successfully");
                        }, 1000);

                    }
                });
            });

            $('#form-upload-video').submit( function (e) {
                e.preventDefault(); 

                var inputFile = document.getElementById('video-source').value;

                if (inputFile == '') {

                    alert('Choose file');
                    return false;
                }

                $.ajax({
                    url:'<?=site_url('franchise/upload_video');?>',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    beforeSend : function() {
                        $('.modal-loading').modal('show');
                    },
                    success: function () {

                        $('.modal-loading').modal('hide');
                        setTimeout(function(){

                            document.getElementById('video-source').value = null;
                            alert("Upload Video Successfully");
                            get_data_videos(franchiseId);
                        }, 1000);
                    }
                });
            });

        });

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
                console.log(1);
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

        tinymce.init({

            selector: "#post_content_2",
            plugins: [
               "advlist autolink lists link image charmap print preview hr anchor pagebreak media",
               "searchreplace wordcount visualblocks visualchars code fullscreen",
               "insertdatetime nonbreaking save table contextmenu directionality",
               "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | media",
            automatic_uploads: true,
            image_advtab: true,
            images_upload_url: "<?=site_url('franchise/image_upload_2/');?>" + franchiseId,
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

        function updateFranchise(param = 0) {

            var inputFranchiseText = document.getElementById('inputFranchiseText').value;
            var inputFranchiseHits = document.getElementById('inputFranchiseHits').value;
            var inputFranchiseStatus = document.getElementById('inputFranchiseStatus').value;

            var chat_df     = document.getElementById('chat_df').value;
            var chat_join   = document.getElementById('chat_join').value;
            var chat_ayo    = document.getElementById('chat_ayo').value;
            var chat_web    = document.getElementById('chat_web').value;

            var url_website = document.getElementById('url_website').value;
            var url_join    = document.getElementById('url_join').value;

            var color = document.getElementById('color').value;

            $.ajax({

                url: "<?=site_url('franchise/update_franchise/' . $franchise['id']);?>",
                type: "post",
                data: {
                    inputFranchiseText : inputFranchiseText,
                    inputFranchiseHits : inputFranchiseHits,
                    inputFranchiseStatus : inputFranchiseStatus,
                    chat_df: chat_df,
                    chat_join: chat_join,
                    chat_web: chat_web,
                    chat_ayo: chat_ayo,
                    url_website: url_website,
                    url_join: url_join,
                    color: color
                },
                cache: false,
                success: function(data) {

                    if (param == 0) {
                        alert('Save Successfully');
                    }
                }

            });

        };

        function get_phone(id) {

            $.ajax({
                url: "<?=site_url('franchise/get_phone');?>",
                type: "post",
                data: {
                    id: id
                },
                dataType: "json",
                beforeSend: function () {
                    var loading = '<div class="col-md-12 text-center"><i class="fa fa-refresh fa-spin"></i></div>';
                    $('#get-phone').html(loading);
                }, 
                success: function (data) {
                    
                    $('#get-phone').html('');
                    $('#table-phone').html('');

                    if (data.length > 0) {

                        for (i = 0; i < data.length; i++) {
                            append_phone_db(data[i]);
                        }

                    } else {
                        append_phone(0);
                    }
                }
            });
        }

        function append_phone(param) {
            var tablePhone = document.getElementById('table-phone');
            var countRow = tablePhone.rows.length;

			var row = tablePhone.insertRow(countRow);

			var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.style.width = '45%';
            cell2.style.width = '45%';
            cell3.style.width = '10%';

            cell1.className = 'p-1';
            cell2.className = 'p-1';
            cell3.className = 'p-1';

            cell1.innerHTML = '<input type="text" name="phone_title" class="form-control" id="phone_title_' + countRow + '" onchange="insert_phone(' + countRow + ')" placeholder="Area Jawa">';
            cell2.innerHTML = '<input type="text" name="phone_val" class="form-control"` id="phone_val_' + countRow + '" onchange="insert_phone(' + countRow + ')" placeholder="+628123456789">';

            if (param == 1) {
			    cell3.innerHTML = '<a onclick="delete_row(this)"><i class="fa fa-trash-o"></i></a>';
            }
        }

        function append_phone_db(data) {

            var tablePhone = document.getElementById('table-phone');
            var countRow = tablePhone.rows.length;

			var row = tablePhone.insertRow(countRow);

			var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.style.width = '45%';
            cell2.style.width = '45%';
            cell3.style.width = '10%';

            cell1.className = 'p-1';
            cell2.className = 'p-1';
            cell3.className = 'p-1';

            cell1.innerHTML = '<input type="text" name="phone_title" class="form-control" value="' + data.title + '" id="phone_title_' + countRow + '" onchange="update_phone(' + countRow + ', ' + data.id + ')" placeholder="Area Jawa">';
            cell2.innerHTML = '<input type="text" name="phone_val" class="form-control" value="' + data.phone + '" id="phone_val_' + countRow + '" onchange="update_phone(' + countRow + ', ' + data.id + ')" placeholder="+628123456789">';
			cell3.innerHTML = '<a onclick="delete_row_db(this, ' + data.id + ')"><i class="fa fa-trash-o"></i></a>';
        }

        function delete_row(param) {
			var i = param.parentNode.parentNode.rowIndex;
			document.getElementById("table-phone").deleteRow(i);
        }

        function delete_row_db(param, id) {

            $.ajax({
                url: "<?=site_url('franchise/delete_phone');?>",
                type: "post",
                data: {
                    id: id
                },
                success: function () {
                    delete_row(param);
                }
            })
        }

        function update_phone(param, id) {

            var val = $('#phone_val_' + param).val();
            var title = $('#phone_title_' + param).val();

            $.ajax({
                url: "<?=site_url('franchise/update_phone');?>",
                type: "post",
                data: {
                    phone: val,
                    title: title,
                    id: id
                },
                success: function () {
                    alert('Save Successfully');
                }
            });
        }

        function insert_phone(param) {
            
            var val = $('#phone_val_' + param).val();
            var title = $('#phone_title_' + param).val();

            if (val != '' && title != '') {

                $.ajax({
                    url: "<?=site_url('franchise/insert_phone');?>",
                    type: "post",
                    data: {
                        phone: val,
                        title: title,
                        franchise_id: franchiseId
                    },
                    success: function () {
                        alert('Save Successfully');                    
                        get_phone(franchiseId);
                    }
                });
            }
        }

        function get_data_videos(franchiseId) {

            $.ajax({
                url: "<?=site_url('franchise/get_data_videos');?>",
                type: "post",
                data: {
                    franchise_id: franchiseId
                },
                dataType: "json",
                success: function (data) {

                    if (data.response == 'success') {

                        if (data.videos.length > 0) {

                            $('#videos-data').html('<table class="table" id="table-videos"></table>');

                            for (i = 0; i < data.videos.length; i++) {
                                append_video(data.videos[i], i);
                            }
                        } else {
                            $('#videos-data').html('');
                        }
                    }
                }
            });
        }

        function append_video(data, i) {
            var tableVideos = document.getElementById('table-videos');
            var l = tableVideos.rows.length;

            var row = tableVideos.insertRow(l);

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);

            cell1.innerHTML = data;
            cell2.innerHTML = '<button class="btn btn-xs" onclick="delete_videos(' + i + ')"><i class="fa fa-trash"></i></button>';
        }

        function delete_videos(i) {

            Swal.fire({
            title: 'Delete data, are you sure?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Delete!'
            }).then((result) => {

                if (result.isConfirmed) {
                    
                    $.ajax({
                        url: "<?=site_url('franchise/delete_video');?>",
                        type: "post",
                        data: {
                            i: i,
                            franchise_id: franchiseId
                        },
                        success: function () {
                            setTimeout( function () {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Delete successfully',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                get_data_videos(franchiseId);
                            }, 500);
                        }
                    });
                }
            });
        }
        
  </script>

   <div class="row">

        <div class="col-md-12">

            <a href="<?=site_url('franchise');?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12"> 

            <center><h2><?php echo $franchise['franchise_name'];?></h2></center>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-6">

            <div class="row">

                <div class="col-md-4">
                    Decsription
                    <hr style="padding:0; margin:0">
                </div>

                <div class="col-md-8">

                    <textarea class="form-control" rows="3" id="inputFranchiseText" onchange="updateFranchise()"><?=$franchise['text'];?></textarea>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Hits
                    <hr style="padding:0; margin:0">
                </div>

                <div class="col-md-8">
        
                    <input type="text" class="form-control" value="<?php echo $franchise['hits'];?>" id="inputFranchiseHits" onchange="updateFranchise()">
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Status
                    <hr style="padding:0; margin:0">
                </div>

                <div class="col-md-8">

                    <select class="form-control select2" id="inputFranchiseStatus" onchange="updateFranchise()">
                        <?php
                        if ($franchiseStatus == 1) {
                            echo '<option value="1" selected>Active</option>'; 
                            echo '<option value="0">Not Active</option>';
                        } else {
                            echo '<option value="0" selected>Not Active</option>';
                            echo '<option value="1">Active</option>'; 
                        } ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    Color
                    <hr style="padding:0;margin:0">
                </div>
                <div class="col-md-8">
                    <div class="input-group my-colorpicker colorpicker-element">
                        <input type="text" class="form-control" id="color" onchange="updateFranchise(1)" value="<?=$franchise['color'];?>">
                        <div class="input-group-addon">
                            <i style="background-color: rgb(0, 0, 0);"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Phone
                    <hr style="padding:0; margin:0">
                </div>
                <div class="col-md-8">
                    <button class="btn btn-primary btn-sm" onclick="append_phone(1)">Add More</button>
                    <div id="get-phone"></div>
                    <table id="table-phone"></table>
                </div>
            </div>
            <br>
            <div class="row">
                <form class="form-horizontal" id="formSubmitImageUpload">
                <input type="hidden" name="inputFranchiseId" value="<?php echo $franchise['id'];?>">
                <div class="col-md-4">
                    Upload Thumbnail
                    <hr style="padding:0; margin:0">
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="file" name="file" id="image-source" onchange="previewImage()" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-block" id="btnUpload"><i class="fa fa-upload"></i> Upload</button>
                        </span>
                    </div>
                    <br>
                    <img id="image-preview" src="<?php if (! empty($thumbnailUrl)) { echo $thumbnailUrl . '?' . date('YmdHis'); } ?>">
                </div>
                </form>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Upload Video
                    <hr style="padding:0; margin:0">
                </div>
                <div class="col-md-8">
                    <form class="form-horizontal" id="form-upload-video">
                    <input type="hidden" name="franchise_id" value="<?php echo $franchise['id'];?>">
                    <div class="input-group">
                        <input type="file" name="file" id="video-source" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-upload-video"><i class="fa fa-upload"></i> Upload</button>
                        </span>
                    </div>
                    </form>

                    <div id="videos-data"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="row">

                <div class="col-md-4">
                    Chat Script
                    <hr style="padding:0; margin:0">
                    For Dunia Franchise
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" rows="4" id="chat_df" placeholder="Hai, ..." onchange="updateFranchise()"><?=$franchise['chat_script_df'];?></textarea>
                    <p>Gunakan [franchise] untuk menyisipkan nama franchise di pesan whatsapp</p>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Chat Script
                    <hr style="padding:0; margin:0">
                    For Join Website
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" rows="4" id="chat_join" placeholder="Hai, ..." onchange="updateFranchise()"><?=$franchise['chat_script_join'];?></textarea>
                    <p>Gunakan [franchise] untuk menyisipkan nama franchise di pesan whatsapp</p>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Chat Script
                    <hr style="padding:0; margin:0">
                    For Website Franchise
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" rows="4" id="chat_web" placeholder="Hai, ..." onchange="updateFranchise()"><?=$franchise['chat_script_web'];?></textarea>
                    <p>Gunakan [franchise] untuk menyisipkan nama franchise di pesan whatsapp</p>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    Chat Script
                    <hr style="padding:0; margin:0">
                    For Ayo Waralaba
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" rows="4" id="chat_ayo" placeholder="Under Construction"><?=$franchise['chat_script_ayo'];?></textarea>
                    <p>Gunakan [franchise] untuk menyisipkan nama franchise di pesan whatsapp</p>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">        
                    URL Website
                    <hr style="padding:0; margin:0">
                </div>
                <div class="col-md-8">  
                    <input type="text" class="form-control" id="url_website" placeholder="https://" onchange="updateFranchise()" value="<?=$franchise['url_website'];?>">
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">        
                    URL Join Franchise
                    <hr style="padding:0; margin:0">
                </div>
                <div class="col-md-8">  
                    <input type="text" class="form-control" id="url_join" placeholder="https://" onchange="updateFranchise()" value="<?=$franchise['url_join'];?>">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>

    <div class="row">

        <div class="col-md-6">                

            <div class="row">
                
                <div class="col-md-12">

                    Dunia Franchise Content
                    
                </div>

            </div>

            <br>

            <div class="row">

                <form class="form-horizontal" action="<?=site_url('franchise/save_content/' . $franchise['id']);?>" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-12">
                                
                                <textarea rows="25" id="post_content" name="post_content" class="form-control"><?php if ($mode == 'edit') { echo $franchise['description']; } ;?></textarea>

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

        </div>

        <div class="col-md-6">    

            <div class="row">

                <div class="col-md-12">

                    Website Content

                </div>

            </div>

            <br>

            <div class="row">

                <form class="form-horizontal" action="<?=site_url('franchise/save_content_2/' . $franchise['id']);?>" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-12">
                                
                                <textarea rows="25" id="post_content_2" name="post_content_2" class="form-control"><?php if ($mode == 'edit') { echo $franchise['content_join']; } ;?></textarea>

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

        </div>

    </div>
    
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/franchise/add_content.php
-->