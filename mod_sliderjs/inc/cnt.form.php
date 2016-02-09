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

// SliderJS module content part form fields
// it's typically implemented in a 2 column table

// current module vars are stored in $phpwcms['modules'][$content["module"]]
// var to modules path: $phpwcms['modules'][$content["module"]]['path']

/**
 * Autoloader, includes all classes
 * @param $pClassName
 */
function my_autoload ($pClassName) {
    include(dirname(dirname(__FILE__)) . "/class/" . $pClassName . ".php");
}
spl_autoload_register("my_autoload");

/**
 * load the object
 */
$mod_obj = new CpSliderjs;

/**
 * @var mixed[] mod_jqs default values
 */
$mod_sliderjs = array();

/**
 * @var int aid current article ID
 */
$mod_sliderjs["aid"] = $content["aid"];

/**
 * if $content["id"] == 0 means this CP was not saved yet
 * we leave this to 0; the AJAX call will use 0 and therefore not find a file in the tmp dir
 * no problem, new CP's will never have assigned content to the images
 * the file in tmp dir will first be saved when saving the CP and then it will get a CP ID in cnt.post.php
 * reason: when we look for the next CP ID in DB (autoincrement) now, this could change until save (Multi User in BE)
 * @var int cpid current contentpart ID
 */
$mod_sliderjs["cpid"] = $content["id"];


//preset all vars
//plugin vars new in /plugins/[pluginname]/inc.form.[pluginname].php
$mod_sliderjs['br_sliderjs_default'] = array(
    'jqs_folders'        => array(),
    'jqs_sliderplugin'   => 0
);
//merge with values from DB
$content['br_sliderjs'] = isset($content['br_sliderjs']) ? array_merge($mod_sliderjs['br_sliderjs_default'], $content['br_sliderjs']) : $mod_sliderjs['br_sliderjs_default'];
if (empty($content['br_sliderjs']['jqs_folders'])) {
    $content['br_sliderjs']['jqs_folders'] = array();
}

//header additions
//include jquery
//$BE['HEADER']['phpwcms_jquery'] = '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>';
$BE['HEADER']['phpwcms_jquery'] = '<script type="text/javascript" src="template/lib/jquery/jquery-2.2.0.min.js"></script>';
//module related js + css
$BE['HEADER'][] = '<link href="' . $phpwcms["modules"][$content["module"]]["dir"] . 'template/backend/css/modulebackend.css" rel="stylesheet" type="text/css">';
//own jquery ui css
$BE['HEADER'][] = '<link rel="stylesheet" type="text/css" href="' . $phpwcms["modules"][$content["module"]]["dir"] . 'template/backend/css/custom/jquery-ui-1.9.2.custom.css">';
//but jquery ui from google
//$BE['HEADER'][] = '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>';
$BE['HEADER'][] = '<script type="text/javascript" src="' . $phpwcms["modules"][$content["module"]]["dir"] . 'template/backend/js/jquery-ui-1.9.2.custom.min.js"></script>';
//js
//jQuery.noConflict must be here in case there are other scripts within the site
$BE['HEADER'][] = '<script type="text/javascript">jQuery.noConflict();</script>' . LF;




/*NOTES*/

$mod_sliderjs['jqs_templ-info'] = array();
$mod_sliderjs['jqs_jslib_notes'] = 'unknown error jslib';
//if category index =0 its the index page -> values in conf.indexpage.inc.php!!! and in array $indexpage
if ($content['article']['article_cid'] == 0 && is_array($indexpage) && $indexpage['acat_name'] == $content['article']['acat_name']){

    //get the template values direct with $indexpage['acat_template'] = template ID
    $mod_sliderjs['jqs_templ-info'] = $mod_obj->getJslibDirect($indexpage['acat_template']);
    //set the category name direct
    $mod_sliderjs['jqs_templ-info']['acat_name'] = $content['article']['acat_name'];

} else {

    /**
     * generate the notes-info
     * get info to curr jslib in template of actual struct/category where this CP/Article is in
     * throw an warning when mootools or jquery lower than 1.8
     * @var mixed[] jqs_templ
     * @var int $content['article']['article_cid'] the ID of the category the curr article is in
     * $mod_obj->getJslib returns:
     *  $mod_sliderjs['jqs_templ-info'] array
     *   ['template_id'] int -
     *   ['template_name'] string -
     *   ['template_var'] array - all infos of the template
     *    ['jslib'] string - like: jquery-1.8
     *   ['acat_name'] string - the title of the category the curr article is in
     */
    $mod_sliderjs['jqs_templ-info'] = $mod_obj->getJslib($content['article']['article_cid']);
}

