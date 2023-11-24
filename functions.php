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



/**
 *	This will hide the Divi "Project" post type.
 *	Thanks to georgiee (https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080) for his improved solution.
 */
add_filter('et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1);
function mytheme_et_project_posttype_args($args)
{
    return array_merge($args, array(
        'public'              => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => false,
        'show_in_nav_menus'   => false,
        'show_ui'             => false
    ));
}



/**
 * Pre-populate Woocommerce checkout fields
 */
add_filter('woocommerce_checkout_get_value', function ($input, $key) {
    global $current_user;
    switch ($key):
        case 'billing_first_name':
        case 'shipping_first_name':
            return $current_user->first_name;
            break;

        case 'billing_last_name':
        case 'shipping_last_name':
            return $current_user->last_name;
            break;
        case 'billing_email':
            return $current_user->user_email;
            break;
        case 'billing_phone_number':
            return $current_user->phone_number;
            break;
    endswitch;
}, 10, 2);




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
add_filter('tutor_student_registration_required_fields', 'required_phone_number_callback');
if (!function_exists('required_phone_number_callback')) {
    function required_phone_number_callback($atts)
    {
        $atts['phone_number'] = 'phone_number Number field is required';
        return $atts;
    }
}
add_action('user_register', 'add_phone_number_after_user_register');
add_action('profile_update', 'add_phone_number_after_user_register');
if (!function_exists('add_phone_number_after_user_register')) {
    function add_phone_number_after_user_register($user_id)
    {
        if (!empty($_POST['phone_number'])) {
            $phone_number = sanitize_text_field($_POST['phone_number']);
            update_user_meta($user_id, 'phone_number', $phone_number);
        }
    }
}
// Nova College MODIFIED
