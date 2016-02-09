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

session_start();
$phpwcms = array();
require_once ('../../../../include/config/conf.inc.php');
require_once ('../../../../include/inc_lib/default.inc.php');
if(empty($_SESSION["wcs_user"])) {
	die('Sorry, access forbidden');
}
require_once (PHPWCMS_ROOT.'/include/inc_lib/dbcon.inc.php');
require_once (PHPWCMS_ROOT.'/include/inc_lib/general.inc.php');
if(!empty($_SESSION["wcs_user_lang"]) && preg_match('/[a-z]{2}/i', $_SESSION["wcs_user_lang"])) {
	$BE['LANG'] = $_SESSION["wcs_user_lang"];
}
//load default language EN
require_once PHPWCMS_ROOT.'/include/inc_lang/backend/en/lang.inc.php';
include_once PHPWCMS_ROOT."/include/inc_lang/code.lang.inc.php";
// check modules
require_once PHPWCMS_ROOT.'/include/inc_lib/modules.check.inc.php';
require_once (PHPWCMS_ROOT.'/include/inc_lib/backend.functions.inc.php');
require_once (PHPWCMS_ROOT.'/include/inc_lib/imagick.convert.inc.php');

if(isset($_POST['action'])) {
	$action		= isset($_POST['action']) ? clean_slweg($_POST['action'], 0, false) : false;
//	$method		= isset($_POST['method']) ? $_POST['method'] : 'json';
	$value		= isset($_POST['value']) ? intval($_POST['value']) : 0;
	$aid		= isset($_POST['aid']) ? intval($_POST['aid']) : 0;
	$cid		= isset($_POST['cid']) ? intval($_POST['cid']) : 0;
	$jquery		= true;
} elseif( isset($_GET['action']) ) {
	$action		= isset($_GET['action']) ? clean_slweg($_GET['action'], 0, false) : false;
//	$method		= isset($_GET['method']) ? $_GET['method'] : 'json';
	$value		= isset($_GET['value']) ? intval($_GET['value']) : 0;
    $aid		= isset($_GET['aid']) ? intval($_GET['aid']) : 0;
	$cid		= isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	$jquery		= true;
} else {
	$action		= false;
//	$method		= false;
	$value		= false;
    $aid		= 0;
    $cid		= 0;
	$jquery		= false;
}

if( empty($value) ) {
	$action = 'empty';
  die('Sorry, no values, no result');
}

$return_output = '';
$imagelist_output  = '';

if ( $action == 'openfolder' ) {

     //phpwcms images from given folder
  	$sql  = "SELECT * FROM ".DB_PREPEND."phpwcms_file";
  	$sql .= " WHERE f_pid=".$value;
  	$sql .= " AND f_ext IN ('jpeg', 'jpg', 'png', 'gif')";
  	$sql .= " AND f_aktiv=1";
  	$sql .= " AND f_kid=1";
  	$sql .= " AND f_trash=0";
  	//$sql .= " AND f_public=1";
  	$sql .= " ORDER BY f_sort, f_name";
  	$data = _dbQuery($sql);

    //phpwcms imagesdata from cp
    $imagesdata = array();
    //only if cp was saved already
    if($cid!=0){
        $sql2  = "SELECT acontent_form FROM ".DB_PREPEND."phpwcms_articlecontent WHERE acontent_id=".$cid." AND acontent_aid=".$aid;
        $data2 = _dbQuery($sql2);
        $data3 = unserialize($data2[0]['acontent_form']);
        $imagesdata = json_decode($data3['jqs_imagedata'],true);
    }

    foreach ($data as $val) {
        //build html img-tag
        //get image
        $thumb_image = get_cached_image(
            array(
                 "target_ext" => $val['f_ext'],
                 "image_name" => $val['f_hash'] . '.' . $val['f_ext'],
                 "max_width"  => $phpwcms['img_list_width'],
                 "max_height" => $phpwcms['img_list_height'],
                 "thumb_name" => md5($val['f_hash'] .
                     $phpwcms['img_list_width'] .
                     $phpwcms['img_list_height'] .
                     $phpwcms["sharpen_level"])
            )
        );

        //add title and descr from DB
        $image_title = '';
        $image_descr = '';
        $image_css = '';
        if ($thumb_image != false) {
            if (isset($imagesdata[$value][$val['f_id']])) {
                if(isset($imagesdata[$value][$val['f_id']][1])) {
                    //allow plain text only
                    $image_title = html_specialchars(strip_tags($imagesdata[$value][$val['f_id']][1]));
                }
                if(isset($imagesdata[$value][$val['f_id']][2])) {
                    //we allow HTML in description
                    //$image_descr = html_specialchars(strip_tags($imagesdata[$value][$val['f_id']][2]));
                    $image_descr = html_specialchars($imagesdata[$value][$val['f_id']][2]);
                }
                if(isset($imagesdata[$value][$val['f_id']][3])) {
                    //CSS Class
                    $image_css = html_specialchars(strip_tags($imagesdata[$value][$val['f_id']][3]));
                }
            }
            //html output per image - image + field title + field descr + Dialog-Link
            $imagelist_output .= '    <div class="jqs_div"><div class="jqs_imgdiv"><img src="' . PHPWCMS_IMAGES . $thumb_image[0] . '" ';
            $imagelist_output .= $thumb_image[3] . ' alt="' . $val['f_name'] . '" title="' . $val['f_name'] . '" /></div>' . LF;
            $imagelist_output .= '    <div class="jqs_cntdiv"><input class="jqs_imgtitle" type="text" maxlength="255" name="jqs_images[' . $value . '][' . $val['f_id'] . '][1]" value="' . $image_title . '" placeholder="title" />';
            $imagelist_output .= '    <textarea id="ta'.$value.$val['f_id'].'" class="jqs_imgdescr" cols="8" name="jqs_images[' . $value . '][' . $val['f_id'] . '][2]" rows="3" placeholder="description">' . $image_descr . '</textarea>';
            $imagelist_output .= '    <span id="'.$value.$val['f_id'].'" class="jqs_wysiwyg_opener">&lt;HTML&gt;</span>';
            $imagelist_output .= '    <input class="jqs_imgcss" type="text" maxlength="255" name="jqs_images[' . $value . '][' . $val['f_id'] . '][3]" value="' . $image_css . '" placeholder="css-class" />';
            $imagelist_output .= '    </div></div>';
        }
    }

    $return_output = $imagelist_output;

  } else {

    $return_output = '';

  }

  echo $return_output;

//cleanup
?>