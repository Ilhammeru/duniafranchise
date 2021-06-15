<!DOCTYPE html>

		</section>
		<!-- /.content -->
		
	</div>
	<!-- /.content-wrapper -->

	<div class="modal fade" id="modalLoading">

		<div class="modal-dialog" style="width:250px">

			<div class="modal-content">

				<div class="modal-body">

					<center><img src="<?=base_url();?>assets/img/spinner/spinner.gif" style="width:200px;height:200px"></center>

				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal fade" id="modalConfirmSignOut">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

					<h4 class="modal-title"><i class="fa fa-sign-out"></i> Sign Out</h4>
				</div>

				<div class="modal-body">

					<p>Sign out application and delete your session?</p>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="button" class="btn btn-primary btn-sm" id="buttonConfirmSignOut"><i class="fa fa-sign-out"></i> Sign Out</button>
				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal modal-loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="row" style="margin-left:auto;margin-right:auto">
                <div class="col-12 text-center">
                    <div class="overlay text-center" style="font-size: 3rem"><i class="fa fa-refresh fa-spin"></i></div>
                </div>
            </div>
        </div>
        <!--/.modal-dialog -->

    </div>
    <!--/.modal.modal-loading -->
	
	<!-- START SCRIPT -->
	
	<script type="text/javascript">	
		
        window.onload = function () {

            $('input:first:visible:enabled').focus();

        }
		
		$(document).ready(function () { 

			$('#buttonSignOut').click( function () {

				$('#modalConfirmSignOut').modal('show');
				
			});

			$("body").on("shown.bs.modal", "#modalConfirmSignOut", function () {

				$('#buttonConfirmSignOut').focus();

				$("#buttonConfirmSignOut").click(function () {

					location.href = "<?=site_url('dashboard/signout');?>";

				});

			});

    		$('.my-colorpicker').colorpicker();

			$('.select2').select2();

			$('.datepicker').datepicker({
		      	autoclose: true,
    			orientation: "top auto",
		      	format: 'yyyy-mm-dd',
            	todayHighlight: true
		    });

		    $('.daterangepicker').daterangepicker({
    			drops: 'down',
            	todayHighlight : true,
            	locale: {
			    	cancelLabel: 'Clear'
			    }
    		});

		    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      			checkboxClass: 'icheckbox_minimal-blue',
      			radioClass: 'iradio_minimal-blue'
    		});

    		$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      			checkboxClass: 'icheckbox_minimal-red',
      			radioClass: 'iradio_minimal-red'
    		});

    		$('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
      			checkboxClass: 'icheckbox_minimal-green',
      			radioClass: 'iradio_minimal-green'
    		});

    		$('.slider').slider();

    		$('.currency-rp').inputmask("numeric", {
				
                radixPoint : ".",
                groupSeparator : ",",
                digits : 2,
                autoGroup : true,
                prefix : 'Rp ',
                rightAlign : false,
               	allowMinus: false,
                oncleared : function(){ 
                	self.Value(''); 
                }
                
            });
		    
		});

	</script>

	<!-- END SCRIPT -->

</body>

</html>

<!--
	This is a footer
	End of file footer-app.php
	Location: ./application/views/webadmin/template/footer-app.php
-->
