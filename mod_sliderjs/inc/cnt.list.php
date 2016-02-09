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

/*
// SliderJS module content part listing
*/
$cinfo["result"] = array();
$cinfo["result"][] = trim(html_specialchars(cut_string($row["acontent_title"],'&#8230;', 55)));
$cinfo["result"][] = trim(html_specialchars(cut_string($row["acontent_subtitle"],'&#8230;', 55)));

$mod_jqs = unserialize($row['acontent_form']);
$cinfo["result"][] = $mod_jqs['jqs_sliderpluginName']." - ".count($mod_jqs['jqs_folders'])." folders";

$cinfo["result"] = implode(' / ', $cinfo["result"]);

if($cinfo["result"]) {
	echo '<tr><td>&nbsp;</td><td class="v10">';
	echo '<a href="phpwcms.php?do=articles&amp;p=2&amp;s=1&amp;aktion=2&amp;id='.$article["article_id"].'&amp;acid='.$row["acontent_id"].'">';
	echo $cinfo["result"].'</a></td><td>&nbsp;</td></tr>';
}

?>