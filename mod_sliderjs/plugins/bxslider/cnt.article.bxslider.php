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

//bxslider

//header additions: _a=js, _b=overall css, _[theme]=theme related css
$mod_sliderjs['head']['br_sliderjs_bxslider_a'] = '  <script type="text/javascript" src="' . $phpwcms['modules'][$crow["acontent_module"]]['dir'] . 'plugins/bxslider/js/jquery.bxslider.min.js"></script>';
$mod_sliderjs['head']['br_sliderjs_bxslider_' . $content['br_sliderjs']['bxslider']['jqs_theme']] = '  <link rel="stylesheet" type="text/css" href="' . $phpwcms['modules'][$crow["acontent_module"]]['dir'] . 'plugins/bxslider/themes/' . $content['br_sliderjs']['bxslider']['jqs_theme'] . '/' . $content['br_sliderjs']['bxslider']['jqs_theme'] . '.css" />';

//get the imagelist
$mod_sliderjs['br_sliderjs']['imglist'] = '';
foreach ($mod_sliderjs['br_sliderjs']['data'] as $key => $value) {
    if ($value['jqs_image'] != false) {
        $mod_sliderjs['br_sliderjs']['imglist'] .= '<li>';
        $mod_sliderjs['br_sliderjs']['imglist'] .= '    <img src="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '" ';
//when captions enabled
        if ($content['br_sliderjs']['bxslider']['jqs_caption'] == 1) {
//clean all RT's - this function also strips all HTML tags
            $mod_sliderjs['br_sliderjs']['imglist'] .= 'title="' . clean_replacement_tags($value['jqs_descr'],'') . '" alt="' . clean_replacement_tags($value['jqs_title'],'') . '"';
        }
        //$mod_sliderjs['br_sliderjs']['imglist'] .= $value['jqs_image'][3].' alt="'.$img_desc.'" border="0" />'.LF;
        $mod_sliderjs['br_sliderjs']['imglist'] .= ' />' . LF;
        $mod_sliderjs['br_sliderjs']['imglist'] .= '</li>';
    }
}

//add html
$mod_sliderjs['br_sliderjs']['output'] .= '  <div class="sliderjsmodule"';
if ($content['br_sliderjs']['bxslider']['jqs_cssadv'] == 0) {
    $mod_sliderjs['br_sliderjs']['output'] .= '  style="position:relative;width:'.$mod_sliderjs['br_sliderjs']['jqs_imgwidth'].'px;overflow:hidden;"';
}
$mod_sliderjs['br_sliderjs']['output'] .= '><ul class="bxslider bxloader'.$crow['acontent_id'].'"';
if ($content['br_sliderjs']['bxslider']['jqs_cssadv'] == 0) {
    $mod_sliderjs['br_sliderjs']['output'] .= ' style="margin:0;padding:0;"';
}
$mod_sliderjs['br_sliderjs']['output'] .= '>' . LF;
$mod_sliderjs['br_sliderjs']['output'] .= $mod_sliderjs['br_sliderjs']['imglist'];
$mod_sliderjs['br_sliderjs']['output'] .= '  </ul></div>' . LF;
//add js
$mod_sliderjs['br_sliderjs']['output'] .= '<script type="text/javascript">' . LF;
$mod_sliderjs['br_sliderjs']['output'] .= '
    $(".bxloader'.$crow['acontent_id'].'").bxSlider({
        mode: "' . $content['br_sliderjs']['bxslider']['jqs_effect'] . '",' . LF;
if ($content['br_sliderjs']['bxslider']['jqs_effect'] == 'vertical') {
    $mod_sliderjs['br_sliderjs']['output'] .= '        slideMargin: 0,' . LF;
}
$mod_sliderjs['br_sliderjs']['output'] .= '        speed: ' . $content['br_sliderjs']['bxslider']['jqs_speed'] . ',
        controls: ' . jqsIsValid($content['br_sliderjs']['bxslider']['jqs_navigation']) . ',
        pager: ' . jqsIsValid($content['br_sliderjs']['bxslider']['jqs_pagination']) . ',
        autoControls: ' . jqsIsValid($content['br_sliderjs']['bxslider']['jqs_play']) . ',
        autoControlsCombine: true,
        auto: true,
        captions: ' . jqsIsValid($content['br_sliderjs']['bxslider']['jqs_caption']) . ',
        pause: ' . $content['br_sliderjs']['bxslider']['jqs_interval'] . ',
        autoStart: ' . jqsIsValid($content['br_sliderjs']['bxslider']['jqs_autoplay']) . ',
        autoHover: ' . jqsIsValid($content['br_sliderjs']['bxslider']['jqs_pauseOnHover']);
if (!empty($content['br_sliderjs']['bxslider']['jqs_jscode'])) {
    $mod_sliderjs['br_sliderjs']['output'] .= ',
        '.trim($content['br_sliderjs']['bxslider']['jqs_jscode'],',').LF;
}
$mod_sliderjs['br_sliderjs']['output'] .= '    });' . LF;
$mod_sliderjs['br_sliderjs']['output'] .= '</script>' . LF;