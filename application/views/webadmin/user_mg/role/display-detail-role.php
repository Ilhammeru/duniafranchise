<!DOCTYPE html>

    <style>

        .nav-tabs-custom {
            font-size: 10px;
        }

    </style>

 	<script>

        $(document).ready(function(){ 
          
            $("#modalDetailPermission").modal("show");

        });

    </script>

	<div class="modal fade" id="modalDetailPermission">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header bg-aqua">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title"><i class="fa fa-list-alt"></i> Role Detail</h4>
                </div>

                <div class="modal-body">

                    <div class="container-fluid">
                        
                        <div class="row">

                            <div class="col-md-12">

                                <table class="table table-bordered" style="width:60%;">
                                    <tr>
                                        <th><i class="fa fa-tag"></i> Role Name</th>
                                        <td><?php echo $permission['role_name'];?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-hourglass-2"></i> Updated Time</th>
                                        <td><?php echo date_format(date_create($permission['updated_time']), 'd M Y H:i');?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-user"></i> Updated By</th>
                                        <td><?php echo $permission['username'];?></td>
                                    </tr>
                                </table>

                            </div>
                            <!-- /.col-md-12 -->

                        </div>
                        <!-- /.row -->
                        
                        <div class="row">

                            <div class="col-md-12">

                                <div class="nav-tabs-custom">
                        
                                    <ul class="nav nav-tabs">

                                        <li class="active"><a href="#tab-user" data-toggle="tab"><i class="fa fa-user"></i> Menu User Management</a></li>
                                        <li><a href="#tab-masterdata" data-toggle="tab"><i class="fa fa-list-alt"></i> Menu Content</a></li>
                                        <li><a href="#tab-report-log" data-toggle="tab"><i class="fa fa-list-alt"></i> Menu Report & Log</a></li>

                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab-user">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fa fa-key"></i> Permission</th>
                                                        <th><i class="fa fa-list-alt"></i> Report</th>
                                                        <th><i class="fa fa-plus"></i> Add</th>
                                                        <th><i class="fa fa-eye"></i> View</th>
                                                        <th><i class="fa fa-edit"></i> Edit</th>
                                                        <th><i class="fa fa-trash-o"></i> Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><i class="fa fa-users"></i> Menu Users</td>
                                                        <td><?php echo $permission['p_user_report'];?>
                                                        <td><?php echo $permission['p_user_add'];?></td>
                                                        <td><?php echo $permission['p_user_view'];?></td>
                                                        <td><?php echo $permission['p_user_edit'];?></td>
                                                        <td><?php echo $permission['p_user_delete'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-key"></i> Menu Role</td>
                                                        <td><?php echo $permission['p_role_report'];?></td>
                                                        <td><?php echo $permission['p_role_add'];?></td>
                                                        <td><?php echo $permission['p_role_view'];?></td>
                                                        <td><?php echo $permission['p_role_edit'];?></td>
                                                        <td><?php echo $permission['p_role_delete'];?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab-masterdata">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fa fa-key"></i> Permission</th>
                                                        <th><i class="fa fa-list-alt"></i> Report</th>
                                                        <th><i class="fa fa-plus"></i> Add</th>
                                                        <th><i class="fa fa-eye"></i> View</th>
                                                        <th><i class="fa fa-edit"></i> Edit</th>
                                                        <th><i class="fa fa-trash-o"></i> Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu Franchise</td>
                                                        <td><?php echo $permission['p_franchise_report'];?>
                                                        <td><?php echo $permission['p_franchise_add'];?></td>
                                                        <td><?php echo $permission['p_franchise_view'];?></td>
                                                        <td><?php echo $permission['p_franchise_edit'];?></td>
                                                        <td><?php echo $permission['p_franchise_delete'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu Article</td>
                                                        <td><?php echo $permission['p_article_report'];?></td>
                                                        <td><?php echo $permission['p_article_add'];?></td>
                                                        <td><?php echo $permission['p_article_view'];?></td>
                                                        <td><?php echo $permission['p_article_edit'];?></td>
                                                        <td><?php echo $permission['p_article_delete'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu About Us</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php echo $permission['p_about_us_view'];?></td>
                                                        <td><?php echo $permission['p_about_us_edit'];?></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu Banner</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php echo $permission['p_banner_view'];?></td>
                                                        <td><?php echo $permission['p_banner_edit'];?></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab-report-log">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fa fa-key"></i> Permission</th>
                                                        <th><i class="fa fa-check-square-o"></i>Allowed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu Record of Activities</td>
                                                        <td>
                                                            <?php echo $permission['p_log_activity'];?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->

                                    </div>
                                    <!-- /.tab-content -->

                                </div>
                                <!-- nav-tabs-custom -->

                            </div>                                

                        </div>
                    
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!--
    This is a content
    End of file display-detail-role.php
    Location: ./application/views/webadmin/user_mg/role/display-detail-role.php
-->