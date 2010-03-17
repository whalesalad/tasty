<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

class Settings {
    function __construct() {
        $this->get_settings();
        // update_option('tasty_settings', NULL);
    }
    
    function defaults() {
        $defaults->color = 'pink';
        $defaults->sidebar_alignment = 'right';
        $defaults->disable_header_text = false;
        $defaults->disable_header_search = false;
        $defaults->socialgrid_enabled = true;
        $defaults->background_color = '#333333';
        $defaults->footer_color = '#FFF';
        return $defaults;
    }
    
    function get_settings() {
        $saved_settings = maybe_unserialize(get_option('tasty_settings'));
        $defaults = $this->defaults();
        
        if (!empty($saved_settings) && is_object($saved_settings)) {
            foreach ($saved_settings as $setting => $value)
                if (empty($setting)) {
                    $this->$setting = $defaults->$setting;
                } else {
                    $this->$setting = $value;
                }
                
        }
        
        if (empty($saved_settings)) {
            update_option('tasty_settings', $defaults);
        }
    }
    
    function save_settings() {
        $default_settings = $this->defaults();
        
        foreach ($default_settings as $setting => $value) {
            if (!isset($this->$setting))
                $this->$setting = $default_settings->$setting;
        }
        
        update_option('tasty_settings', $this);
    }
}

?>