<table class="br_module_table">
    <!-- themes -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_themes'] ?>:</td>
        <td>
            <div id="jqs_bxslider_theme_div"><select name="jqs_bxslider_theme" id="jqs_bxslider_theme"><?php
                            $mod_sliderjs_bxslider['dirlist'] = array();
                            $mod_sliderjs_bxslider['full_path'] = $phpwcms["modules"][$content["module"]]['path'] . 'plugins/bxslider/themes';
                            $mod_sliderjs_bxslider['handle'] = opendir($mod_sliderjs_bxslider['full_path']);
                            if ($mod_sliderjs_bxslider['handle']) {
                                while (false !== ($mod_sliderjs_bxslider['file'] = readdir($mod_sliderjs_bxslider['handle']))) {
                                    if (is_dir($mod_sliderjs_bxslider['full_path'] . "/" . $mod_sliderjs_bxslider['file'])) {
                                        if ($mod_sliderjs_bxslider['file'] != "." && $mod_sliderjs_bxslider['file'] != "..") {
                                            array_push($mod_sliderjs_bxslider['dirlist'], $mod_sliderjs_bxslider['file']);
                                        }
                                    }
                                }
                            }

                            if (is_array($mod_sliderjs_bxslider['dirlist']) && count($mod_sliderjs_bxslider['dirlist'])) {
                                foreach ($mod_sliderjs_bxslider['dirlist'] as $mod_sliderjs_bxslider['optionval']) {
                                    $mod_sliderjs_bxslider['selected_dir'] = (isset($content['br_sliderjs']['bxslider']['jqs_theme']) && $mod_sliderjs_bxslider['optionval'] == $content['br_sliderjs']['bxslider']['jqs_theme']) ? ' selected="selected"' : '';
                                    $mod_sliderjs_bxslider['optionval'] = html_specialchars($mod_sliderjs_bxslider['optionval']);
                                    echo '	<option value="' . $mod_sliderjs_bxslider['optionval'] . '"' . $mod_sliderjs_bxslider['selected_dir'] . '>' . $mod_sliderjs_bxslider['optionval'] . '</option>' . LF;
                }
                }
                ?></select>
            </div>
        </td>
    </tr>
    <tr><td></td><td><span><?php echo $phpwcms['modules'][$content["module"]]['dir'] . 'plugins/bxslider/themes'; ?></span></td></tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- dimensions -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_dimensions']; ?>:</td>
        <td>
            <?php echo $BL['modules'][$content["module"]]['jqs_width'] ?>
            <input type="text" name="jqs_bxslider_imgwidth" id="jqs_bxslider_imgwidth" value="<?php echo $content['br_sliderjs']['bxslider']['jqs_imgwidth']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
            px&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_height'] ?>
            <input type="text" name="jqs_bxslider_imgheight" id="jqs_bxslider_imgheight" value="<?php echo $content['br_sliderjs']['bxslider']['jqs_imgheight']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
            px
        </td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_dim1'] ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="radio" name="jqs_bxslider_cssadv" id="jqs_bxslider_cssadv_0" value="0"  <?php is_checked(0, $content['br_sliderjs']['bxslider']['jqs_cssadv']); ?> /><label for="jqs_bxslider_cssadv_0"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv0']; ?></label>
        </td>
    </tr>
    <tr>
        <td><span class="toggle" id="tbxslider1"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td>
            <input type="radio" name="jqs_bxslider_cssadv" id="jqs_bxslider_cssadv_1" value="1"  <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_cssadv']); ?> /><label for="jqs_bxslider_cssadv_1"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv1']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tbxslider1-content" class="togglecontent"><?php echo $BL['modules'][$content["module"]]['jqs_dim2'] ?><br />
                See plugins/bxslider/[themes].css for specific settings.
                BXSLIDES does allow %-width.</div></td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- options -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_options']; ?>:</td>
        <td>
            <input type="checkbox" name="jqs_bxslider_imgrand" id="jqs_bxslider_imgrand" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_imgrand']); ?> />
            <label for="jqs_bxslider_imgrand"><?php echo $BL['modules'][$content["module"]]['jqs_imgrand_listing'] ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_bxslider_navigation" id="jqs_bxslider_navigation" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_navigation']); ?> />
            <label for="jqs_bxslider_navigation" class="checkbox"><?php echo $BL['modules'][$content["module"]]['jqs_navigation']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_navigation2'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_bxslider_pagination" id="jqs_bxslider_pagination" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_pagination']); ?> />
            <label for="jqs_bxslider_pagination" class="checkbox"><?php echo $BL['modules'][$content["module"]]['jqs_pagination']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_pagination2'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_bxslider_play" id="jqs_bxslider_play" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_play']); ?> />
            <label for="jqs_bxslider_play" class="checkbox"><?php echo $BL['modules'][$content["module"]]['jqs_play']; ?></label>
        </td>
    </tr>
    <!-- effect section -->
    <tr>
        <td></td>
        <td>
            <table>
                <tr>
                    <td><?php echo $BL['modules'][$content["module"]]['jqs_effect3'] ?></td>
                    <td><?php echo $BL['modules'][$content["module"]]['jqs_speed'] ?></td>
                </tr>
                <tr>
                    <td><select name="jqs_bxslider_effect" id="jqs_bxslider_effect">
                        <option value="horizontal"<?php is_selected($content['br_sliderjs']['bxslider']['jqs_effect'], 'horizontal') ?>>slide horizontal</option>
                        <option value="vertical"<?php is_selected($content['br_sliderjs']['bxslider']['jqs_effect'], 'vertical') ?>>slide vertical</option>
                        <option value="fade"<?php is_selected($content['br_sliderjs']['bxslider']['jqs_effect'], 'fade') ?>>fade</option>
                    </select></td>
                    <td>
                        <input type="text" name="jqs_bxslider_speed" id="jqs_bxslider_speed" value="<?php echo $content['br_sliderjs']['bxslider']['jqs_speed']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_bxslider_autoplay" id="jqs_bxslider_autoplay" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_autoplay']); ?> />
            <label for="jqs_bxslider_autoplay" class="checkbox"><?php echo $BL['modules'][$content["module"]]['jqs_play_auto']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="text" name="jqs_bxslider_interval" id="jqs_bxslider_interval" value="<?php echo $content['br_sliderjs']['bxslider']['jqs_interval']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="6" />
            &nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_interval']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_bxslider_pauseOnHover" id="jqs_bxslider_pauseOnHover" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_pauseOnHover']); ?> />
            <label for="jqs_bxslider_pauseOnHover" class="checkbox"><?php echo $BL['modules'][$content["module"]]['jqs_pauseOnHover']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_bxslider_caption" id="jqs_bxslider_caption" value="1" <?php is_checked(1, $content['br_sliderjs']['bxslider']['jqs_caption']); ?> />
            <label for="jqs_bxslider_caption" class="checkbox"><?php echo $BL['modules'][$content["module"]]['jqs_caption']; ?> BXSLIDER does not allow HTML in caption!</label>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <tr>
        <td><span class="toggle" id="tbxslider2"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_jscode1']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tbxslider2-content" class="togglecontent">
                <?php echo $BL['modules'][$content["module"]]['jqs_jscode2']; ?><br />option:value,<br />
                <textarea name="jqs_bxslider_jscode" id="jqs_bxslider_jscode" class="" placeholder="JS Code" rows="4" cols="15"><?php echo $content['br_sliderjs']['bxslider']['jqs_jscode']; ?></textarea>
            </div>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spacedot"></div></td></tr>
    <!-- link to script -->
    <tr>
        <td>Script:</td>
        <td><a class="br_module_a" href="http://bxslider.com/" target="_blank">bxslider.com</a></td>
    </tr>
</table>