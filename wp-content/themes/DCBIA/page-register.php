<?php
use INUtils\Entity\PostEntity;
use Committee\Controller\CommitteeController;
use Member\Controller\MemberController;
use Member\Helper\MemberHelper;
$pageEntity = new PostEntity(get_the_ID());
get_header(); ?>
<div class="container all-pad-gone">      
      <nav class="site-navigation" role="navigation">
          <ul class="nav custom-nav hide-on-phone">
              <li id="about" <?php if($url == "about" || $url == "about")
                  echo "class='active'"; ?>><a href="/about">ABOUT</a>
                  <ul class="" id="" role="menu">       
                        <li id="staff"><a href="/about/">STAFF</a></li>
                        <li id="board"><a href="/about/">BOARD</a></li>
                        <li id="committees"><a href="/about/">COMMITTEES</a></li>
                  </ul>
              </li>
              <li id="join"><a href="/join">JOIN</a></li>
              <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
              <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="/sponsors">SPONSORS</a></li>

              <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="/events">EVENTS</a></li>
              <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="/news">NEWS</a></li>
            </ul> 
        </nav>   
    </div>

    <div class="container all-pad-gone register" ng-controller="MembershipController" ng-init="getMembershipLevels()">
        <div class="row">
            <form class="" ng-init="initialize()" ng-hide="isSuccess">
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
                        <select class="form-control" ng-model="member.membership_level" ng-change="setMembershipCost()" required>
                            <option ng-repeat="level in membershipLevels" value="{{level.id}}">{{level.name}}</option>
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
                      <a href="">Already a Member?</a>
                    </div>
                    <div class="form-group">     
                      <label>Referred By</label>
                      <input type="text" class="form-control" placeholder="Referred By" ng-model="member.refered_by">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" placeholder="Email" ng-model="member.email" required>
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
                      <label>Company Name</label>
                      <input type="text" class="form-control" placeholder="Company Name" ng-model="member.company_name">
                    </div>
                    
                    <div class="form-group">
                      <label>Business Category</label>
                      <select ng-model="member.business_category" class="form-control">
                        <?php foreach(MemberHelper::getBusinessCategories() as $category): ?>
                            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php endforeach; ?>
                      </select>
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
                      <input type="number" class="form-control" placeholder="Telephone" ng-model="member.telephone">
                    </div>
                    <div class="form-group">
                      <label><h4>Description for member directory</h4></label>
                      <textarea class="form-control register-form-text-area" ng-model="member.company_description"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Affiliate Listing in Directory</h4>
                    <p>Membership in DCBIA is corporate based and it entitles you to one representative to be listed in the Membership Directory under your company’s listing. Additional representatives from a member firm can be listed as affiliate members for a $75/year charge.</p>
                    <p><b>Enter information for Affiliates to be added * :</b></p>
                    <p>($ 75 per individual)</p>
                </div>
                <div class="col-md-12">
                    <div class="user-container">
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
                        <div class="button2" ng-click="add()">Add Affiliate</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="button3" ng-disabled="usernameTaken" ng-click="register()">Submit Registration Form</button>
                </div>    
            </form>
        </div>
    </div>

<p>&nbsp;</p>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>