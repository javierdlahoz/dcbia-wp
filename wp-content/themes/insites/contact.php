<?php

use INUtils\Entity\PostEntity;
/*
  Template Name: contact
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$pageEntity =  new PostEntity(get_the_ID());
get_header(); ?>
<div ng-app="angular-wp" ng-controller="EmailController">
    <!--start main content here-->

    <p>&nbsp;</p>
    <!--sidebar-->
    <div class="container">
        <div class="row">

            <?php getContactSidebar(); ?>
            
            <!--main content-->

            <div class="col-sm-8 col-sm-offset-1 resource-main" ng-show="successfull === undefined">
                <h3>Contact Us</h3>
                <p><?php echo $pageEntity->getContent(); ?></p>
                <br><br>
                <div id="contact-form">
                    <div class="form-group">
                        <label class="hidden" for="name">Name</label>
                        <input class="form-control" ng-model="name" type="text" name="name" id="name" placeholder="Name*">
                    </div>
                    <div class="form-group">
                        <label class="hidden" for="from">From</label>
                        <input class="form-control" ng-model="from" type="email" name="from" id="from" placeholder="Email*">
                    </div>
                    <div class="form-group">
                        <label class="hidden" for="subject">Subject</label>
                        <input class="form-control" ng-model="content" type="subject" name="subject" id="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label class="hidden" for="content">Content</label>
                        <textarea name="content" cols="30" rows="12" style="resize:none; width:100%;" id="content" placeholder="Message*"></textarea>
                    </div>
                    <label class="hidden" for="to">Submit</label>
                    <input type="hidden" ng-model="to" name="to" id="to" value="<?php echo get_option('admin_email'); ?>">
                    <input class="contact-btn" type="submit" name="submit" value="Send" ng-click="sendContactEmail()">
                </div>
            </div>

            <div class="col-md-8 resource-main" ng-show="successfull === true">
                <div class="alert alert-success">Your message was sent</div>
            </div>

            <div class="col-md-8 resource-main" ng-show="successfull === false">
                <div class="alert alert-danger">Your message couldn't be sent, please try again later</div>
            </div>

        </div>
    </div>
    <p>&nbsp;</p>
</div>
<?php get_footer();
