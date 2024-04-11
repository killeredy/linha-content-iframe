<?php



function la_content_iframe_submenu_page()
{
    add_submenu_page(
        'options-general.php', // Parent menu slug (options-general.php for the Settings menu)
        'Feature Iframe Page',
        'Feature Iframe Page',
        'manage_options',
        'iframe-custom-submenu-page',
        'iframe_submenu_page_callback'
    );
}
add_action('admin_menu', 'la_content_iframe_submenu_page');