<?php
/* Image Block */
if(!class_exists('ICY_Donate_Block')) {
	class ICY_Donate_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Donate',
				'size' => 'span3',
			);
			
			//create the widget
			parent::__construct('ICY_Donate_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'first_line' => 'We finish together.',
				'second' => 'Donate',
				'email' => 'example@example.com',
				'predefined_amount' => '10 25 50 100 250 500 1000',	
				'currency_sign' => '$',
				'currency_code' => 'USD',
				'donation_image' => '',
				'server_type' => 'sandbox',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$currency_codes = array(
		        'AUD' => 'Australian Dollars (A $)',
		        'CAD' => 'Canadian Dollars (C $)',
		        'EUR' => 'Euros (&euro;)',
		        'GBP' => 'Pounds Sterling (&pound;)',
		        'JPY' => 'Yen (&yen;)',
		        'USD' => 'U.S. Dollars ($)',
		        'NZD' => 'New Zealand Dollar ($)',
		        'CHF' => 'Swiss Franc',
		        'HKD' => 'Hong Kong Dollar ($)',
		        'SGD' => 'Singapore Dollar ($)',
		        'SEK' => 'Swedish Krona',
		        'DKK' => 'Danish Krone',
		        'PLN' => 'Polish Zloty',
		        'NOK' => 'Norwegian Krone',
		        'HUF' => 'Hungarian Forint',
		        'CZK' => 'Czech Koruna',
		        'ILS' => 'Israeli Shekel',
		        'MXN' => 'Mexican Peso',
		        'BRL' => 'Brazilian Real',
		        'TWD' => 'Taiwan New Dollar',
		        'PHP' => 'Philippine Peso',
		        'TRY' => 'Turkish Lira',
		        'THB' => 'Thai Baht'
		    );

			$server_type_options = array(
				'sandbox' => 'Sandbox (Test Server)',
				'production' => 'Live (Production Server)',
			);

			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('first_line') ?>">
					First Line (e.g. We finish together.)<br/>
					<?php echo aq_field_input('first_line', $block_id, $first_line) ?>
				</label>
			</p>			

			<p class="description">
				<label for="<?php echo $this->get_field_id('second') ?>">
					Second Line (e.g. Donate )<br/>
					<?php echo aq_field_input('second', $block_id, $second) ?>
				</label>
			</p>		

			<p class="description">
				<label for="<?php echo $this->get_field_id('email') ?>">
					PayPal Email<br/>
					<?php echo aq_field_input('email', $block_id, $email) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('purpose') ?>">
					Purpose of donation<br/>
					<?php echo aq_field_input('purpose', $block_id, $purpose) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('currency_sign') ?>">
					Currency sign (e.g. $)<br />
					<?php echo aq_field_input('currency_sign', $block_id, $currency_sign); ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('currency_code') ?>">
					Currency code (e.g. USD)<br/>
					<?php echo aq_field_select('currency_code', $block_id, $currency_codes, $currency_code); ?>
				</label>
			</p>	

			<p class="description">
				<label for="<?php echo $this->get_field_id('predefined_amount') ?>">
				Predefined Donation Values (Separate values by space)<br/>
				<?php echo aq_field_input('predefined_amount', $block_id, $predefined_amount) ?>
				</label>
			</p>	

			<p class="description">
				<label for="<?php echo $this->get_field_id('donation_image') ?>">
					Donate button image (optional)<br/>
					<?php echo aq_field_upload('donation_image', $block_id, $donation_image) ?>
				</label>
				<?php if($donation_image) { ?>
				<div class="screenshot">
					<img src="<?php echo $donation_image ?>" />
				</div>
				<?php } ?>
			</p>			

			<p class="description">
				<label for="<?php echo $this->get_field_id('server_type') ?>">
					Operation mode:<br/>
					<?php echo aq_field_select('server_type', $block_id, $server_type_options, $server_type); ?>
				</label>
			</p>			
			
			<?php
		}
		
		function block($instance) {
			extract($instance);	
			global $icy_options; 								
			
			$amount_array = array();
			$amount_array = explode(' ', $predefined_amount);			

			?> 

				<div class="icy-donation-form">

					<?php if ($first_line || $second) { ?>
						<div class="description">						
							<?php if ($first_line) { ?> <span class="body-text"><?php echo $first_line; ?></span> <?php } ?>
							<?php if ($second) { ?> <span class="keyword-text"><?php echo $second; ?></span> <?php } ?>
						</div>
					<?php } ?>
					
					<div class="icy-donation-amounts">
						<ul id="amounts">

							<?php foreach ($amount_array as $amount) {
								echo '<li class="predefined-amount">';
									echo '<span class="amount-'.$amount.' amount" data-amount="'.$amount.'"> '.$currency_sign . $amount . '</span>';
							} ?>
							<li class="other-amount">
								<input type="text" placeholder="<?php _e('Other Amount', 'framework'); ?>" />
						</ul>
					
					</div>

					<?php $URL = '';

						if ( $server_type == 'production' ) {
							$URL = 'https://www.paypal.com/cgi-bin/webscr';
						} 
						if ( $server_type == 'sandbox') {
							$URL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
						}

					?>

					<div class="donate-next-wrapper">

						<form action="<?php echo $URL; ?>" method="post" target="_top">
							<input type="hidden" name="cmd" value="_donations">			

							<?php if ($email) { ?>			
								<input type="hidden" name="business" value="<?php echo $email; ?>">
							<?php } ?>												
							
							<?php if ($purpose) { ?>
					            <input type="hidden" name="item_name" value="<?php echo $purpose; ?>">				        
					        <?php } ?>
					        
					        <input type="hidden" name="amount" class="icy-donation-value" value="0">						
							
							<?php if ($currency_code) { ?>
	            				<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>">
							<?php } else { ?>
								<input type="hidden" name="currency_code" value="USD">
							<?php } ?>


							<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">

							<?php 
							
							$src= '';

							if ($donation_image != '') {
								$src = $donation_image;
							} else {
								$src = 'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif';
							} ?>

							<input type="image" src="<?php echo $src; ?>" target="_blank" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">	

						</form>
					</div>

				</div>
				<?php			
		}
		
		
	}
}