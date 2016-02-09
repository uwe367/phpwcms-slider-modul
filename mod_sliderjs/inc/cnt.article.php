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

// SliderJS module content part frontend article rendering
// if you want to access module vars check that var
// $phpwcms['modules'][$crow["acontent_module"]]

//specific functions for the frontend
include_once($phpwcms['modules'][$crow["acontent_module"]]['dir'] . 'class/FeSliderjs.php');

/**
 * @var mixed[] mod_sliderjs array to store all variables opend while the execution of the script
 */
$mod_sliderjs = array();

//to work with in this script
$mod_sliderjs['br_sliderjs'] = array();

//open reference to header block
$mod_sliderjs['head'] = & $GLOBALS['block']['custom_htmlhead'];

/*
$content['br_sliderjs'] only contains the values from the cp
all other variables in the script see $mod_sliderjs['br_sliderjs']...
*/
//get contentpart settings
$content['br_sliderjs'] = @unserialize($crow['acontent_form']);

//open output holder
$mod_sliderjs['br_sliderjs']['output'] = "";

//if no active folder then abort
if (!empty($content['br_sliderjs']['jqs_folders'])) {

//check for jslib
    $mod_sliderjs['br_sliderjs']['jslib'] = (strpos($GLOBALS["block"]["jslib"], 'jquery') !== false) ? "jquery" : "mootools";

    if ($mod_sliderjs['br_sliderjs']['jslib'] == "mootools") {
        //with mootools just output a comment with the warning
        $mod_sliderjs['br_sliderjs']['output'] .= '<!-- slidesJS - sorry no jquery -->';
        $mod_sliderjs['head']['br_sliderjs'] = "";

    } elseif ($mod_sliderjs['br_sliderjs']['jslib'] == "jquery") { //jquery

//version check, if lower than 1.8 -> load and overwrite with 1.8
        $mod_sliderjs['br_sliderjs']['jslibver'] = explode('-', $GLOBALS["block"]["jslib"]);
        if (!empty($mod_sliderjs['br_sliderjs']['jslibver'][1]) && ($mod_sliderjs['br_sliderjs']['jslibver'][1] < 1.8 && $mod_sliderjs['br_sliderjs']['jslibver'][1] != '1.10')) {
            $GLOBALS['block']['custom_htmlhead']['jquery.js'] = getJavaScriptSourceLink(TEMPLATE_PATH . 'lib/jquery/jquery-2.2.0min.js');
            //$GLOBALS['block']['custom_htmlhead']['jquery.js'] = '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
        }

// is width/height set in cp-settings? else use phpwcms standard prev sizes
        $mod_sliderjs['br_sliderjs']['jqs_imgwidth'] = ($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgwidth'] == 0 || empty($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgwidth'])) ? "" : intval($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgwidth']);
        $mod_sliderjs['br_sliderjs']['jqs_imgheight'] = ($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgheight'] == 0 || empty($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgheight'])) ? "" : intval($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgheight']);
        if (empty($mod_sliderjs['br_sliderjs']['jqs_imgwidth']) && empty($mod_sliderjs['br_sliderjs']['jqs_imgheight'])) {
            $mod_sliderjs['br_sliderjs']['jqs_imgwidth'] = $phpwcms['img_prev_width'];
            $mod_sliderjs['br_sliderjs']['jqs_imgheight'] = $phpwcms['img_prev_height'];
        }

//get jsondecoded imagesdata
        $mod_sliderjs['br_sliderjs']['imagesdata'] = array();
        $mod_sliderjs['br_sliderjs']['imagesdata'] = json_decode($content['br_sliderjs']['jqs_imagedata'], true);

//data will get all images, we loop through all folders and add the images for each folder
/*
TODO
jqs_folders has the order from the CP with sort order of the folders they had when
the CP was last saved, but this could have changed since
*/

        //get all file-folders from DB
        $mod_sliderjs['br_sliderjs']['fldr_sql'] = "SELECT * FROM " . DB_PREPEND . "phpwcms_file WHERE f_kid=0";
        $mod_sliderjs['br_sliderjs']['fldr_data'] = _dbQuery($mod_sliderjs['br_sliderjs']['fldr_sql']);
        //will get the images
        $mod_sliderjs['br_sliderjs']['data'] = array();
        //loop through all folders
        foreach ($content['br_sliderjs']['jqs_folders'] as $key => $val) {

            //first check if curr folder and all its parents are active and not deleted
            if( strpos( recursiveFolderSearch($val, $mod_sliderjs['br_sliderjs']['fldr_data']), 'abort') ) {
                //something pathupwards is inactive therfore do nothing
                $mod_sliderjs['br_sliderjs']['img_sql_data'] = array();

            } else {

                //phpwcms images - get only active and not deleted images with curr parent
                $mod_sliderjs['br_sliderjs']['img_sql'] = "SELECT * FROM " . DB_PREPEND . "phpwcms_file ";
                $mod_sliderjs['br_sliderjs']['img_sql'] .= "WHERE f_pid=".$val." ";
                $mod_sliderjs['br_sliderjs']['img_sql'] .= "AND f_aktiv=1 AND f_trash=0 AND f_kid=1 AND f_ext IN ('jpeg', 'jpg', 'png', 'gif') ";
                $mod_sliderjs['br_sliderjs']['img_sql'] .= "ORDER BY f_sort, f_name";

                //join deprecated
//                $mod_sliderjs['br_sliderjs']['img_sql'] = "SELECT f1.* FROM " . DB_PREPEND . "phpwcms_file AS f1 JOIN " . DB_PREPEND . "phpwcms_file AS f2 ON f1.f_pid = f2.f_id ";
//                $mod_sliderjs['br_sliderjs']['img_sql'] .= "WHERE f2.f_id=".$val." ";
//                $mod_sliderjs['br_sliderjs']['img_sql'] .= "AND f2.f_aktiv=1 AND f2.f_kid=0 AND f2.f_trash=0 ";
//                $mod_sliderjs['br_sliderjs']['img_sql'] .= "AND f1.f_aktiv=1 AND f1.f_trash=0 AND f1.f_kid=1 AND f1.f_ext IN ('jpeg', 'jpg', 'png', 'gif') ";
//                $mod_sliderjs['br_sliderjs']['img_sql'] .= "ORDER BY f1.f_sort, f1.f_name";

                $mod_sliderjs['br_sliderjs']['img_sql_data'] = _dbQuery($mod_sliderjs['br_sliderjs']['img_sql']);

                //foreach image
                foreach ($mod_sliderjs['br_sliderjs']['img_sql_data'] as $k => $v) {
                    //? do we have aditional data
                    if (isset($mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']])) {
                        //? do we have title
                        if (isset($mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']][1])) {
                            $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_title'] = $mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']][1];
                        } else {
                            $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_title'] = '';
                        }
                        //? do we have description
                        if (isset($mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']][2])) {
                            $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_descr'] = $mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']][2];
                        } else {
                            $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_descr'] = '';
                        }
                        //? do we have css-class
                        if (isset($mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']][3])) {
                            $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_css'] = $mod_sliderjs['br_sliderjs']['imagesdata'][$val][$v['f_id']][3];
                        } else {
                            $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_css'] = '';
                        }
                    } else {
                        $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_title'] = '';
                        $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_descr'] = '';
                        $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_css'] = '';
                    }

                    //get image
                    $mod_sliderjs['br_sliderjs']['img_sql_data'][$k]['jqs_image'] = get_cached_image(
                        array(
                             "target_ext" => $v['f_ext'],
                             "image_name" => $v['f_hash'] . '.' . $v['f_ext'],
                             "max_width"  => $mod_sliderjs['br_sliderjs']['jqs_imgwidth'],
                             "max_height" => $mod_sliderjs['br_sliderjs']['jqs_imgheight'],
                             "thumb_name" => md5($v['f_hash'] .
                                 $mod_sliderjs['br_sliderjs']['jqs_imgwidth'] .
                                 $mod_sliderjs['br_sliderjs']['jqs_imgheight'] .
                                 $phpwcms["sharpen_level"] . '1'),
                             "crop_image" => 1
                        )
                    );
                } //end foreach image

            }

            $mod_sliderjs['br_sliderjs']['data'] = array_merge($mod_sliderjs['br_sliderjs']['data'], $mod_sliderjs['br_sliderjs']['img_sql_data']);
        } //end foreach folder

        //only when some images...
        if(count($mod_sliderjs['br_sliderjs']['data'])) {

//randomize
            if ($content['br_sliderjs'][$content['br_sliderjs']['jqs_sliderpluginAlias']]['jqs_imgrand'] == 1) {
                shuffle($mod_sliderjs['br_sliderjs']['data']);
            }

//include plugin cnt.article
            include($phpwcms['modules'][$crow["acontent_module"]]['dir'] . 'plugins/' . $content['br_sliderjs']['jqs_sliderpluginAlias'] . '/cnt.article.' . $content['br_sliderjs']['jqs_sliderpluginAlias'] . '.php');

        }

    } //end if jquery

//display output
    $CNT_TMP .= headline($crow["acontent_title"], $crow["acontent_subtitle"], $template_default["article"]) . LF;
    $CNT_TMP .= '<!-- SLIDERJS Module Start -->' . LF . $mod_sliderjs['br_sliderjs']['output'] . LF . '<!-- SLIDERJS Module End -->' . LF;

} //end no active folders

//cleanup
unset($mod_sliderjs);
?>