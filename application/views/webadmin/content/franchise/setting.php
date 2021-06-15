    
    <!-- Font -->
    <link rel="stylesheet" href="<?=base_url();?>assets/font/sf-font.css?1">

    <style>
        .ff-sfpd-semibold {
            font-family: var(--sfpd-semibold);
        }
        .clr-dim-gray {
            color: var(--dim-gray);
        }
        .bootstrap-switch {
            border: 1px solid #ced4da;
            border-radius: .25rem;
            cursor: pointer;
            direction: ltr;
            display: inline-block;
            line-height: .5rem;
            overflow: hidden;
            position: relative;
            text-align: left;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            vertical-align: middle;
            z-index: 0;
        }
        .bootstrap-switch.bootstrap-switch-animate .bootstrap-switch-container {
            transition: margin-left .5s;
        }
        .bootstrap-switch .bootstrap-switch-container {
            border-radius: .25rem;
            display: inline-block;
            top: 0;
            -webkit-transform: translate3d(0,0,0);
            transform: translate3d(0,0,0);
        }
        .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-primary, .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-primary {
            background: #007bff;
            color: #fff;
        }

        .bootstrap-switch .bootstrap-switch-handle-on {
            border-bottom-left-radius: .1rem;
            border-top-left-radius: .1rem;
        }
        .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-handle-on {
            text-align: center;
            z-index: 1;
        }
        .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-label {
            box-sizing: border-box;
            cursor: pointer;
            display: table-cell;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.2rem;
            padding: .25rem .5rem;
            vertical-align: middle;
        }
        .bootstrap-switch.bootstrap-switch-inverse.bootstrap-switch-off .bootstrap-switch-label, .bootstrap-switch.bootstrap-switch-on .bootstrap-switch-label {
            border-bottom-right-radius: .1rem;
            border-top-right-radius: .1rem;
        }
        .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-label {
            box-sizing: border-box;
            cursor: pointer;
            display: table-cell;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.2rem;
            padding: .25rem .5rem;
            vertical-align: middle;
        }
        .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-default, .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-default {
            background: #e9ecef;
            color: #1f2d3d;
        }
        .bootstrap-switch .bootstrap-switch-handle-off {
            border-bottom-right-radius: .1rem;
            border-top-right-radius: .1rem;
        }
        .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-handle-on {
            text-align: center;
            z-index: 1;
        }
        .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-label {
            box-sizing: border-box;
            cursor: pointer;
            display: table-cell;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.2rem;
            padding: .25rem .5rem;
            vertical-align: middle;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        .bootstrap-switch input[type=checkbox], .bootstrap-switch input[type=radio] {
            left: 0;
            margin: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            visibility: hidden;
            z-index: -1;
        }
        input[type=checkbox], input[type=radio] {
            box-sizing: border-box;
            padding: 0;
        }
        button, input {
            overflow: visible;
        }
        button, input, optgroup, select, textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }
        .p-1 {
            padding-right: 5px;
            padding-top: 5px;
        }
        #image-preview {
            width: 100%;
            height: auto;
        }
        .mr-0 {
            margin-right: 0 !important;
        }
        .ml-0 {
            margin-left: 0 !important;
        }
        .text-upper {
            text-transform: uppercase;
        }
        .mb-5 {
            margin-bottom: 3rem;
        }
        .mb-3 {
            margin-bottom: 1.8rem;
        }
        #box-join {
            text-transform: uppercase;
        }
        .box-setting img {
            width: 100% !important;
            height: auto;
        }
        #box-join .btn {
            border-radius: var(--br-default) !important;
        }
        .btn-primary {
            background: var(--deep-sky-blue) !important;
            color: var(--white) !important;
            font-family: var(--sfpd-bold) !important;
            border-color: var(--deep-sky-blue) !important;
        }
        #box-page p {
            margin: 0 !important;
        }
		video {
			width: 65%;
			height: auto;
		}
        #franchise-phone {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>

    <div class="content-wrapper">

		<ol class="breadcrumb">

			<?php echo $homeLink;?>
			<?php echo $linkMenu;?>
			<?php echo $sublinkMenu;?>
		</ol>

		<section class="invoice">

			<div class="row">

				<div class="col-xs-12">

					<h2 class="page-header">

                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-on" style="width: 60px;" id="switch-tool">
                            <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                <input type="checkbox" name="franchise_status" value="1" id="franchise_status" data-bootstrap-switch=""
                                <?=$franchise['status'] == 1 ? 'checked' : '' ?>>
                            </div>
                        </div>
                        <?=$franchise['franchise_name'];?>
					</h2>

				</div>
				<!-- /.col-xs-12 -->

			</div>
			<!-- /.row -->

            <div class="row">

                <div class="col-md-12">
                    <button class="btn btn-setting btn-deep-sky-blue" id="btn-attr" data-id="attr">Attribute</button>
                    <button class="btn btn-setting btn-white-lilac" id="btn-chat" data-id="chat">Chat</button>
                    <button class="btn btn-setting btn-white-lilac" id="btn-page" data-id="page">Page</button>
                    <button class="btn btn-setting btn-white-lilac" id="btn-join" data-id="join">Join Franchise</button>
                </div>

            </div>

        </section>

        <div class="row box-setting" id="box-attr">

            <div class="col-md-6">

                <section class="invoice mr-0">
                    
                    <h2 class="page-header">Attribute</h2>

                    <div class="row">

                        <div class="col-md-4">
                            Decsription
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <textarea rows="2" class="form-control" rows="3" id="franchise_desc" onchange="update_franchise()"><?=$franchise['text'];?></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            Hits | DF
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?=$franchise['hits'];?>" id="hits" onchange="update_franchise()">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            Hits | Ayo
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?=$franchise['hits_ayo'];?>" id="hits_ayo" onchange="update_franchise()">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            Invesment
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?=$franchise['invesment'];?>" id="invesment" onchange="update_franchise()">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            Total Outlet
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?=$franchise['total_outlet'];?>" id="total_outlet" onchange="update_franchise()">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            Instagram
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?=$franchise['instagram'];?>" id="instagram" onchange="update_franchise()">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            URL Website
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" id="url_website" placeholder="https://" onchange="update_franchise()" value="<?=$franchise['url_website'];?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            URL Join Franchise
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <input type="text" class="form-control" id="url_join" placeholder="https://" onchange="update_franchise()" value="<?=$franchise['url_join'];?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-4">
                            Phone
                            <hr style="padding:0; margin:0">
                        </div>

                        <div class="col-md-8">
                            <button class="btn btn-primary btn-sm" style="margin-bottom: 10px" onclick="append_phone(1)"><i class="fa fa-plus"></i></button>
                            <div id="get-phone"></div>
                            <table id="table-phone"></table>
                        </div>
                    </div>

                </section>
            </div>
            <div class="col-md-6">

                <section class="invoice ml-0">
                    
                    <h2 class="page-header">Thumbnail</h2>

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
                </section>
            </div>
        </div>

        <div class="row box-setting" id="box-chat" style="display: none">

            <div class="col-md-6">

                <section class="invoice mr-0">
                    
                    <h2 class="page-header">Chat</h2>
                    
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
                            <textarea class="form-control" rows="4" id="chat_join" placeholder="Hai, ..." onchange="update_chat()"><?=$franchise['chat_script_join'];?></textarea>
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
                            <textarea class="form-control" rows="4" id="chat_web" placeholder="Hai, ..." onchange="update_chat()"><?=$franchise['chat_script_web'];?></textarea>
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
                            <textarea class="form-control" rows="4" id="chat_ayo" placeholder="Hai, ..." onchange="update_chat()"><?=$franchise['chat_script_ayo'];?></textarea>
                            <p>Gunakan [franchise] untuk menyisipkan nama franchise di pesan whatsapp</p>
                        </div>
                    </div>

                </section>
            </div>
        </div>

        <div class="row box-setting" id="box-page" style="display: none">

            <div class="col-md-8">

                <section class="invoice mr-0">
                    
                    <h2 class="page-header">Videos</h2>
                    
                    <form class="form-horizontal" id="form-upload-video">
                    <input type="hidden" name="franchise_id" value="<?php echo $franchise['id'];?>">
                    <div class="input-group">
                        <input type="file" name="file" id="video-source" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-upload-video"><i class="fa fa-upload"></i> Upload</button>
                        </span>
                    </div>
                    </form>

                    <div id="videos-data" style="margin-top: 10px"></div>

                </section>
            
                <section class="invoice mr-0">
                    
                    <h2 class="page-header">Page Franchise</h2>

                    <div class="row">
                        <div class="col-xs-4">
                            Button Color
                            <hr style="padding:0;margin:0">
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group my-colorpicker colorpicker-element">
                                <input type="text" class="form-control" id="color" value="<?=$franchise['color'];?>">
                                <div class="input-group-addon">
                                    <i style="background-color: rgb(0, 0, 0);"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <button type="button" class="btn btn-primary" id="btn-color">Save</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <form id="form-join" class="form-horizontal" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="post_content" name="post_content" class="form-control" style="height: 300px"><?php if ($mode == 'edit') { echo $franchise['description']; } ;?></textarea>
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
                </section>
            </div>
            <div class="col-md-4" style="padding: 0 75px">
                <section class="invoice ml-0" style="height: 800px; overflow-y: auto; padding: 0; max-width: 100%">
                    <div id="get-page"></div>
                </section>
            </div>
        </div>
    
        <div class="row box-setting" id="box-join" style="display: none">

            <div class="col-md-8">
                <section class="invoice mr-0">
                    
                    <h2 class="page-header">Join Franchise</h2>

                    <div class="row">
                        <form id="form-join" class="form-horizontal" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="post_content_2" name="post_content_2" class="form-control" style="height: 300px"><?php if ($mode == 'edit') { echo $franchise['content_join']; } ;?></textarea>
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
                    
                </section>
            </div>
            <div class="col-md-4" style="padding: 0 75px">
                <section class="invoice ml-0" style="height: 700px; overflow-y: auto">
                    <div id="get-thumbnail" style="padding:2.5rem 0"></div>
                </section>
            </div>
        </div>

        <section>

    <script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="<?=base_url();?>assets/plugins/bootstrap.switch/bootstrap-switch.min.js"></script>

    <script>

        var franchiseId = <?=$franchise['id'];?>;

        $(function () {

            get_phone(franchiseId);
        
            $('#franchise_status').bootstrapSwitch('state');      
        });

        $('#franchise_status').on('switchChange.bootstrapSwitch', function (e, data) {
                
            if (data == true) {
                var value = 1;
            } else {
                var value = 0;
            }

            $.ajax({
                url: "<?=site_url('franchise/update_status/' . $franchise['id']);?>",
                type: "post",
                data: {
                    value: value
                },
                beforeSend: function () {
                    $('.modal-loading').modal('show');
                },
                success: function () {
                    $('.modal-loading').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        }); 

        $('.btn-setting').on('click', function () {

            var attr = $(this).data('id');

            $('.box-setting').css('display', 'none');
            $('#box-' + attr).css('display', 'block');

            $('.btn-setting').removeClass('btn-deep-sky-blue').removeClass('btn-white-lilac').addClass('btn-white-lilac');
            $('#btn-' + attr).removeClass('btn-white-lilac').addClass('btn-deep-sky-blue');

            if (attr == 'join') {
                get_preview_join();
            } else if (attr == 'page') {
                get_data_videos(franchiseId);
                get_preview_page();
            }
        });

        function get_preview_join() {

            $.ajax({
                url: "<?=site_url('franchise/get_franchise_by_id/' . $franchise['id'] . '/join');?>",
                dataType: "json",
                beforeSend: function () {
                    var loading = '<div class="row"><div class="col-md-12 text-center"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i></div></div>';
                    $('#get-thumbnail').html(loading);
                },
                success: function (data) {
                    $('#get-thumbnail').html(data.thumbnail);
                    $('#get-thumbnail').append(data.title);
                    $('#get-thumbnail').append(data.phone);
                    $('#get-thumbnail').append(data.website);
                    $('#get-thumbnail').append(data.content);
                }
            });
        }

        function get_preview_page() {

            $.ajax({
                url: "<?=site_url('franchise/get_franchise_by_id/' . $franchise['id'] . '/page');?>",
                dataType: "json",
                beforeSend: function () {
                    var loading = '<div class="row"><div class="col-md-12 text-center"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i></div></div>';
                    $('#get-page').html(loading);
                },
                success: function (data) {
                    $('#get-page').html(data.page);
                    $('#get-page').append(data.staticPhone);
                }
            });
        }

        function update_franchise() {

            var franchise_desc  = $('#franchise_desc').val();
            var hits            = $('#hits').val();
            var hits_ayo        = $('#hits_ayo').val();
            var invesment       = $('#invesment').val();
            var total_outlet    = $('#total_outlet').val();
            var instagram       = $('#instagram').val();
            var url_website     = $('#url_website').val();
            var url_join        = $('#url_join').val();

            $.ajax({
                url: "<?=site_url('franchise/update_franchise/' . $franchise['id']);?>",
                type: "post",
                data: {
                    status: status,
                    franchise_desc: franchise_desc,
                    hits: hits,
                    hits_ayo: hits_ayo,
                    invesment: invesment,
                    total_outlet: total_outlet,
                    instagram: instagram,
                    url_website: url_website,
                    url_join: url_join
                },
                beforeSend: function () {
                    $('.modal-loading').modal('show');
                },
                success: function () {
                    $('.modal-loading').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        }

        function update_chat() {

            var chat_df     = $('#chat_df').val();
            var chat_join   = $('#chat_join').val();
            var chat_web    = $('#chat_web').val();
            var chat_ayo    = $('#chat_ayo').val();

            $.ajax({
                url: "<?=site_url('franchie/update_chat/' . $franchise['id']);?>",
                type: "post",
                data: {
                    chat_join: chat_join,
                    chat_web: chat_web,
                    chat_ayo: chat_ayo,
                    chat_df: chat_df
                },
                beforeSend: function () {
                    $('.modal-loading').modal('show');
                },
                success: function () {
                    $('.modal-loading').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            })
        }

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

            row.style.height = '40px';

			var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.style.width = '45%';
            cell2.style.width = '45%';
            cell3.style.width = '10%';

            cell1.className = 'p-1';
            cell2.className = 'p-1';
            cell3.className = 'p-1 text-center';

            cell1.innerHTML = '<input type="text" name="phone_title" class="form-control" id="phone_title_' + countRow + '" onchange="insert_phone(' + countRow + ')" placeholder="Area Jawa">';
            cell2.innerHTML = '<input type="text" name="phone_val" class="form-control"` id="phone_val_' + countRow + '" onchange="insert_phone(' + countRow + ')" placeholder="+628123456789">';

            if (param == 1) {
			    cell3.innerHTML = '<a onclick="delete_row(this)"><i class="fa fa-trash-o" style="font-size: 16px"></i></a>';
            }
        }

        function append_phone_db(data) {

            var tablePhone = document.getElementById('table-phone');
            var countRow = tablePhone.rows.length;

			var row = tablePhone.insertRow(countRow);

            row.style.height = '40px';

			var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.style.width = '45%';
            cell2.style.width = '45%';
            cell3.style.width = '10%';

            cell1.className = 'p-1';
            cell2.className = 'p-1';
            cell3.className = 'p-1 text-center';

            cell1.innerHTML = '<input type="text" name="phone_title" class="form-control" value="' + data.title + '" id="phone_title_' + countRow + '" onchange="update_phone(' + countRow + ', ' + data.id + ')" placeholder="Area Jawa">';
            cell2.innerHTML = '<input type="text" name="phone_val" class="form-control" value="' + data.phone + '" id="phone_val_' + countRow + '" onchange="update_phone(' + countRow + ', ' + data.id + ')" placeholder="+628123456789">';
			cell3.innerHTML = '<a onclick="delete_row_db(this, ' + data.id + ')"><i class="fa fa-trash-o" style="font-size: 16px"></i></a>';
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
                beforeSend: function () {
                    $('.modal-loading').modal('show');
                },
                success: function () {
                    $('.modal-loading').modal('hide');
                    delete_row(param);
                }
            });
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
                beforeSend: function () {
                    $('.modal-loading').modal('show');
                },
                success: function () {
                    $('.modal-loading').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });
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
                    beforeSend: function () {
                        $('.modal-loading').modal('show');
                    },
                    success: function () {
                        $('.modal-loading').modal('hide');

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Save successfully',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        get_phone(franchiseId);
                    }
                });
            }
        }

        function previewImage() {
            document.getElementById("image-preview").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
 
            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").src = oFREvent.target.result;
            };
        };

        $('#formSubmitImageUpload').submit(function(e){
            e.preventDefault(); 

            var inputFile = document.getElementById('image-source').value;

            if (inputFile == '') {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Choose file',
                    showConfirmButton: true
                });
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
                    $('.modal-loading').modal('show');
                },
                complete: function () {
                    $('.modal-loading').modal('hide');

                    setTimeout(function(){
                        document.getElementById('image-source').value = null;

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Save successfully',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }, 1000);

                }
            });
        });

        $('#form-join').submit( function (e) {
            e.preventDefault(); 

            var content = $('#post_content').val();

            $.ajax({
                url: "<?=site_url('franchise/save_content/' . $franchise['id']);?>",
                type: "post",
                data: {
                    content: content
                },
                beforeSend : function() {
                    $('.modal-loading').modal('show');
                },
                complete: function () {
                    $('.modal-loading').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    setTimeout(function(){
                        get_preview_page();
                    }, 1000);

                }
            });
        });

        $('#form-join').submit( function (e) {
            e.preventDefault(); 

            var content = $('#post_content_2').val();

            $.ajax({
                url: "<?=site_url('franchise/save_content_2/' . $franchise['id']);?>",
                type: "post",
                data: {
                    content: content
                },
                beforeSend : function() {
                    $('.modal-loading').modal('show');
                },
                complete: function () {
                    $('.modal-loading').modal('hide');

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    setTimeout(function(){
                        get_preview_join();
                    }, 1000);

                }
            });
        });

        $('#btn-color').on('click', function () {

            var color = $('#color').val();

            $.ajax({
                url: "<?=site_url('franchise/save_color/' . $franchise['id']);?>",
                type: "post",
                data: {
                    color: color
                },
                success: function () {
                    
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Save successfully',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    setTimeout(function(){
                        get_preview_page();
                    }, 1000);
                }
            })
        });

        tinymce.init({

            selector: "#post_content",
            height: "550",
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
            height: "550",
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

                            $('#videos-data').html('<table class="table table-bordered" id="table-videos"></table>');

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

            cell1.style.width = '90%';
            cell2.style.width = '10%';
            cell2.style.textAlign = 'center';

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
    