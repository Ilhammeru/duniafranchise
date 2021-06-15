	
	<script type="text/javascript">

		$(document).ready(function () {

		 	var tableFranchise = $('#tableFranchise').DataTable({

                // Data
                ajax: {
                    url: "<?=site_url('banner/get_data_franchise');?>",
                    type: "POST"
                },
                processing: true,
                serverSide: true,
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                select: 'single',
                scrollY: "200px",
        		scrollCollapse: true,

            });

            $('#btnSortingBanner').click( function () {

                $('#modalSortingBanner').modal('show');

            });

            $('#tableFranchise tbody').on( 'click', 'tr', function () {

            	var valueClicked = tableFranchise.row(this).data();

            	$.ajax({
					url: "<?=site_url('banner/display_banner_franchise');?>",
                    type: "post",
                    data: {
                            franchiseName : valueClicked
                    },
                    cache: false,
                    success: function(data) {

                        $('#displayImageUpload').html(data);

                    }   
                });

			});

            var tableTopBanner = $('#tableTopBanner').DataTable({

                // Data
                ajax: {
                    url: "<?=site_url('banner/get_data_top_banner');?>",
                    type: "POST"
                },
                processing: true,
                serverSide: true,
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                select: 'single',
                scrollY: "200px",
                scrollCollapse: true,

            });

            $('#top-banner').click( function() {

                $('#displayImageUpload').html('');

            });

            $('#franchise').click( function() {

                $('#displayImageUpload').html('');

            });

            $('#addTopBanner').click( function() {

                $.ajax({
                    url: "<?=site_url('banner/add_top_banner');?>",
                    type: "post",
                    cache: false,
                    success: function(data) {

                        alert('Added banner successfully');

                        tableTopBanner.ajax.reload();

                    }   
                });

            });

            $('#tableTopBanner tbody').on( 'click', 'tr', function () {

                var valueClickedTopBanner = tableTopBanner.row(this).data();

                $.ajax({
                    url: "<?=site_url('banner/display_top_banner');?>",
                    type: "post",
                    data: {
                            topBannerName : valueClickedTopBanner
                    },
                    cache: false,
                    success: function(data) {

                        $('#displayImageUpload').html(data);

                    }   
                });

            });

            var tableFranchiseSortingLeft = $('#tableFranchiseSortingLeft').DataTable({

                rowReorder: true,
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                select: 'single',
                scrollY: "200px",
                scrollCollapse: true,

            });

            var tableFranchiseSortingRight = $('#tableFranchiseSortingRight').DataTable({

                rowReorder: true,
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                select: 'single',
                scrollY: "200px",
                scrollCollapse: true,

            });

            $('#btnSaveSorting').click( function () {

                var form_dataLeft  = tableFranchiseSortingLeft.rows().data();
                var stringLeft = [];

                var f = form_dataLeft;

                for(var i = 0; f.length > i; i++) {
                    
                    var n = f[i].length;

                    for(var j = 0 ; n > j; j++) {

                        stringLeft.push(f[i][j]);

                    }

                }

                var form_dataRight  = tableFranchiseSortingRight.rows().data();
                var stringRight = [];

                var x = form_dataRight;

                for(var a = 0; x.length > a; a++) {
                    
                    var y = x[a].length;

                    for(var b = 0 ; y > b; b++) {

                        stringRight.push(x[a][b]);

                    }

                }

                $.ajax({
                    url: "<?=site_url('banner/set_sorting_banner');?>",
                    type: "post",
                    data: {
                        bannerSortLeft : stringLeft,
                        bannerSortRight : stringRight
                    },
                    cache: false,
                    success: function(data) {

                        alert('Successfully saved');

                        $('#modalSortingBanner').modal('hide');

                    }   
                });

            });

        });

	</script>
	
    <div class="row">

        <div class="col-md-5">

            <div class="nav-tabs-custom">
                            
                <ul class="nav nav-tabs">

                    <li class="active"><a href="#tab-franchise" id="franchise" data-toggle="tab">Franchise</a></li>
                    <li><a href="#tab-top-banner" id="top-banner" data-toggle="tab">Top Banner</a></li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab-franchise">

                        <?php

                        if ($sessionData['pBannerEdit'] == 1) {

                        ?>

                        <button type="button" class="btn btn-sm btn-primary" id="btnSortingBanner"><i class="fa fa-sort"></i> Sorting Banner</button>

                        <?php } ?>

                        <div id="result"></div>

                    	<table class="table table-stripted table-bordered" id="tableFranchise">

                    		<thead>

                    			<tr>
                    				<th>Franchise List</th>
                    			</tr>

                    		</thead>

                    		<tbody>
                    		</tbody>

                    	</table>

                    </div>

                    <div class="tab-pane" id="tab-top-banner">

                        <?php

                        if ($sessionData['pBannerEdit'] == 1) {

                        ?>

                        <button type="button" class="btn btn-sm btn-primary" id="addTopBanner"><i class="fa fa-plus"></i> Add Top Banner</button>

                        <?php } ?>

                        <table class="table table-stripted table-bordered" id="tableTopBanner">

                            <thead>

                                <tr>
                                    <th>Banner List</th>
                                </tr>

                            </thead>

                            <tbody>
                            </tbody>

                        </table>

                    </div>

                </div>

    		</div>

        </div>

        <div class="col-md-7">

            <div id="displayImageUpload"></div>

        </div>

    </div>

    <div class="modal fade" id="modalSortingBanner">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title"><i class="fa fa-sort"></i> Sorting Banner</h4>
                </div>

                <div class="modal-body">

                    <div class="nav-tabs-custom">
                                          
                        <ul class="nav nav-tabs">

                            <li class="active"><a href="#tab-left" data-toggle="tab">Left Banner</a></li>
                            <li><a href="#tab-right" data-toggle="tab">Right Banner</a></li>

                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="tab-left">

                                <table class="table table-bordered table-stripted" id="tableFranchiseSortingLeft">

                                    <thead>

                                        <tr>
                                            <th>Banner List</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        foreach ($franchiseListLeft as $row) :

                                            echo '<tr>';

                                            echo '<td>' . $row->franchise_name . '</td>';

                                            echo '</tr>';

                                        endforeach;

                                        ?>

                                    </tbody>

                                </table>

                            </div>

                            <div class="tab-pane" id="tab-right">

                                <table class="table table-bordered table-stripted" id="tableFranchiseSortingRight">

                                    <thead>

                                        <tr>
                                            <th>Banner List</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        foreach ($franchiseListRight as $row) :

                                            echo '<tr>';

                                            echo '<td>' . $row->franchise_name . '</td>';

                                            echo '</tr>';

                                        endforeach;

                                        ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnSaveSorting"><i class="fa fa-floppy-o"></i> Save</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!--
    This is a content
    End of file view.php
    Location: ./application/views/webadmin/content/banner/view.php
-->