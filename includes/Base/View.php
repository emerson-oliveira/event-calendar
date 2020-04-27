<?php

/**
 * @package Event Calendar
 * Configure all necessary settings for the plugin
 */

namespace Includes\Base;

class View
{
    public function register()
    {
        add_filter('template_include', array($this, 'add_template_html'));
    }

    public function add_template_html(string $template)
    {

        if (is_singular('pl_event_calendar')) {
            if (file_exists(get_stylesheet_directory() . 'assets/single-template.php')) {
                return get_stylesheet_directory() . 'assets/single-template.php';
            }
            return PLUGIN_DIR . 'assets/single-template.php';
        } elseif (is_archive('pl_event_calendar')) {
            if (file_exists(get_stylesheet_directory() . 'assets/page-template.php')) {
                return get_stylesheet_directory() . 'assets/page-template.php';
            }
            return PLUGIN_DIR . 'assets/page-template.php';
        }

        return $template;
    }
}
