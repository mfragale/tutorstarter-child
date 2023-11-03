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


// Remove the additional notes area from the WooCommerce checkout
add_filter('woocommerce_enable_order_notes_field', '__return_false');





// Nova College MODIFIED
// add_filter('tutor_student_registration_required_fields', 'required_cpf_no_callback');
// if (!function_exists('required_cpf_no_callback')) {
//     function required_cpf_no_callback($atts)
//     {
//         $atts['cpf'] = 'CPF';
//         return $atts;
//     }
// }
// add_action('user_register', 'add_cpf_after_user_register');
// add_action('profile_update', 'add_cpf_after_user_register');
// if (!function_exists('add_cpf_after_user_register')) {
//     function add_cpf_after_user_register($user_id)
//     {
//         if (!empty($_POST['cpf'])) {
//             $cpf = sanitize_text_field($_POST['cpf']);
//             update_user_meta($user_id, '_cpf', $cpf);
//         }
//     }
// }
// Nova College MODIFIED


// Nova College MODIFIED
add_filter('tutor_student_registration_required_fields', 'required_phone_no_callback');
if (!function_exists('required_phone_no_callback')) {
    function required_phone_no_callback($atts)
    {
        $atts['phone_no'] = 'Phone Number field is required';
        return $atts;
    }
}
add_action('user_register', 'add_phone_after_user_register');
add_action('profile_update', 'add_phone_after_user_register');
if (!function_exists('add_phone_after_user_register')) {
    function add_phone_after_user_register($user_id)
    {
        if (!empty($_POST['phone_no'])) {
            $phone_number = sanitize_text_field($_POST['phone_no']);
            update_user_meta($user_id, 'phone_no', $phone_number);
        }
    }
}
// Nova College MODIFIED