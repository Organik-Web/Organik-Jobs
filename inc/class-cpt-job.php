<?php
/**
 * Define constant variables
 */
define( 'ORGNK_JOBS_CPT_NAME', 'job' );
define( 'ORGNK_JOBS_SINGLE_NAME', 'Job' );
define( 'ORGNK_JOBS_PLURAL_NAME', 'Jobs' );

/**
 * Main Organik_Jobs class
 */
class Organik_Jobs {

	/**
     * The single instance of Organik_Jobs
     */
	private static $instance = null;

	/**
     * Main class instance
     * Ensures only one instance of this class is loaded or can be loaded
     */
    public static function instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
	}
	
	/**
     * Constructor function
     */
	public function __construct() {

		// Define the CPT rewrite variable on init - required here because we need to use get_permalink() which isn't available when plugins are initialised
		add_action( 'init', array( $this, 'orgnk_jobs_cpt_rewrite_slug' ) );

		// Hook into the 'init' action to add the Custom Post Type
		add_action( 'init', array( $this, 'orgnk_jobs_cpt_register' ) );

        // Change the title placeholder
		add_filter( 'enter_title_here', array( $this, 'orgnk_jobs_cpt_title_placeholder' ) );

		// Modify the archive query
		add_filter( 'pre_get_posts', array( $this, 'orgnk_jobs_cpt_archive_query' ) );
	}
	
	/**
	 * orgnk_jobs_cpt_register()
	 * Register the custom post type
	 */
	public function orgnk_jobs_cpt_register() {

		$labels = array(
			'name'                      	=> ORGNK_JOBS_PLURAL_NAME,
			'singular_name'             	=> ORGNK_JOBS_SINGLE_NAME,
			'menu_name'                 	=> ORGNK_JOBS_PLURAL_NAME,
			'name_admin_bar'            	=> ORGNK_JOBS_SINGLE_NAME,
			'archives'              		=> 'Job archives',
			'attributes'            		=> 'Job Attributes',
			'parent_item_colon'     		=> 'Parent job:',
			'all_items'             		=> 'All jobs',
			'add_new_item'          		=> 'Add new job',
			'add_new'               		=> 'Add new job',
			'new_item'              		=> 'New job',
			'edit_item'             		=> 'Edit job',
			'update_item'           		=> 'Update job',
			'view_item'             		=> 'View job',
			'view_items'            		=> 'View jobs',
			'search_items'          		=> 'Search job',
			'not_found'             		=> 'Not found',
			'not_found_in_trash'    		=> 'Not found in Trash',
			'featured_image'        		=> 'Featured Image',
			'set_featured_image'    		=> 'Set featured image',
			'remove_featured_image' 		=> 'Remove featured image',
			'use_featured_image'    		=> 'Use as featured image',
			'insert_into_item'      		=> 'Insert into job',
			'uploaded_to_this_item' 		=> 'Uploaded to this job',
			'items_list'            		=> 'Jobs list',
			'items_list_navigation' 		=> 'Jobs list navigation',
			'filter_items_list'     		=> 'Filter jobs list'
		);
	
		$rewrite = array(
			'slug'                  		=> ORGNK_JOBS_REWRITE_SLUG, // The slug for single posts
			'with_front'            		=> false,
			'pages'                 		=> true,
			'feeds'                 		=> false
		);
	
		$args = array(
			'label'                 		=> ORGNK_JOBS_SINGLE_NAME,
			'description'           		=> 'Manage and display jobs',
			'labels'                		=> $labels,
			'supports'              		=> array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'            		=> array(),
			'hierarchical'          		=> false,
			'public'                		=> true,
			'show_ui'               		=> true,
			'show_in_menu'          		=> true,
			'menu_position'         		=> 25,
			'menu_icon'             		=> 'dashicons-portfolio',
			'show_in_admin_bar'     		=> true,
			'show_in_nav_menus'     		=> true,
			'can_export'            		=> true,
			'has_archive'           		=> true, // The slug for archive, bool toggle archive on/off
			'publicly_queryable'    		=> true, // Bool toggle single on/off
			'exclude_from_search'   		=> false,
			'capability_type'       		=> 'page',
			'rewrite'						=> $rewrite
		);
		register_post_type( ORGNK_JOBS_CPT_NAME, $args );
	}

	/**
	 * orgnk_jobs_cpt_rewrite_slug()
	 * Conditionally define the CPT archive permalink based on the pages for CPT functionality in Organik themes
	 * Includes a fallback string to use as the slug if the option isn't set
	 */
	public function orgnk_jobs_cpt_rewrite_slug() {
		$default_slug = 'careers';
		$archive_page_id = get_option( 'page_for_' . ORGNK_JOBS_CPT_NAME );
		$archive_page_slug = str_replace( home_url(), '', get_permalink( $archive_page_id ) );
		$archive_permalink = ( $archive_page_id ? $archive_page_slug : $default_slug );
		$archive_permalink = ltrim( $archive_permalink, '/' );
		$archive_permalink = rtrim( $archive_permalink, '/' );

		define( 'ORGNK_JOBS_REWRITE_SLUG', $archive_permalink );
	}

	/** 
	 * orgnk_jobs_cpt_title_placeholder()
	 * Change CPT title placeholder on edit screen
	 */
	public function orgnk_jobs_cpt_title_placeholder( $title ) {

		$screen = get_current_screen();

		if ( $screen && $screen->post_type == ORGNK_JOBS_CPT_NAME ) {
			return 'Add job title';
		}

		return $title;
	}

	/**
	 * orgnk_jobs_cpt_archive_query()
	 * Change the number of 'posts per page' for the CPT archive
	 */
	public function orgnk_jobs_cpt_archive_query( $query ) {

		if ( $query->is_post_type_archive( ORGNK_JOBS_CPT_NAME ) && ! is_admin() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', -1 ); // No limit so display all
		}

		return $query;
	}
}
