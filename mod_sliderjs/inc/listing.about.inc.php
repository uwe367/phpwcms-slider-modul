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
<div id="br_module_body">
    <img src="<?php echo $mod_jqs->getModImgPath() . 'slider_js_header.jpg'; ?>" alt="" width="540" height="92" />
    <table class="br_module_table">
        <tr>
            <td valign="top" class="br_module_firsttdwidth">Version:</td>
            <td>Thank you for using the phpwcms-module
                <br/><strong><?php echo $mod_jqs->getModName() . " " . $mod_jqs->getModVersion(); ?></strong></td>
        </tr>
        <tr>
            <td valign="top">Licence:</td>
            <td>The module was written by webrealisierung gmbh in May 2013 and released on June 08. 2013 under the GNU
                General Public Licence
            </td>
        </tr>
        <!-- tr>
            <td valign="top">Updates:</td>
            <td>Update 1.0 in ... 20..<br /></td>
        </tr -->
        <tr>
            <td valign="top">Docu:</td>
            <td>You find a detailed documentation and changelog of all functions of the module in the <a
                    class="br_module_a" href="http://www.phpwcms-howto.de/wiki/doku.php/3rd-party-modules" target="_blank">phpwcms-howto:wiki</a>.
                There you'll find other modules to use in phpwcms as well as a <strong>donation button</strong>.
            </td>
        </tr>
    </table>
</div>
