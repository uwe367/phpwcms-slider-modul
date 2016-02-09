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

// module default stuff
if (isset($phpwcms['modules'][$module]['path'])) {

// put translation back to have easier access to it - use it as relation
    $BLM = & $BL['modules'][$module];

//includes classes
define('MODULE_HREF', 'phpwcms.php?'.get_token_get_string('csrftoken').'&amp;do=modules&amp;module='.$module);
    include_once($phpwcms['modules'][$module]['path'] . 'class/ModCustom.php');
    include_once($phpwcms['modules'][$module]['path'] . 'class/ModSliderjsSpec.php');

//open new object instance
    $mod_jqs = new ModSliderjsSpec();

// set module href backlink
    $mod_jqs->setModHref('phpwcms.php?do=modules&amp;module=' . $module);
// set modules image path
    $mod_jqs->setModImgPath($phpwcms['modules'][$module]['dir'].'img/');
// set name
    $mod_jqs->setModName("Module SliderJS");
// set version
    $mod_jqs->setModVersion("1.3");
// set author
    $mod_jqs->setModAuthor("Webrealisierung GmbH");
// set copyright from
    $mod_jqs->setModStartCr("2013");
// setDeepLink;
    // phpwcms.php
    // do='articles'
    // p=2=Edit article (p=1 would be new article)
    // s=1 single article information
// getDeepLink with these 3 params more
    // id=article ID
    // aktion empty=listing | 1=articlesummary | 2=new CP (or if with acid load existing CP)
    // acid=CpID
    $mod_jqs->setDeepLink('phpwcms.php','articles',2,1);

    /** @var mixed[] $plugin assoc array that holds all values generated from the module*/
    $plugin = array();
    $plugin['br_sliderjs'] = array();

// set controller - available:
    //module
    //about
    $plugin['br_sliderjs']['controller'] = empty($_GET['controller']) ? 'module' : strtolower($_GET['controller']);

// set action
    $plugin['br_sliderjs']['action'] = '';
    if (isset($_GET['edit'])) {
        $plugin['br_sliderjs']['action'] = 'edit';
    } elseif (isset($_GET['update'])) {
        $plugin['br_sliderjs']['action'] = 'update';
    } elseif (isset($_GET['verify'])) {
        $plugin['br_sliderjs']['action'] = 'status';
    } elseif (isset($_GET['delete'])) {
        $plugin['br_sliderjs']['action'] = 'delete';
    }

// header/body additions
// module related css
    $BE['HEADER']['module_be_css'] = '  <link href="' . $phpwcms['modules'][$module]['dir'] . 'template/backend/css/modulebackend.css" rel="stylesheet" type="text/css">';

// header
    include_once($phpwcms['modules'][$module]['path'] . 'inc/tabs.inc.php');

// when action -> processing -> action
// else -> listing
    if ($plugin['br_sliderjs']['action']) {
        include_once($phpwcms['modules'][$module]['path'] . 'inc/processing.' . $plugin['br_sliderjs']['controller'] . '.inc.php');
        include_once($phpwcms['modules'][$module]['path'] . 'inc/' . $plugin['br_sliderjs']['action'] . '.' . $plugin['br_sliderjs']['controller'] . '.inc.php');
    } else {
        include_once($phpwcms['modules'][$module]['path'] . 'inc/listing.' . $plugin['br_sliderjs']['controller'] . '.inc.php');
    }

// footer
    include_once($phpwcms['modules'][$module]['path'] . 'inc/footer.inc.php');

    unset($plugin);
}