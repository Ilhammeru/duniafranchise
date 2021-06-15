<!DOCTYPE html>

	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <script type="text/javascript" src="<?=base_url();?>application/views/users/users-script.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#buttonResetPassword').click(function () {

                $('#modalConfirmResetPassword').modal('show');

            });

            $("body").on("shown.bs.modal", "#modalConfirmResetPassword", function () {

                $("#buttonConfirmResetPassword").click(function () {

                    var id = $('#inputId').val();

                    location.href = "<?=site_url('users/reset_password/user_id');?>/" + id;

                });

            });

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

                <input type="hidden" name="inputUsername" value="<?php echo $users['username'];?>">
                <input type="hidden" id="inputId" value="<?php echo $users['user_id'];?>">

                <div class="box-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-envelope-o"></i> Username
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-7"> 
                                <?php echo $users['username'];?>
                            </div>
                        </div>

                    </div>
                    <!-- /.row-->

                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-user"></i> Full Name
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-7">
                            	<input type="text" name="inputFullName" class="form-control" style="width: 100%" id="focus" required value="<?php echo $users['user_fullname'];?>" data-toggle="tooltip" data-placement="top" title="Change full name *txt">
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                    
                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-key"></i> Role
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-6" data-toggle="tooltip" data-placement="top" title="Change permission"> 

                            	<select name="inputRole" class="form-control select2" id="inputRole" style="width: 100%" required>

                            		<?php

                            		echo '<option value="' . $users['role_id'] . '">' . $users['role_name'] . '</option>';

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

                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-lock"></i> Password
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-2">
                                <button type="button" class="btn btn-danger btn-sm btn-block" id="buttonResetPassword"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                            <div class="col-xs-5">
                                <label class="label label-info">*) The default password is '12345678'</label>
                            </div>
                        </div>

                    </div>
                    <!-- /.row-->

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

    <div class="modal fade" id="modalConfirmResetPassword">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title"><i class="fa fa-warning"></i> Confirmation</h4>
                </div>

                <div class="modal-body">

                    <p>Reset this user password?</p>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-sm" id="buttonConfirmResetPassword"><i class="fa fa-refresh"></i> Reset</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!--
	This is a content
	End of file edit.php
	Location: ./application/views/webadmin/user_mg/users/edit.php
-->