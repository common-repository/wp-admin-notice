<?php
/*
  Plugin Name: WP Admin Notice
  Plugin URI: http://aiddroid.com
  Description: This plugin allows you to show a simple notice to alert admins.
  Version: 1.0.0
  Author: Allen Hu
  Author URI: http://aiddroid.com
 */

/*  Copyright 2015 Allen Hu <aiddroid@gmail.com>

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

//register js css scripts
add_action('admin_init', 'wp_admin_notice_admin_init');
//setup admin setting menu
add_action('admin_menu', 'wp_admin_notice_setup_admin');
//inject admin notice
add_action('admin_notices','wp_admin_notice_inject_notice');

/**
 * Adds the action link to settings. That's from Plugins. It is a nice thing.
 * @param type $links
 * @param type $file
 * @return type
 */
function wp_admin_notice_add_quick_settings_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $link = admin_url('options-general.php?page=' . plugin_basename(__FILE__));
        $dashboard_link = "<a href=\"{$link}\">".__('Settings')."</a>";
        array_unshift($links, $dashboard_link);
    }

    return $links;
}

/**
 * Init plugin and register js css scripts
 * @global string $wp_version
 */
function wp_admin_notice_admin_init() {
    wp_admin_notice_register_settings();

    global $wp_version;

    $color_picker = version_compare($wp_version, '3.5') >= 0 ? 'wp-color-picker' // new WP
            : 'farbtastic'; // old WP

    wp_enqueue_style($color_picker);
    wp_enqueue_script($color_picker);

    wp_register_script('simple_notice_admin', plugins_url("/assets/admin.js", __FILE__), array('jquery',), '1.0', true);
    wp_enqueue_script('simple_notice_admin');
}

/**
 * Inject notice to pages
 * @global string $pagenow current page,for example 'plugins.php'
 * @return type
 */
function wp_admin_notice_inject_notice() {
    global $pagenow;
    // This applies only for the live site.
    if ( defined( 'DOING_AJAX' ) || !is_admin()) {
        return;
    }

    echo get_wp_admin_notice_html();
}

/**
 * get notice html
 * @return string $html
 */
function get_wp_admin_notice_html(){
    $opts = wp_admin_notice_get_options();
    if($opts['status']){
        $notice = $opts['notice'] ? $opts['notice'] : '';
        $text_color = $opts['text_color'] ? $opts['text_color'] : '#444';
        $font_size = $opts['font_size'] ? $opts['font_size'] : '12px';
        $style = $opts['style'] ? $opts['style'] : 'updated';
        return "<div class='{$style}'><p style='color:{$text_color};font-size:{$font_size}'>{$notice}</p></div>";
    }
    return '';
}

/**
 * setup admin menu
 */
function wp_admin_notice_setup_admin() {
    add_options_page('WP Admin Notice', 'WP Admin Notice', 'manage_options', __FILE__, 'wp_admin_notice_options_page');

    add_filter('plugin_action_links', 'wp_admin_notice_add_quick_settings_link', 10, 2);
}

/**
 * Sets the setting variables
 */
function wp_admin_notice_register_settings() { // whitelist options
    register_setting('wp_admin_notice_settings', 'wp_admin_notice_options', 'wp_admin_notice_validate_settings');
}

/**
 * This is called by WP after the user hits the submit button.
 * The variables are trimmed first and then passed to the who ever wantsto filter them.
 * @param array the entered data from the settings page.
 * @return array the modified input array
 */
function wp_admin_notice_validate_settings($input) { // whitelist options
    $input = array_map('trim', $input);

    // did the extension break stuff?
    $input = is_array($input_filtered) ? $input_filtered : $input;

    // for font size we want 12px
    if ($input['font_size']) {
        $input['font_size'] = preg_replace('#\s#si', '', $input['font_size']);
    }

    return $input;
}

/**
 * Retrieves the plugin options. It inserts some defaults.
 * The saving is handled by the settings page. Basically, we submit to WP and it takes care of the saving.
 * @return array $opts
 */
function wp_admin_notice_get_options() {
    $defaults = array(
        'status' => 0,
        'text_color' => '#444',
        'font_size' => '12px',
        'style' => 'updated',
        'notice' => 'We are going to be doing server maintenance at 9pm today.',
    );

    $opts = get_option('wp_admin_notice_options');

    $opts = (array) $opts;
    $opts = array_merge($defaults, $opts);

    return $opts;
}

/**
 * Options page
 */
function wp_admin_notice_options_page() {
    $opts = wp_admin_notice_get_options();
    global $wp_version;
    require dirname(__FILE__).'/options-page.php';
}

