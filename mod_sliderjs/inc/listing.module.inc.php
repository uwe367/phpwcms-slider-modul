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
//    die("You Cannot Access This Script Directly, Have a Nice Day.");
}

//get the structure, article and cp with all nessesary data according visibality etc. and the settings in the contentparts 'plugin:SliderJS'
$mod_jqs->jqs_get_articles();

?>

<div></div>


<!-- overwiev cp's -->
<div id="br_module_body">
    <div class="br_module_title"> <?php echo $BLM['jqs_module_title'] ?></div>

    <div class="br_module_listing">
        <?php
        $plugin['br_sliderjs']['row_count'] = 0;
        foreach ($mod_jqs->plugin_cplist as $row) {
            $mod_jqs->setStrucIcon($row["artdata"]["acat_hidden"], $row["artdata"]["acat_regonly"]);
            ?>
            <div class="br_module_listing_row<?php if ($plugin['br_sliderjs']['row_count'] % 2) echo ' even'; ?> br_module_overview_cont">

                <div class="br_module_overview_loc">

                    <table style="border-collapse:separate;border-spacing:0;">
                        <tr title="structure">
                            <td colspan="4" class="br_module_subtitle">
                                Category
                            </td>
                            <td><?php echo $mod_jqs->maxStrlen($row["artdata"]["acat_name"],20); ?></td>
                        </tr>
                        <tr title="structure">
                            <td style="width:3%;">
                                <img src="<?php echo $mod_jqs->getModImgPath() . $mod_jqs->getStrucIcon(); ?>" alt="" />
                            </td>
                            <td style="width:21%;"><?php echo $row["artdata"]["acat_id"] ?></td>
                            <td style="width:3%;">
                                <img src="<?php echo $mod_jqs->getModImgPath() ?>visible_11x11a_<?php echo $row["artdata"]["acat_aktiv"] ?>.gif" alt="active" />
                            </td>
                            <td style="width:3%;">
                                <img src="<?php echo $mod_jqs->getModImgPath() ?>public_11x11a_<?php echo $row["artdata"]["acat_public"] ?>.gif" alt="public" />
                            </td>
                            <td style="width:70%;"><?php
							
							
                                $plugin['br_sliderjs']['jslib'] = explode('-', $mod_jqs->plugin_jslib[$row["acontent_id"]]);
                                $plugin['br_sliderjs']['jslibwarning'] = "";
                                if (stripos($mod_jqs->plugin_jslib[$row["acontent_id"]], 'jquery') !== false) {
                                    echo '<span>' . $mod_jqs->plugin_jslib[$row["acontent_id"]] . '</span>';
                                    if ($plugin['br_sliderjs']['jslib'][1] < 1.8 && $plugin['br_sliderjs']['jslib'][1] != '1.10') {
                                        $plugin['br_sliderjs']['jslibwarning'] = '<span style="color:#F00;">module updates to 1.8</span>';
                                    }
                                } else {
                                    echo '<img src="' . $mod_jqs->getModImgPath() . 'visible_11x11a_9.gif" alt="" /><span style="color:#F00;">' . $mod_jqs->plugin_jslib[$row["acontent_id"]] . '</span>';
                                }
								
								
                                ?></td>
                        </tr>
                        <tr title="structure">
                            <td colspan="4"></td>
                            <td><?php echo $plugin['br_sliderjs']['jslibwarning']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="br_module_spacedot"></td>
                        </tr>
                        <tr title="article">
                            <td colspan="4" class="br_module_subtitle">
                                Article
                            </td>
                            <td><?php
                                $plugin['br_sliderjs']['output'] = "";
                                $plugin['br_sliderjs']['article_title'] = $mod_jqs->maxStrlen($row["artdata"]["article_title"], 20);
                                //if user has permissions or admin with link
                                if ($_SESSION['wcs_user_id'] == $row["artdata"]["article_uid"] || $_SESSION["wcs_user_admin"] == 1) {
                                    $plugin['br_sliderjs']['output'] .= '<a href="' . $mod_jqs->getDeepLink($row["artdata"]["article_id"]) . '">' . $plugin['br_sliderjs']['article_title'] . '</a>';
                                } else {
                                    $plugin['br_sliderjs']['output'] .= $plugin['br_sliderjs']['article_title'];
                                }
                                echo $plugin['br_sliderjs']['output'];
                                ?></td>
                        </tr>
                        <tr title="article">
                            <td><img src="<?php echo $mod_jqs->getModImgPath() ?>text_1.gif" alt="" /></td>
                            <td><?php echo $row["artdata"]["article_id"] ?></td>
                            <td>
                                <img src="<?php echo $mod_jqs->getModImgPath() ?>visible_11x11a_<?php echo $row["artdata"]["article_aktiv"] ?>.gif" alt="active" />
                            </td>
                            <td>
                                <img src="<?php echo $mod_jqs->getModImgPath() ?>public_11x11a_<?php echo $row["artdata"]["article_public"] ?>.gif" alt="public" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="br_module_spacedot"></td>
                        </tr>
                        <tr title="contentpart">
                            <td colspan="4" class="br_module_subtitle">
                                Content
                            </td>
                            <td><?php
                                $plugin['br_sliderjs']['output'] = "";
                                $plugin['br_sliderjs']['cp_title'] = $mod_jqs->maxStrlen($row["acontent_title"], 20);
                                if (strlen($row["acontent_title"]) == 0) $plugin['br_sliderjs']['cp_title'] = 'no title';

                                if ($_SESSION['wcs_user_id'] == $row["artdata"]["article_uid"] || $_SESSION["wcs_user_admin"] == 1) {
                                    $plugin['br_sliderjs']['output'] .= '<a href="' . $mod_jqs->getDeepLink($row["artdata"]["article_id"], 2, $row["acontent_id"]) . '">' . $plugin['br_sliderjs']['cp_title'] . '</a>';
                                } else {
                                    $plugin['br_sliderjs']['output'] .= $plugin['br_sliderjs']['cp_title'];
                                }
                                echo $plugin['br_sliderjs']['output'];
                                ?></td>
                        </tr>
                        <tr title="contentpart">
                            <td><img src="<?php echo $mod_jqs->getModImgPath() ?>content_9x11.gif" alt="" /></td>
                            <td><?php echo $row["acontent_id"] ?></td>
                            <td>
                                <img src="<?php echo $mod_jqs->getModImgPath() ?>visible_11x11a_<?php echo $row["acontent_visible"] ?>.gif" alt="active" />
                            </td>
                            <td></td>
                            <td><?php echo $row["acontent_tstamp"] ?></td>
                        </tr>
                    </table>
                </div>

                <div class="br_module_overview_det">

                    <table style="border-collapse:separate;border-spacing:0;width: 100%;">
                        <tr>
                            <td colspan="3" class="br_module_subtitle"><?php
                                echo $BLM['jqs_sliderplugin'];
                                echo '<strong>'.$row['acontent_form']['jqs_sliderpluginName'].'</strong>';
                                ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo $BLM['jqs_cp_actcals'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="br_module_spacedot"></td>
                        </tr>
                        <?php
                        if ($row['acontent_form']['jqs_folders'] == '') $row['acontent_form']['jqs_folders'] = array();
                        if (count($row['acontent_form']['jqs_folders'])) {
                            foreach ($row['acontent_form']['jqs_folders'] as $rowcals) {
                                $plugin['br_sliderjs']['sql'] = "SELECT f_id, f_name, f_aktiv, f_public, f_trash FROM " . DB_PREPEND . "phpwcms_file WHERE f_id=" . $rowcals;
                                $plugin['br_sliderjs']['data'] = _dbQuery($plugin['br_sliderjs']['sql']);
                                ?>
                                <tr>
                                    <td style="width: 12%;"><?php echo $plugin['br_sliderjs']['data'][0]['f_id'] ?></td>
                                    <td style="width: 78%;"><?php echo $plugin['br_sliderjs']['data'][0]['f_name'] ?></td>
                                    <td style="width: 10%;"><?php
                                        if ($plugin['br_sliderjs']['data'][0]['f_trash'] == 9) {
                                            ?>
                                            <img src="<?php echo $mod_jqs->getModImgPath() ?>active_11x11a_<?php echo $plugin['br_sliderjs']['data'][0]['f_trash'] ?>.gif" alt="deleted" /><?php
                                        } else {
                                            ?>
                                            <img src="<?php echo $mod_jqs->getModImgPath() ?>active_11x11a_<?php echo $plugin['br_sliderjs']['data'][0]['f_aktiv'] ?>.gif" alt="active" />&nbsp;<img src="<?php echo $mod_jqs->getModImgPath() ?>public_11x11a_<?php echo $plugin['br_sliderjs']['data'][0]['f_public'] ?>.gif" alt="public" /><?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="br_module_spacedot"></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3" style="color:#F00;"><?php echo $BLM['jqs_cp_nosel'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="br_module_spacedot"></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <?php
            $plugin['br_sliderjs']['row_count']++;
        } ///end foreach
        ?>
    </div>
    <!-- end overwiev cp's -->
    <?php
    if ($plugin['br_sliderjs']['row_count'] == 0) {
    // nothing found
        echo '<div>'.$BLM['jqs_no_entry'].'</div>';
    }
    unset($row, $rowcals);
    ?>
</div>