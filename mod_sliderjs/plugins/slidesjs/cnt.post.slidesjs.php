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

//SLIDESJS
$content['br_sliderjs']['slidesjs']['jqs_autoplay'] = empty($_POST['jqs_slidesjs_autoplay']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_caption'] = empty($_POST['jqs_slidesjs_caption']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_cssadv'] = empty($_POST['jqs_slidesjs_cssadv']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_jscode'] = empty($_POST['jqs_slidesjs_jscode']) ? '' : clean_slweg($_POST['jqs_slidesjs_jscode']);
$content['br_sliderjs']['slidesjs']['jqs_effect'] = empty($_POST['jqs_slidesjs_effect']) ? 'slide' : clean_slweg($_POST['jqs_slidesjs_effect']);
$content['br_sliderjs']['slidesjs']['jqs_imgheight'] = empty($_POST['jqs_slidesjs_imgheight']) ? '300' : intval($_POST['jqs_slidesjs_imgheight']);
$content['br_sliderjs']['slidesjs']['jqs_imgrand'] = empty($_POST['jqs_slidesjs_imgrand']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_imgwidth'] = empty($_POST['jqs_slidesjs_imgwidth']) ? '600' : intval($_POST['jqs_slidesjs_imgwidth']);
$content['br_sliderjs']['slidesjs']['jqs_interval'] = empty($_POST['jqs_slidesjs_interval']) ? '5000' : intval($_POST['jqs_slidesjs_interval']);
$content['br_sliderjs']['slidesjs']['jqs_navigation'] = empty($_POST['jqs_slidesjs_navigation']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_pagination'] = empty($_POST['jqs_slidesjs_pagination']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_pauseOnHover'] = empty($_POST['jqs_slidesjs_pauseOnHover']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_play'] = empty($_POST['jqs_slidesjs_play']) ? 0 : 1;
$content['br_sliderjs']['slidesjs']['jqs_speed'] = empty($_POST['jqs_slidesjs_speed']) ? '200' : intval($_POST['jqs_slidesjs_speed']);
$content['br_sliderjs']['slidesjs']['jqs_theme'] = empty($_POST['jqs_slidesjs_theme']) ? 'default' : clean_slweg($_POST['jqs_slidesjs_theme']);
$content['br_sliderjs']['slidesjs']['plugin_name'] = 'SLIDESJS';