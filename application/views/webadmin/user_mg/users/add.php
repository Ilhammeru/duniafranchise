<!DOCTYPE html>

	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <style>
    
        table tr th i {
            margin: 0 5px 0 0;
        }
        
    </style>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#inputRole').on('change', function () {

                var roleId = $('#inputRole').val();

                if (roleId != null) {

                    $.ajax({

                        url: "<?=site_url('permission/display_permission_by_role_id');?>",
                        type: "post",
                        data: {
                            roleId : roleId
                        },
                        cache: false,
                        success: function(data) {

                            $('#displayPermission').html(data);

                        }   
                    });

                }

            });

        });

    </script>

	<div class="row">

		<div class="col-xs-12 col-sm-12">

            <?php echo validation_errors();?>

            <?php echo $this->session->flashdata('message');?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                <div class="box-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-user"></i> Full Name
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-7">
                            	<input type="text" name="inputFullName" class="form-control" style="width: 100%" id="focus" required data-toggle="tooltip" data-placement="top" title="Input Full Name *txt">
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->

                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-envelope-o"></i> Username
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-7"> 
                            	<input type="text" name="inputUsername" class="form-control" style="width: 100%" required data-toggle="tooltip" data-placement="top" title="Input username *txt/number">
                            </div>
                        </div>

                    </div>
                    <!-- /.row-->

                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-key"></i> Role
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-6" data-toggle="tooltip" data-placement="top" title="Select permission"> 

                            	<select name="inputRole" class="form-control select2" style="width: 100%" required id="inputRole">

                            		<?php

                            		echo '<option value="">-</option>';

                            		foreach ($role as $row) :

                            			echo '<option value="' . $row->id . '">' . $row->name . '</option>';

                            		endforeach;

                            		?>

                            	</select>

                            </div>
                            <div class="col-xs-1">

                                <div class="btn-group pull-right" data-toggle="tooltip" data-placement="top" title="Quick Access">
                                    <button type="button" class="btn btn-box-tool btn-default dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-external-link"></i>
                                    </button>
                                    
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?=site_url('role/new_role');?>"><i class="fa fa-plus"></i> New Role</a></li>
                                        <li><a href="<?=site_url('role');?>"><i class="fa fa-list-alt"></i> Role Report</a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.row-->

                    <div id="displayPermission"></div>

                </div><!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-floppy-o"></i> Save </button>

                    <a href="<?=site_url('users');?>" class="btn btn-default btn-sm pull-right" style="margin: 0 5px 0 0"><i class="fa fa-arrow-left"></i> Back</a>

                </div><!-- /.box-footer -->
            
            </form>

		</div>
		<!-- /.col-xs-12 -->

	</div>
	<!-- /.row -->

<!--
	This is a content
	End of file add.php
	Location: ./application/views/webadmin/user_mg/users/add.php
-->