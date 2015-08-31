<?php
use INUtils\Entity\PostEntity;
use Committee\Controller\CommitteeController;
use Member\Controller\MemberController;
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
                <h3><?php echo $pageEntity->getTitle(); ?></h3>
                
                <div ng-show="isSuccess">
                    <div class="alert alert-success">The membership was created successfully</div>
                </div>
                
                <form class="form-horizontal" ng-init="initialize()" ng-hide="isSuccess">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" placeholder="First name" ng-model="member.first_name" required>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" placeholder="Last name" ng-model="member.last_name" required>
                    </div>
                    
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="Email" ng-model="member.email" required>
                    </div>
                   
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" ng-model="member.password" required>
                    </div>
                    
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" placeholder="Address" ng-model="member.address1">
                    </div>
                    <div class="form-group">
                      <label>Address2</label>
                      <input type="text" class="form-control" placeholder="Address2" ng-model="member.address2">
                    </div>
                    <div class="form-group">
                      <label>Address3</label>
                      <input type="text" class="form-control" placeholder="Address3" ng-model="member.address3">
                    </div>
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City" ng-model="member.city" 
                        g-places-autocomplete ng-change="setCity()">
                    </div>
                    <div class="form-group">
                      <label>State</label>
                      <input type="text" class="form-control" placeholder="State" ng-model="member.state">
                    </div>
                    <div class="form-group">
                      <label>ZIP</label>
                      <input type="number" class="form-control" placeholder="ZIP" ng-model="member.zip">
                    </div>
                    <div class="form-group">
                      <label>Telephone</label>
                      <input type="number" class="form-control" placeholder="Telephone" ng-model="member.telephone">
                    </div>
                    <div class="form-group">
                      <label>Referred By</label>
                      <input type="text" class="form-control" placeholder="Referred By" ng-model="member.refered_by">
                    </div>
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" class="form-control" placeholder="Company Name" ng-model="member.company_name">
                    </div>
                    <div class="form-group">
                      <label>Company Website</label>
                      <input type="url" class="form-control" placeholder="Company Website" ng-model="member.company_website">
                    </div>
                    <div class="form-group">
                      <label>Company Description</label>
                      <textarea class="form-control" ng-model="member.company_description"></textarea>
                    </div>
                    
                    <h2>Affiliate Listing in Directory</h2>
                    <p>Membership in DCBIA is corporate based and it entitles you to one representative to be listed in the Membership 
                    Directory under your company’s listing. Additional representatives from a member firm can be listed as 
                    affiliate members for a $75/year charge.</p>
                    <p><b>Enter information for Affiliates to be added * :</b></p>
                    <p>($ 75 per individual)</p>
                    <div class="user-container">
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
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" ng-model="user.password">
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
                    <button class="btn btn-success" ng-disabled="usernameTaken" ng-click="register()">Send</button>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>