<?php
/**
 * @package WordPress
 * @subpackage Tasty
 */

class Settings {
    function defaults() {
        $defaults->color = 'pink';
        $defaults->sidebar_alignment = 'left';
        return $defaults;
    }
    
    function get_settings() {
        $saved_settings = maybe_unserialize(get_option('tasty_settings'));
        
        if (!empty($saved_settings) && is_object($saved_settings)) {
            foreach ($saved_settings as $setting => $value)
                $this->$setting = $value;
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