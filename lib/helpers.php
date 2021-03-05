<?php
//=======================================================================================================================================================
// Jobs helper & templating functions
//=======================================================================================================================================================

/**
 * orgnk_jobs_entry_apply_button()
 * Generates an offsite apply button for a job
 * Accepts a string for changing the button text
 */
function orgnk_jobs_entry_apply_button( $button_text = 'Apply now' ) {
	
	$output     = NULL;
	$link       = esc_url( get_post_meta( get_the_ID(), 'job_application_link', true ) );

	if ( $link ) { 
        $output .= '<a class="primary-button" href="' . $link . '" target="_blank" rel="noopener">' . $button_text . '</a>';
	}

	return $output;
}

//=======================================================================================================================================================

/**
 * orgnk_jobs_entry_meta_table()
 * Generates a table of the event's details
 */
function orgnk_jobs_entry_meta_table( $heading_text = 'Job details', $heading_size = 'h3' ) {

	$output         	= NULL;

	// Variables
	$location       	= esc_html( get_post_meta( get_the_ID(), 'job_location', true ) );
	$employment_type	= esc_html( get_post_meta( get_the_ID(), 'job_employment_type', true ) );

	if ( $location || $employment_type ) {

		$output .= '<div class="entry-meta entry-meta-table job-entry-meta">';

			$output .= '<div class="meta-table-header">';
			$output .= '<span class="title ' . $heading_size . '">' . $heading_text . '</span>';
			$output .= '</div>';

			$output .= '<div class="meta-table-wrap">';

                if ( $location ) {

                    $output .= '<div class="meta-group location">';

                        $output .= '<div class="group-label">';
                            $output .= '<i class="icon location"></i>';
                            $output .= '<span class="label">Location</span>';
                        $output .= '</div>';

                        $output .= '<div class="group-content">';
                            $output .= $location;
                        $output .= '</div>';

                    $output .= '</div>';
                }

				if ( $employment_type ) {

					$output .= '<div class="meta-group employment-type">';

						$output .= '<div class="group-label">';
							$output .= '<i class="icon employment-type"></i>';
							$output .= '<span class="label">Employment type</span>';
						$output .= '</div>';

						$output .= '<div class="group-content">';
							$output .= $employment_type;
						$output .= '</div>';

					$output .= '</div>';
				}

			$output .= '</div>';
		$output .= '</div>';
	}

	return $output;
}
