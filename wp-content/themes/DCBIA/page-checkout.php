<?php 

    global $wpdb, $current_user, $pmpro_msg, $pmpro_msgt, $show_paypal_link;
    global $bfirstname, $blastname, $baddress1, $baddress2, $bcity, $bstate, $bzipcode, $bcountry, $bphone, $bemail, $bconfirmemail, $CardType, $AccountNumber, $ExpirationMonth, $ExpirationYear;

    if($current_user->ID == 0){
        header('Location: '. "/register");
    }

    use Member\Controller\MemberController;
    get_header(); 
    
	
	$level = MemberController::getSingleton()->getStoredMembershipLevel($current_user->ID);
    $current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
    if(!$current_user->membership_level){
        $current_user->membership_level = new stdClass();
        $current_user->membership_level = $level;
    }
    $current_user->membership_level->billing_amount = get_user_meta($current_user->ID, MemberController::MEMBERSHIP_TOTAL_COST, true);

        


	/**
	 * Filter to set if PMPro uses email or text as the type for email field inputs.
	 * 
	 * @since 1.8.4.5
	 *
	 * @param bool $use_email_type, true to use email type, false to use text type
	 */
	$pmpro_email_field_type = apply_filters('pmpro_email_field_type', true);

	//set to true via filter to have Stripe use the minimal billing fields
	$pmpro_stripe_lite = apply_filters("pmpro_stripe_lite", !pmpro_getOption("stripe_billingaddress")); //default is oposite of the stripe_billingaddress setting

	//$level = $current_user->membership_level;
	//var_dump($level->billing_amount); die();
    ?>
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


