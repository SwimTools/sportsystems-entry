<?php
/**
 * Plugin Name: Sport Systems Entry Tools
 * Plugin URI: http://www.swimtools.uk/wordpress-plugin/
 * Description: Plugin to display accepted entries for swimming meets / galas using reports from Sport Systems Meet Organisation v5.3 within a wordpress page or post.
 * Version: 2.1.2
 * Author: SwimTools | Mark Ralph
 * Update URI: https://github.com/SwimTools/sportsystems-entry/
 * Author URI: http://www.swimtools.uk
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}



    function media_uploader_enqueue() {
    	wp_enqueue_media();
    	wp_register_script('media-uploader', plugins_url('media-uploader.js' , __FILE__ ), array('jquery'));
    	wp_enqueue_script('media-uploader');
    }
    add_action('admin_enqueue_scripts', 'media_uploader_enqueue');


include( plugin_dir_path( __FILE__ ) . 'sport-systems-entry-standard.php');
include( plugin_dir_path( __FILE__ ) . 'sport-systems-entry-withdrawel.php');


class SportSystems {

	private $sport_systems_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'sport_systems_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'sport_systems_page_init' ) );
	}

	public function sport_systems_add_plugin_page() {
		add_menu_page(
			'Sport Systems', // page_title
			'Sport Systems', // menu_title
			'manage_options', // capability
			'sport-systems', // menu_slug
			array( $this, 'sport_systems_create_admin_page' ), // function
			'dashicons-universal-access', // icon_url
			25 // position
		);
	}

	public function sport_systems_create_admin_page() {
		$this->sport_systems_options = get_option( 'sport_systems_option_name' ); ?>
<?php
//Get the active tab from the $_GET param
  $default_tab = null;
  $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>
		<div class="wrap">
			<h2>Sport Systems - Entry Tools Plugin v2.01.2 <img src="<?php echo plugin_dir_url( 'sportsystems-entry' ) ; ?>sportsystems-entry/img/Powered_By_SwimTools.png" width="100"></h2>
			
			<p></p>
<nav class="nav-tab-wrapper">
      <a href="?page=sport-systems" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Meet</a>
      <a href="?page=sport-systems&tab=swimmers" class="nav-tab <?php if($tab==='swimmers'):?>nav-tab-active<?php endif; ?>">Swimmers</a>
      <a href="?page=sport-systems&tab=settings" class="nav-tab <?php if($tab==='settings'):?>nav-tab-active<?php endif; ?>">Settings</a>
      <a href="?page=sport-systems&tab=help" class="nav-tab <?php if($tab==='help'):?>nav-tab-active<?php endif; ?>">Help</a>
      <a href="?page=sport-systems&tab=changelog" class="nav-tab <?php if($tab==='changelog'):?>nav-tab-active<?php endif; ?>">Change Log</a>
    </nav>

<div class="tab-content">
    <?php switch($tab) :
      case 'swimmers':
        
	?>
	<h2><u>Coming Soon</u></h2>
	Upload competing swimmer file: </p>
	(Allows date of bith check on withdrawals)</p>
	</div>
	<?php
        break;
      case 'settings':
        
	?>
	<h2><u>Settings</u></h2>
	Event Split Delimiter </p>
	</div>
	<?php
        break;
      case 'changelog':
        
	?>
	<h2><u>Plugin Updates and changes</u></h2>
	v2.01.2 -  (11/04/24)</p>
	v2.01.1 - Added HELP tab (11/04/24)</p>
	v2.01.0 - Plugin name changed to 'Sport Systems - Entry Tools' (10/04/24)</p>
	v1.15.1 - Updates for linux Apache Servers (01/04/24)</p>
	v1.15.0 - Updates for Wordpress 6.5.2 and php 8.0 and above (31/03/24)</p>

	
	</div>
	<?php
        break;
      case 'help':

?>
<hr><h2><u>Exporting your meet entries</u></h2></hr>
			<u>Usage: Export the accepeted entries from your meet.</u></p>
			Reports > Entries > Acceptance Status > Meet</p>
			Choose: Sort Order: Club | Destination : File | Report Content : Submitted Time / Year of Birth</p>
			</i>Ticking 'Year of Birth' will prevent publishing swimmer Dates of Birth</i></p><br><br>
			If your wordpress setup does not allow uploading of .txt files , rename the file extenstion to .CSV
<hr><h2><u>Wordpress ShortCodes</u></h2></hr>
			<hr>Use the following shortcode to add your 'default' accepeted entries to your page </p>
			Standard Viewer - <b>[sport-systems-viewer]</b></p>
			Viewer with Withdrawel Function - <b>[sport-systems-withdrawalsviewer]</b>
			</p>
			<hr>Use the following shortcode to add your chosen accepeted entries to your page </p>
			Repalce x with the meet file reference you have selected above</p>
			Standard Viewer - <b>[sport-systems-viewer meet="x"]</b></p>
			Viewer with Withdrawel Function - <b>[sport-systems-withdrawalsviewer meet="x"]</b>

<hr><h2><u>Passing withdrawal data to your withdrawal form</u></h2></hr>
<b>When using the withdrawal feature the following variables are posted to the form.</b></p>
'Meet Name' = meetname</br>
'Swimmer Name' = swimmer</br>
'Swimmer Year of Birth'	= yob</br>
'Swimmer Club' = club</br>
'Events to Withdraw (All)' = events</br>
</p>
Event (x) to Withdraw = evx
16 events will be sent ev1 to ev16 , so variable ev1 will return the swimmers first event ev2 will return the swimmers second event
</p>	
You can either call the individual events (ev?) or all events (events) variable..
</p>
<hr>
<b>Further plugin information can be found on our website <a href="https://www.swimtools.uk" target="_blank">www.swimtools.uk</a></b>
<hr>
</div>
<?php
        break;
      default:
?>
    </div>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">

	
				<?php
//echo sport_systems_options['accepted_entries_file_0'];
					settings_fields( 'sport_systems_option_group' );
					do_settings_sections( 'sport-systems-admin' );
					submit_button();
				?>



			</form>
			<hr>
<h2>Selected Meet Files</h2></hr>
						
<?php
if (empty($this->sport_systems_options['accepted_entries_file_0'])) {
echo "<b>Meet File (1): </b>No meet file selected </p>";
} else {
$myfile = fopen($this->sport_systems_options['accepted_entries_file_0'], "r");
echo "<b>Default Meet File (0): </b>" . fgets($myfile) . " | ";
echo fgets($myfile) . "</p>";
fclose($myfile);
}


if (empty($this->sport_systems_options['accepted_entries_file_1'])) {
echo "<b>Meet File (1): </b>No meet file selected </p>";
} else {
$myfile = fopen($this->sport_systems_options['accepted_entries_file_1'], "r");
echo "<b>Meet File (1): </b>" . fgets($myfile) . " | ";
echo fgets($myfile) . "</p>";
fclose($myfile);
}

if (empty($this->sport_systems_options['accepted_entries_file_2'])) {
echo "<b>Meet File (2): </b>No meet file selected </p>";
} else {
$myfile = fopen($this->sport_systems_options['accepted_entries_file_2'], "r");
echo "<b>Meet File (2): </b>" . fgets($myfile) . " | ";
echo fgets($myfile) . "</p>";
fclose($myfile);
}

if (empty($this->sport_systems_options['accepted_entries_file_3'])) {
echo "<b>Meet File (3): </b>No meet file selected </p>";
} else {
$myfile = fopen($this->sport_systems_options['accepted_entries_file_3'], "r");
echo "<b>Meet File (3): </b>" . fgets($myfile) . " | ";
echo fgets($myfile);
fclose($myfile);
}

?>			
		</div>
<?php
       
        break;
    endswitch; ?>
			</p><hr>
			SwimTools - UK Swimming Tools & Tech - info@swimtools.uk - If you are using this plugin we would love to hear from you!
			<hr>
			<b>This plugin has no affiliation with Sport Systems Ltd</b>
			<hr>


	<?php }

	public function sport_systems_page_init() {
		register_setting(
			'sport_systems_option_group', // option_group
			'sport_systems_option_name', // option_name
			array( $this, 'sport_systems_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'sport_systems_setting_section', // id
			'Settings', // title
			array( $this, 'sport_systems_section_info' ), // callback
			'sport-systems-admin' // page
		);

		add_settings_field(
			'accepted_entries_file_0', // id
			'Accepted Entries File (Default)', // title
			array( $this, 'accepted_entries_file_0_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);

		add_settings_field(
			'accepted_entries_file_1', // id
			'Accepted Entries File (1)', // title
			array( $this, 'accepted_entries_file_1_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);

		add_settings_field(
			'accepted_entries_file_2', // id
			'Accepted Entries File (2)', // title
			array( $this, 'accepted_entries_file_2_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);

		add_settings_field(
			'accepted_entries_file_3', // id
			'Accepted Entries File (3)', // title
			array( $this, 'accepted_entries_file_3_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);


		add_settings_field(
			'withdrawals_form_url_2', // id
			'Withdrawals \'form\' URL', // title
			array( $this, 'withdrawals_form_url_2_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_header', // id
			'Main Header', // title
			array( $this, 'entries_header_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_text', // id
			'Entry Information', // title
			array( $this, 'entries_text_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_emailaddress', // id
			'Contact: Email Address', // title
			array( $this, 'entries_emailaddress_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_emailname', // id
			'Contact: Email Name/Text', // title
			array( $this, 'entries_emailname_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_headereventno', // id
			'Header - Event No', // title
			array( $this, 'entries_headereventno_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_headereventname', // id
			'Header - Event Name', // title
			array( $this, 'entries_headereventname_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_headereventcompno', // id
			'Header - Competitor No', // title
			array( $this, 'entries_headereventcompno_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_headerevententrytime', // id
			'Header - Entry Time', // title
			array( $this, 'entries_headerevententrytime_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_headereventsession', // id
			'Header - Session', // title
			array( $this, 'entries_headereventsession_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_headereventwithdraw', // id
			'Header - Withdraw', // title
			array( $this, 'entries_headereventwithdraw_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'entries_withdrawbutton', // id
			'Withdraw Button Label', // title
			array( $this, 'entries_withdrawbutton_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'hide_yob', // id
			'Hide YOB (Year of Birth)', // title
			array( $this, 'hide_yob_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);
		add_settings_field(
			'hide_disability', // id
			'Hide Disability Classifications', // title
			array( $this, 'hide_disability_callback' ), // callback
			'sport-systems-admin', // page
			'sport_systems_setting_section' // section
		);


			}

	public function sport_systems_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['accepted_entries_file_0'] ) ) {
			$sanitary_values['accepted_entries_file_0'] = sanitize_text_field( $input['accepted_entries_file_0'] );
		}
		if ( isset( $input['accepted_entries_file_1'] ) ) {
			$sanitary_values['accepted_entries_file_1'] = sanitize_text_field( $input['accepted_entries_file_1'] );
		}
		if ( isset( $input['accepted_entries_file_2'] ) ) {
			$sanitary_values['accepted_entries_file_2'] = sanitize_text_field( $input['accepted_entries_file_2'] );
		}
		if ( isset( $input['accepted_entries_file_3'] ) ) {
			$sanitary_values['accepted_entries_file_3'] = sanitize_text_field( $input['accepted_entries_file_3'] );
		}


		if ( isset( $input['withdrawals_form_url_2'] ) ) {
			$sanitary_values['withdrawals_form_url_2'] = sanitize_text_field( $input['withdrawals_form_url_2'] );
		}
		if ( isset( $input['entries_header'] ) ) {
			$sanitary_values['entries_header'] = sanitize_text_field( $input['entries_header'] );
		}
		if ( isset( $input['entries_text'] ) ) {
			$sanitary_values['entries_text'] = sanitize_text_field( $input['entries_text'] );
		}
		if ( isset( $input['entries_emailaddress'] ) ) {
			$sanitary_values['entries_emailaddress'] = sanitize_text_field( $input['entries_emailaddress'] );
		}
		if ( isset( $input['entries_emailname'] ) ) {
			$sanitary_values['entries_emailname'] = sanitize_text_field( $input['entries_emailname'] );
		}

		$headersession = sanitize_text_field( $input['entries_headereventsession'] );
		if (empty($headersession)) {
		    $headersession = 'Session' ;
		}
		$withdrawbutton = sanitize_text_field( $input['entries_withdrawbutton'] );
		if (empty($withdrawbutton)) {
		    $withdrawbutton = 'Submit Withdrawal' ;
		}
		$headerwithdraw = sanitize_text_field( $input['entries_headereventwithdraw'] );
		if (empty($headerwithdraw)) {
		    $headerwithdraw = 'Withdraw' ;
		}
		$headereventno = sanitize_text_field( $input['entries_headereventno'] );
		if (empty($headereventno)) {
		    $headereventno = 'Event No' ;
		}
		$headercompno = sanitize_text_field( $input['entries_headereventcompno'] );
		if (empty($headercompno)) {
		    $headercompno = 'Comp No' ;
		}
		$headereventname = sanitize_text_field( $input['entries_headereventname'] );
		if (empty($headereventname)) {
		    $headereventname = 'Event Name' ;
		}
		$headerentrytime = sanitize_text_field( $input['entries_headerevententrytime'] );
		if (empty($headerentrytime)) {
		    $headerentrytime = 'Entry Time' ;
		}
		if ( isset( $input['hide_yob'] ) ) {
			$sanitary_values['hide_yob'] = $input['hide_yob'];
		}
		if ( isset( $input['hide_disability'] ) ) {
			$sanitary_values['hide_disability'] = $input['hide_disability'];
		}



		if ( isset( $input['entries_headereventno'] ) ) {
			$sanitary_values['entries_headereventno'] = $headereventno ;
		}
		if ( isset( $input['entries_headereventname'] ) ) {
			$sanitary_values['entries_headereventname'] = $headereventname ;
		}
		if ( isset( $input['entries_headereventcompno'] ) ) {
			$sanitary_values['entries_headereventcompno'] = $headercompno ;
		}
		if ( isset( $input['entries_headerevententrytime'] ) ) {
			$sanitary_values['entries_headerevententrytime'] = $headerentrytime ;
		}
		if ( isset( $input['entries_headereventsession'] ) ) {
			$sanitary_values['entries_headereventsession'] = $headersession ;
		}
		if ( isset( $input['entries_headereventwithdraw'] ) ) {
			$sanitary_values['entries_headereventwithdraw'] = $headerwithdraw ;
		}
		if ( isset( $input['entries_withdrawbutton'] ) ) {
			$sanitary_values['entries_withdrawbutton'] = $withdrawbutton ;
		}
		



		return $sanitary_values;

	}

	public function sport_systems_section_info() {
		
	}

	public function accepted_entries_file_0_callback() {
		printf(
			'<input class="regular-text" type="text" width="250" name="sport_systems_option_name[accepted_entries_file_0]" id="accepted_entries_file_0" value="%s"><input type="button" class="upload-button" data-target="accepted_entries_file_0" value="Choose Default Meet File" />',
			isset( $this->sport_systems_options['accepted_entries_file_0'] ) ? esc_attr( $this->sport_systems_options['accepted_entries_file_0']) : ''
		);
	}

	public function accepted_entries_file_1_callback() {
		printf(
			'<input class="regular-text" type="text" width=250" name="sport_systems_option_name[accepted_entries_file_1]" id="accepted_entries_file_1" value="%s"><input type="button" class="upload-button" data-target="accepted_entries_file_1" value="Choose Meet File (1)" />',
			isset( $this->sport_systems_options['accepted_entries_file_1'] ) ? esc_attr( $this->sport_systems_options['accepted_entries_file_1']) : ''
		);
	}
	public function accepted_entries_file_2_callback() {
		printf(
			'<input class="regular-text" type="text" width="250" name="sport_systems_option_name[accepted_entries_file_2]" id="accepted_entries_file_2" value="%s"><input type="button" class="upload-button" data-target="accepted_entries_file_2" value="Choose Meet File (2)" />',
			isset( $this->sport_systems_options['accepted_entries_file_2'] ) ? esc_attr( $this->sport_systems_options['accepted_entries_file_2']) : ''
		);
	}
	public function accepted_entries_file_3_callback() {
		printf(
			'<input class="regular-text" type="text" width="250" name="sport_systems_option_name[accepted_entries_file_3]" id="accepted_entries_file_3" value="%s"><input type="button" class="upload-button" data-target="accepted_entries_file_3" value="Choose Meet File (3)" />',
			isset( $this->sport_systems_options['accepted_entries_file_3'] ) ? esc_attr( $this->sport_systems_options['accepted_entries_file_3']) : ''
		);
	}


	public function withdrawals_form_url_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[withdrawals_form_url_2]" id="withdrawals_form_url_2" value="%s">',
			isset( $this->sport_systems_options['withdrawals_form_url_2'] ) ? esc_attr( $this->sport_systems_options['withdrawals_form_url_2']) : ''
		);
	}
	public function entries_header_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_header]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_header'] ) ? esc_attr( $this->sport_systems_options['entries_header']) : ''
		);
	}
	public function entries_text_callback() {
		printf(
			'<textarea class="regular-text" type="text" rows="7" cols="100" name="sport_systems_option_name[entries_text]" id="entries_header">%s</textarea>',
			isset( $this->sport_systems_options['entries_text'] ) ? esc_attr( $this->sport_systems_options['entries_text']) : ''
		);
	}
	public function entries_emailaddress_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_emailaddress]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_emailaddress'] ) ? esc_attr( $this->sport_systems_options['entries_emailaddress']) : ''
		);
	}
	public function entries_emailname_callback() {
		printf(
			'<textarea class="regular-text" type="text" rows="4" cols="100" name="sport_systems_option_name[entries_emailname]" id="entries_header">%s</textarea>',
			isset( $this->sport_systems_options['entries_emailname'] ) ? esc_attr( $this->sport_systems_options['entries_emailname']) : ''
		);
	}
	public function entries_headereventno_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_headereventno]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_headereventno'] ) ? esc_attr( $this->sport_systems_options['entries_headereventno']) : ''
		);
	}
	public function entries_headereventname_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_headereventname]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_headereventname'] ) ? esc_attr( $this->sport_systems_options['entries_headereventname']) : ''
		);
	}
	public function entries_headereventcompno_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_headereventcompno]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_headereventcompno'] ) ? esc_attr( $this->sport_systems_options['entries_headereventcompno']) : ''
		);
	}
	public function entries_headerevententrytime_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_headerevententrytime]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_headerevententrytime'] ) ? esc_attr( $this->sport_systems_options['entries_headerevententrytime']) : ''
		);
	}
	public function entries_headereventsession_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_headereventsession]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_headereventsession'] ) ? esc_attr( $this->sport_systems_options['entries_headereventsession']) : ''
		);
	}
	public function entries_headereventwithdraw_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_headereventwithdraw]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_headereventwithdraw'] ) ? esc_attr( $this->sport_systems_options['entries_headereventwithdraw']) : ''
		);
	}
	public function entries_withdrawbutton_callback() {
		printf(
			'<input class="regular-text" type="text" name="sport_systems_option_name[entries_withdrawbutton]" id="entries_header" value="%s">',
			isset( $this->sport_systems_options['entries_withdrawbutton'] ) ? esc_attr( $this->sport_systems_options['entries_withdrawbutton']) : ''
		);
	}
		public function hide_yob_callback() {
		printf(
			'<input type="checkbox" name="sport_systems_option_name[hide_yob]" id="hide_yob" value="hide_yob" %s>',
			( isset( $this->sport_systems_options['hide_yob'] ) && $this->sport_systems_options['hide_yob'] === 'hide_yob' ) ? 'checked' : ''
		);
	}
	public function hide_disability_callback() {
		printf(
			'<input type="checkbox" name="sport_systems_option_name[hide_disability]" id="hide_yob" value="hide_disability" %s>',
			( isset( $this->sport_systems_options['hide_disability'] ) && $this->sport_systems_options['hide_disability'] === 'hide_disability' ) ? 'checked' : ''
		);
	}
	




}





if ( is_admin() )
	$sport_systems = new SportSystems();

/* 
 * Retrieve this value with:
 * $sport_systems_options = get_option( 'sport_systems_option_name' ); // Array of All Options
 * $accepted_entries_file_0 = $sport_systems_options['accepted_entries_file_0']; // Accepted Entries File
 * $show_withdrawels_1 = $sport_systems_options['show_withdrawels_1']; // Show Withdrawels
 * $withdrawals_form_url_2 = $sport_systems_options['withdrawals_form_url_2']; // Withdrawals \'form\' URL
 */






?>