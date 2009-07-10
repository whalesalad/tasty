<?php
/**
 * @package Word-Press
 * @subpackage Tasty
 */

class Settings {
    function __construct() {
        $this->get_settings();
    }
    
    function defaults() {
        $defaults->color = 'pink';
        $defaults->sidebar_alignment = 'right';
        $defaults->header_text = false;
        $defaults->header_search = false;
        $defaults->socialgrid_enabled = true;
        return $defaults;
    }
    
    function get_settings() {
        $saved_settings = maybe_unserialize(get_option('tasty_settings'));
        
        if (!empty($saved_settings) && is_object($saved_settings)) {
            foreach ($saved_settings as $setting => $value)
                $this->$setting = $value;
        }
        
        if (empty($saved_settings)) {
            $defaults = $this->defaults();
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