if ( isset($mod_sliderjs['jqs_templ-info']) && count($mod_sliderjs['jqs_templ-info']) ) {
    $mod_sliderjs['jqs_templ_var_jslib'] = explode('-', $mod_sliderjs['jqs_templ-info']['template_var']['jslib']); //jslib has the form: jquery-1.8
    if (stripos($mod_sliderjs['jqs_templ-info']['template_var']['jslib'], 'jquery') !== false) {
        if (!empty($mod_sliderjs['jqs_templ_var_jslib'][1]) && $mod_sliderjs['jqs_templ_var_jslib'][1] < '1.8' && $mod_sliderjs['jqs_templ_var_jslib'][1] != '1.10') {
            $mod_sliderjs['jqs_jslib_notes'] = $mod_sliderjs['jqs_templ-info']['template_var']['jslib'] . $BL['modules'][$content["module"]]['jqs_note4'] . $BL['modules'][$content["module"]]['jqs_note5'] . '<a class="br_module_a" href="phpwcms.php?do=admin&p=11&s=' . $mod_sliderjs['jqs_templ-info']['template_id'] . '&t=1">' . $mod_sliderjs['jqs_templ-info']['template_name'] . '</a>';
        } else {
            $mod_sliderjs['jqs_jslib_notes'] = $BL['modules'][$content["module"]]['jqs_note0'] . $mod_sliderjs['jqs_templ-info']['template_var']['jslib'] . $BL['modules'][$content["module"]]['jqs_note1'] . $mod_sliderjs['jqs_templ-info']['acat_name'];
        }
    } else {
        $mod_sliderjs['jqs_jslib_notes'] = $BL['modules'][$content["module"]]['jqs_note2'] . $mod_sliderjs['jqs_templ-info']['acat_name'] . $BL['modules'][$content["module"]]['jqs_note3'] . '<a class="br_module_a" href="phpwcms.php?do=admin&p=11&s=' . $mod_sliderjs['jqs_templ-info']['template_id'] . '&t=1">' . $mod_sliderjs['jqs_templ-info']['template_name'] . '</a>';
    }
}


/*FOLDERLIST*/
/**
 * generate the folderlist
 * only public folders and those the BE-USER has permissions to
 */
$mod_sliderjs['jqs_folderlist'] = '<ul class="br_module_jqs_folderlist">' . LF;
$mod_sliderjs['jqs_folderlist'] .= '<li class="br_module_jqs_folderlist_first">';
$mod_sliderjs['jqs_folderlist'] .=  '<img src="' . $phpwcms["modules"][$content["module"]]["dir"] . 'img/harddisk_16x11.gif" alt="" />&nbsp;';
$mod_sliderjs['jqs_folderlist'] .=  $BL['modules'][$content["module"]]['jqs_folderlistHome'] . '</li>' . LF;
//get the folderlist from root
//returns html
$mod_sliderjs['jqs_folderlist_tmp'] = $mod_obj->getFolderList(0, $phpwcms["img_list_width"], $phpwcms["img_list_height"], $phpwcms["sharpen_level"], $content['br_sliderjs']['jqs_folders']);
if (empty($mod_sliderjs['jqs_folderlist_tmp'])) {
    $mod_sliderjs['jqs_folderlist'] .=  '<li>'.$BL['modules'][$content["module"]]['jqs_folderlistNoFolder'].'</li>';
} else {
    $mod_sliderjs['jqs_folderlist'] .=  $mod_sliderjs['jqs_folderlist_tmp'];
}
$mod_sliderjs['jqs_folderlist'] .= '</ul>';


