<!DOCTYPE html>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <style>

        i {
            margin: 0 5px 0 0;
        }

    </style>

    <script type="text/javascript">

        var username = "<?php echo $users['username'];?>";

        var tableLogsProfile;
        var titleExport = 'Logs Activity User';
        var columnExport = [ 0, 1];

        $(document).ready( function () {

            tableLogsProfile  = $('#tableLogsProfile').DataTable({

                ajax: {
                    url: "<?=site_url('logs/get_data_log_activity_by_user_id/' . $users['user_id']);?>",
                    type: "POST"
                },
                processing: true,
                serverSide: true,
                order: [0, 'desc'],
                columns: [
                            {
                                "width": "25%"
                            },
                            {
                                "width": "70%"
                            }
                        ],             
                lengthChange: false,
                buttons: [ 
                            'pageLength',
                            'colvis',
                            {
                                extend: 'copy',
                                exportOptions: {
                                    columns: columnExport
                                }
                            },
                            {
                                extend: 'excel',
                                title: titleExport,
                                exportOptions: {
                                    columns: columnExport
                                }
                            },
                            {
                                extend: 'pdf',
                                title: titleExport,
                                exportOptions: {
                                    columns: columnExport
                                }
                            },
                            {
                                extend: 'print',
                                title: titleExport,
                                exportOptions: {
                                    columns: columnExport
                                }
                            }
                        ],

                dom: 'Bfrtip',
                select: {
                    style: 'multi'
                },

                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],

                responsive: {

                    details: {

                        display: $.fn.dataTable.Responsive.display.modal( {

                            header: function ( row ) {

                                var data = row.data();
                                return 'Details for ' + data[1];

                            }

                        }),

                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }

            });
 
            tableLogsProfile.buttons().container().appendTo('#example_wrapper .col-sm-6:eq(0)');

            var notif = "<?php echo $notif;?>";

            if (notif == 'restart') {

                alert('Your data has been successfully updated. Please Log In again');  

                location.href = "<?=site_url('dashboard/signout');?>";

            }

            $('#inputPassword').attr('disabled', 'disabled');
            $('#inputPassword').hide();

            $('#checkPassword').on('ifChecked', function (event) {

                $('#inputPassword').show();
                $('#inputPassword').removeAttr('disabled');
                $('#inputPassword').focus();   

            });

            $('#checkPassword').on('ifChanged', function (event) {

                $('#inputPassword').attr('disabled', 'disabled');
                $('#inputPassword').hide();  
                
            });

        });

    </script>
	
	<div class="row">

		<div class="col-md-5">

            <div class="box box-widget widget-user-2">
            
                <div class="widget-user-header bg-aqua-active">

                    <div class="widget-user-image">
                        <?php
                        if ( empty($users['images'])) {

                            echo '<img class="img-circle" src="' . base_url() . 'assets/img/no-image.jpg" alt="User profile picture">';

                        } else {

                            echo '<img class="img-circle" src="' . base_url() . $users['images'] . '" alt="User profile picture">'; 

                        }
                        ?>
                    </div>

                    <h3 class="widget-user-username"><i class="fa fa-user"></i> <?php echo $users['user_fullname'];?></h3>
                    <h5 class="widget-user-desc">
                        | <i class="fa fa-user"></i> <?php echo $users['username'];?> | <i class="fa fa-key"></i> <?php echo $users['role_name'];?> |
                    </h5>
                </div>

                <!--
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                        <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                        <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                        <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                    </ul>
                </div>-->
            </div>

		</div>
		<!-- /.col-md-5 -->

		<div class="col-md-7">
          		
        	<div class="nav-tabs-custom">

           		<ul class="nav nav-tabs">
        
           			<li class="active"><a href="#tab-setting" data-toggle="tab"><i class="fa fa-gears"></i> Settings</a></li>
                   <!--<li><a href="#tab-activity" data-toggle="tab"><i class="fa fa-list-alt"></i> Activity</a></li>-->

           		</ul>

           		<div class="tab-content">

                    <div class="tab-pane active" id="tab-setting">
        
               			<?php echo validation_errors();?>

                        <?php echo $this->session->flashdata('message');?>

                        <?php echo $this->session->flashdata('messageSuccess');?>
                        
                        <?php echo $this->session->flashdata('messageInfo');?>

                        <form class="form-horizontal" action="<?=site_url('users/update_profile');?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="inputUsername" value="<?php echo $users['username'];?>">
                            <input type="hidden" name="inputId" value="<?php echo $users['user_id'];?>">

                            <div class="box-body">
                                
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="col-xs-5">
                                            <i class="fa fa-user"></i> Username
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
                                        	<input type="text" name="inputFullName" class="form-control" style="width: 100%" id="focus" required value="<?php echo $users['user_fullname'];?>" data-toggle="tooltip" data-placement="top" title="Change full name">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.row -->

                                <br>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="col-xs-5">
                                            <i class="fa fa-lock"></i> Password
                                            <hr style="padding:0; margin:0">
                                        </div>
                                        <div class="col-xs-2">

                                        	<input type="checkbox" class="minimal" name="checkPassword" value="yes" style="margin: 0 10px 0 0" id="checkPassword"> <small>Change Password</small>

                                        </div>
                                        <div class="col-xs-5">

                                        	<input type="password" name="inputPassword" class="form-control" style="width: 100%" id="inputPassword" data-toggle="tooltip" data-placement="top" title="Change password">

                                        </div>
                                    </div>

                                </div>
                                <!-- /.row-->

                                <br>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="col-xs-5">
                                            <i class="fa fa-image"></i> Change Avatar
                                            <hr style="padding:0; margin:0">
                                        </div>
                                        <div class="col-xs-7">

                                            <?php

                                            foreach ($avatarList as $row) :

                                                echo '<div class="col-xs-2" style="text-align: center; padding:0!important">

                                                    <input type="radio" class="minimal" name="inputAvatarDir" value="' . $avatarDir . $row . '">

                                                    <br>

                                                    <br>

                                                    <img class="img-circle" src="' . base_url() . $avatarDir . $row . '" style="width: 50px; height: 50px; border: 1px solid grey" alt="User profile picture">

                                                </div>';

                                            endforeach;

                                            ?>

                                        </div>
                                    </div>

                                </div>
                                 <!-- /.row-->

                            </div><!-- /.box-body -->

                            <div class="box-footer">

                                <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-floppy-o"></i> Save </button>

                            </div><!-- /.box-footer -->
                        
                        </form>

                    </div>
                    <!-- /.tab-pane -->

                    <!--

                    <div class="tab-pane" id="tab-activity">

                        <table class="table table-stripted table-bordered" id="tableLogsProfile" style="width: 100%">

                            <thead>

                                <tr>
                                    <th><i class="fa fa-hourglass-2"></i> Time</th>
                                    <th><i class="fa fa-list-alt"></i> Log</th>
                                </tr>

                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                    </div>
                    <!-- /.tab-pane -->

              	</div>
              	<!-- /.tab-content -->

            </div>
            <!-- /.nav -->

        </div>

	</div>
	<!-- /.row -->

<!--
	This is a content
	End of file user-profile.php
	Location: ./application/webadmin/user_mg/users/user-profile.php
-->