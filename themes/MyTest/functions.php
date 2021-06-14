<?php 

/* =========================================================================
* THEMING
===========================================================================*/
define('THEME_DIR', get_template_directory_uri());
define('THEME_DOMAIN', 'mytest');

// Register all scripts ----------------------------------------------------
function mytest_theme_register_assets() {
    // Scripts List
    $mytest_theme_register_script = array(
        array(
			'name'      => 'mytest-script',
			'src'       => THEME_DIR. '/js/script.js',
			'deps'      => array(),
			'ver'       => '3.0.2',
			'in_footer' => true,
		)
    ); 
    
    // Styles List
    $mytest_theme_register_style = array(
		array(
			'name' => 'mytest-style',
			'src'    => THEME_DIR. '/style.css',
			'deps'   => array(),
			'ver'    => '1.0.0',
			'media'  => 'all',
		)
    );

    $mytest_theme_register_style   = apply_filters('mytest_theme_register_style', $mytest_theme_register_style);
    $mytest_theme_register_script  = apply_filters('mytest_theme_register_script', $mytest_theme_register_script);

	foreach($mytest_theme_register_style as $style){
		wp_register_style($style['name'], $style['src'], $style['deps'], $style['ver'], $style['media'] );
	}

	foreach($mytest_theme_register_script as $script){
		wp_register_script($script['name'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] ); 
	}
}
add_action('init', 'mytest_theme_register_assets');

// Enqueue Scripts ---------------------------------------------------------
function mytest_theme_options_enqueue_scripts() {
	wp_enqueue_style('mytest-style');
	wp_enqueue_script('mytest-script');
}
add_action('wp_enqueue_scripts', 'mytest_theme_options_enqueue_scripts', 10);


// Menus -------------------------------------------------------------------
function mytest_register_theme_menus() {
    register_nav_menus(
        array('header-menu'      => __('Header Menu', THEME_DOMAIN))
    );
}
add_action('init', 'mytest_register_theme_menus');


/* =========================================================================
* SETUP 
===========================================================================*/
function mytest_theme_setup() {
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ));
    
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'square', 600, 552, true);
	add_image_size( 'post-preview', 600, 288, true);

	// Dependency
	if(!function_exists('get_field') && !is_admin()) { die('You must install all the required plugins in the admin panel'); } 
}
add_action('after_setup_theme', 'mytest_theme_setup');


/* =========================================================================
* REQUIRED PLUGINS
===========================================================================*/
define('INCLUDE_PATH', get_template_directory().'/includes');
define('TGMPA_PATH', INCLUDE_PATH.'/tgm_pa' );

require_once TGMPA_PATH . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'mytest_register_required_plugins' );

