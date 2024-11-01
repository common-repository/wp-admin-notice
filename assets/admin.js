jQuery(document).ready(function($) {
    wp_admin_notice_setup_js();
});

function wp_admin_notice_setup_js() {
    // This if statement checks if the color picker widget exists within jQuery UI
    //If it does exist then we initialize the WordPress color picker on our text input field
    if ( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ) {
        jQuery('#wp_admin_notice_options_text_color').wpColorPicker();
    } else { //We use farbtastic if the WordPress color picker widget doesn't exist
        jQuery('.wp_admin_notice_admin_wrapper #text_color_picker').farbtastic('#wp_admin_notice_options_text_color');
    }
}
