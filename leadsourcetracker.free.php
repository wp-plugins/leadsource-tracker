<?php
/*
Plugin Name: LeadSource Tracker - Free Edition 
Plugin URI: http://www.leadsourcetracker.com/
Description: LeadSource Tracker is a WordPress plugin that allows you to perform marketing attribution with your WordPress based website.  It stores information about which marketing campaigns visitors come from and allows the information to be recorded when the user registers on your website.  This allows you to attribute the lead to multiple marketing campaigns so that you can optimize your marketing spend / activities accordingly.  
Author: Cadman Chui
Author URI: http://www.leadsourcetracker.com
Version: 1.0
*/


function ldsrctrckr_settings_menu() {
	add_options_page( 'LeadSource Tracker', 'LeadSource Tracker', 'manage_options', 'ldsrctrckr_store_leadsource-settings', 'ldsrctrckr_settings_page' );
}

add_action('admin_menu', 'ldsrctrckr_settings_menu');

function ldsrctrckr_settings_page() {
	?>
	<div class="wrap">
		<h2><?php _e('LeadSource Tracker - Free Edition - Settings'); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields('settings'); ?>
			
			<table class="form-table">
				<tbody>
					<hr />

<tr>
<a href="http://www.leadsourcetracker.com">Upgrade to Enterprise Edition</a> and get Unlimited Campaigns and Contact Forms!
</tr>

<?php

        $pg_name = "ldsrctrckr_store_leadsource_pg_1";
        echo "<tr><th scope='row'>Contact Form 1</th><td>";
        echo "Select the contact form where the campaign tracking is retrieved.  It will appear as parameters in the URL of the page.<br />";
        $args = array(
            'depth'                 => 0,
            'child_of'              => 0,
            'selected'              => get_option($pg_name),
            'echo'                  => 1,
            'name'                  => $pg_name,
            'id'                    => null, // string
            'show_option_none'      => "Not Selected", // string
            'show_option_no_change' => null, // string
            'option_none_value'     => -65535, // string
        );
        wp_dropdown_pages($args);
        echo "</td></tr>";

?>

<tr>
<th></th>
<td>
<?php submit_button(); ?>
</td>
</tr>



<tr>
    <th scope='row'>Campaign Tracking Setup:</th>
    <td>Append <b>&quot;?ldsrc=[Campaign_Name]&quot;</b> after the URL for every link that brings visitors to your site.<br /> [Campaign_Name] cannot contain any spaces. The campaign tracking information will stay with the visitor until they register on a contact or order form that you specify.<br /><br />
	Examples: <br />
        http://www.mywebsite.com/anypage/<b>?ldsrc=Home_and_Garden_Tradeshow</b><br />
        http://www.mywebsite.com/products/<b>?ldsrc=Google_Adwords</b><br />
        http://www.mywebsite.com/<b>?ldsrc=LinkedIn_Ads</b><br />
        http://www.mywebsite.com/services/solution1/<b>?ldsrc=Press_Release_2015-04-20</b><br /><br />
        In the case where there are other parameters that are placed first, use an '&' instead of '?'<br />
        http://www.mywebsite.com/?other_params=1<b>&ldsrc=Email_2015-04-21</b>
  </td>
</tr>
<tr>	   
<th scope='row'>Campaign Retrieval & Attribution</th>
  <td>On any page you choose, campaign names can be retrieved from the user's browser and placed as a series of GET parameters in the URL in the order in which the user came through to your site:<br /><br />
  http://www.mywebsite.com/mycontactform/<b>?ldsrc_0=Home_and_Garden_Tradeshow&ldsrc_1=Google_Adwords&ldsrc_2=LinkedIn_Ads&ldsrc_3=Press_Release_2015-04-20&ldsrc_4=Email_2015-04-21&ldsrc_n=Email_2015-04-21</b><br /><br />
	In the Free Edition, only the first campaign (ldsrc_0) and the last (ldsrc_n) are retrieved.  Pull these parameters into your contact or order forms with hidden fields.  Many form plugins like Gravity Forms allows you to do this as well through their "Parameters" features. They also have integrations with CRM systems like SalesForce where you can populate the Lead Source field and other custom fields for report generation.
  </td>
</tr>


					</tbody>
			</table>	
	
		
		</form>
<?php
}

function ldsrctrckr_register_option() {
	// creates our settings in the options table
	register_setting('settings', 'ldsrctrckr_store_leadsource_pg_1');
}
add_action('admin_init', 'ldsrctrckr_register_option');



function ldsrctrckr_store_leadsource() {
     	if ( isset($_COOKIE["ldsrc"])) {
		if (  isset($_GET["ldsrc"]) && !(in_array($_GET["ldsrc"], $_COOKIE["ldsrc"])) ) {
       		        $cookie_count = count($_COOKIE["ldsrc"]);
 	              	if ($cookie_count > 1) {
       	                	$cookie_count = $cookie_count - 1;
       		        }
       	  	        $cookie_name = "ldsrc[".$cookie_count."]";
			$cookie_value = $_GET["ldsrc"];
        	       	$number_of_days = 365;
	       	        $date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
	                setcookie($cookie_name, $cookie_value, $date_of_expiry, "/");
	               	setcookie("ldsrc[n]", $cookie_value, $date_of_expiry, "/");
		}
	} else {
		if ( isset($_GET["ldsrc"]) ) {
			$cookie_name = "ldsrc[0]";
			$cookie_value = $_GET["ldsrc"];
                        $number_of_days = 365;
                        $date_of_expiry = time() + 60 * 60 * 24 * $number_of_days;
                        setcookie($cookie_name, $cookie_value, $date_of_expiry, "/");
                        setcookie("ldsrc[n]", $cookie_value, $date_of_expiry, "/");
		}
	}
}


function ldsrctrckr_refresh_page(){
	$page_1 = get_option('ldsrctrckr_store_leadsource_pg_1');

	if ((is_page($page_1)) && (isset($_GET["ldsrc"]) || ((isset($_COOKIE["ldsrc"])) && (!isset($_GET["ldsrc_0"]))))) {
		/*
		foreach ($_COOKIE["ldsrc"] as $key => $val) {
		      	//print "$key = $val\n";
                       	$query_string["ldsrc_$key"] = $val;
		}
		*/
		if (isset($_GET["ldsrc"])) {
			if (isset($_COOKIE["ldsrc"])) {
				/*
				$query_string["ldsrc_$key"] = $_GET["ldsrc"];
				$key = count($_COOKIE["ldsrc"]) - 1;
				$query_string["ldsrc_$key"] = $_GET["ldsrc"];
				*/
				$query_string["ldsrc_0"] = $_COOKIE["ldsrc"][0];
				$query_string["ldsrc_n"] = $_GET["ldsrc"];
			} else {
			 	$query_string["ldsrc_0"] = $_GET["ldsrc"];
				$query_string["ldsrc_n"] = $_GET["ldsrc"];
			}
		} else {
			$query_string["ldsrc_0"] = $_COOKIE["ldsrc"][0];
			$query_string["ldsrc_n"] = $_COOKIE["ldsrc"][n];
		}
  	
              	$location = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$location = remove_query_arg('ldsrc', $location);
             	$location = add_query_arg($query_string, $location);
              	//echo "REDIRECT = ".$location;
              	wp_redirect( $location );
        }       
}

add_action('template_redirect', 'ldsrctrckr_refresh_page');
add_action('init', 'ldsrctrckr_store_leadsource');

?>
