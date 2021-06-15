    <style>
    .modal-dialog-centered {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        min-height: calc(100% - (.5rem * 2));
    }

    .modal-content {
        width: 100%;
        display: flex;
        border-radius: 2rem;
    }

    .modal-body {
        width: 100%;
    }
    img {
        width: 100%;
        height: auto;
    }
    .video-content {
        width: 100%;
        height: 200px;
    }
    .video-content > input {
        display: hidden!important;
    }
    video:focus{
        outline: none !important;
    }
    video {
        width: 80%;
        height: auto;
    }
    #home-left-banner a img {
        width:100%;
        height:auto;
        margin-bottom:10px !important;
    }
    </style>

    <script type="text/javascript">

        $(document).ready ( function() {

            $('img').removeAttr('width');

            loadContent();
            loadLeftBanner();
            
            function createElementFranchiseDetail(result) {

                $('#franchise-detail').empty();

                $('#franchise-detail').append(result.description);

            }

            $('#contact-franchise').on({
                click: function () {
                    $('#modal-contact-franchise').modal('show');
                }
            });

        });

		function loadContent() {
			var franchise_id = <?=$franchise_id;?>;
            $.ajax({
                url: "<?=site_url('webpublic/franchise/get_content');?>/" + franchise_id + '/1',
                success: function (data) {
					$('#spinner').html('');
                    $('#franchise-detail').html(data);
                }
            });
        }


        function loadLeftBanner() {

            $.ajax({
                url: "<?=site_url('webpublic/franchise/loadLeftbanner/');?>",
                dataType: 'json',
                success: function(response){
                    createElementLeftBanner(response.result);
                }
            });
        }

        function createElementLeftBanner(result) {

            $('#home-left-banner').empty();

            for (index in result) {
                
                var imageSource = result[index].image_source;

                var slug = result[index].slug;

                var franchiseBannerImgPath = "<?php echo $franchiseBannerImgPath;?>";

                var colmd = '<a href="<?=site_url('franchises');?>/' + slug + '"><img src="' + franchiseBannerImgPath + imageSource + '" alt="Franchise banner" class="img-franchise-banner"></a>';

                $('#home-left-banner').append(colmd);

            }

        }

    </script>

    <div class="content-wrapper">

    	<section class="content">

            <div class="row">

                <div class="col-xs-3">
                    <div id="home-left-banner"></div>
                </div>

                <div class="col-xs-9" style="padding-left: 0">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box box-widget">
                                
                                <div class="box-body">

                                    <div id="spinner"><center><img src="<?=base_url();?>assets/img/spinner/spinner.gif" style="width:200px;height:200px"></center></div>
                                <div id="franchise-detail"></div>

                            </div>

                        </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12">

                        <?php

                        foreach ($franchiseHits as $row) :

                        ?>

                        <a href="<?=site_url('franchises/' . $row->slug);?>">

                        <div class="col-sm-3 col-xs-6" style="padding: 3px">

                            <div class="box box-widget">

                                <div class="box-header with-border">
                                    <?php echo $row->franchise_name;?>
                                </div>
                                
                                <div class="box-body">

                                    <img src="<?php echo $franchiseThumbnailImgPath . $row->thumbnail . '?' . date('YmdHis');?>" class="img-franchise-thumbnail" alt="Franchise thumbnail">

                                </div>

                                <div class="box-footer">
                                    <label class="label label-warning">franchise</label>
                                </div>

                            </div>

                        </div>

                        </a>

                        <?php

                        endforeach; ?>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

    <div class="row-fixed">

        <div class="row">
            <div class="col-xs-6">
                <a class="btn btn-blue btn-block" href="<?=site_url('franchises-list');?>">Franchise Lainnya</a>
            </div>
            <div class="col-xs-6">
                <?php $phone > 0 ? $disabled = '' : $disabled = 'disabled';?>
                <a class="btn btn-blue btn-block <?=$disabled;?>" id="contact-franchise">Join</a>
            </div>
        </div>

    </div>
    <!--/.cart -->

    <div class="modal fade" id="modal-contact-franchise">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center">Hibungi via whatsapp</h3>
                    <table class="table" style="width: 100%">
                        <?php 
                        if ($phone > 0) {
                            foreach ($franchisePhone as $row) :

                                echo '<tr>';
                                    echo '<td style="width: 50%">';
                                        echo $row->title;
                                    echo '</td>';
                                    echo '<td style="width: 50%">';
                                        echo '<a target="_blank" href="https://api.whatsapp.com/send/?phone=' . $row->phone . '&text=' . $messageContent . '&app_absent=0">' . $row->phone . '</a>';
                                    echo '</td>';
                                echo '</tr>';
                            endforeach;
                        }
                        ?>
                    </table>
                    <button class="btn btn-default" style="float:right" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
