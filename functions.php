<?php
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array('main'),
        wp_get_theme()->get('Version') // This only works if you have Version defined in the style header.
    );
}





add_filter('tutor_student_registration_required_fields', 'required_nid_no_callback');
if (!function_exists('required_nid_no_callback')) {
    function required_nid_no_callback($atts)
    {
        $atts['nid'] = 'National Id';
        return $atts;
    }
}
add_action('user_register', 'add_nid_after_user_register');
add_action('profile_update', 'add_nid_after_user_register');
if (!function_exists('add_nid_after_user_register')) {
    function add_nid_after_user_register($user_id)
    {
        if (!empty($_POST['nid'])) {
            $nid = sanitize_text_field($_POST['nid']);
            update_user_meta($user_id, '_nid', $nid);
        }
    }
}
