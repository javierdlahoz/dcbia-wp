<?php 
use Member\Helper\MemberHelper; 
use Member\Controller\MemberController;

$accountId = get_user_meta($user->ID, "account_id", true);
$affiliates = array();
if($accountId !== "" && $accountId !== null){
    $affiliates = MemberController::getSingleton()->getUsersByAccountId($accountId);
}
else{
    $otherMembers = get_user_meta($user->ID, "addUsers", true);
    if($otherMembers !== "" && $otherMembers !== null){
        $affiliates = array();
        foreach($otherMembers as $member){
            $affiliates[] = get_user_by("id", $member);
        }
    }
}

$contactId = get_user_meta($user->ID, "contact_id", true);
if($contactId === "" || $contactId === null){
    $contactId = MemberController::getSingleton()->getZohoContactId($user->user_email);
    if($contactId !== null){
        update_user_meta($user->ID, "contact_id", $contactId);
    }
}

if($accountId === "" || $accountId === null){
    $accountId = MemberController::getSingleton()->getZohoAccountId($user->user_email);
    if($accountId !== null){
        update_user_meta($user->ID, "account_id", $accountId);
    }
}

?>
<h3>Business Category</h3>

<table class="form-table">
<tr>
<th><label for="category">Type</label></th>
<td>
<select name="business_category" id="business_category">
    <?php foreach(MemberHelper::getBusinessCategories() as $cat): ?>
        <option value="<?php echo $cat; ?>" <?php
            if($cat == get_the_author_meta('business_category', $user->ID )){
                echo "selected='selected'";
            }
        ?>><?php echo $cat; ?></option>
    <?php endforeach; ?>
</select>
</td>
</tr>
</table>
<br>
<h2>Company Information</h2>
<table class="form-table">
<tr>
<th><label for="company_name">Company</label></th>
<td>
<input type="text" id="company_name" name="company_name" class="regular-text" value="<?php echo get_user_meta($user->ID, "company_name", true); ?>">
</td>
</tr>

<tr>
<th><label for="company_website">Company Website</label></th>
<td>
<input type="text" id="company_website" name="company_website" class="regular-text" value="<?php echo get_user_meta($user->ID, "company_website", true); ?>">
</td>
</tr>

<tr>
<th><label for="company_description">Company Description</label></th>
<td>
<textarea id="company_description" name="company_description" rows="5" cols="30"><?php echo get_user_meta($user->ID, "company_description", true); ?></textarea>
</td>
</tr>

<tr>
<th><label for="address1">Address</label></th>
<td>
<input type="text" id="address1" name="address1" class="regular-text" value="<?php echo get_user_meta($user->ID, "address1", true); ?>">
</td>
</tr>

<tr>
<th><label for="city">City</label></th>
<td>
<input type="text" id="city" name="city" class="regular-text" value="<?php echo get_user_meta($user->ID, "city", true); ?>">
</td>
</tr>

<tr>
<th><label for="state">State</label></th>
<td>
<input type="text" id="state" name="state" class="regular-text" value="<?php echo get_user_meta($user->ID, "state", true); ?>">
</td>
</tr>

<tr>
<th><label for="zip">Zip Code</label></th>
<td>
<input type="text" id="zip" name="zip" class="regular-text" value="<?php echo get_user_meta($user->ID, "zip", true); ?>">
</td>
</tr>

<tr>
<th><label for="telephone">Telephone</label></th>
<td>
<input type="text" id="telephone" name="telephone" class="regular-text" value="<?php echo get_user_meta($user->ID, "telephone", true); ?>">
</td>
</tr>

<tr>
<th><label for="telephone">Zoho Account ID</label></th>
<td>
<?php echo $accountId; ?>
</td>
</tr>

<tr>
<th><label for="telephone">Zoho Contact ID</label></th>
<td>
<?php echo $contactId; ?>
</td>
</tr>

</table>

<?php if(count($affiliates) > 0): ?>

<br>
<h2>Affiliates</h2>
<table class="wp-list-table widefat fixed striped users">
<tr>
	<th>username</th>
	<th>Name</th>
</tr>
<?php foreach($affiliates as $affiliate): ?>
<?php if($affiliate->ID !== $user->ID): ?>
<tr>
	<th><a href="/wp-admin/user-edit.php?user_id=<?php echo $affiliate->ID; ?>"><?php echo $affiliate->user_login; ?></a></th>
	<th><a href="/wp-admin/user-edit.php?user_id=<?php echo $affiliate->ID; ?>"><?php echo $affiliate->first_name." ".$affiliate->last_name; ?></a></th>
</tr>
<?php endif; ?>
<?php endforeach; ?>
</table>
<?php endif; ?>