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

//Camera
$content['br_sliderjs']['camera']['jqs_autoplay'] = empty($_POST['jqs_camera_autoplay']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_caption'] = empty($_POST['jqs_camera_caption']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_captionFadein'] = empty($_POST['jqs_camera_captionFadein']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_cssadv'] = empty($_POST['jqs_camera_cssadv']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_jscode'] = empty($_POST['jqs_camera_jscode']) ? '' : clean_slweg($_POST['jqs_camera_jscode']);
$content['br_sliderjs']['camera']['jqs_effect'] = empty($_POST['jqs_camera_effect']) ? '' : clean_slweg($_POST['jqs_camera_effect']);
$content['br_sliderjs']['camera']['jqs_imgheight'] = empty($_POST['jqs_camera_imgheight']) ? '300' : intval($_POST['jqs_camera_imgheight']);
$content['br_sliderjs']['camera']['jqs_imgrand'] = empty($_POST['jqs_camera_imgrand']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_imgwidth'] = empty($_POST['jqs_camera_imgwidth']) ? '600' : intval($_POST['jqs_camera_imgwidth']);
$content['br_sliderjs']['camera']['jqs_interval'] = empty($_POST['jqs_camera_interval']) ? '5000' : intval($_POST['jqs_camera_interval']);
$content['br_sliderjs']['camera']['jqs_navigation'] = empty($_POST['jqs_camera_navigation']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_pagination'] = empty($_POST['jqs_camera_pagination']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_pauseOnHover'] = empty($_POST['jqs_camera_pauseOnHover']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_play'] = empty($_POST['jqs_camera_play']) ? 0 : 1;
$content['br_sliderjs']['camera']['jqs_speed'] = empty($_POST['jqs_camera_speed']) ? '200' : intval($_POST['jqs_camera_speed']);
$content['br_sliderjs']['camera']['jqs_theme'] = empty($_POST['jqs_camera_theme']) ? 'default' : clean_slweg($_POST['jqs_camera_theme']);
$content['br_sliderjs']['camera']['plugin_name'] = 'Camera Slideshow';