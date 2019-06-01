<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function showStyles($op_type = "0")
{
    global $wpdb;
    $param_values = array();
    html_showStyles($param_values, $op_type);
}
