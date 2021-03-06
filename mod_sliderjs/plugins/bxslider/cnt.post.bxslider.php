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

//BXSLIDER
$content['br_sliderjs']['bxslider']['jqs_autoplay'] = empty($_POST['jqs_bxslider_autoplay']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_caption'] = empty($_POST['jqs_bxslider_caption']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_cssadv'] = empty($_POST['jqs_bxslider_cssadv']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_jscode'] = empty($_POST['jqs_bxslider_jscode']) ? '' : clean_slweg($_POST['jqs_bxslider_jscode']);
$content['br_sliderjs']['bxslider']['jqs_effect'] = empty($_POST['jqs_bxslider_effect']) ? '' : clean_slweg($_POST['jqs_bxslider_effect']);
$content['br_sliderjs']['bxslider']['jqs_imgheight'] = empty($_POST['jqs_bxslider_imgheight']) ? '300' : intval($_POST['jqs_bxslider_imgheight']);
$content['br_sliderjs']['bxslider']['jqs_imgrand'] = empty($_POST['jqs_bxslider_imgrand']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_imgwidth'] = empty($_POST['jqs_bxslider_imgwidth']) ? '600' : intval($_POST['jqs_bxslider_imgwidth']);
$content['br_sliderjs']['bxslider']['jqs_interval'] = empty($_POST['jqs_bxslider_interval']) ? '5000' : intval($_POST['jqs_bxslider_interval']);
$content['br_sliderjs']['bxslider']['jqs_navigation'] = empty($_POST['jqs_bxslider_navigation']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_pagination'] = empty($_POST['jqs_bxslider_pagination']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_pauseOnHover'] = empty($_POST['jqs_bxslider_pauseOnHover']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_play'] = empty($_POST['jqs_bxslider_play']) ? 0 : 1;
$content['br_sliderjs']['bxslider']['jqs_speed'] = empty($_POST['jqs_bxslider_speed']) ? '200' : intval($_POST['jqs_bxslider_speed']);
$content['br_sliderjs']['bxslider']['jqs_theme'] = empty($_POST['jqs_bxslider_theme']) ? 'default' : clean_slweg($_POST['jqs_bxslider_theme']);
$content['br_sliderjs']['bxslider']['plugin_name'] = 'BXSLIDER';