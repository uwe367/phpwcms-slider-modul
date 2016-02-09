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

//default values
$mod_sliderjs = array();
$mod_sliderjs['jqs_images_cp'] = array();
$mod_sliderjs['jqs_images_db'] = array();

//sanitize POST for imagefields
if (!empty($_POST['jqs_images'])) {
    $mod_sliderjs['jqs_images_cp'] = $_POST['jqs_images'];
    foreach ($mod_sliderjs['jqs_images_cp'] as $key => $value) { //foreach folder
        foreach ($value as $ky => $vy) { //foreach image
            foreach ($vy as $k => $v) { //foreach field
                //remove all linebreacks
                $mod_sliderjs['jqs_images_cp'][$key][$ky][$k] = preg_replace( "/\r\n\t|\r\n|\n|\r|\t|/m", "",  slweg($v) );
            }
        }
    }
}
unset($key, $value, $ky, $vy, $k, $v);

//get previously stored entries
//only if stored yet
if ($_POST["cid"] != 0) {
    $mod_sliderjs['prevdata'] = unserialize($row['acontent_form']);
    if($mod_sliderjs['prevdata']['jqs_imagedata']){
        $mod_sliderjs['jqs_images_db'] = json_decode($mod_sliderjs['prevdata']['jqs_imagedata'],true);
    }
}
//merge values from CP with values from DB
$mod_sliderjs['jqs_images_result'] = $mod_sliderjs['jqs_images_cp'] + $mod_sliderjs['jqs_images_db'];
//clean empty entries
foreach ($mod_sliderjs['jqs_images_result'] as $key=>$value) { //foreach folder
    foreach ($value as $ky=>$vy) { //foreach image
        foreach ($vy as $k=>$v) { //foreach field
            //delete fields
            if(empty($v))unset($mod_sliderjs['jqs_images_result'][$key][$ky][$k]);
        }
        //delete image level
        if(!count($mod_sliderjs['jqs_images_result'][$key][$ky]))unset($mod_sliderjs['jqs_images_result'][$key][$ky]);
    }
    //delete folder level
    if(!count($mod_sliderjs['jqs_images_result'][$key]))unset($mod_sliderjs['jqs_images_result'][$key]);
}

/**
 * This handles module content part POST values
 */
$content['br_sliderjs'] = array();

//jqs_folders array of int's
$content['br_sliderjs']['jqs_folders'] = array();
if (!empty($_POST['jqs_folders'])) {
    $content['br_sliderjs']['jqs_folders'] = array_map('intval', $_POST['jqs_folders']);
}

//jqs_reg_sliders array of strings
$content['br_sliderjs']['jqs_reg_sliders'] = empty($_POST['jqs_reg_sliders']) ? array() : array_map('slweg', explode(',',$_POST['jqs_reg_sliders']));

//jqs_sliderplugin string default is first registered slider
$content['br_sliderjs']['jqs_sliderplugin'] = empty($_POST['jqs_sliderplugin']) ? $content['br_sliderjs']['jqs_reg_sliders'][0] : slweg($_POST['jqs_sliderplugin']);

//add jqs_imagedata cleaned imagedata as json
$content['br_sliderjs']['jqs_imagedata'] = json_encode($mod_sliderjs['jqs_images_result']);

/**
 * includes the files of plugins (cnt.post.[plugin].php in each plugin-dir
 * for handling of plugin-POST-vars
 */
foreach ($content['br_sliderjs']['jqs_reg_sliders'] as $val) {
    if (file_exists($phpwcms["modules"][$content["module"]]["dir"] . 'plugins/'.$val.'/cnt.post.'.$val.'.php')){
        include($phpwcms["modules"][$content["module"]]["dir"] . 'plugins/'.$val.'/cnt.post.'.$val.'.php');
    }
}

//selected Plugin Name, alias
$content['br_sliderjs']['jqs_sliderpluginName'] = $content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderplugin']]['plugin_name'];
$content['br_sliderjs']['jqs_sliderpluginAlias'] = $content['br_sliderjs']['jqs_sliderplugin'];

//cleanup
unset($mod_sliderjs, $key, $value, $ky, $vy, $k, $v);