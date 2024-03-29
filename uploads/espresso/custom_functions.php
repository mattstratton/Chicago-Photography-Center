<?php
/*
Function Name: Maximum Date Display
Author: Seth Shoultes
Contact: seth@smartwebutah.com
Website: http://shoultes.net
Description: This function is used in the Events Table Display template file to show events for a maximum number of days in the future
Usage Example: 
Requirements: Events Table Display template file
Notes: 
*/
function display_event_espresso_date_max($max_days="null"){
	global $wpdb;
	//$org_options = get_option('events_organization_settings');
	//$event_page_id =$org_options['event_page_id'];
	if ($max_days != "null"){
		if ($_REQUEST['show_date_max'] == '1'){
			foreach ($_REQUEST as $k=>$v) $$k=$v;
		}
		$max_days = $max_days;
		$sql  = "SELECT * FROM " . EVENTS_DETAIL_TABLE . " WHERE ADDDATE('".date ( 'Y-m-d' )."', INTERVAL ".$max_days." DAY) >= start_date AND start_date >= '".date ( 'Y-m-d' )."' AND is_active = 'Y' ORDER BY date(start_date)";
		event_espresso_get_event_details($sql);//This function is called from the event_list.php file which should be located in your templates directory.

	}				
}

/*
Function Name: Event Status
Author: Seth Shoultes
Contact: seth@eventespresso.com
Website: http://eventespresso.com
Description: This function is used to display the status of an event.
Usage Example: Can be used to display custom status messages in your events.
Requirements: 
Notes: 
*/
if (!function_exists('espresso_event_status')) {
	function espresso_event_status($event_id){
		$event_status = event_espresso_get_is_active($event_id);
		
		//These messages can be uesd to display the status of the an event.
		switch ($event_status['status']){
			case 'EXPIRED':
				$event_status_text = __('This event is expired.','event_espresso');
			break;
			
			case 'ACTIVE':
				$event_status_text = __('This event is active.','event_espresso');
			break;
			
			case 'NOT_ACTIVE':
				$event_status_text = __('This event is not active.','event_espresso');
			break;
			
			case 'ONGOING':
				$event_status_text = __('This is an ongoing event.','event_espresso');
			break;
			
			case 'SECONDARY':
				$event_status_text = __('This is a secondary/waiting list event.','event_espresso');
			break;
			
		}
		return $event_status_text;
	}
}

