<?php
/**
 * This class defines all code necessary to run during the plugin's activation and deactivation behaviour
 */
class Organik_Jobs_Activator {

	/**
	 * Activation behaviour
	 */
	public static function activate() {
        flush_rewrite_rules();
    }
    
    /**
	 * Deactivation behaviour
	 */
	public static function deactivate() {
        flush_rewrite_rules();
	}
}
