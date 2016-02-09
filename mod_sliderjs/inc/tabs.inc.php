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

?>
<h1 class="title" style="margin-bottom:10px"><?php echo $BLM['listing_title'] ?></h1>
<div id="tabsG" style="height:20px;">
    <ul>
        <li<?php if ($plugin['br_sliderjs']['controller'] == 'module') echo ' class="activeTab"'; ?>>
            <a href="<?php echo $mod_jqs->mapUrl('controller=module') ?>"><span><?php echo $BLM['tab_module'] ?></span></a>
        </li>
        <li<?php if ($plugin['br_sliderjs']['controller'] == 'about') echo ' class="activeTab"'; ?>>
            <a href="<?php echo $mod_jqs->mapUrl('controller=about') ?>"><span><?php echo $BLM['tab_about'] ?></span></a>
        </li>
    </ul>
    <br class="clear"/>
</div>