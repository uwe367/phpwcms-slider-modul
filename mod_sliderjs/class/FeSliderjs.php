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

/**
 * @param int $val either 0 or 1
 * @param string $istrue the value if $val=1
 * @param string $isfalse the value if $val=0
 * @return string on default either 'true' or 'false'
 */
function jqsIsValid($val, $istrue = 'true', $isfalse = 'false') {
    $output = $isfalse;
    if ($val == 0) {
        $output = $isfalse;
    }
    if ($val == 1) {
        $output = $istrue;
    }
    return $output;
}


function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if (is_array($value)) $val = recursive_array_search($needle,$value);
        if($needle===$value OR ($val != false and $val != NULL)) {
            if($val==NULL) return array($current_key);
            return array_merge(array($current_key), $val);
        }
    }
    return false;
}

function recursiveFolderSearch($dir,$data) {
    $returnstring = '';
    foreach($data as $val) {
        if($val['f_id'] == $dir) {
            if($val['f_aktiv'] == 1 && $val['f_trash'] == 0   ) {
                if($val['f_pid']){
                    $returnstring.= $val['f_id'];
                    $returnstring.= recursiveFolderSearch($val['f_pid'],$data);
                } elseif ($val['f_pid'] == 0){ //toplevel
                    $returnstring.= $val['f_id'];
                    $returnstring.= 0;
                }
            } else { //if not active or deleted
                $returnstring.= $val['f_id'];
                $returnstring.= 'abort';
            }
            break;
        }
    }
    return $returnstring;
}
