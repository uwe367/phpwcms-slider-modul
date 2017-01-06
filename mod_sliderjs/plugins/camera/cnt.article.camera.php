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

//camera slider

//header additions: _a=js, _b=overall css, _[theme]=theme related css
$mod_sliderjs['head']['br_sliderjs_camera_a'] = '  <script type="text/javascript" src="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/camera/js/jquery.easing.1.3.js"></script>';
$mod_sliderjs['head']['br_sliderjs_camera_b'] = '  <script type="text/javascript" src="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/camera/js/camera.min.js"></script>';
$mod_sliderjs['head']['br_sliderjs_camera_c'] = '  <link rel="stylesheet" type="text/css" href="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/camera/themes/camera.css" />';

//get the imagelist
$mod_sliderjs['br_sliderjs']['imglist'] = '';
$mod_sliderjs['br_sliderjs']['caplist'] = '';
foreach ($mod_sliderjs['br_sliderjs']['data'] as $key => $value) {
    if ($value['jqs_image'] != false) {
//when caption enabled
        if ( $content['br_sliderjs']['camera']['jqs_caption'] == 1 && !empty($value['jqs_descr']) ) {
//leave HTML in description
            $mod_sliderjs['br_sliderjs']['imglist'] .= '<div data-src="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '">';
            $mod_sliderjs['br_sliderjs']['imglist'] .= '<div class="camera_caption';
            $mod_sliderjs['br_sliderjs']['imglist'] .= jqsIsValid($content['br_sliderjs']['camera']['jqs_captionFadein'],' fadeIn','');
            if ( !empty($value['jqs_css']) ) {
                $mod_sliderjs['br_sliderjs']['imglist'] .= " ".clean_replacement_tags($value['jqs_css']);
            }
            $mod_sliderjs['br_sliderjs']['imglist'] .= '">'.$value['jqs_descr'].'</div>' . LF;
            $mod_sliderjs['br_sliderjs']['imglist'] .= '</div>' . LF;
        } else {
            $mod_sliderjs['br_sliderjs']['imglist'] .= '<div data-src="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '">' . LF;
            $mod_sliderjs['br_sliderjs']['imglist'] .= '</div>' . LF;
        }
    }
}

//add html
$mod_sliderjs['br_sliderjs']['output'] .= '  <div class="sliderjsmodule"';
if ($content['br_sliderjs']['camera']['jqs_cssadv'] == 0) {
    $mod_sliderjs['br_sliderjs']['output'] .= ' style="position:relative;width:'.$mod_sliderjs['br_sliderjs']['jqs_imgwidth'].'px;overflow:hidden;"';
}
$mod_sliderjs['br_sliderjs']['output'] .= '><div class="camera_wrap camera_'.$content['br_sliderjs']['camera']['jqs_theme'].'_skin" id="camera_wrap_'.$crow['acontent_id'].'">';
$mod_sliderjs['br_sliderjs']['output'] .= $mod_sliderjs['br_sliderjs']['imglist'];
$mod_sliderjs['br_sliderjs']['output'] .= '  </div></div>'.LF;

//add js
$mod_sliderjs['br_sliderjs']['output'] .= '<script type="text/javascript">'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= '
    $("#camera_wrap_'.$crow['acontent_id'].'").camera({
        fx: "'.$content['br_sliderjs']['camera']['jqs_effect'].'",
        cols: 6,
        rows: 4,
        loader: "none",
        pauseOnClick: false,
        playPause:'.jqsIsValid($content['br_sliderjs']['camera']['jqs_play']).',
        transPeriod: '.$content['br_sliderjs']['camera']['jqs_speed'].',
        time: '.$content['br_sliderjs']['camera']['jqs_interval'].',
        navigation: '.jqsIsValid($content['br_sliderjs']['camera']['jqs_navigation']).',
        pagination: '.jqsIsValid($content['br_sliderjs']['camera']['jqs_pagination']).',
        hover: '.jqsIsValid($content['br_sliderjs']['camera']['jqs_pauseOnHover']).',
        autoAdvance: '.jqsIsValid($content['br_sliderjs']['camera']['jqs_autoplay']).',
        //this callback is invoked when the image on a slide start loading
        onStartLoading: function() { },
        //this callback is invoked when the image on a slide has completely loaded
        onLoaded: function() { },
        //this callback is invoked when the transition effect starts
        onStartTransition: function() { },
        //this callback is invoked when the transition effect ends
        onEndTransition: function() { }';
if (!empty($content['br_sliderjs']['camera']['jqs_jscode'])) {
    $mod_sliderjs['br_sliderjs']['output'] .= ',
        '.trim($content['br_sliderjs']['camera']['jqs_jscode'],',').LF;
}
$mod_sliderjs['br_sliderjs']['output'] .= '    });'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= '</script>'.LF;