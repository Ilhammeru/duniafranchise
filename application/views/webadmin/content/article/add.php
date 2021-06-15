
    <script type="text/javascript">

        $(document).ready(function () {

            $("#btnSaveArticle").click(function () {

                var inputArticleTitle = $('#inputArticleTitle').val();

                if (inputArticleTitle == '') {

                    alert('Fill the title');

                    return false;

                }

                $.ajax({

                    url: "<?=site_url('article/save_article');?>",
                    type: "post",
                    data: {
                        inputArticleTitle : inputArticleTitle
                    },
                    cache: false,
                    success: function(data) {

                        alert(data.msg);

                        if (data.status == 'success') {

                            location.href = "<?=site_url('article/add_content/');?>" + data.id;

                        }

                    }   

                });

            });

        });

    </script>

	<div class="row">

		<div class="col-md-12">

            <div class="box-body">

                <div class="row">

                    <div class="col-md-12">
                        <div class="col-xs-5">
                            Title
                            <hr style="padding:0; margin:0">
                        </div>
                        <div class="col-xs-7">
                            <input type="text" id="inputArticleTitle" class="form-control" style="width: 100%" id="focus" required data-toggle="tooltip" data-placement="top" title="Input title">
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>

            <div class="box-footer">
                
                <button id="btnSaveArticle" class="btn btn-primary btn-sm pull-right"><i class="fa fa-floppy-o"></i> Save</button>

                <a href="<?=site_url('article');?>" class="btn btn-default btn-sm pull-right" style="margin: 0 5px 0 0"><i class="fa fa-arrow-left"></i> Back</a>

            </div>

		</div>
		
	</div>
	
<!--
    This is a content
    End of file index.php
    Location: ./application/views/webadmin/content/article/add.php
-->