<?php
use INUtils\Helper\AdminPanelHelper;
/*
  Template Name: contact
*/
get_header(); ?>
<div class="container all-pad-gone">
    <?php echo getTopMenu(); ?>
</div>
<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12">
            <h2>Contact</h2>
            <br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3105.003818272561!2d-77.017944!3d38.901028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b7b7946b379afd%3A0xe85a9d9a21f3a1b0!2s455+Massachusetts+Avenue%2C+Washington%2C+DC+20001!5e0!3m2!1sen!2sus!4v1442085046430" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>    
    </div>    
</div>
<p>&nbsp;</p>
<div class="container all-pad-gone">
    <div class="row" ng-controller="EmailController">
        <div class="col-sm-6" id="contact-form" ng-hide="successfull">
            <h4>Contact DCBIA</h4>
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" ng-model="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="from" id="from" ng-model="from" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="content" cols="30" rows="10" style="resize:none; width:100%;" ng-model="content" id="content" required></textarea>
            </div>
            <input type="hidden" name="send_email">
            <input type="hidden" name="to" id="to" ng-model="to" value="<?php echo AdminPanelHelper::getSingleton()->getOption("admin_email"); ?>">
            <input class="button2" type="submit" name="submit" value="Send" ng-click="sendContactEmail()">
        </div>
        <div class="col-sm-6" id="contact-form-sent" ng-show="successfull">
            <h3>Your email was sent successfully</h3>
        </div>
        <div class="col-sm-6">
        	<h4>Info</h4>
                <p>Telephone: (202) 966-8665</p> 
            <p><a href="mailto:info@dcbia.org">info@dcbia.org</a></p>
            <p>District of Columbia Building Industry Association<br>
                455 Massachusetts Avenue, NW, Suite 400<br> 
                Washington, D.C. 20001</p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/EmailController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/EmailService.js"></script>