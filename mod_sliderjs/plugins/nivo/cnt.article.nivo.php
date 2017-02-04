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

//nivo slider

//header additions: _a=js, _b=overall css, _[theme]=theme related css
$mod_sliderjs['head']['br_sliderjs_nivo_a'] = '  <script type="text/javascript" src="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/nivo/js/jquery.nivo.slider.pack.js"></script>';
$mod_sliderjs['head']['br_sliderjs_nivo_b'] = '  <link rel="stylesheet" type="text/css" href="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/nivo/nivo-slider.css" />';
$mod_sliderjs['head']['br_sliderjs_nivo_'.$content['br_sliderjs']['nivo']['jqs_theme']] = '  <link rel="stylesheet" type="text/css" href="'.$phpwcms['modules'][$crow["acontent_module"]]['dir'].'plugins/nivo/themes/'.$content['br_sliderjs']['nivo']['jqs_theme'].'/'.$content['br_sliderjs']['nivo']['jqs_theme'].'.css" />';

//get the imagelist
$mod_sliderjs['br_sliderjs']['imglist'] = '';
$mod_sliderjs['br_sliderjs']['caplist'] = '';
foreach ($mod_sliderjs['br_sliderjs']['data'] as $key => $value) {
    if ($value['jqs_image'] != false) {
//when caption enabled
        if ( $content['br_sliderjs']['nivo']['jqs_caption'] == 1 && !empty($value['jqs_descr']) ) {
//leave HTML in description
            $mod_sliderjs['br_sliderjs']['imglist'] .= '<img src="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '" title="#' .$value['f_hash'] . '" alt="' . clean_replacement_tags($value['jqs_title'],'') . '"';
            if ( isset($content['br_sliderjs']['nivo']['jqs_thumbnav']) && $content['br_sliderjs']['nivo']['jqs_thumbnav'] == 1){
                $mod_sliderjs['br_sliderjs']['imglist'] .= 'data-thumb="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '"';
            }
            $mod_sliderjs['br_sliderjs']['imglist'] .= ' />' . LF;
            if ( !empty($value['jqs_css']) ) {
                $mod_sliderjs['br_sliderjs']['caplist'] .= '<div id="'.$value['f_hash'].'" class="nivo-html-caption">';
                $mod_sliderjs['br_sliderjs']['caplist'] .= '<div class="'.clean_replacement_tags($value['jqs_css']).'">'.$value['jqs_descr'].'</div></div>' . LF;
            } else {
                $mod_sliderjs['br_sliderjs']['caplist'] .= '<div id="'.$value['f_hash'].'" class="nivo-html-caption">'.$value['jqs_descr'].'</div>' . LF;
            }

        } else {
            $mod_sliderjs['br_sliderjs']['imglist'] .= '<img src="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '"';
            if ( isset($content['br_sliderjs']['nivo']['jqs_thumbnav']) && $content['br_sliderjs']['nivo']['jqs_thumbnav'] == 1){
                $mod_sliderjs['br_sliderjs']['imglist'] .= 'data-thumb="' . PHPWCMS_IMAGES . $value['jqs_image'][0] . '"';
            }
            $mod_sliderjs['br_sliderjs']['imglist'] .= ' />' . LF;
        }
        //$mod_sliderjs['br_sliderjs']['imglist'] .= $value['jqs_image'][3].' alt="'.$img_desc.'" border="0" />'.LF;
    }
}

//add html
$mod_sliderjs['br_sliderjs']['output'] .= '  <div class="sliderjsmodule"';
if ($content['br_sliderjs']['nivo']['jqs_cssadv'] == 0) {
    $mod_sliderjs['br_sliderjs']['output'] .= ' style="position:relative;width:'.$mod_sliderjs['br_sliderjs']['jqs_imgwidth'].'px;overflow:hidden;"';
}
$mod_sliderjs['br_sliderjs']['output'] .= '><div class="slider-wrapper theme-'.$content['br_sliderjs']['nivo']['jqs_theme'].'"><div id="nivoslider'.$crow['acontent_id'].'" class="nivoSlider">'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= $mod_sliderjs['br_sliderjs']['imglist'];
$mod_sliderjs['br_sliderjs']['output'] .= '  </div>'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= $mod_sliderjs['br_sliderjs']['caplist'];
$mod_sliderjs['br_sliderjs']['output'] .= '  </div></div>'.LF;

//add js
$mod_sliderjs['br_sliderjs']['output'] .= '<script type="text/javascript">'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= '
    $("#nivoslider'.$crow['acontent_id'].'").nivoSlider({
        effect: "'.$content['br_sliderjs']['nivo']['jqs_effect'].'",
        slices: 15,
        boxCols: 8,
        boxRows: 4,
        animSpeed: '.$content['br_sliderjs']['nivo']['jqs_speed'].',
        pauseTime: '.$content['br_sliderjs']['nivo']['jqs_interval'].',
        startSlide: 0,
        directionNav: '.jqsIsValid($content['br_sliderjs']['nivo']['jqs_navigation']).',
        controlNav: '.jqsIsValid($content['br_sliderjs']['nivo']['jqs_pagination']).',
        controlNavThumbs: '.jqsIsValid($content['br_sliderjs']['nivo']['jqs_thumbnav']).',
        controlNavThumbsFromRel: false,
        pauseOnHover: '.jqsIsValid($content['br_sliderjs']['nivo']['jqs_pauseOnHover']).',
        manualAdvance: '.jqsIsValid($content['br_sliderjs']['nivo']['jqs_autoplay'],'false','true').',
        prevText: "<<", // Prev directionNav text
        nextText: ">>", // Next directionNav text
        randomStart: false,
        beforeChange: function(){},
        afterChange: function(){},
        slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}';
if (!empty($content['br_sliderjs']['nivo']['jqs_jscode'])) {
    $mod_sliderjs['br_sliderjs']['output'] .= ',
        '.trim($content['br_sliderjs']['nivo']['jqs_jscode'],',').LF;
}
$mod_sliderjs['br_sliderjs']['output'] .= '    });'.LF;
$mod_sliderjs['br_sliderjs']['output'] .= '</script>'.LF;