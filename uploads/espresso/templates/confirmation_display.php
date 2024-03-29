<?php
/* WARNING MODIFYING THIS AT YOUR OWN RISK  */
/* Payments template page. Currently this just shows the registration data block.*/

//This page gets all of the varaibles from includes/process-registration/payment_page.php
//Payment confirmation block
$attendee_num = 1;
?>
			<form id="form1" name="form1" method="post" action="<?php echo home_url()?>/?page_id=<?php echo $event_page_id?>">
				<div class="event-conf-block event-display-boxes" >
							<h2 class="event_title">
              <?php _e('Please verify your registration details:','event_espresso'); ?>
            </h2>
            <table class="event-display-tables grid"  id="event_espresso_attendee_verify">
								
              <tr>
                <th scope="row" class="header">
                  <?php _e('Event Name:','event_espresso'); ?>
                </th><!--This section is changed on purpose -->
                <td><span class="event_espresso_value"><?php echo stripslashes_deep($event_name)?> on <?php echo do_shortcode('[EVENT_TIME event_id="'.$event_id.'" type="start_date" format="F jS"]'); ?></span></td>
<!-- end change-->	
              </tr>
               <?php
				/*
				 * Added for seating chart addon
				 */
				$display_price = true;
				if ( defined('ESPRESSO_SEATING_CHART') )
				{
					$seating_chart_id = seating_chart::check_event_has_seating_chart($event_id);
					if ( $seating_chart_id !== false )
					{
						$display_price = false;
					}
				}
				if ( $display_price )
				{
				/*
				 * End
				 */
			   ?>	
               <tr>
                <th scope="row" class="header">
                  <?php echo empty($price_type) ? __('Price per attendee:','event_espresso') : __('Type/Price per attendee:','event_espresso'); ?>
                </th>
                <td><span class="event_espresso_value"><?php echo empty($price_type) ? $org_options['currency_symbol'] . $event_price : stripslashes_deep($price_type) . ' / ' .$org_options['currency_symbol'].$event_price;?></span></td>
              </tr>
              <?php
				/*
				 * Added for seating chart addon
				 */
				 }
				 else
				 {
					$price_range = seating_chart::get_price_range($event_id);
					$price = "";
					if ( $price_range['min'] != $price_range['max'] )
					{
						$price = $org_options['currency_symbol']. number_format($price_range['min'], 2) . ' - ' . $org_options['currency_symbol']. number_format($price_range['max'], 2);
					}
					else
					{
						$price = $org_options['currency_symbol']. number_format($price_range['min'], 2);
					}
				 ?>
			  <tr>
                <td><strong class="event_espresso_name">Price : </strong></td>
                <td><?php echo $price; ?></td>
              </tr>
				 <?php
				 }
				 /*
				  * End
				  */
			  ?>
              <tr>
                <th scope="row" class="header">
                  <?php _e('Attendee Name:','event_espresso'); ?>
									</th>
                <td  valign="top">
										<span class="event_espresso_value"><?php echo stripslashes_deep($attendee_name)?> (<?php echo $attendee_email?>) <?php echo '<a href="'.home_url().'/?page_id='.$event_page_id.'&amp;registration_id='.$registration_id.'&amp;id='.$attendee_id.'&amp;regevent_action=register&amp;form_action=edit_attendee&amp;primary='.$attendee_id.'&amp;p_id='.$p_id.'&amp;event_id='.$event_id.'&amp;coupon_code='.$coupon_code.'&amp;groupon_code='.$groupon_code.'&amp;attendee_num='.$attendee_num.'">'. __('Edit', 'event_espresso').'</a>'; ?>
    								<?php
    								//Create additional attendees
    								$sql = "SELECT * FROM " . EVENTS_ATTENDEE_TABLE;
    								$sql .= " WHERE registration_id = '" . espresso_registration_id( $attendee_id ) . "' AND id != '".$attendee_id."' ";
    								//echo $sql;
    								$x_attendees = $wpdb->get_results( $sql, ARRAY_A );
    								if ( $wpdb->num_rows > 0 ){
    									foreach ($x_attendees as $x_attendee){
    										$attendee_num++;
    										//echo $attendee_num;
    										//print_r($x_attendees);
    										echo "<br/>" . $x_attendee['fname'] . " " . $x_attendee['lname'] . " ";
    										if ($x_attendee['email'] != '') { echo "(" . $x_attendee['email']  . ") "; }
    
    										//Create edit link
    										echo '<a href="'.home_url().'/?page_id='.$event_page_id.'&amp;registration_id='.$registration_id.'&amp;id='.$x_attendee['id'].'&amp;regevent_action=register&amp;form_action=edit_attendee&amp;primary='.$attendee_id.'&amp;p_id='.$p_id.'&amp;coupon_code='.$coupon_code.'&amp;groupon_code='.$groupon_code.'&amp;attendee_num='.$attendee_num.'">'. __('Edit', 'event_espresso').'</a>';
    										//Create delete link
    										echo ' | <a href="'.home_url().'/?page_id='.$event_page_id.'&amp;registration_id='.$registration_id.'&amp;id='.$x_attendee['id'].'&amp;regevent_action=register&amp;form_action=edit_attendee&amp;primary='.$attendee_id.'&amp;delete_attendee=true&amp;p_id='.$p_id.'&amp;coupon_code='.$coupon_code.'&amp;groupon_code='.$groupon_code.'">'. __('Delete', 'event_espresso').'</a>';						
    									}
    								}	?>
										</span>
									</td>
              </tr>
              <?php if ($num_people > 1){?>
              <tr>
                <th scope="row" class="header">
                  <?php _e('Total Registrants:','event_espresso'); ?>
                 </th>
                <td><span class="event_espresso_value"><?php echo $num_people; ?></span></td>
              </tr>
              <?php } ?>
              <tr valign="top">
                <th scope="row" class="header">
                  <?php _e('Total Price:','event_espresso'); ?>
                 </td>
                <td><span class="event_espresso_value"><?php echo $org_options['currency_symbol']?><?php echo $event_price_x_attendees;  echo $event_discount_label;?></span></td>
              </tr>

              </table>
							</div>
						
            <p class="espresso_confirm_registration"><input class="btn_event_form_submit" type="submit" name="confirm" id="confirm" value="<?php _e('Confirm Registration', 'event_espresso'); ?>" /></p>
						<!--a piece is removed here on purpose-->
					

  
        <input name="confirm_registration" id="confirm_registration" type="hidden" value="true" />
        <input type="hidden" name="attendee_id" id="attendee_id" value="<?php echo $attendee_id ?>" />
        <input type="hidden" name="registration_id" id="registration_id" value="<?php echo $registration_id ?>" />
        <input type="hidden" name="regevent_action" id="regevent_action-<?php echo $event_id;?>" value="post_attendee">
        <input type="hidden" name="event_id" id="event_id-<?php echo $event_id;?>" value="<?php echo $event_id;?>">
    </form>
	<p><h3>Refund and Credit Policy</h3> <br/><br/>To receive a full refund (minus a $25.00 processing fee), you must submit a written, dated request (electronic or paper) to The Chicago Photography Center (CPC) at least 7 days prior to the first meeting of the class/boot camp. Approved refunds may take up to 30 days to process. CPC cannot be held responsible for refunds due to illness, personal emergency, unattended classes, or any event not under our control. Class credits may be issued in these circumstances, subject to review by the Executive Director and the Board of Directors. <br/><br/>CPC classes/boot camps may be cancelled due to under-enrollment and/or other reasons. In any such case, you will be notified before the start date, and CPC will automatically issue to you a class/boot camp credit. If you would prefer a refund, please contact CPC within 7 days of notification of the cancellation. A refund cannot happen automatically.
