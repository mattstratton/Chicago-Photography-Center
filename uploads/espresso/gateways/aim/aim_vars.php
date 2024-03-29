<?phpfunction espresso_display_aim($data) {	extract($data);	global $org_options;	?>	<div class="event-display-boxes">		<?php		$authnet_aim_settings = get_option('event_espresso_authnet_aim_settings');		$use_sandbox = $authnet_aim_settings['use_sandbox'] || $authnet_aim_settings['test_transactions'];		if ($use_sandbox) {			echo '<p>The New Test credit card # 4007000000027</p>';			echo '<h3 style="color:#ff0000;" title="Payments will not be processed">' . __('Debug Mode Is Turned On', 'event_espresso') . '</h3>';		}		if ($authnet_aim_settings['force_ssl_return']) {
			$home = str_replace('http://', 'https://', home_url());
		} else {
			$home = home_url();
		}
		if ($authnet_aim_settings['display_header']) {
		?>			<h3 class="payment_header"><?php echo $authnet_aim_settings['header']; ?></h3><?php } ?>
		<p class="section-title"><?php _e('Billing Information', 'event_espresso') ?></p>		<form id="aim_payment_form" name="aim_payment_form" method="post" action="<?php echo $home . '/?page_id=' . $org_options['return_url'] . '&registration_id=' . $registration_id; ?>">
			<div class = "event_espresso_form_wrapper">				<p>	        <label for="first_name"><?php _e('First Name', 'event_espresso'); ?></label>					<input name="first_name" type="text" id="aim_first_name" value="<?php echo $fname ?>" />
				</p>				<p>	        <label for="last_name"><?php _e('Last Name', 'event_espresso'); ?></label>					<input name="last_name" type="text" id="aim_last_name" value="<?php echo $lname ?>" />
				</p>				<p>	        <label for="email"><?php _e('Email Address', 'event_espresso'); ?></label>					<input name="email" type="text" id="aim_email" value="<?php echo $attendee_email ?>" />
				</p>				<p>	        <label for="address"><?php _e('Address', 'event_espresso'); ?></label>					<input name="address" type="text" id="aim_address" value="<?php echo $address ?>" />
				</p>				<p>	        <label for="city"><?php _e('City', 'event_espresso'); ?></label>					<input name="city" type="text" id="aim_city" value="<?php echo $city ?>" />
				</p>				<p>	        <label for="state"><?php _e('State', 'event_espresso'); ?></label>					<input name="state" type="text" id="aim_state" value="<?php echo $state ?>" />
				</p>				<p>	        <label for="zip"><?php _e('Zip', 'event_espresso'); ?></label>					<input name="zip" type="text" id="aim_zip" value="<?php echo $zip ?>" />
				</p>				<p><strong><?php _e('Credit Card Information', 'event_espresso'); ?></strong></p>				<p>	        <label for="card_num"><?php _e('Card Number', 'event_espresso'); ?></label>					<input type="text" name="card_num" id="aim_card_num" />
				</p>				<p>	        <label for="exp_date"><?php _e('Exp. Date', 'event_espresso'); ?></label>					<input type="text" name="exp_date" id="aim_exp_date" />
				</p>				<p>	        <label for="ccv_code"><?php _e('CCV Code', 'event_espresso'); ?></label>					<input type="text" name="ccv_code" id="aim_ccv_code" />
				</p>				<input name="amount" type="hidden" value="<?php echo number_format($event_cost, 2) ?>" />				<input name="invoice_num" type="hidden" value="<?php echo 'au-' . event_espresso_session_id() ?>" />				<input name="class_desc" type="hidden" value="<?php echo $event_name; ?>" />				<input name="authnet_aim" type="hidden" value="true" />				<input name="x_cust_id" type="hidden" value="<?php echo $attendee_id ?>" />				<input name="aim_submit" id="aim_submit" type="submit" value="<?php _e('Complete Purchase', 'event_espresso'); ?>" />
			</div>		</form>	</div>	<?php}add_action('action_hook_espresso_display_onsite_payment_gateway', 'espresso_display_aim');