/*PLUGINS*/
/**
 * @deprecated all is done with dir-names now
 * @var mixed[] br_sliderjs_plugins array with plugins data
 * gets ordered acc to ID
 */
//$mod_sliderjs['jqs_plugins'] = array();

/**
 * @var string jqs_plugins_tabs html with ul for tabs titles
 */
$mod_sliderjs['jqs_plugins_tabs'] = "";

/**
 * set the plugin directory
 */
$mod_obj->setPluginDir($phpwcms["modules"][$content["module"]]["path"].'plugins/');

/**
 * get the plugin-directories
 * array with dir-names in alphabetical order in $mod_obj->plugins
 */
$mod_obj->getPlugins();

/**
 * load the plugins (inc.form.[plugin].php) in each plugin-dir
 * includes the files and writes back to reference ($mod_sliderjs)
 */
$mod_obj->loadPlugins($mod_sliderjs);

//tabs changed to accordion
// if we have plugins, then build tabs titles as html (ul)
//if ( is_array($mod_obj->plugins) && count($mod_obj->plugins) ) {
//    $mod_sliderjs['jqs_plugins_tabs'] ="<ul>".LF;
//    //asort($mod_sliderjs['jqs_plugins']);
//    foreach ($mod_obj->plugins as $val) {
//        $mod_sliderjs['jqs_plugins_tabs'] .= '<li id="'.$val.'"><a href="#tabs-'.$val.'">'.$content['br_sliderjs'][$val]['plugin_name'].'&nbsp;</a></li>'.LF;
//    }
//    $mod_sliderjs['jqs_plugins_tabs'] .="</ul>".LF;
//}

?>
    <!-- phpwcms bug - first column has no default width -->
    <tr>
        <td style="min-width:80px;"></td><td></td>
    </tr>

    <!-- plug-in: SliderJS -->
    <tr>
        <td colspan="2">
            <div class="br_module_spaceh10"></div>
        </td>
    </tr>
    <!-- SliderJS - Folderlist -->
    <tr>
        <td colspan="2">
            <div>
                <div class="br_module_title"><?php echo $BL['modules'][$content["module"]]['jqs_folderList'] ?></div>
                <div class="br_module_text"><?php echo $mod_sliderjs['jqs_folderlist'] ?></div>
                <div class="br_module_spaceh10"></div>
                <div class="br_module_text"><?php echo $BL['modules'][$content["module"]]['jqs_folderInfo'] ?></div>
            </div>
        </td>
    </tr>

    <!-- SliderJS - Plugins -->
    <tr>
        <td colspan="2">
            <div class="br_module_spacedot"></div>
        </td>
    </tr>
    <!-- tabs start -->
    <tr>
        <td colspan="2">
            <div class="br_module_title"><?php echo $BL['modules'][$content["module"]]['jqs_plugin'] ?>
                <span class="br_module_text"><?php echo $BL['modules'][$content["module"]]['jqs_pluginInfo'] ?></span>
            </div>

            <div id="accordion">
