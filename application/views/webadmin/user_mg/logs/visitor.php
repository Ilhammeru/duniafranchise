<!DOCTYPE html>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

    <style>

        .dataTables_filter {
            
            display: none; 
            
        }

    </style>

	<script type="text/javascript">

        var titleExport = 'Logs Visitor';
        var columnExport = [ ':visible' ];

        $(document).ready( function () {

            $('#tableLogs thead tr').clone(true).appendTo('#tableLogs thead');

            $('#tableLogs thead tr:eq(1) th').each( function (i) {
            
                var title = $(this).text();

                switch (i) {

                    case 0 :

                        $(this).html('<input type="text" class="form-control input-sm daterangepicker" placeholder="Search ' + title + '" readonly />');

                        break;

                    default :

                        $(this).html('<input type="text" class="form-control input-sm" placeholder="Search ' + title + '" />');

                        break;

                } 

                $('.daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                
                    $(this).val("");

                    tableLogs
                        .column(i)
                        .search(this.value)
                        .draw();

                });

                $('input', this).on('change', function () {

                    tableLogs
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

                    tableLogs
                        .column(i)
                        .search(result)
                        .draw();
                        
                });

            });

        	var tableLogs  = $('#tableLogs').DataTable({

                // Data
                ajax: {
                    url: "<?=site_url('logs/get_data_log_visitor');?>",
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
                    [ 10, 25, 50, 100, -1],
                    [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show All']
                ],

                // Column
                columns: [
                            {
                                "width": "20%"
                            },
                            {
                                "width": "20%"
                            },
                            {
                                "width": "20%"
                            },
                            {
                                "width": "20%"
                            },
                            {
                                "width": "20%"
                            }
                        ],            
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
 
            tableLogs.buttons().container().appendTo('#example_wrapper .col-sm-6:eq(0)');

        });

    </script>

	<div class="row">

        <div class="col-xs-12 col-sm-12">

            <?php echo $this->session->flashdata('messageSuccess');?>
            <?php echo $this->session->flashdata('message');?>
            <?php echo $this->session->flashdata('messageInfo');?>

            <table class="table table-stripted table-bordered" id="tableLogs" style="width: 100%">

                <thead>

                    <tr>
                        <th><i class="fa fa-hourglass-2"></i> Time</th>
                        <th><i class="fa fa-map-pin"></i> IP Address</th>
                        <th><i class="fa fa-check"></i> Log</th>
                        <th><i class="fa fa-list-alt"></i> Access</th>
                        <th><i class="fa fa-map-pin"></i> Location</th>
                    </tr>

                </thead>

                <tbody>

                </tbody>

            </table>

        </div>
        <!-- /.col-xs-12 -->

    </div>
    <!-- /.row -->

<!--
	This is a content
	End of file visitor.php
	Location: ./application/views/webadmin/user_mg/logs/visitor.php
-->