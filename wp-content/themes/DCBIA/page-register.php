<?php
use INUtils\Entity\PostEntity;
use Committee\Controller\CommitteeController;
$pageEntity = new PostEntity(get_the_ID());
get_header(); ?>
<p>&nbsp;</p>
<div class="container inside-pages">
    <div class="breadcrumbs-box">
        <a href="/">Home</a><span>></span><a href="/about/">About</a><span>></span>
        <a href="/<?php echo $pageEntity->getName(); ?>"><?php echo $pageEntity->getTitle(); ?></a>
    </div>
   <p>&nbsp;</p>
    <div class="container inside-pages" ng-controller="MembershipController">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <input type="text" name="query">
                    <input type="submit" value="Search">
                    <input type="hidden" name="action-type" value="search">
                    <input type="hidden" name="resource-types[]" id="resource-types[]" value="Evaluation Reports">
                </form>

                <h3><?php echo $pageEntity->getTitle(); ?></h3>
                <?php 
                    echo do_shortcode('[pmpro_signup level="3" short="1" title="Sign Up for Gold Membership" intro="0" button="Signup Now"]'); 
                ?>
                <div ng-init="initialize()">
                    <h2>Affiliate Listing in Directory</h2>
                    <p>Membership in DCBIA is corporate based and it entitles you to one representative to be listed in the Membership Directory under your company’s listing. Additional representatives from a member firm can be listed as affiliate members for a $75/year charge.</p>
                    <p><b>Enter information for Affiliates to be added * :</b></p>
                    <p>($ 75 per individual)</p>
                    <div class="user-container">
                        <div class="input-group" ng-repeat="user in users">
                              <input type="text" class="form-control" placeholder="First name" ng-model="user.fname">
                              <input type="text" class="form-control" placeholder="Last name" ng-model="user.lname">
                              <input type="email" class="form-control" placeholder="E-Mail" ng-model="user.email">
                              <select class="form-control" ng-model="user.committee">
                                <?php foreach (CommitteeController::getSingleton()->getCommitteeTerms() as $committee): ?>
                                    <option value="<?php echo $committee->getTermId(); ?>"><?php echo $committee->getName(); ?></option>
                                <?php endforeach; ?>
                              </select>
                              <button class="btn btn-danger" ng-click="remove(user.id)" ng-show="$index > 0">Remove Affiliate</button>
                        </div>
                        <button class="btn btn-primary" ng-click="add()">Add Affiliate</button>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>