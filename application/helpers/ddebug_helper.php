<?php

/**
 * ------------------------------------------------------------------------
 *
 * dDebug Helper
 *
 * Outputs the given variable(s) with formatting and location
 *
 * @access public
 * @param mixed - variables to be output
 */
if (!function_exists('dDebug')) {
    function dDebug($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        die;
    }
}