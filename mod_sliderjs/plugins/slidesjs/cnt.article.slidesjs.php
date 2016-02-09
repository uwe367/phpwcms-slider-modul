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

//slidesJS

//header additions: _a=js, _b=overall css, _[theme]=theme related css
$mod_sliderjs['head']['br_sliderjs_slidesjs_a'] = '  <script type="text/javascript" src="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/slidesjs/js/jquery.slides.min.js"></script>';
$mod_sliderjs['head']['br_sliderjs_slidesjs_'.$content['br_sliderjs']['slidesjs']['jqs_theme']] = '  <link rel="stylesheet" type="text/css" href="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/slidesjs/themes/'.$content['br_sliderjs']['slidesjs']['jqs_theme'].'/'.$content['br_sliderjs']['slidesjs']['jqs_theme'].'.css" />';

//get the imagelist
$mod_sliderjs['br_sliderjs']['imglist'] = '';
foreach ($mod_sliderjs['br_sliderjs']['data'] as $key => $value) {
    if ($value['jqs_image'] != false) {
        $mod_sliderjs['br_sliderjs']['imglist'] .= '    <img src="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '"';
//no captions allowed
//        if ($content['br_sliderjs']['slidesjs']['jqs_caption'] == 1) {
//            $mod_sliderjs['br_sliderjs']['imglist'] .= 'title="' . $value['jqs_descr'] . '" alt="' . $value['jqs_title'] . '"';
//        }
        //$mod_sliderjs['br_sliderjs']['imglist'] .= $value['jqs_image'][3].' alt="'.$img_desc.'" border="0" />'.LF;
        $mod_sliderjs['br_sliderjs']['imglist'] .= ' />' . LF;
    }
}

//add html
$mod_sliderjs['br_sliderjs']['output'] .= '  <div class="sliderjsmodule"';
if ($content['br_sliderjs']['slidesjs']['jqs_cssadv'] == 0) {
    $mod_sliderjs['br_sliderjs']['output'] .= ' style="width:'.$mod_sliderjs['br_sliderjs']['jqs_imgwidth'].'px;"';
}
$mod_sliderjs['br_sliderjs']['output'] .= '><div class="slides_container"';
if ($content['br_sliderjs']['slidesjs']['jqs_cssadv'] == 0) {
$mod_sliderjs['br_sliderjs']['output'] .= ' style="width:'.$mod_sliderjs['br_sliderjs']['jqs_imgwidth'].'px;"';
}
$mod_sliderjs['br_sliderjs']['output'] .= '><div id="slidesjs'.$crow['acontent_id'].'">'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= $mod_sliderjs['br_sliderjs']['imglist'];
$mod_sliderjs['br_sliderjs']['output'] .= '  </div></div></div>'.LF;
//add js
$mod_sliderjs['br_sliderjs']['output'] .= '<script type="text/javascript">'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= '
   $(function(){
      $("#slidesjs'.$crow['acontent_id'].'").slidesjs({
        width: '.$mod_sliderjs['br_sliderjs']['jqs_imgwidth'].',
        height: '.$mod_sliderjs['br_sliderjs']['jqs_imgheight'].',
        start: 1,
        navigation: {
            active: '.jqsIsValid($content['br_sliderjs']['slidesjs']['jqs_navigation']).',
            effect: "'.$content['br_sliderjs']['slidesjs']['jqs_effect'].'"
        },
        pagination: {
            active: '.jqsIsValid($content['br_sliderjs']['slidesjs']['jqs_pagination']).',
            effect: "'.$content['br_sliderjs']['slidesjs']['jqs_effect'].'"
        },
        play: {
            active: '.jqsIsValid($content['br_sliderjs']['slidesjs']['jqs_play']).',
            effect: "'.$content['br_sliderjs']['slidesjs']['jqs_effect'].'",
            interval: '.$content['br_sliderjs']['slidesjs']['jqs_interval'].',
            auto: '.jqsIsValid($content['br_sliderjs']['slidesjs']['jqs_autoplay']).',
            swap: true,
            pauseOnHover: '.jqsIsValid($content['br_sliderjs']['slidesjs']['jqs_pauseOnHover']).',
            restartDelay: 2500
        },'.LF;

if($content['br_sliderjs']['slidesjs']['jqs_effect']=='fade') {
    $mod_sliderjs['br_sliderjs']['output'] .= '        effect: {
            fade: {
                speed: '.$content['br_sliderjs']['slidesjs']['jqs_speed'].',
                crossfade: true
            }
        },'.LF;
} else {
    $mod_sliderjs['br_sliderjs']['output'] .= '        effect: {
            slide: {
                speed: '.$content['br_sliderjs']['slidesjs']['jqs_speed'].'
            }
        },'.LF;
}

$mod_sliderjs['br_sliderjs']['output'] .= '        callback: {
            loaded: function(number) {
        // Passes start slide number
            },
            start: function(number) {
        // Passes slide number at start of animation
            },
            complete: function(number) {
        // Passes slide number at end of animation
            }
        }';
if (!empty($content['br_sliderjs']['slidesjs']['jqs_jscode'])) {
    $mod_sliderjs['br_sliderjs']['output'] .= ',
        '.trim($content['br_sliderjs']['slidesjs']['jqs_jscode'],',').LF;
}
$mod_sliderjs['br_sliderjs']['output'] .= '      });
    });'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= '</script>'.LF;