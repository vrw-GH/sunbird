<?php
/*
 * @package     WBC_Importer - Extension for Importing demo content
 * @version     1.0
 */



if ( !function_exists( 'wbc_importer_description_text' ) ) {

	/**
	 * Filter for changing importer description info in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $title description above demos
	 *
	 * @return [string] return.
	 */

	function wbc_importer_description_text( $description ) {

		$message = '<p style="font-size: 18px;color:#D85245;">'. esc_html__( '&#8594; Important Instruction:', 'avas' ) .'</p>';
		$message .= '<p style="font-size: 15px;">'. esc_html__( '&#9957; Best if used on new WordPress install. Before you begin, make sure all the required plugins are activated according to your need.', 'avas' ) .'</p>';
		
		$message .= '<p style="font-size: 15px;">'. esc_html__( '&#9957; If import process get stuck, please reload the page and click the "Import Demo" button again.', 'avas' ) .'</p>';
		$message .= '<p style="font-size: 15px;">'. esc_html__( '&#9957; By chance demo do not work properly after successfully imported then please reload the page and click the "Re-Import" button again.', 'avas' ) .'</p>';
		$message .= '<p style="font-size:15px">'. esc_html__( '&#9957; Please do not activate Child Theme and WPBakery plugin while import demo.', 'avas' ) .'</p>';
		
		$message .= '<p style="font-size:15px">'. esc_html__( '&#9957; If you plan to import more than one demo then please clear exising demo before import new demo. You can use "WP Reset" plugin to reset everything.', 'avas' ) .'</p>';
		$message .= '<p style="font-size:15px">'. esc_html__( '&#9957; Before start importing please check your server reserouce with our server minimum requirements.', 'avas' ) .'</p>';
		
		$message .= '<h3>'. esc_html__('Server Minimum Requirements','avas').'</h3>';
		$message .= '<p>'.esc_html__('&#8680; PHP version 5.6.20 or latest version','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; MySQL version 5.6 or greater / MariaDB version 10.0 or greater','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; WP Memory limit of 128 MB or greater','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; max_execution_time 360 (This needs to be increased if your server is slow and cannot import data.)','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; PHP Post Max Size: 128 MB or greater','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; Upload File Size: 128 MB','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; PHP Time Limit: 360','avas').'</p>';
		$message .= '<p>'.esc_html__('&#8680; Wordpress version 5.0 or greater','avas').'</p>';
		return $message;
	}

	// Uncomment the below
	 add_filter( 'wbc_importer_description', 'wbc_importer_description_text', 10 );
}

if ( !function_exists( 'wbc_importer_label_text' ) ) {

	/**
	 * Filter for changing importer label/tab for redux section in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $title label above demos
	 *
	 * @return [string] return no html
	 */

	function wbc_importer_label_text( $label_text ) {

		$label_text = esc_html__( 'Demo Import','avas' );

		return $label_text;
	}

	// Uncomment the below
	 add_filter( 'wbc_importer_label', 'wbc_importer_label_text', 10 );
}

if ( !function_exists( 'wbc_change_demo_directory_path' ) ) {

	/**
	 * Change the path to the directory that contains demo data folders.
	 *
	 * @param [string] $demo_directory_path
	 *
	 * @return [string]
	 */

	function wbc_change_demo_directory_path( $demo_directory_path ) {

		$demo_directory_path = TX_THEME_DIR .'inc/demo-data/';

		return $demo_directory_path;

	}

	// Uncomment the below
	 add_filter('wbc_importer_dir_path', 'wbc_change_demo_directory_path' );
}




