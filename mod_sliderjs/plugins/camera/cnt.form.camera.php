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

// obligate check for phpwcms constants
if (!defined('PHPWCMS_ROOT')) {
    die("You Cannot Access This Script Directly, Have a Nice Day.");
}

/**
 * @var mixed[] mod_jqs_camera Camera values in cnt.tmpl.camera.php
 */
$mod_sliderjs_camera = array();

//camera default values
$mod_sliderjs['br_sliderjs_default']['camera'] = array(
    'plugin_name' => 'Camera Slideshow',
    'jqs_autoplay'     => 0,
    'jqs_caption'      => 0,
    'jqs_captionFadein'=> 0,
    'jqs_cssadv'       => 0,
    'jqs_jscode'       => '',
    'jqs_effect'       => '',
    'jqs_imgheight'    => 300,
    'jqs_imgrand'      => 0,
    'jqs_imgwidth'     => 600,
    'jqs_interval'     => 5000,
    'jqs_navigation'   => 1,
    'jqs_pagination'   => 0,
    'jqs_pauseOnHover' => 0,
    'jqs_play'         => 0,
    'jqs_speed'        => 200,
    'jqs_theme'        => 'default'
);