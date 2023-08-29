<?php 
# Show only the index page. The admin page redirection happens, when a user has logged in
$adminUrl = get_admin_url();
if( is_user_logged_in() )
{
    wp_redirect( $adminUrl );
    exit();
}
echo sprintf('No front-end feature enabled. Please login to the dashboard <a href="%s">here.</a>', $adminUrl);
exit();