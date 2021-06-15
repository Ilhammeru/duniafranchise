
    <script type="text/javascript">

        $(document).ready(function () {

            $("#btnSaveFranchise").click(function () {

                var inputFranchiseName = $('#inputFranchiseName').val();
                var inputFranchiseText = $('#inputFranchiseText').val();

                if (inputFranchiseName == '') {

                    alert('Fill the franchise name');

                    return false;

                }

                if (inputFranchiseText == '') {

                    alert('Fill the description');

                    return false;

                }

                $.ajax({

                    url: "<?=site_url('franchise/save_franchise');?>",
                    type: "post",
                    data: {
                        inputFranchiseName : inputFranchiseName,
                        inputFranchiseText : inputFranchiseText
                    },
                    cache: false,
                    success: function(data) {

                        alert(data.msg);

                        if (data.status == 'success') {

                            location.href = "<?=site_url('franchise/add_content/');?>" + data.id;

                        }

                    }   

                });

            });

        });

    </script>

	<div class="row">

		<div class="col-md-12">

            <?php echo $this->session->flashdata('message');?>

            <div class="box-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="col-xs-5">
                            Franchise Name
                            <hr style="padding:0; margin:0">
                        </div>
                        <div class="col-xs-7">
                            <input type="text" id="inputFranchiseName" class="form-control" style="width: 100%" id="focus" required data-toggle="tooltip" data-placement="top" title="Input franchise name">
                        </div>

                    </div>

                </div>
                <!-- /.row -->

                <br>

                <div class="row">

                    <div class="col-md-12">
                        
                        <div class="col-xs-5">
                            Description
                            <hr style="padding:0; margin:0">
                        </div>
                        <div class="col-xs-7">
                            <textarea rows="2" id="inputFranchiseText" class="form-control" style="width: 100%" required data-toggle="tooltip" data-placement="top" title="Input description"></textarea>
                        </div>

                    </div>

                </div>

            </div>

            <div class="box-footer">

                <button id="btnSaveFranchise" class="btn btn-primary btn-sm pull-right"><i class="fa fa-floppy-o"></i> Save</button>

                <a href="<?=site_url('franchise');?>" class="btn btn-default btn-sm pull-right" style="margin: 0 5px 0 0"><i class="fa fa-arrow-left"></i> Back</a>

            </div>

		</div>
		
	</div>
	
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/franchise/add.php
-->