/************************************************************************
* Extended Example:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/

if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/

		if ( class_exists( 'RevSliderSlider' ) ) {

			//Set slider zip name
			$wbc_sliders_array = array(
				'Agency' => 'avas-agency.zip', 
				'App' => 'avas-app.zip', 
				'Creative' => 'avas-creative.zip', 
				'Business' => 'avas-business.zip', 
				'Startup' => 'avas-startup.zip', 
				'Creative Agency' => 'avas-creative-agency.zip', 
				'News' => 'avas-news.zip', 
				'Digital Agency' => 'digital-agency.zip', 
				'Photographer' => 'avas-photographer.zip', 
				'Corporate' => 'avas-corporate.zip', 
				'Cleaning Services' => 'avas-cleaning-services.zip', 
				'Construction' => 'avas-construction.zip', 
				'Nice and Clean' => array('avas-nice-and-clean-header.zip','avas-nice-and-clean-services.zip','avas-nice-and-clean-projects.zip'),
				'Web Solutions' => array('avas-web-solutions.zip','avas-web-solutions-projects.zip'),
				'Finance' => 'avas-finance.zip',
				'Consultant' => 'avas-consultant.zip',
				'Lawyer' => 'avas-lawyer.zip',
				'Medical' => 'avas-medical.zip',
				'Gym' => 'avas-gym.zip',
				'Blog' => 'avas-blog.zip',
				'Charity' => 'avas-charity.zip',
				'Education' => 'avas-education.zip',
				'Shop' => 'avas-shop.zip',
				'Website Builder' => array('avas-website-builder.zip','avas-website-builder-discover.zip','avas-website-builder-customizable.zip'),
				'SEO' => 'avas-seo.zip',
				'Chef' => 'avas-chef.zip',
				'Insurance' => 'avas-insurance.zip',
				'Architecture' => 'avas-architecture.zip',
				'Music Band' => array('avas-music-band.zip','avas-music-band-videos.zip'),
				'Spa' => 'avas-spa.zip',
				'Barber Shop' => 'avas-barber-shop.zip',
				'Fitness' => 'avas-fitness.zip', 
				'Hosting' => 'avas-hosting.zip',
				'Kindergarten' => 'avas-kindergarten.zip',
				'Driving School' => 'avas-driving-school.zip',
				'Education Two' => 'avas-education-two.zip',
				'RTL' => 'avas-rtl.zip',
				'Wedding' => 'avas-wedding.zip',
				'Travel' => 'avas-travel.zip',
				'Restaurant' => 'avas-restaurant.zip',
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

					if(is_array($wbc_sliders_array[$demo_active_import[$current_key]['directory']])) {
						foreach ($wbc_sliders_array[$demo_active_import[$current_key]['directory']] as $key => $value) {
							$wbc_slider_import = $value;
							if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
								
									$slider = new RevSliderSliderImport();
								
								
								$slider->import_slider( true, $demo_directory_path.$wbc_slider_import );
							}
						}
					}
					else{
					$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
						if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
						
									$slider = new RevSliderSliderImport();
								
						$slider->import_slider( true, $demo_directory_path.$wbc_slider_import );
						}
					}
			}

		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/

		// set demo name
		$wbc_menu_array = array( 
			'Agency',
			'App',
			'Creative',
			'Business', 
			'Startup',
			'Creative Agency',
			'News', 
			'Digital Agency', 
			'Photographer', 
			'Corporate', 
			'Cleaning Services',
			'Construction',
			'Nice and Clean',
			'Web Solutions',
			'ICO Cryptocurrency',
			'Finance',
			'Consultant',
			'Lawyer',
			'Resume',
			'Medical',
			'Gym',
			'Magazine',
			'Blog',
			'Charity',
			'Education',
			'Shop',
			'Crypto News',
			'Website Builder',
			'SEO',
			'Chef',
			'Insurance',
			'Architecture',
			'Music Band',
			'Spa',
			'Barber Shop',
			'Fitness',
			'Hosting',
			'Kindergarten',
			'Driving School',
			'News Dark', 
			'Education Two', 
			'RTL', 
			'Wedding', 
			'Coronavirus',
			'Travel', 
			'Pinterest', 
			'Tattoo Parlour', 
			'Restaurant',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
			$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
			$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
			$left_menu = get_term_by( 'name', 'Left Menu', 'nav_menu' );
			$right_menu = get_term_by( 'name', 'Right Menu', 'nav_menu' );
			$side_menu = get_term_by( 'name', 'Side Menu', 'nav_menu' );
			$mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
			

			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'top_menu' => $top_menu->term_id,
						'main_menu' => $main_menu->term_id,
						'footer_menu'  => $footer_menu->term_id,
						'left_menu'  => $left_menu->term_id,
						'right_menu'  => $right_menu->term_id,
						'side_menu'  => $side_menu->term_id,
						'mobile_menu'  => $mobile_menu->term_id,
					)
				);
			}

		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'Agency' => 'Home Agency',
			'App' => 'Home App',
			'Creative' => 'Home Creative',
			'Business' => 'Home Business',
			'Startup' => 'Home Startup',
			'Creative Agency' => 'Home Creative Agency',
			'News' => 'Home News',
			'Digital Agency' => 'Home Digital Agency',
			'Photographer' => 'Home Photographer',
			'Corporate' => 'Home Corporate',
			'Cleaning Services' => 'Home Cleaning Services',
			'Construction' => 'Home Construction',
			'Nice and Clean' => 'Home Nice and Clean',
			'Web Solutions' => 'Home Web Solutions',
			'ICO Cryptocurrency' => 'Home ICO Cryptocurrency',
			'Finance' => 'Home Finance',
			'Consultant' => 'Home Consultant',
			'Lawyer' => 'Home Lawyer',
			'Resume' => 'Home Resume',
			'Medical' => 'Home Medical',
			'Gym' => 'Home Gym',
			'Magazine' => 'Home Magazine',
			'Blog' => 'Home Blog',
			'Charity' => 'Home Charity',
			'Education' => 'Home Education',
			'Shop' => 'Home Shop',
			'Crypto News' => 'Home Crypto News',
			'Website Builder' => 'Home Website Builder',
			'SEO' => 'Home SEO',
			'Chef' => 'Home Chef',
			'Insurance' => 'Home Insurance',
			'Architecture' => 'Home Architecture',
			'Music Band' => 'Home Music Band',
			'Spa' => 'Home Spa',
			'Barber Shop' => 'Home Barber Shop',
			'Fitness' => 'Home Fitness',
			'Hosting' => 'Home Hosting',
			'Kindergarten' => 'Home Kindergarten',
			'Driving School' => 'Home Driving School',
			'News Dark'	=> 'Home News Dark',
			'Education Two'	=> 'Home Education Two',
			'RTL' => 'Home RTL',
			'Wedding' => 'Home Wedding',
			'Coronavirus' => 'Home Coronavirus',
			'Travel' => 'Home Travel',
			'Pinterest' => 'Home Pinterest',
			'Tattoo Parlour' => 'Home Tattoo Parlour',
			'Restaurant' => 'Home Restaurant',
			
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}

		// remove hello world post 
		wp_delete_post( 1, true );

	}


	// Uncomment the below
	 add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}

?>