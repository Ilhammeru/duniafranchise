
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <style>

        html {
            --black: #000;
            --white: #fff;
            --dim-gray: #5e5e5e;
            --suva-gray: #929292;
            --light-gray: #d5d5d5;
            --silver: #c2c2c2;
            --solitude: #f2f2f7;
            --white-lilac: #e5e5eb;
            --dark-gray: #adadad;
            --ghost-white: #f9f9ff;
            --deep-sky-blue: #00a2ff;
            --misty-rose: #ffdbd8;
            --tomato: #ff644e;
            --orange: #feae00;
        }

        .btn-banner {
            background-color: var(--solitude);
            color: var(--dim-gray);
        }

        .btn-banner.active {
            background-color: var(--deep-sky-blue) !important;
            color: var(--white) !important;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        #table-banner thead {
            font-weight: 500;
        }

        .badge {
            font-size: 1rem;
        }

        .badge-secondary {
            background-color: var(--white-lilac);
            color: var(--white);
        }

        .badge-primary {
            background-color: var(--deep-sky-blue);
            color: var(--white);
        }

        .img-banner {
            width: 50%;
            height: auto;
        }

        .modal-content {
            width: 100%;
        }

        #modal-sorting-banner {
            overflow-y: hidden;
        }

        #table-premium_wrapper .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        .dt-rowReorder-moving {
            background-color: var(--deep-sky-blue) !important;
            color: var(--white) !important;
        }

    </style>

    <div class="row">

        <div class="col-md-12 mb-4">

            <button class="btn btn-banner" id="banner-0" onclick="select_banner(0)">Premium Banner</button>
            <button class="btn btn-banner" id="banner-1" onclick="select_banner(1)">Top Banner</button> 
            <button class="btn btn-banner" id="banner-2" onclick="select_banner(2)">Center Banner</button> 
            <button class="btn btn-banner" id="banner-3" onclick="select_banner(3)">Left Banner</button> 
            <button class="btn btn-banner" id="banner-4" onclick="select_banner(4)">Right Banner</button>
            <button class="btn btn-banner" id="banner-x" onclick="add_banner()"><i class="fa fa-plus"></i></button>
            
        </div>
        <!--/.col -->

        <div class="col-md-12">
            <div id="show-data"></div>

            <div id="add-banner" style="display: none">

            <form class="form-horizontal" id="form-add-banner">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-4">

                        Franchise
                        <hr style="padding: 0; margin: 0">

                    </div>

                    <div class="col-md-8">

                        <select name="franchise_id" id="franchise-id" class="form-control select2" style="width: 100%">
                            <option value="" selected disabled>Select Franchise</option>
                            <?php
                            foreach ($franchise as $row) :
                                echo '<option value="' . $row->franchise_id . '">' . $row->name . '</option>';
                            endforeach;
                            ?>
                        </select>

                    </div>

                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-4">

                        Banner Position
                        <hr style="padding: 0; margin: 0">

                    </div>

                    <div class="col-md-8">

                        <select name="param" id="param" class="form-control select2" style="width: 100%">
                            <option value="" selected disabled>Select Position</option>
                            <option value="0">Premium Banner</option>
                            <option value="1">Top Banner</option>
                            <option value="2">Center Banner</option>
                            <option value="3">Left Banner</option>
                            <option value="4">Right Banner</option>
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

                        <div class="input-group">

                            <input type="file" name="file" class="form-control" id="image-source-2" onchange="previewImage_2()">
                        </div>
                        <br>
                        <img class="img-banner" id="img-preview-2" src="" alt="Image Banner">

                    </div>

                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>

            </div>

        </div>
        <!--/.col -->

    </div>
    <!--/.row -->
    
	<div class="modal" id="modal-sorting-banner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-sort"></i> Sorting Banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <table class="table table-bordered table-stripped" id="table-premium">
                        <thead>
                            <tr>
                                <th>Banner List</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="btn_save_sorting()">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!--/.modal-dialog -->

    </div>
    <!--/.modal -->

    <script>

        var loading = '<div class="overlay text-center" style="font-size: 3rem"><i class="fa fa-refresh fa-spin"></i></div>';
        
        function add_banner() {
            $('.btn-banner').removeClass('active');
            $('#banner-x').addClass('active');

            $('#show-data').hide();
            $('#add-banner').show();
        }

        function select_banner(param) {

            $.ajax({
                url: "<?=site_url('ayowaral_banner/get_banner');?>",
                type: "post",
                data: {
                    param: param
                },
                dataType: "json",
                beforeSend: function () {
                    $('#show-data').html(loading);
                },
                success: function (response) {

                    $('#add-banner').hide();
                    $('#show-data').show();

                    if (response == 'error-null') {

                        $('#show-data').html('Data tidak tersedia');
                    } else {

                        if (param == 0) {
                            $('#show-data').html('<div class="col-md-6"><button class="btn btn-primary btn-sm" onclick="sortingBanner()" style="margin-bottom:2rem">Sorting Banner</button><table class="table table-hover table-bordered" id="table-banner" style="width:100%"><tbody></tbody></table></div><div class="col-md-6"><div id="get-banner"></div></div>');
                        } else {
                            $('#show-data').html('<div class="col-md-6"><table class="table table-hover table-bordered" id="table-banner" style="width:100%"><tbody></tbody></table></div><div class="col-md-6"><div id="get-banner"></div></div>');
                        }

                        append_header(param);

                        for (i = 0; i < response.banner.length; i++) {
                            append_row(response.banner[i], param);
                        }

                        if (param == 0) {
                            for (i = 0; i < response.banner.length; i++) {
                                append_row_modal(response.banner[i]);
                            }
                        }

                        var tableBanner = $('#table-banner').DataTable();

                        if (param == 0) {
                            $('#table-premium').DataTable().destroy();

                            var tablePremium = $('#table-premium').DataTable({

                                rowReorder: true,
                                paging: false,
                                searching: false,
                                info: false,
                                ordering: false,
                                select: 'single',
                                scrollY: "200px",
                                scrollCollapse: true,
                                columns: [
                                    {
                                        "width": "15%"
                                    },
                                ]
                            });
                        }

                    }

                    $('.btn-banner').removeClass('active');
                    $('#banner-' + param).addClass('active');
                }
            });
        }

        function append_header() {

            var tableBanner = document.getElementById('table-banner');
            var header = tableBanner.createTHead();

			var row = header.insertRow(0);

			var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.innerHTML = 'Franchise Name';
            cell2.innerHTML = 'Images';
			cell3.innerHTML = 'Is Active';
        }

        function append_row(data, param) {

            var tableBanner = document.getElementById('table-banner').getElementsByTagName('tbody')[0];
            var countRow = tableBanner.rows.length;

			var row = tableBanner.insertRow(countRow);
            row.setAttribute("onclick", "get_banner(" + data.banner_id + ", '" + param + "')");

			var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            var active = '<span class="badge badge-secondary">not active</span>';

            if (data.is_active == 1) {
                active = '<span class="badge badge-primary">active</span>';
            }

            cell1.innerHTML = data.franchise_name;
            cell2.innerHTML = data.image_banner;
			cell3.innerHTML = active;

        }

        function append_row_modal(data, param) {

            if (data.is_active == 1) {

                var tablePremium = document.getElementById('table-premium').getElementsByTagName('tbody')[0];
                var countRow = tablePremium.rows.length;

                var row = tablePremium.insertRow(countRow);

                var cell1 = row.insertCell(0);

                cell1.innerHTML = data.franchise_name;
            }
        }

        function get_banner(id, param) {

            $.ajax({
                url: "<?=site_url('ayowaral_banner/get_data_banner');?>",
                type: "post",
                data: {
                    id: id,
                    param: param
                },
                beforeSend: function () {
                    $('#get-banner').html(loading);
                },
                success: function (html) {

                    $('#get-banner').html(html);
                }
            });

        }

        function previewImage_2() {
    		// document.getElementById("image-preview").style.display = "block";
    		var oFReader = new FileReader();
     		oFReader.readAsDataURL(document.getElementById("image-source-2").files[0]);
 
    		oFReader.onload = function(oFREvent) {
      			document.getElementById("img-preview-2").src = oFREvent.target.result;
    		};
  		}

        function sortingBanner() {
            $('#modal-sorting-banner').modal('show');
        }

        function btn_save_sorting() {
            
            Swal.fire({
            title: 'Submit data, are you sure?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Submit!'
            }).then((result) => {

                if (result.isConfirmed) {

                    var tablePremium = $('#table-premium').DataTable();

                    var form_data  = tablePremium.rows().data();

                    var string = [];

                    var f = form_data;

                    for(var i = 0; f.length > i; i++) {
                        
                        var n = f[i].length;

                        for(var j = 0 ; n > j; j++) {
                            string.push(f[i][j]);
                        }
                    }

                    $.ajax({
                        url: "<?=site_url('ayowaral_banner/set_sorting_banner');?>",
                        type: "post",
                        data: {
                            banner: string
                        },
                        beforeSend: function () {
                            $('.modal-loading').modal('show');
                        },
                        success: function() {
                            $('.modal-loading').modal('hide');

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Data saved successfully',
                                showConfirmButton: false,
                                timer: 1000
                            });

                            $('#modal-sorting-banner').modal('hide');
                        }   
                    });

                }
            });
        }

        $('#form-add-banner').submit(function(e){
            e.preventDefault(); 

            var inputFile = document.getElementById('image-source-2').value;

            var franchiseId = $('#franchise-id').val();
            var param = $('#param').val();

            if (franchiseId == null) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please select franchise!',
                    showConfirmButton: true,
                });

                return false;
            }

            if (param == null) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please select position!',
                    showConfirmButton: true,
                });

                return false;
            }

            if (inputFile == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please select image!',
                    showConfirmButton: true,
                });

                return false;
            }

            Swal.fire({
            title: 'Submit data, are you sure?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Submit!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url:'<?=site_url('ayowaral_banner/insert_banner');?>',
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

                            } else if (data == 'error-duplicate') {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Duplicate Banner!',
                                    showConfirmButton: true,
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
                    });

                }

            });
        });


    </script>