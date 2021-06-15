<!DOCTYPE html>
	
    <script type="text/javascript">

        var mode = "<?php echo $mode;?>";

        var pUserReport = "<?php echo $role['p_user_report'];?>";
        var pUserAdd = "<?php echo $role['p_user_add'];?>";
        var pUserView = "<?php echo $role['p_user_view'];?>";
        var pUserEdit = "<?php echo $role['p_user_edit'];?>";
        var pUserDelete = "<?php echo $role['p_user_delete'];?>";

        var pRoleReport = "<?php echo $role['p_role_report'];?>";
        var pRoleAdd = "<?php echo $role['p_role_add'];?>";
        var pRoleView = "<?php echo $role['p_role_view'];?>";
        var pRoleEdit = "<?php echo $role['p_role_edit'];?>";
        var pRoleDelete = "<?php echo $role['p_role_delete'];?>";

        var pFranchiseReport = "<?php echo $role['p_franchise_report'];?>";
        var pFranchiseAdd = "<?php echo $role['p_franchise_add'];?>";
        var pFranchiseView = "<?php echo $role['p_franchise_view'];?>";
        var pFranchiseEdit = "<?php echo $role['p_franchise_edit'];?>";
        var pFranchiseDelete = "<?php echo $role['p_franchise_delete'];?>";

        var pArticleReport = "<?php echo $role['p_article_report'];?>";
        var pArticleAdd = "<?php echo $role['p_article_add'];?>";
        var pArticleView = "<?php echo $role['p_article_view'];?>";
        var pArticleEdit = "<?php echo $role['p_article_edit'];?>";
        var pArticleDelete = "<?php echo $role['p_article_delete'];?>";

        var pAboutUsView = "<?php echo $role['p_about_us_view'];?>";
        var pAboutUsEdit = "<?php echo $role['p_about_us_edit'];?>";

        var pBannerView = "<?php echo $role['p_banner_view'];?>";
        var pBannerEdit = "<?php echo $role['p_banner_edit'];?>";

        var pLogActivity = "<?php echo $role['p_log_activity'];?>";  
        
        $(document).ready(function () {

        if (mode == 'update') {

            if (pUserReport == 1) {

                $('input[name="inputPUserReport"]').attr('checked', true);

            }

            if (pUserAdd == 1) {

                $('input[name="inputPUserAdd"]').attr('checked', true);

            }

            if (pUserView == 1) {

                $('input[name="inputPUserView"]').attr('checked', true);

            }

            if (pUserEdit == 1) {

                $('input[name="inputPUserEdit"]').attr('checked', true);

            }

            if (pUserDelete == 1) {

                $('input[name="inputPUserDelete"]').attr('checked', true);

            }

            if (pRoleReport == 1) {

                $('input[name="inputPRoleReport"]').attr('checked', true);

            }

            if (pRoleAdd == 1) {

                $('input[name="inputPRoleAdd"]').attr('checked', true);

            }

            if (pRoleView == 1) {

                $('input[name="inputPRoleView"]').attr('checked', true);

            }

            if (pRoleEdit == 1) {

                $('input[name="inputPRoleEdit"]').attr('checked', true);

            }

            if (pRoleDelete == 1) {

                $('input[name="inputPRoleDelete"]').attr('checked', true);

            }

            if (pFranchiseReport == 1) {

                $('input[name="inputPFranchiseReport"]').attr('checked', true);

            }

            if (pFranchiseAdd == 1) {

                $('input[name="inputPFranchiseAdd"]').attr('checked', true);

            }

            if (pFranchiseView == 1) {

                $('input[name="inputPFranchiseView"]').attr('checked', true);

            }

            if (pFranchiseEdit == 1) {

                $('input[name="inputPFranchiseEdit"]').attr('checked', true);

            }

            if (pFranchiseDelete == 1) {

                $('input[name="inputPFranchiseDelete"]').attr('checked', true);

            }

            if (pArticleReport == 1) {

                $('input[name="inputPArticleReport"]').attr('checked', true);

            }

            if (pArticleAdd == 1) {

                $('input[name="inputPArticleAdd"]').attr('checked', true);

            }

            if (pArticleView == 1) {

                $('input[name="inputPArticleView"]').attr('checked', true);

            }

            if (pArticleEdit == 1) {

                $('input[name="inputPArticleEdit"]').attr('checked', true);

            }

            if (pArticleDelete == 1) {

                $('input[name="inputPArticleDelete"]').attr('checked', true);

            }

            if (pAboutUsView == 1) {

                $('input[name="inputPAboutUsView"]').attr('checked', true);

            }

            if (pAboutUsEdit == 1) {

                $('input[name="inputPAboutUsEdit"]').attr('checked', true);

            }

            if (pBannerView == 1) {

                $('input[name="inputPBannerView"]').attr('checked', true);

            }

            if (pBannerEdit == 1) {

                $('input[name="inputPBannerEdit"]').attr('checked', true);

            }

            if (pLogActivity == 1) {

                $('input[name="inputPLogActivity"]').attr('checked', true);  

            }

        }

    });  
        
    </script>


<!--
	This is a content
	End of file pass-var.php
	Location: ./application/views/webadmin/user_mg/role/pass-var.php
-->