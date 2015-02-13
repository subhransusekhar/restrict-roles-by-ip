<?php
/*
Plugin Name: Restrict Roles by IP
Author: Subhransu Sekhar
Author URI: http://github.com/subhransusekhar
Plugin URI: http://github.com/subhransusekhar/restrict-roles-by-ip
Version: 1.0
*/

$rri_options = get_option('rri_settings');

include('includes/restrict-roles-by-ip-admin-page.php');
include('includes/restrict-ip-access.php');