<?php
/**
 * phpwcms content management system
 * This script is a module for PHPWCMS Copyright (c) 2002-2013, Oliver Georgi http://www.phpwcms.de
 *
 * SliderJS Module
 * @version v1.3
 * @author breitsch - webrealisierung gmbh <mail@webrealisierung.ch>
 * @copyright Copyright (c) 2013, webrealisierung gmbh
 * @license http://opensource.org/licenses/GPL-2.0 GNU GPL-2
 *
 **/

// Module/Plug-in  

// obligate check for phpwcms constants
if (!defined('PHPWCMS_ROOT')) {
    die("You Cannot Access This Script Directly, Have a Nice Day.");
}

// register module name
//DO NOT USE SPECIAL CHARS HERE, NO WHITE SPACES, USE LOWER CASE!!!
$_module_name 			= 'br_sliderjs';

// module type - defines where used
// 0 = BE and FE, 1 = BE only, 2 = FE only
$_module_type 			= 0;

// Set if it should be listed as content part
// has content part: true or false
$_module_contentpart	= true;

// simple switch to allow fe render or fe init
$_module_fe_render		= false;
$_module_fe_init		= false;
$_module_fe_search		= false;

?>