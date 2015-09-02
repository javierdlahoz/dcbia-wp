<?php
use INUtils\Entity\PostEntity;
use Committee\Controller\CommitteeController;
use Member\Controller\MemberController;
$pageEntity = new PostEntity(get_the_ID());
get_header(); ?>
<p>&nbsp;</p>
<div class="container inside-pages">
   <p>&nbsp;</p>
    <div class="container inside-pages" ng-controller="MembershipController">
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo $pageEntity->getTitle(); ?></h3>
                <h4>Your registration has expired, now you need to renew your account in order to access to our content</h4>
                    
                <h2>Affiliate Listing in Directory</h2>
                <p>Membership in DCBIA is corporate based and it entitles you to one representative to be listed in the Membership 
                Directory under your company’s listing. Additional representatives from a member firm can be listed as 
                affiliate members for a $75/year charge.</p>
                <p><b>Enter information for Affiliates to be added * :</b></p>
                <p>($ 75 per individual)</p>
                <div class="user-container" ng-init="getAdditionalUsers()">
                    <div class="form-horizontal">
                        <div ng-repeat="user in users">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" placeholder="First name" ng-model="user.first_name">
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" placeholder="Last name" ng-model="user.last_name">
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" class="form-control" placeholder="E-Mail" ng-model="user.email">
                            </div>
                            <div class="form-group">
                                <label>Committee</label>
                                <select class="form-control" ng-model="user.committee">
                                <?php foreach (CommitteeController::getSingleton()->getCommitteeTerms() as $committee): ?>
                                    <option value="<?php echo $committee->getTermId(); ?>"><?php echo $committee->getName(); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="btn btn-danger" ng-click="remove(user.id)">Remove Affiliate</div>
                        </div>
                        <div class="btn btn-primary" ng-click="add()">Add Affiliate</div>
                    </div>
                </div>
                <br>
                <button class="btn btn-success" ng-disabled="usernameTaken" ng-click="setAdditionalUsers()">Renew</button>
                
                <br>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>