<?php
                //tabs deprecated
                //echo $mod_sliderjs['jqs_plugins_tabs'];
                //now accordion default index is 0
                $mod_sliderjs["startTab"] = 0;

                //loop over all plugins
                foreach ($mod_obj->plugins as $key => $val) {

                    //for accordion we need the index of the startTab JS function
                    if ($val === $content['br_sliderjs']['jqs_sliderplugin']) {
                        $mod_sliderjs["startTab"] = $key;
                    }

                    //when new $content['br_sliderjs'][$val] is empty and array_merge would result in NULL
                    //therfore we have to check if empty and set it if so
                    if(empty($content['br_sliderjs'][$val])) {
                        $content['br_sliderjs'][$val]=array();
                    }

                    //now merge the values from DB over the defaults (from cnt.article...)
                    $content['br_sliderjs'][$val] = array_merge($mod_sliderjs['br_sliderjs_default'][$val], $content['br_sliderjs'][$val]);

                    //if cnt.form... file of plugin exists then add an accordion header+panel
                    if (file_exists($phpwcms["modules"][$content["module"]]["dir"] . 'plugins/'.$val.'/cnt.tmpl.'.$val.'.php')){
                        echo '<!-- '.$content['br_sliderjs'][$val]['plugin_name'].' -->'.LF;
                        echo '<h3 id="header-'.$val.'">'.$content['br_sliderjs'][$val]['plugin_name'].'</h3>'.LF;
                        echo '<div id="panel-'.$val.'">'.LF;
                        include($phpwcms["modules"][$content["module"]]["dir"] . 'plugins/'.$val.'/cnt.tmpl.'.$val.'.php');
                        echo '</div>'.LF;
                    } else {
                        //tabs deprecated
                        //echo '<div id="tabs-'.$val.'"></div>'.LF;
                        //with accordion we don't need an else
                    }

                }
?>
            </div>
            <!-- tabs end -->
            <input type="hidden" name="jqs_sliderplugin" id="jqsseltab" value="<?php echo $content['br_sliderjs']['jqs_sliderplugin']; ?>" />
            <input type="hidden" name="jqs_reg_sliders" id="jqs_reg_sliders" value="<?php echo implode(',',$mod_obj->plugins); ?>" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="br_module_spacedot"></div>
        </td>
    </tr>

    <!-- SliderJS - Notes -->
    <tr>
        <td colspan="2">
            <div class="br_module_title"><?php echo $BL['modules'][$content["module"]]['jqs_note'] ?></div>
            <div class="br_module_text"><?php echo $mod_sliderjs['jqs_jslib_notes'] ?></div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="br_module_spacedot"></div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="dialog" title="Edit HTML"><?php
                $wysiwyg_editor = array(
                    'value'		=> "",
                    'field'		=> 'jqs_description',
                    'height'	=> '250px',
                    'width'		=> '520px',
                    'rows'		=> '6',
                    'editor'	=> $_SESSION["WYSIWYG_EDITOR"],
                    'lang'		=> 'en'
                );

                include(PHPWCMS_ROOT.'/include/inc_lib/wysiwyg.editor.inc.php');

                ?></div>
        </td>
    </tr>

<?php
//body close additions
//module related js
$BE['BODY_CLOSE'][] = '<script type="text/javascript" src="' . $phpwcms["modules"][$content["module"]]["dir"] . 'template/backend/js/phpwcms_modules.js"></script>
<script type="text/javascript" src="' . $phpwcms["modules"][$content["module"]]["dir"] . 'template/backend/js/phpwcms_module_jqs.js"></script>';
//inline js
$BE['BODY_CLOSE'][] = '<script type="text/javascript">
jQuery(document).ready(function() {
    //ui-accordion loaded by init function in JQS Class
    //load curr tab
    PHPWCMS_MODULE.JQS.startTab('.$mod_sliderjs["startTab"].');
    //set curr IDs
    PHPWCMS_MODULE.JQS.aid = ' . $mod_sliderjs["aid"] . ';
    PHPWCMS_MODULE.JQS.cpid = ' . $mod_sliderjs["cpid"] . ';

    //set event handlers
    jQuery(".toggle").trigger("click");
    //allow only numbers
    jQuery(".br_module_number").blur(function(){PHPWCMS_MODULE.validNumber(this)});
});
</script>' . LF;
unset($mod_sliderjs, $mod_sliderjs_slidesjs, $mod_sliderjs_nivo, $mod_sliderjs_bxslider);
?>