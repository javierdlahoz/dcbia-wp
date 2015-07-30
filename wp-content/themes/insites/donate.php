<?php
use INUtils\Entity\PostEntity;
/*
  Template Name: donate
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$donatePage = new PostEntity(get_the_ID());

get_header(); ?>
<div ng-app="angular-wp" ng-controller="EmailController">
    <!--start main content here-->

  <p>&nbsp;</p>
    <!--sidebar-->
    <div class="container">
        <div class="row">
                <?php getContactSidebar(); ?>

                <!--main content-->

            <div class="col-md-8 col-sm-offset-1 resource-main" ng-show="successfull === undefined">
                    <h3 class=""><?php echo $donatePage->getTitle(); ?></h3>
                    <br><br>
                    <p><?php echo $donatePage->getContent(); ?></p>
                <br>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="PVE6X6SCSFZ92">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
                <br>    
            </div>
        </div>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>

    <!-- Modal -->
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog email-modal">
    <div class="modal-content inside-modal">
        <button type="button" class="close-x" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Share This Page</h4>
            <div class="form-group form-override">
            <label for="">Email To: </label>
            <input type="email" class="form-control" id="5543ab44ed189_send_to" name="to" placeholder="Email Here" required="">
            <input type="hidden" id="5543ab44ed189_send_from" name="from" value="none">

            <input type="hidden" class="form-control" id="5543ab44ed189_subject" name="subject" value="toolkits">
            <input type="hidden" class="form-control" id="5543ab44ed189_url" name="url" value="http://sciencefestivals.com/toolkits/">

            <input type="hidden" class="form-control" id="5543ab44ed189_content" name="content" value="none">
            </div>
        <div type="button" class="large-btn pull-left btn-modal" onclick="sendEmail_5543ab44ed189();">SUBMIT</div>
          <div id="" style="display:none; padding: 0px 0px 15px 15px;">
            <h2>The email was sent successfully</h2>
          </div>
    </div>
  </div>
</div>-->

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/angular.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/app.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/services/EmailService.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/EmailController.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/paypal.js"></script>
<?php get_footer();
