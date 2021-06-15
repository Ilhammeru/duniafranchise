<!DOCTYPE html>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <style>

        .dataTables_filter {
            
            display: none; 

        }

    </style>

    <script type="text/javascript">

        var titleExport = 'Users Report';
        var columnExport = [ ':visible:not(.not-export-col)' ];

        $(document).ready( function () {

            $('#tableUsers thead tr').clone(true).appendTo('#tableUsers thead');

            $('#tableUsers thead tr:eq(1) th').each( function (i) {
            
                var title = $(this).text();

                switch (i) {

                    case 0 :

                        $(this).html('<input type="text" class="form-control input-sm daterangepicker" placeholder="Search ' + title + '" readonly />');

                        break;

                    case 3 :
                        
                        $(this).html('<?php echo $filterRole;?>');

                        break;

                    case 4 :

                        $(this).html('');

                        break;

                    default :

                        $(this).html('<input type="text" class="form-control input-sm" placeholder="Search ' + title + '" />');

                        break;

                }

                $('.daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                
                    $(this).val("");

                    tableUsers
                        .column(i)
                        .search(this.value)
                        .draw();

                });

                $('input', this).on('change', function () {

                    tableUsers
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

                    tableUsers
                        .column(i)
                        .search(result)
                        .draw();
                        
                });

            });

            var tableUsers  = $('#tableUsers').DataTable({

                // Data
                ajax: {
                    url: "<?=site_url('users/get_data_users_and_role');?>",
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
                                targets: [ 4 ],
                                orderable: false,                                
                                className: "not-export-col"
                            }
                        ],
                columns: [
                            {
                                "width": "20%"
                            },
                            {
                                "width": "25%"
                            },
                            {
                                "width": "20%"
                            },
                            {
                                "width": "20%"
                            },
                            {
                                "width": "15%"
                            }
                        ],   

                // Buttons          
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
                                text: 'New User',
                                className: 'btn-info',
                                action: function (e, dt, node, config) {

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
                                return 'Details for ' + data[1] + ' [' + data[2] + ']';

                            }

                        }),

                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }

            });
        
            tableUsers.buttons().container().appendTo('#example_wrapper .col-sm-6:eq(0)');

            $('#tableUsers tbody').on('click', '.user-delete', function () {

                var code = $(this).attr('code');

                $('#deleteUserId').val(code);

                $('#modalConfirmDelete').modal('show');

            });

            $('body').on('shown.bs.modal', '#modalConfirmDelete', function () {

                var id = $('#deleteUserId').val();

                $('#buttonConfirmDelete').click(function () {

                    location.href = '<?=site_url('users/delete/user_id');?>/' + id;

                });

            });

            $('#tableUsers tbody').on('click', '.user-detail', function () {

                var userId = $(this).attr('code');

                $.ajax({

                    url: "<?=site_url('users/display_detail_user_by_id');?>",
                    type: "post",
                    data: {
                        userId : userId
                    },
                    cache: false,
                    success: function(data) {

                        $('#displayDetailUser').html(data);

                    }   

                });

            });

            $("body").on("shown.bs.modal", ".dtr-bs-modal", function () {

                $('.dtr-details').on('click', '.user-detail', function () {

                    $('.dtr-bs-modal').modal('hide');

                    var userId = $(this).attr('code');

                    $.ajax({

                        url: "<?=site_url('users/display_detail_user_by_id');?>",
                        type: "post",
                        data: {
                            userId : userId
                        },
                        cache: false,
                        success: function(data) {

                            $('#displayDetailUser').html(data);

                        }   

                    });

                });

                $('.dtr-details').on('click', '.user-delete', function () {
                    
                    $('.dtr-bs-modal').modal('hide');

                    var code = $(this).attr('code');

                    $('#deleteUserId').val(code);

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

            <table class="table table-stripted table-bordered" id="tableUsers" style="width: 100%">

                <thead>

                    <tr>
                        <th><i class="fa fa-hourglass-2"></i> Updated</th>
                        <th><i class="fa fa-user"></i> Full Name</th>
                        <th><i class="fa fa-user"></i> Username</th>
                        <th><i class="fa fa-key"></i> Role</th>
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

    <div id="displayDetailUser"></div>

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

                    <input type="hidden" id="deleteUserId">

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
    Location: ./application/views/webadmin/user_mg/users/index.php
-->
