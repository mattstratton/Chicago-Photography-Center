<?php
function event_espresso_groupon_payment_page($use_groupon_code, $event_id, $event_cost, $attendee_id){
	$org_options = get_option('events_organization_settings');
	global $wpdb;
	$today = date("m-d-Y");
	if ($use_groupon_code == "Y"){
		if ($_REQUEST['groupon_code'] != ''){
			
			$groupons = $wpdb->get_results("SELECT d.* FROM " . EVENTS_GROUPON_CODES_TABLE . " d
											WHERE d.groupon_code = '".$_REQUEST['groupon_code']."' AND d.groupon_status > '0' ");
			if ($wpdb->num_rows > 0) {	
				$valid_groupon = true;
				foreach ($groupons as $groupon){
					$groupon_id = $groupon->id;
					$groupon_code = $groupon->groupon_code;
					$groupon_status = $groupon->groupon_status;
					$groupon_holder = $groupon->groupon_holder;
				}
				_e('<p id="event_espresso_valid_groupon"><strong>You are using groupon code:</strong> '.$groupon_code.' purchased by '.$groupon_holder.'</p>','event_espresso');
							
				if($valid_groupon == true){
					$event_cost = '0.00';
					//$event_cost = __('0.00','event_espresso');
					$payment_status = __('Completed','event_espresso');
				}
							
				$sql=array('coupon_code'=>$_REQUEST['groupon_code'], 'amount_pd'=>$event_cost, 'payment_status'=>$payment_status, 'payment_date' => $today);
			
				$sql_data = array('%s','%s','%s', '%s');
							
				$update_id = array('id'=> $attendee_id);
							
				$wpdb->update(EVENTS_ATTENDEE_TABLE, $sql, $update_id, $sql_data, array( '%d' ) );
							
				$groupon_status = $groupon_status - 1;
													
				$groupon_used="UPDATE " . EVENTS_GROUPON_CODES_TABLE . " SET groupon_status='" . $groupon_status . "', attendee_id='" . $attendee_id . "', date='" . $today . "' WHERE id = '" . $groupon_id . "'";
				$wpdb->query($groupon_used);
				//event_espresso_email_confirmations($attendee_id, 'true', 'true' );
                                //event_espresso_email_confirmations(array('attendee_id' => $attendee_id, 'send_admin_email' => 'true', 'send_attendee_email' => 'true'));
			
			}else{
				echo '<p id="event_espresso_invalid_coupon"><font color="red">'.__('Sorry, that groupon code is invalid or has already been used.','event_espresso'). '</font></p>';
			}
		}
	}
	return $event_cost;
}

function event_espresso_groupon_registration_page($use_groupon_code, $event_id){
	if ($use_groupon_code == "Y"){ ?>
		<p class="event_form_field" id="groupon_code-"><label for="groupon_code"><?php _e('If you ahve a Groupon code, enter it here:','event_espresso'); ?></label>		<input tabIndex="9" maxLength="25" size="35" type="text" name="groupon_code" id="groupon_code-<?php echo $event_id;?>">
		</p>
<?php
	}
}