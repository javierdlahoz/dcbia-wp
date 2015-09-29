<?php 
use Member\Helper\MemberHelper; 
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