function mytest_register_required_plugins() {
	$plugins = array(
		array(
			'name' 		=> 'Advanced Custom Fields',
			'slug' 		=> 'advanced-custom-fields',
			'required' 	=> true,
			'force_activation' => true
		),
	);

	$config = array(
		'id'           => 'mytest',                // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/* =========================================================================
* PLUGIN: ADVANCED CUSTOM FIELDS
===========================================================================*/
add_filter('acf/settings/show_admin', 'mytest_settings_show_admin');
function mytest_settings_show_admin( $show_admin ) {
    return true;
}

function mytest_add_local_field_groups() {

	// Options only in front page
	$frontpage_id = get_option( 'page_on_front' );
	$location = $frontpage_id ? array(
		'param' => 'page',
		'operator' => '==',
		'value' => $frontpage_id
	) : array(
		'param' => 'post_type',
		'operator' => '==',
		'value' => 'page'
	);

	// Fields Main Banner
	acf_add_local_field_group(array(
		'key' => 'page_options_banner',
		'title' => 'Main Banner',
		'fields' => array (
			array (
				'key' 		    => 'home_banner_background',
				'label' 	    => 'Banner Background Color',
				'name' 		    => 'banner_bg_color',
				'type' 		    => 'color_picker',
				'default_value' => '#EBEBEB',
			),
			array (
				'key' 		    => 'home_banner_color',
				'label' 	    => 'Banner Text Color',
				'name' 		    => 'banner_text_color',
				'type' 		    => 'color_picker',
				'default_value' => '#000',
			),
			array (
				'key' 		    => 'home_banner_subtitle',
				'label' 	    => 'Banner Subtitle',
				'name' 		    => 'banner_subtitle',
				'type' 		    => 'text',
				'default_value' => __('Well, Hello there', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_banner_title',
				'label' 	    => 'Banner Title',
				'name' 		    => 'banner_title',
				'type' 		    => 'textarea',
				'rows' 		    => '3',
				'new_lines'     => 'br',
				'default_value' => __("This is where your \nmessage should go.", THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_banner_button_label',
				'label' 	    => 'Banner Button Label',
				'name' 		    => 'banner_button_label',
				'type' 		    => 'text',
				'instructions'  => 'Add a button on the main home banner',
				'default_value' => __('DOWNLOAD NOW', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_banner_button_href',
				'label' 	    => 'Banner Button Link',
				'name' 		    => 'banner_button_href',
				'type' 		    => 'url',
				'placeholder'   => 'https://',
				'default_value' => __('', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_banner_button_file',
				'label' 	    => 'Banner Button File',
				'name' 		    => 'banner_button_file',
				'type' 		    => 'file',
				'instructions'  => 'If you want that button downloads a file instead of a simple link upload it'
			),
		),
		'location' => array ( array ($location) ),
	));

	// Fields Feature Block
	acf_add_local_field_group(array(
		'key' => 'page_options_feature',
		'title' => 'Feature',
		'fields' => array (
			array (
				'key' 		    => 'home_feature_image',
				'label' 	    => 'Feature Image',
				'name' 		    => 'feature_image',
				'type' 		    => 'image',
				'return_format' => 'id',
			),
			array (
				'key' 		    => 'home_feature_title',
				'label' 	    => 'Feature Title',
				'name' 		    => 'feature_title',
				'type' 		    => 'text',
				'default_value' => __('Get the New Razda template', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_feature_subtitle',
				'label' 	    => 'Feature Subtitle',
				'name' 		    => 'feature_subtitle',
				'type' 		    => 'text',
				'default_value' => __('The best new way to showcase your work', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_feature_content',
				'label' 	    => 'Feature Content',
				'name' 		    => 'feature_content',
				'type' 		    => 'wysiwyg'
			),
			array (
				'key' 		    => 'home_feature_button_label',
				'label' 	    => 'Feature Button Label',
				'name' 		    => 'feature_button_label',
				'type' 		    => 'text',
				'instructions'  => 'Add a button on the main home banner',
				'default_value' => __('DOWNLOAD NOW', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_feature_button_href',
				'label' 	    => 'Feature Button Link',
				'name' 		    => 'feature_button_href',
				'type' 		    => 'url',
				'placeholder'   => 'https://',
				'default_value' => __('', THEME_DOMAIN),
			),
			array (
				'key' 		    => 'home_feature_button_file',
				'label' 	    => 'Feature Button File',
				'name' 		    => 'feature_button_file',
				'type' 		    => 'file',
				'instructions'  => 'If you want that button downloads a file instead of a simple link upload it'
			),
		),
		'location' => array ( array ($location) ),
	));
}
add_action('acf/init', 'mytest_add_local_field_groups');

/* =========================================================================
* CUSTOMIZER OPTIONS
===========================================================================*/
if(!class_exists('MyTest_Customize')) {
	class MyTest_Customize {
		// This hooks into 'custome_register' and allows you to add new sections and controls to the Theme Customize
		public static function register($wp_customize) { 

			// Settings
			$wp_customize->add_setting('mytest_logo');
			$wp_customize->add_setting('mytest_phone');
			$wp_customize->add_setting('mytest_copyright');

			// Controls
			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mytest_logo',
				array(
					'label' => 'Upload Logo',
					'section' => 'title_tagline',
					'settings' => 'mytest_logo',
					'description' => __('Allows you to customize the header logo.', THEME_DOMAIN), 
					'transport'  => 'postMessage'
				) 
			));
			
			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mytest_phone',
				array(
					'label' => 'Phone',
					'section' => 'title_tagline',
					'settings' => 'mytest_phone',
					'description' => __('Set a phone number to display at the footer.', THEME_DOMAIN), 
					'transport'  => 'postMessage'
				) 
			));
			
			$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mytest_copyright',
				array(
					'label' => 'Copyright',
					'section' => 'title_tagline',
					'settings' => 'mytest_copyright',
					'description' => __('Set the copyright to display at the footer.', THEME_DOMAIN), 
					'transport'  => 'postMessage'
				) 
			));
		}
	}
}
add_action( 'customize_register' , array( 'MyTest_Customize' , 'register' ) );


/* =========================================================================
* HELPERS
===========================================================================*/
function mytest_get_excerpt( $limit = 100 ){
	global $post;
	$excerpt = strip_tags(get_the_excerpt());
	$excerpt = substr($excerpt, 0, $limit);
	$excerpt .= strlen($excerpt) == $limit ? '...' : '';
	return $excerpt;
}

/* =========================================================================
* STYLE RULES
===========================================================================*/
function mytest_theme_style_rules() { 
	if(function_exists('acf_add_local_field_group')):
	
		$main_banner_background_color = get_field('home_banner_background') ?? '#EBEBEB'; 
		$main_banner_text_color 	  = get_field('home_banner_color') ?? '#000'; 

		?><style>
			.main__banner {
				background-color: <?php echo $main_banner_background_color ?>;
				color: <?php echo $main_banner_text_color; ?>;
			}
		</style>
	
	<?php endif; 
}
add_filter('wp_head', 'mytest_theme_style_rules');

?>