<!DOCTYPE html>

    <style>
    
        table tr th i {
            margin: 0 5px 0 0;
        }
        #radioLeft {
            margin: 0px 5px 0 0;
        }
        #radioRight {
            margin: 0px 5px 0 15px;
        }
        .nav-tabs-custom {
            font-size: 10px;
        }
        
    </style>

	<div class="row">

		<div class="col-xs-12 col-sm-12">

            <?php echo validation_errors();?>

            <?php echo $this->session->flashdata('message');?>

            <form class="form-horizontal" action="<?=site_url('role/save_role/' . $mode . '/' . $role['role_id']);?>" method="post" enctype="multipart/form-data">

                <div class="box-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-xs-5">
                                <i class="fa fa-tag"></i> Role Name
                                <hr style="padding:0; margin:0">
                            </div>
                            <div class="col-xs-7">

                                <?php

                                switch ($mode):

                                    case 'add':
                            	   
                                        echo '<input type="text" name="inputRole" class="form-control" style="width: 100%" id="focus" required data-toggle="tooltip" data-placement="top" title="Input role name *txt/number">';

                                    break;

                                    case 'update':

                                        echo $role['role_name'];

                                        echo '<input type="hidden" name="inputRole" value="' . $role['role_name'] . '">';

                                    break;

                                endswitch;

                                ?>

                            </div>
                        </div>

                    </div>
                    <!-- /.row -->

                    <br>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-xs-5">
                                <i class="fa fa-key"></i> Role Detail
                                <hr style="padding:0; margin:0">
                            </div>

                            <div class="col-xs-7">

                                <div class="nav-tabs-custom">
                                
                                    <ul class="nav nav-tabs">

                                        <li class="active"><a href="#tab-user" data-toggle="tab"><i class="fa fa-user"></i> Menu User Management</a></li>
                                        <li><a href="#tab-masterdata" data-toggle="tab"><i class="fa fa-list-alt"></i> Menu Content</a></li>
                                        <li><a href="#tab-report-log" data-toggle="tab"><i class="fa fa-list-alt"></i> Menu Report & Log</a></li>

                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab-user">

                                            <table class="table table-stripted table-bordered">
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
                                                        <td><i class="fa fa-users"></i> Menu User</td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPUserReport" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPUserAdd" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPUserView" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPUserEdit" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPUserDelete" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-key"></i> Menu Role</td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPRoleReport" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPRoleAdd" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPRoleView" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPRoleEdit" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPRoleDelete" value="1">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab-masterdata">

                                            <table class="table table-stripted table-bordered">
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
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPFranchiseReport" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPFranchiseAdd" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPFranchiseView" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPFranchiseEdit" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPFranchiseDelete" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu Article</td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPArticleReport" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPArticleAdd" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPArticleView" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPArticleEdit" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPArticleDelete" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu About Us</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPAboutUsView" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPAboutUsEdit" value="1">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-list-alt"></i> Menu Banner</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPBannerView" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="minimal" name="inputPBannerEdit" value="1">
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab-report-log">

                                            <table class="table table-stripted table-bordered">
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
                                                            <input type="checkbox" class="minimal" name="inputPLogActivity" value="1">
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
                            <!-- /.col-xs-7 -->

                        </div>
                        <!-- /.col-md-12 -->

                    </div>
                    <!-- /.row -->

                </div><!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-floppy-o"></i> Save </button>

                    <a href="<?=site_url('role');?>" class="btn btn-default btn-sm pull-right" style="margin: 0 5px 0 0"><i class="fa fa-arrow-left"></i> Back</a>

                </div><!-- /.box-footer -->
            
            </form>

		</div>
		<!-- /.col-xs-12 -->

	</div>
	<!-- /.row -->

<!--
	This is a content
	End of file submit.php
	Location: ./application/views/webadmin/user_mg/role/submit.php
-->