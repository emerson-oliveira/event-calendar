<?php

/**
 * @package Event Calendar
 * Configure all necessary settings for the plugin
 */

namespace Includes\Base;

class Settings
{
    /**
     * Register plugin icon in menu
     *
     * @return void
     * @author Emerson Oliveira <emerson-ods@hotmail.com>
     */
    public function register()
    {

        add_action('init', array($this, 'register_post_type'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('tgmpa_register', array($this, 'check_required_plugins'));
        add_filter('rwmb_meta_boxes', array($this, 'meta_box_info_event'));
    }

    /**
     * Register custom post type
     *
     * @return void
     * @author Emerson Oliveira <emerson-ods@hotmail.com>
     */

    public function register_post_type()
    {

        register_post_type(
            'pl_event_calendar',
            array(

                'labels' => array(
                    'name'               => esc_html__('Events', TEXT_DOMAIN),
                    'singular_name'      => esc_html__('Event', TEXT_DOMAIN),
                    'add_new'            => esc_html__('Add New', TEXT_DOMAIN),
                    'add_new_item'       => esc_html__('Add New Event', TEXT_DOMAIN)
                ),

                'description'       => 'Holds our events and event specific data',
                'supports'          =>
                array(

                    'title', 'editor', 'thumbnail'
                ),
                'has_archive' => true,
                'menu_icon' => 'dashicons-calendar-alt',
                'public'    =>  TRUE,
                'menu_position'     => 4,
            )
        );
    }

    /**
     * Register taxonomy 
     *
     * @return void
     * @author Emerson Oliveira <emerson-ods@hotmail.com>
     */
    public function register_taxonomies()
    {
        register_taxonomy(
            'event_category',
            array('pl_event_calendar'),
            array(

                'labels' => array(

                    'name' => esc_html__('Event Categories', TEXT_DOMAIN),
                    'singular_name' => esc_html__('Event Category', TEXT_DOMAIN),
                    'search_items' => esc_html__('Search Event Categories', TEXT_DOMAIN),
                    'all_items' =>   esc_html__('All Categories', TEXT_DOMAIN),
                    'parent_item' => esc_html__('Parent Event Category', TEXT_DOMAIN),
                    'parent_item_colon' => esc_html__('Parent Event Category:', TEXT_DOMAIN),
                    'edit_item' => esc_html__('Edit Event Category', TEXT_DOMAIN),
                    'update_item' => esc_html__('Update Event Category', TEXT_DOMAIN),
                    'add_new_item' =>  esc_html__('Add New Event Category', TEXT_DOMAIN),
                    'new_item_name' => esc_html__('Add New Event Category', TEXT_DOMAIN),
                    'menu_name' => esc_html__('Event Categories', TEXT_DOMAIN),

                ),

                'public' => TRUE,
                'show_ui' => TRUE,
                'show_admin_column' => TRUE,
                'hierarchical' => TRUE,
                'query_var' => TRUE,
                'rewrite'  => array('slug' => 'cagetory'),
            )

        );
    }


    /**
     * Register custom fields
     *
     * @param array $meta_boxes
     * @return void
     * @author Emerson Oliveira <emerson-ods@hotmail.com>
     */
    public function meta_box_info_event(array $meta_boxes)
    {

        $meta_boxes[] = array(
            'id' => 'date_event',
            'title' => esc_html__('Date of the event', TEXT_DOMAIN),
            'post_types' => array('post', 'page'),
            'pages'     => array('pl_event_calendar', 'post'),
            'context' => 'advanced',
            'priority' => 'default',
            'autosave' => 'false',
            'fields' => array(
                array(
                    'id' => FILED_PREFIX . 'start_date',
                    'type' => 'date',
                    'name' => esc_html__('Start Date', TEXT_DOMAIN),
                ),
                array(
                    'id' => FILED_PREFIX . 'start_time',
                    'name' => esc_html__('Start Time', TEXT_DOMAIN),
                    'type' => 'time',
                ),
                array(
                    'id' => FILED_PREFIX . 'end_date',
                    'type' => 'date',
                    'name' => esc_html__('End Date', TEXT_DOMAIN),
                ),
                array(
                    'id' => FILED_PREFIX . 'end_time',
                    'name' => esc_html__('End Time', TEXT_DOMAIN),
                    'type' => 'time',
                ),
                array(
                    'id' => FILED_PREFIX . 'allday',
                    'name' => esc_html__('All day', TEXT_DOMAIN),
                    'type' => 'checkbox',
                ),
                array(
                    'id' => FILED_PREFIX . 'recurrence',
                    'name' => esc_html__('Recurrence', TEXT_DOMAIN),
                    'type' => 'select',
                    'options' => array(
                        'recurrence-event-none' => esc_html__('none', TEXT_DOMAIN),
                        'recurrence-event-daily' => esc_html__('daily', TEXT_DOMAIN),
                        'recurrence-event-weekly' => esc_html__('weekly', TEXT_DOMAIN),
                        'recurrence-event-monthly' => esc_html__('monthly', TEXT_DOMAIN),
                        'recurrence-event-yearly' => esc_html__('yearly', TEXT_DOMAIN),
                    ),
                    'std' => 'recurrence-event-none',
                ),
            ),
        );

        $meta_boxes[] = array(
            'id' => 'external-link',
            'title' => esc_html__('Event Website', TEXT_DOMAIN),
            'post_types' => array('post', 'page'),
            'pages' => array('pl_event_calendar', 'post'),
            'context' => 'advanced',
            'priority' => 'default',
            'autosave' => 'false',
            'fields' => array(
                array(
                    'id' => FILED_PREFIX . 'website',
                    'type' => 'url',
                    'name' => esc_html__('URL:', TEXT_DOMAIN),
                    'placeholder' => esc_html__('www.myevent.com', TEXT_DOMAIN),
                ),
            ),
        );

        $meta_boxes[] = array(
            'id' => 'venue',
            'title' => esc_html__('Venue:', TEXT_DOMAIN),
            'post_types' => array('post', 'page'),
            'pages' => array('pl_event_calendar', 'post'),
            'context' => 'advanced',
            'priority' => 'default',
            'autosave' => 'false',
            'fields' => array(
                array(
                    'id' => FILED_PREFIX . 'vn_name',
                    'type' => 'text',
                    'name' => esc_html__('Venue Name:', TEXT_DOMAIN),
                ),
                array(
                    'id' => FILED_PREFIX . 'vn_address',
                    'type' => 'text',
                    'name' => esc_html__('Address:', TEXT_DOMAIN),
                ),
                array(
                    'id' => FILED_PREFIX . 'vn_city',
                    'type' => 'text',
                    'name' => esc_html__('City:', TEXT_DOMAIN),
                ),
                array(
                    'id' => FILED_PREFIX . 'vn_country',
                    'type' => 'text',
                    'name' => esc_html__('Country:', TEXT_DOMAIN),
                ),
                array(
                    'id' => FILED_PREFIX . 'vn_state',
                    'type' => 'text',
                    'name' => esc_html__('State or Province:', TEXT_DOMAIN),
                ),
            ),
        );

        return $meta_boxes;
    }
}
