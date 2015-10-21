<?php
use INUtils\Entity\PostEntity;
use Committee\Controller\CommitteeController;
use Member\Helper\MemberHelper;

if(wp_get_current_user()->ID != 0 && wp_get_current_user()->membership_level->name != "unpaid"){
    header("Location: /editme");
}

$pageEntity = new PostEntity(get_the_ID());
get_header(); ?>
<div class="container all-pad-gone">      
    <?php echo getTopMenu(); ?> 
</div>

    <div class="container all-pad-gone register" ng-controller="MembershipController" ng-init="getMembershipLevels(); getCurrentUser()" ng-cloak>
        <div class="row">
            <form class="" ng-init="initialize()" ng-hide="isSuccess" ng-submit="register()">
                <div class="col-md-12">
                    <div class="form-group">
                        <h2><?php echo $pageEntity->getTitle(); ?></h2>
                    </div>
                    <div class="form-group">
                        <h3>Create your account</h3>
                    </div>
                    <div ng-show="isSuccess">
                        <div class="alert alert-success">The membership was created successfully</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Membership Level</label>
                        <select class="form-control new-select-checkout" ng-model="member.membership_level" ng-change="setMembershipCost()" required>
                            <option ng-repeat="level in membershipLevels" value="{{level.id}}"
                                ng-if="level.name != 'unpaid' && level.name != 'DLD'">{{level.name}}</option>
                        </select>
                        <p ng-show="membershipCost != null">This will cost you: ${{membershipCost}} US</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" placeholder="First name" ng-model="member.first_name" required>
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" placeholder="Last name" ng-model="member.last_name" required>
                    </div>
                    <div class="form-group">     
                      <a href="/login">Already a Member?</a>
                    </div>
                    <div class="form-group">     
                      <label>Referred By</label>
                      <input type="text" class="form-control" placeholder="Referred By" ng-model="member.refered_by">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="Email" ng-model="member.email" required ng-change="isUsernameTaken()">
                      <div class="alert alert-danger" ng-show="usernameTaken">This email belongs to a member</div>
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password" ng-model="member.password" required>
                    </div>
                    <div class="form-group">
                      <p>&nbsp;</p>
                    </div>
                     <div class="form-group">
                      <p>&nbsp;</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h3>Organization Details</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Business Category</label>
                      <select ng-model="member.business_category" class="form-control new-select-checkout">
                        <?php foreach(MemberHelper::getBusinessCategories() as $category): ?>
                            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    
                    <div class="form-group" ng-show="member.business_category == 'Other'">
                      <label>Business Category</label>
                      <input type="text" class="form-control" placeholder="Business Category" ng-model="member.business_category2">
                    </div>
                    
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" class="form-control" placeholder="Company Name" ng-model="member.company_name" required>
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
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City" ng-model="member.city" 
                        g-places-autocomplete ng-change="setCity()">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label>State</label>
                      <input type="text" class="form-control" placeholder="State" ng-model="member.state">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label>ZIP</label>
                      <input type="number" class="form-control" placeholder="ZIP" ng-model="member.zip">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label>Company Website</label>
                      <input type="url" class="form-control" placeholder="Company Website" ng-model="member.company_website">
                    </div>
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" class="form-control" placeholder="Telephone" ng-model="member.telephone">
                    </div>
                    <div class="form-group">
                      <label><h4>Description for member directory</h4></label>
                      <textarea class="form-control register-form-text-area" ng-model="member.company_description" maxlength="150"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="user-container">
                        <div ng-repeat="user in users">
                            <div class="form-group">
                                <h4>Affiliate Listing in Directory</h4>
                                <p>Membership in DCBIA is corporate based and it entitles you to one representative to be listed in the Membership Directory under your company’s listing. Additional representatives from a member firm can be listed as affiliate members for a $75/year charge.</p>
                                <p><b>Enter information for Affiliates to be added * :</b></p>
                                <p>$75 per affilate:</p>
                            </div>    
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
                                <input type="email" class="form-control" placeholder="E-Mail" ng-model="user.email" ng-change="checkEmailForAffiliates($index)">
                                <div class="alert alert-danger" ng-show="user.isTaken">This email belongs to a member</div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" ng-model="user.password">
                            </div>
                            <div class="form-group">
                                <label>Committee</label>
                                <select class="form-control new-select-checkout" ng-model="user.committee">
                                <?php foreach (CommitteeController::getSingleton()->getCommitteeTerms() as $committee): ?>
                                    <option value="<?php echo $committee->getTermId(); ?>"><?php echo $committee->getName(); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="btn btn-danger" ng-click="remove(user.id)">Remove Affiliate</div>
                        </div>
                        <div class="alert alert-success" ng-show="isPacAdded">A $25 PAC HAS BEEN ADDED</div>
                        <div class="button2" ng-click="add()">Add Affiliate</div>
                        <div class="button2" ng-click="addPac()">
                            <span ng-hide="isPacAdded">ADD 25$ Political Action Committee</span>
                            <span ng-show="isPacAdded">REMOVE 25$ Political Action Committee</span>
                        </div>
                        <div class="button3 total-but">your total: ${{totalCost}}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="button3" type="submit" ng-disabled="disabledToSend">Submit Registration Form</button>
                </div>    
            </form>
        </div> 
    </div>

<p>&nbsp;</p>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>