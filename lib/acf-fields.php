<?php

/**
 * Main Organik_Jobs_ACF_Fields class
 */
class Organik_Jobs_ACF_Fields {

	/**
     * Constructor function
     */
	public function __construct() {

		// Hook into the 'init' action to add the ACF Fields on to CPT
		add_filter( 'init', array( $this, 'orgnk_jobs_cpt_acf_fields' ) );
	}

	/**
	 * orgnk_jobs_cpt_acf_fields()
	 * Manually insert ACF fields for this CPT
	 */
	public function orgnk_jobs_cpt_acf_fields() {

		// Return early if ACF isn't active
		if ( ! class_exists( 'ACF' ) || ! function_exists( 'acf_add_local_field_group' ) || ! is_admin() || ! defined( 'ORGNK_JOBS_CPT_NAME' ) ) return;

        // ACF Field Group for Single Job
        acf_add_local_field_group(array(
            'key'       => 'group_604174c5c66b1',
            'title'     => 'Single Job Settings',
            'fields'    => array(

                // Field - Job Location - Text
                array(
                    'key'               => 'field_604174d0d8ac2',
                    'label'             => 'Location',
                    'name'              => 'job_location',
                    'type'              => 'text',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width'     => '',
                        'class'     => '',
                        'id'        => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                    'prepend'           => '',
                    'append'            => '',
                    'maxlength'         => '',
                ),

                // Field - Employment Type - Text
                array(
                    'key'               => 'field_604174dbd8ac3',
                    'label'             => 'Employment Type',
                    'name'              => 'job_employment_type',
                    'type'              => 'text',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width'     => '',
                        'class'     => '',
                        'id'        => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                    'prepend'           => '',
                    'append'            => '',
                    'maxlength'         => '',
                ),

                // Field - Application Type - Button Group
                array(
                    'key'               => 'field_604186a79555b',
                    'label'             => 'Application Type',
                    'name'              => 'job_application_type',
                    'type'              => 'button_group',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width'     => '',
                        'class'     => '',
                        'id'        => '',
                    ),
                    'choices'           => array(
                        'url'       => 'URL',
                        'email'     => 'email',
                    ),
                    'allow_null'        => 0,
                    'default_value'     => '',
                    'layout'            => 'horizontal',
                    'return_format'     => 'value',
                ),

                // Field - Application Link - Url
                array(
                    'key'               => 'field_60583bbe31913',
                    'label'             => 'Application Link',
                    'name'              => 'job_application_link',
                    'type'              => 'url',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'     => 'field_604186a79555b',
                                'operator'  => '==',
                                'value'     => 'url',
                            ),
                        ),
                    ),
                    'wrapper'           => array(
                        'width'     => '',
                        'class'     => '',
                        'id'        => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                ),

                // Field - Application Email - email
                array(
                    'key'               => 'field_60583bfd31914',
                    'label'             => 'Application Email',
                    'name'              => 'job_application_email',
                    'type'              => 'email',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'     => 'field_604186a79555b',
                                'operator'  => '==',
                                'value'     => 'email',
                            ),
                        ),
                    ),
                    'wrapper'           => array(
                        'width'     => '',
                        'class'     => '',
                        'id'        => '',
                    ),
                    'default_value'     => '',
                    'placeholder'       => '',
                    'prepend'           => '',
                    'append'            => '',
                ),
            ),

            // Location Rules - Single Job CPT
            'location' => array(
                array(
                    array(
                        'param'     => 'post_type',
                        'operator'  => '==',
                        'value'     => 'job',
                    ),
                ),
            ),
            'menu_order'                => 0,
            'position'                  => 'acf_after_title',
            'style'                     => 'default',
            'label_placement'           => 'left',
            'instruction_placement'     => 'label',
            'hide_on_screen'            => '',
            'active'                    => true,
            'description'               => '',
        ));
    }
}