<div class="container all-pad-gone checkedout">
    <div class="row">
    <form ng-controller="MembershipController" id="pmpro_form" class="pmpro_form" ng-submit="charge()">
    <div class="col-md-12">
        <h2 style="margin-bottom:0;">Checkout</h2>
        <?php if($level)
        {
            $level->billing_amount = (float) $level->initial_payment;
        ?>
            <ul>
                <li><strong><?php _e("Level", "pmpro");?>:</strong> <?php echo $level->name?></li>
            <?php if($level->billing_amount > 0) { ?>
                <li><strong><?php _e("Membership Fee", "pmpro");?>:</strong>
                    <?php
                        //$level = $current_user->membership_level;
                        if($current_user->membership_level->cycle_number > 1) {
                            printf(__('%s every %d %s.', 'pmpro'), pmpro_formatPrice($level->billing_amount), $level->cycle_number, pmpro_translate_billing_period($level->cycle_period, $level->cycle_number));
                        } elseif($current_user->membership_level->cycle_number == 1) {
                            printf(__('%s per %s.', 'pmpro'), pmpro_formatPrice($level->billing_amount), pmpro_translate_billing_period($level->cycle_period));
                        } else {
                            echo pmpro_formatPrice($current_user->membership_level->billing_amount);
                        }
                    ?>
                </li>
            <?php } ?>

            <?php if($level->billing_limit) { ?>
                <li><strong><?php _e("Duration", "pmpro");?>:</strong> <?php echo $level->billing_limit.' '.sornot($level->cycle_period,$level->billing_limit)?></li>
            <?php } ?>
            </ul>
        <?php
        }
    ?>
    
        <?php if($show_paypal_link) { ?>

            <p><?php  _e('Your payment subscription is managed by PayPal. Please <a href="http://www.paypal.com">login to PayPal here</a> to update your billing information.', 'pmpro');?></p>

        <?php } else { ?>
                <div class="alert alert-danger" ng-show="billing.status == false">Please check your credit card information</div>
                <div class="alert alert-success" ng-show="billing.status == true">Payment successful, redirecting to home in 5s</div>

    <input type="hidden" ng-model="billing.level" name="level" value="<?php echo esc_attr($level->id);?>" />
    <?php if($pmpro_msg)
        {
    ?>
        <div class="pmpro_message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
    <?php
        }
    ?>

    <?php if(empty($pmpro_stripe_lite) || $gateway != "stripe") { ?>
                <div id="pmpro_billing_address_fields" class="pmpro_checkout" width="100%" cellpadding="0" cellspacing="0" border="0">
    </div>                
</div>                
	<div class="col-md-12">		
        <h3 style="margin-top: 0;"><?php _e('Billing Address', 'pmpro');?></h3>
	</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="bfirstname"><?php _e('First Name', 'pmpro');?></label>
            <input ng-model="billing.first_name" id="bfirstname" name="bfirstname" type="text" class="form-control" value="<?php echo esc_attr($bfirstname);?>" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="blastname"><?php _e('Last Name', 'pmpro');?></label>
            <input ng-model="billing.last_name" id="blastname" name="blastname" type="text" class="form-control" value="<?php echo esc_attr($blastname);?>" />
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="baddress1"><?php _e('Address 1', 'pmpro');?></label>
            <input ng-model="billing.address1" id="baddress1" name="baddress1" type="text" class="form-control" value="<?php echo esc_attr($baddress1);?>" />
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="baddress2"><?php _e('Address 2', 'pmpro');?></label>
            <input ng-model="billing.address2" id="baddress2" name="baddress2" type="text" class="form-control" value="<?php echo esc_attr($baddress2);?>" /> <small class="lite">(<?php _e('optional', 'pmpro');?>)</small>
        </div>
    </div>

        <?php
            $longform_address = apply_filters("pmpro_longform_address", false);
            if($longform_address)
            {
            ?>
    
            
    <div class="col-md-4">
        <div class="form-group">
            <label for="bcity"><?php _e('City', 'pmpro');?>City</label>
            <input ng-model="billing.city" id="bcity" name="bcity" type="text" class="form-control" value="<?php echo esc_attr($bcity)?>" />
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="bstate"><?php _e('State', 'pmpro');?>State</label>
            <input ng-model="billing.state" id="bstate" name="bstate" type="text" class="form-control" value="<?php echo esc_attr($bstate)?>" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="bzipcode"><?php _e('Postal Code', 'pmpro');?></label>
            <input ng-model="billing.zip" id="bzipcode" name="bzipcode" type="text" class="form-control" value="<?php echo esc_attr($bzipcode)?>" />
        </div>
    </div>
    
        <?php } else { ?>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="bcity"><?php _e('City');?></label>
            <input ng-model="billing.city" id="bcity" name="bcity" type="text" class="form-control" size="30" value="<?php echo esc_attr($bcity)?>" />
        </div>    
    </div> 
 
        <?php
            $state_dropdowns = apply_filters("pmpro_state_dropdowns", false);
            if($state_dropdowns === true || $state_dropdowns == "names")
            {
                global $pmpro_states;
            ?>
            <select class="new-select-checkout" name="bstate" ng-model="billing.state">
                <option value="">--</option>
                <?php
                    foreach($pmpro_states as $ab => $st)
                    {
                ?>
                    <option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo $st;?></option>
                <?php } ?>
            </select>
            <?php
            }
            elseif($state_dropdowns == "abbreviations")
            {
                global $pmpro_states_abbreviations;
            ?>
                <select class="new-select-checkout" name="bstate" ng-model="billing.state">
                    <option value="">--</option>
                    <?php
                        foreach($pmpro_states_abbreviations as $ab)
                        {
                    ?>
                        <option value="<?php echo esc_attr($ab);?>" <?php if($ab == $bstate) { ?>selected="selected"<?php } ?>><?php echo $ab;?></option>
                    <?php } ?>
                </select>
            <?php
            }
            else
            {
            ?>
 
        <div class="col-md-4">
            <div class="form-group">
                <label for="bstate"><?php _e('State');?></label>
                <input ng-model="billing.state" id="bstate" name="bstate" type="text" class="form-control"  value="<?php echo esc_attr($bstate)?>" />
                <?php
                }
            ?>
            </div>    
        </div>
        <div class="col-md-4">
        <div class="form-group">
        <label for="bzip"><?php _e('Zip');?></label>    
        <input ng-model="billing.zip" id="bzipcode" name="bzipcode" type="text" class="form-control" value="<?php echo esc_attr($bzipcode)?>" />  
        </div>
    </div>
        <?php } ?>

            <?php
                $show_country = apply_filters("pmpro_international_addresses", false);
                if($show_country)
                {
            ?>
    
        <div class="col-md-4">
                <div class="form-group">
                    <label for="bcountry"><?php _e('Country', 'pmpro');?></label>
                    <select class="form-control new-select-checkout" name="bcountry" ng-model="billing.country">
                        <?php
                            global $pmpro_countries, $pmpro_default_country;
                            foreach($pmpro_countries as $abbr => $country)
                            {
                                if(!$bcountry)
                                    $bcountry = $pmpro_default_country;
                            ?>
                            <option value="<?php echo $abbr?>" <?php if($abbr == $bcountry) { ?>selected="selected"<?php } ?>><?php echo $country?></option>
                            <?php
                            }
                        ?>
                    </select>
				</div>
        </div>
            <?php
                }
                else
                {
                ?>
                    <input type="hidden" ng-model="billing.country" id="bcountry" name="bcountry" value="US" />
                <?php
                }
            ?>
    
        <div class="col-md-4">
            <div class="form-group">
                <label for="bphone"><?php _e('Phone', 'pmpro');?></label>
                <input ng-model="billing.phone" id="bphone" name="bphone" type="text" class="form-control" value="<?php echo esc_attr($bphone)?>" />
            </div>
        </div>
    
            <?php if($current_user->ID) { ?>
            <?php
                if(!$bemail && $current_user->user_email)
                    $bemail = $current_user->user_email;
                if(!$bconfirmemail && $current_user->user_email)
                    $bconfirmemail = $current_user->user_email;
            ?>
    
    <div class="col-md-4">
            <div class="form-group">
							<label for="bemail"><?php _e('E-mail Address', 'pmpro');?></label>
							<input ng-model="billing.email" id="bemail" name="bemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="form-control" value="<?php echo esc_attr($bemail)?>" />
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="form-group">
                <label for="bconfirmemail"><?php _e('Confirm E-mail', 'pmpro');?></label>
                <input id="bconfirmemail" name="bconfirmemail" type="<?php echo ($pmpro_email_field_type ? 'email' : 'text'); ?>" class="form-control" value="<?php echo esc_attr($bconfirmemail)?>" />

            </div>
        </div>
    
        
				<?php } ?>  
			<?php } ?>

			<?php
				$pmpro_accepted_credit_cards = pmpro_getOption("accepted_credit_cards");
				$pmpro_accepted_credit_cards = explode(",", $pmpro_accepted_credit_cards);
				$pmpro_accepted_credit_cards_string = pmpro_implodeToEnglish($pmpro_accepted_credit_cards);
			?>
     
    <div id="pmpro_payment_information_fields" class="pmpro_checkout top1em">
          <div class="col-md-12">
            <h3><?php _e('Credit Card Information', 'pmpro');?></h3>  
            <h4><span class=""><?php printf(__('We accept %s', 'pmpro'), $pmpro_accepted_credit_cards_string);?></span></h4>
            <?php
                $sslseal = pmpro_getOption("sslseal");
                if($sslseal)
                {
                ?>
                    <div class="pmpro_sslseal"><?php echo stripslashes($sslseal)?></div>
                <?php
                }
            ?>
            <?php if(empty($pmpro_stripe_lite) || $gateway != "stripe") { ?>
              <br>
        </div>
                
            <div class="col-md-6">
                <div class="form-group">
                <label for="CardType"><?php _e('Card Type', 'pmpro');?></label>
                <select class="form-control new-select-checkout" ng-model="billing.card_type" id="CardType" <?php if($gateway != "stripe") { ?>name="CardType"<?php } ?>>
                    <?php foreach($pmpro_accepted_credit_cards as $cc) { ?>
                        <option value="<?php echo $cc?>" <?php if($CardType == $cc) { ?>selected="selected"<?php } ?>><?php echo $cc?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
                <?php } ?>

            <div class="col-md-6">
                <div class="form-group">
                <label for="AccountNumber"><?php _e('Card Number', 'pmpro');?></label>
                <input ng-model="billing.account_number" id="AccountNumber" <?php if($gateway != "stripe" && $gateway != "braintree") { ?>name="AccountNumber"<?php } ?> class="form-control <?php echo pmpro_getClassForField("AccountNumber");?>" type="text" value="<?php echo esc_attr($AccountNumber)?>" <?php if($gateway == "braintree") { ?>data-encrypted-name="number"<?php } ?> autocomplete="off" />
            </div>
            </div>

        <div class="col-md-4">
            <label for="ExpirationMonth"><?php _e('Expiration Date', 'pmpro');?></label>
            <select class="form-control new-select-checkout" ng-model="billing.expiration_month" id="ExpirationMonth" <?php if($gateway != "stripe") { ?>name="ExpirationMonth"<?php } ?>>
                <option value="01" <?php if($ExpirationMonth == "01") { ?>selected="selected"<?php } ?>>01</option>
                <option value="02" <?php if($ExpirationMonth == "02") { ?>selected="selected"<?php } ?>>02</option>
                <option value="03" <?php if($ExpirationMonth == "03") { ?>selected="selected"<?php } ?>>03</option>
                <option value="04" <?php if($ExpirationMonth == "04") { ?>selected="selected"<?php } ?>>04</option>
                <option value="05" <?php if($ExpirationMonth == "05") { ?>selected="selected"<?php } ?>>05</option>
                <option value="06" <?php if($ExpirationMonth == "06") { ?>selected="selected"<?php } ?>>06</option>
                <option value="07" <?php if($ExpirationMonth == "07") { ?>selected="selected"<?php } ?>>07</option>
                <option value="08" <?php if($ExpirationMonth == "08") { ?>selected="selected"<?php } ?>>08</option>
                <option value="09" <?php if($ExpirationMonth == "09") { ?>selected="selected"<?php } ?>>09</option>
                <option value="10" <?php if($ExpirationMonth == "10") { ?>selected="selected"<?php } ?>>10</option>
                <option value="11" <?php if($ExpirationMonth == "11") { ?>selected="selected"<?php } ?>>11</option>
                <option value="12" <?php if($ExpirationMonth == "12") { ?>selected="selected"<?php } ?>>12</option>
            </select>
                </div>
            <div class="col-md-4">
                <label for="ExpirationYear"><?php _e('Expiration Year', 'pmpro');?></label>
                <select ng-model="billing.expiration_year" id="ExpirationYear" class="form-control new-select-checkout" <?php if($gateway != "stripe") { ?>name="ExpirationYear"<?php } ?>>
                    <?php
                        for($i = date("Y"); $i < date("Y") + 10; $i++)
                        {
                    ?>
                    <option value="<?php echo $i?>" <?php if($ExpirationYear == $i) { ?>selected="selected"<?php } ?>><?php echo $i?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>

            <?php
                $pmpro_show_cvv = apply_filters("pmpro_show_cvv", true);
                if($pmpro_show_cvv)
                {
            ?>
                
            <div class="col-md-4">
                <label for="CVV"><?php _ex('CVV', 'Credit card security code, CVV/CCV/CVV2', 'pmpro');?></label>
                <input class="form-control" ng-model="billing.cvv" id="CVV" <?php if($gateway != "stripe" && $gateway != "braintree") { ?>name="CVV"<?php } ?> type="text" value="<?php if(!empty($_REQUEST['CVV'])) { echo esc_attr($_REQUEST['CVV']); }?>" class=" <?php echo pmpro_getClassForField("CVV");?>" <?php if($gateway == "braintree") { ?>data-encrypted-name="cvv"<?php } ?> />  <small>(<a href="javascript:void(0);" onclick="javascript:window.open('<?php echo pmpro_https_filter(PMPRO_URL)?>/pages/popup-cvv.html','cvv','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=475');"><?php _ex("what's this?", 'link to CVV help', 'pmpro');?></a>)</small>
            </div>
            <?php
                }
            ?>
        </div>

			<?php if($gateway == "braintree") { ?>
				<input type='hidden' data-encrypted-name='expiration_date' id='credit_card_exp' />
				<input type='hidden' name='AccountNumber' id='BraintreeAccountNumber' />
				<script type="text/javascript" src="https://js.braintreegateway.com/v1/braintree.js"></script>
				<script type="text/javascript">
					//setup braintree encryption
					var braintree = Braintree.create('<?php echo pmpro_getOption("braintree_encryptionkey"); ?>');
					braintree.onSubmitEncryptForm('pmpro_form');

					//pass expiration dates in original format
					function pmpro_updateBraintreeCardExp()
					{
						jQuery('#credit_card_exp').val(jQuery('#ExpirationMonth').val() + "/" + jQuery('#ExpirationYear').val());
					}
					jQuery('#ExpirationMonth, #ExpirationYear').change(function() {
						pmpro_updateBraintreeCardExp();
					});
					pmpro_updateBraintreeCardExp();

					//pass last 4 of credit card
					function pmpro_updateBraintreeAccountNumber()
					{
						jQuery('#BraintreeAccountNumber').val('XXXXXXXXXXXXX' + jQuery('#AccountNumber').val().substr(jQuery('#AccountNumber').val().length - 4));
					}
					jQuery('#AccountNumber').change(function() {
						pmpro_updateBraintreeAccountNumber();
					});
					pmpro_updateBraintreeAccountNumber();
				</script>
			<?php } ?>
            <div class="col-md-12">
                <div ng-hide="billing.status">
                    <input type="hidden" name="update-billing" value="1" />
                    <input type="submit" class="button2" value="<?php _e('Update', 'pmpro');?>" />
                    <input type="button" name="cancel" class="button2" value="<?php _e('Cancel', 'pmpro');?>" onclick="location.href='<?php echo pmpro_url("account")?>';" />
                </div>
			</div>
	<?php } ?>
        </form> 
    </div>
</div>    

<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MembershipController.js"></script>