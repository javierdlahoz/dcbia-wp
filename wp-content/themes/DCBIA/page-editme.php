<?php
get_header(); ?>
<div class="container all-pad-gone">
    <?php echo getTopMenu(); ?>
</div>
<p>&nbsp;</p>
<div class="container all-pad-gone" id="MembershipController" ng-controller="MembershipController" ng-init="getCurrentUser()">
    <div class="row" ng-hide="loadingUser">
        <div class="col-md-12">
    	    <h2>Edit my profile</h2>
		    <h3>Address Information</h3>
        </div>
        <div class="col-md-12">
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
              <input type="text" class="form-control" placeholder="City" ng-model="member.city">
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
              <label>Phone</label>
              <input type="text" class="form-control" placeholder="Telephone" ng-model="member.telephone">
            </div>
        </div>
    </div>
    <div class="row" ng-show="loadingUser">
    	<div class="col-md-12">
        	<div class="alert alert-info">
        		Please wait
        	</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Profile Information</h3>
            <?php echo do_shortcode("[wppb-edit-profile]"); ?>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>
<script type="text/javascript">
	angular.element(document).ready(function(){
		angular.element("#edit_profile").click(function(){
			angular.element(angular.element('#MembershipController')).scope().updateUser();
		});
	});
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>