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

//NIVO
$content['br_sliderjs']['nivo']['jqs_autoplay'] = empty($_POST['jqs_nivo_autoplay']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_caption'] = empty($_POST['jqs_nivo_caption']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_cssadv'] = empty($_POST['jqs_nivo_cssadv']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_jscode'] = empty($_POST['jqs_nivo_jscode']) ? '' : clean_slweg($_POST['jqs_nivo_jscode']);
$content['br_sliderjs']['nivo']['jqs_effect'] = empty($_POST['jqs_nivo_effect']) ? '' : clean_slweg($_POST['jqs_nivo_effect']);
$content['br_sliderjs']['nivo']['jqs_imgheight'] = empty($_POST['jqs_nivo_imgheight']) ? '300' : intval($_POST['jqs_nivo_imgheight']);
$content['br_sliderjs']['nivo']['jqs_imgrand'] = empty($_POST['jqs_nivo_imgrand']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_imgwidth'] = empty($_POST['jqs_nivo_imgwidth']) ? '600' : intval($_POST['jqs_nivo_imgwidth']);
$content['br_sliderjs']['nivo']['jqs_interval'] = empty($_POST['jqs_nivo_interval']) ? '5000' : intval($_POST['jqs_nivo_interval']);
$content['br_sliderjs']['nivo']['jqs_navigation'] = empty($_POST['jqs_nivo_navigation']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_pagination'] = empty($_POST['jqs_nivo_pagination']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_pauseOnHover'] = empty($_POST['jqs_nivo_pauseOnHover']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_play'] = empty($_POST['jqs_nivo_play']) ? 0 : 1;
$content['br_sliderjs']['nivo']['jqs_speed'] = empty($_POST['jqs_nivo_speed']) ? '200' : intval($_POST['jqs_nivo_speed']);
$content['br_sliderjs']['nivo']['jqs_theme'] = empty($_POST['jqs_nivo_theme']) ? 'default' : clean_slweg($_POST['jqs_nivo_theme']);
$content['br_sliderjs']['nivo']['plugin_name'] = 'NIVO SLIDER';