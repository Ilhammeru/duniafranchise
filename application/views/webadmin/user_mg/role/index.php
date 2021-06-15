<!DOCTYPE html>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <style>

        .dataTables_filter {
            
            display: none; 
            
        }

    </style>

    <script type="text/javascript">

        var titleExport = 'Role Report';
        var columnExport = [ ':visible:not(.not-export-col)' ];

        $(document).ready( function () {

            $('#tablePermission thead tr').clone(true).appendTo('#tablePermission thead');

            $('#tablePermission thead tr:eq(1) th').each( function (i) {
            
                var title = $(this).text();

                switch (i) {

                    case 0 :

                        $(this).html('<input type="text" class="form-control input-sm daterangepicker" placeholder="Search ' + title + '" readonly />');

                        break;

                    case 2 :
                        
                        $(this).html('<?php echo $filterUser;?>');

                        break;

                    case 3 :

                        $(this).html('');

                        break;

                    default :

                        $(this).html('<input type="text" class="form-control input-sm" placeholder="Search ' + title + '" />');

                        break;

                }

                $('.daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                
                    $(this).val("");

                    tablePermission
                        .column(i)
                        .search(this.value)
                        .draw();

                });

                $('input', this).on('change', function () {

                    tablePermission
                        .column(i)
                        .search(this.value)
                        .draw();

                });

                $('select', this).on('change', function () {

                    var result = [];
                    var options = this && this.options;
                    var opt;

                    for (var x = 0, xLen = options.length; x < xLen; x++) {
                            
                        opt = options[x];

                        if (opt.selected) {

                            result.push(opt.value || opt.text);
                            
                        }

                    }

                    tablePermission
                        .column(i)
                        .search(result)
                        .draw();
                        
                });
                
            });

            var tablePermission  = $('#tablePermission').DataTable({

                // Data
                ajax: {
                    url: "<?=site_url('role/get_data_role');?>",
                    type: "POST"
                },
                processing: true,
                serverSide: true,

                // Ordering
                order: [0, 'desc'],
                colReorder: true,
                orderCellsTop: true,

                // Header
                fixedHeader: {
                    headerOffset: 50
                },

                // Select
                select: {
                    style: 'multi'
                },

                // Length
                lengthChange: false,
                lengthMenu: [
                    [ 10, 25, 50, 100],
                    [ '10 rows', '25 rows', '50 rows', '100 rows']
                ],

                // Column
                columnDefs: [
                            {  
                                targets: [ 3 ],
                                orderable: false,                                
                                className: "not-export-col"
                            }
                        ],
                columns: [
                            {
                                "width": "25%"
                            },
                            {
                                "width": "30%"
                            },
                            {
                                "width": "25%"
                            },
                            {
                                "width": "20%"
                            }
                        ],    

                // Button        
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
                            },
                            {
                                text: 'New Role',
                                attr : {
                                    id: 'new-role'
                                },
                                className: 'btn-info',
                                action: function ( e, dt, node, config ) {
                                    location.href = "<?=site_url('role/new_role');?>"                
                                }
                            },
                            {
                                text: 'New User',
                                className: 'btn-info',
                                action: function ( e, dt, node, config ) {
                                    location.href = "<?=site_url('users/new_user');?>"                
                                }
                            } 
                        ],
                dom: 'Bfrtip',

                // Responsive
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
 
            tablePermission.buttons().container().appendTo('#example_wrapper .col-sm-6:eq(0)');

            $('#tablePermission tbody').on('click', '.role-delete', function () {

                var code = $(this).attr('code');

                $('#deleteRoleId').val(code);

                $('#modalConfirmDelete').modal('show');

            });

            $('body').on('shown.bs.modal', '#modalConfirmDelete', function () {

                var id = $('#deleteRoleId').val();

                $('#buttonConfirmDelete').click(function () {

                    location.href = '<?=site_url('role/delete/role_id');?>/' + id;

                });

            });

            $('#tablePermission tbody').on('click', '.role-detail', function () {

                var roleId = $(this).attr('code');

                $.ajax({

                    url: "<?=site_url('role/display_detail_role_by_role_id');?>",
                    type: "post",
                    data: {
                        roleId : roleId
                    },
                    cache: false,
                    success: function(data) {

                        $('#displayDetailRole').html(data);

                    }   

                });

            });

            $("body").on("shown.bs.modal", ".dtr-bs-modal", function () {

                $('.dtr-details').on('click', '.role-detail', function () {

                    $('.dtr-bs-modal').modal('hide');

                    var roleId = $(this).attr('code');

                    $.ajax({

                        url: "<?=site_url('role/display_detail_role_by_role_id');?>",
                        type: "post",
                        data: {
                            roleId : roleId
                        },
                        cache: false,
                        success: function(data) {

                            $('#displayDetailRole').html(data);

                        }   

                    });

                });

                $('.dtr-details').on('click', '.role-delete', function () {
                    
                    $('.dtr-bs-modal').modal('hide');

                    var code = $(this).attr('code');

                    $('#deleteRoleId').val(code);

                    $('#modalConfirmDelete').modal('show');

                });

            });

        });

    </script>

    <div class="row">

        <div class="col-xs-12 col-sm-12 table-responsive">

            <?php echo $this->session->flashdata('messageSuccess');?>
            <?php echo $this->session->flashdata('message');?>
            <?php echo $this->session->flashdata('messageInfo');?>

            <table class="table table-stripted table-bordered" id="tablePermission" style="width: 100%">

                <thead>

                    <tr>
                        <th><i class="fa fa-hourglass-2"></i> Updated</th>
                        <th><i class="fa fa-key"></i> Role</th>
                        <th><i class="fa fa-user"></i> Updated By</th>
                        <th><i class="glyphicon glyphicon-wrench"></i> Action</th>
                    </tr>

                </thead>

                <tbody>

                </tbody>

            </table>

        </div>
        <!-- /.col-xs-12 -->

    </div>
    <!-- /.row -->

    <div id="displayDetailRole"></div>

    <div class="modal fade" id="modalConfirmDelete">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header bg-red">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title"><i class="fa fa-warning"></i> Confirmation</h4>
                </div>

                <div class="modal-body">

                    <p>Are you sure to delete this data?</p>

                    <input type="hidden" id="deleteRoleId">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="button" class="btn btn-danger btn-sm" id="buttonConfirmDelete"><i class="fa fa-check"></i> Yes</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/user_mg/role/index.php
-->