/*
Function Name: Custom Event List Builder
Author: Seth Shoultes
Contact: seth@eventespresso.com
Website: http://eventespresso.com
Description: This function creates lists of events using custom templates.
Usage Example: Create a page or widget template to show events.
Requirements: Template files must be stored in your wp-content/uploads/espresso/templates directory
Notes: 
*/
if (!function_exists('espresso_list_builder')) {
	function espresso_list_builder($sql, $template_file, $before, $after){
		
		global $wpdb, $org_options;
		//echo 'This page is located in ' . get_option( 'upload_path' );
		$event_page_id = $org_options['event_page_id'];
		$currency_symbol = $org_options['currency_symbol'];
		$events = $wpdb->get_results($sql);
		$category_id = $wpdb->last_result[0]->id;
		$category_name = $wpdb->last_result[0]->category_name;
		$category_desc = html_entity_decode( wpautop($wpdb->last_result[0]->category_desc) );
		$display_desc = $wpdb->last_result[0]->display_desc;
		
		if ($display_desc == 'Y'){
			echo '<p id="events_category_name-'. $category_id . '" class="events_category_name">' . stripslashes_deep($category_name) . '</p>';
			echo wpautop($category_desc);				
		}
		
		foreach ($events as $event){
			$event_id = $event->id;
			$event_name = $event->event_name;
			$event_identifier = $event->event_identifier;
			$active = $event->is_active;
			$registration_start = $event->registration_start;
			$registration_end = $event->registration_end;
			$start_date = $event->start_date;
			$end_date = $event->end_date;
			$reg_limit = $event->reg_limit;
			$event_address = $event->address;
			$event_address2 = $event->address2;
			$event_city = $event->city;
			$event_state = $event->state;
			$event_zip = $event->zip;
			$event_country = $event->country;
			$member_only = $event->member_only;
			$externalURL = $event->externalURL;
			$recurrence_id = $event->recurrence_id;
			
			$allow_overflow = $event->allow_overflow;
			$overflow_event_id = $event->overflow_event_id;
			
			//Address formatting
			$location = ($event_address != '' ? $event_address :'') . ($event_address2 != '' ? '<br />' . $event_address2 :'') . ($event_city != '' ? '<br />' . $event_city :'') . ($event_state != '' ? ', ' . $event_state :'') . ($event_zip != '' ? '<br />' . $event_zip :'') . ($event_country != '' ? '<br />' . $event_country :'');
			
			//Google map link creation
			$google_map_link = espresso_google_map_link(array( 'address'=>$event_address, 'city'=>$event_city, 'state'=>$event_state, 'zip'=>$event_zip, 'country'=>$event_country, 'text'=> 'Map and Directions', 'type'=> 'text') );
			
			//These variables can be used with other the espresso_countdown, espresso_countup, and espresso_duration functions and/or any javascript based functions.
			$start_timestamp = espresso_event_time($event_id, 'start_timestamp');
			$end_timestamp = espresso_event_time($event_id, 'end_timestamp');
			
			//This can be used in place of the registration link if you are usign the external URL feature
			$registration_url = $externalURL != '' ? $externalURL : get_option('siteurl') . '/?page_id='.$event_page_id.'&regevent_action=register&event_id='. $event_id;
		
			if (!is_user_logged_in() && get_option('events_members_active') == 'true' && $member_only == 'Y') {
				//Display a message if the user is not logged in.
				 //_e('Member Only Event. Please ','event_espresso') . event_espresso_user_login_link() . '.';
			}else{
	//Serve up the event list
	//As of version 3.0.17 the event lsit details have been moved to event_list_display.php
				echo $before = $before == ''? '' : $before;
				include('templates/'. $template_file);
				echo $after = $after == ''? '' : $after;
			} 
		}
	//Check to see how many database queries were performed
	//echo '<p>Database Queries: ' . get_num_queries() .'</p>';
	}
}

//This function overrides the core additional attendees function and displays a dropdown instead.
/*if (!function_exists('event_espresso_additional_attendees')) {
	function event_espresso_additional_attendees($additional_limit, $available_spaces){ ?>
		<p class="espresso_additional_limit">
        
        <label for="num_people"><?php _e('Number of Attendees','event_regis'); ?></label> 
		<select name="num_people" id="num_people-<?php echo $event_id;?>" style="width:70px;margin-top:4px">
	<?php	
		while (($i <= $additional_limit) && ($i < $available_spaces)) {
			$i++;
	?>
		<option value="<?php echo $i;?>"><?php echo $i; ?></option>
	<?php	
		}
	?>
		</select>
		<br />
		<?php //_e('The # of people who will be attending IN ADDITION TO yourself.','event_regis');?>
        <input type="hidden" name="espresso_addtl_limit_dd" value="true">
		</p>
        
	<?php
	}
}*/
// This is the thing for the discount code fix

if (!function_exists('event_espresso_coupon_registration_page')) {
    function event_espresso_coupon_registration_page($use_coupon_code, $event_id, $multi_reg = 0) {
        global $espresso_premium;
        if ($espresso_premium != true)
            return;
        if ($use_coupon_code == "Y") {

            $multi_reg_adjust = $multi_reg == 1 ? "[$event_id]" : '';

            $output ='<p class="event_form_field coupon_code" id="coupon_code-' . $event_id . '">';
            $output .= '<label for="coupon_code">' . __('Enter Discount Code', 'event_espresso') . ':</label>';
            $output .= '<input type="text" tabIndex="9" maxLength="25" size="35" name="coupon_code';
            $output .= $multi_reg_adjust . '" id="coupon_code-' . $event_id . '"></p>';
        } else $output = '';
        return $output;
    }
}