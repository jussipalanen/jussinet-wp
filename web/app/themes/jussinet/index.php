<?php 
$adminUrl = get_admin_url();
if( is_user_logged_in() )
{
    wp_redirect( $adminUrl );
    exit();
}
echo sprintf('No front-end feature enabled. Please login to the dashboard <a href="%s">here.</a>', $adminUrl);
?>