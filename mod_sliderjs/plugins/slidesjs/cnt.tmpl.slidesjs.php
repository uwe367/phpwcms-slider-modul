<table class="br_module_table">
    <!-- themes -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_themes'] ?>:</td>
        <td>
            <div id="jqs_slidesjs_theme_div"><select name="jqs_slidesjs_theme" id="jqs_slidesjs_theme"><?php
                                        $mod_sliderjs_slidesjs['dirlist'] = array();
                                        $mod_sliderjs_slidesjs['full_path'] = $phpwcms["modules"][$content["module"]]['path'] . 'plugins/slidesjs/themes';
                                        $mod_sliderjs_slidesjs['handle'] = opendir($mod_sliderjs_slidesjs['full_path']);
                                        if ($mod_sliderjs_slidesjs['handle']) {
                                            while (false !== ($mod_sliderjs_slidesjs['file'] = readdir($mod_sliderjs_slidesjs['handle']))) {
                                                if (is_dir($mod_sliderjs_slidesjs['full_path'] . "/" . $mod_sliderjs_slidesjs['file'])) {
                                                    if ($mod_sliderjs_slidesjs['file'] != "." && $mod_sliderjs_slidesjs['file'] != "..") {
                                                        array_push($mod_sliderjs_slidesjs['dirlist'], $mod_sliderjs_slidesjs['file']);
                                                    }
                                                }
                                            }
                                        }

                                        if (is_array($mod_sliderjs_slidesjs['dirlist']) && count($mod_sliderjs_slidesjs['dirlist'])) {
                                            foreach ($mod_sliderjs_slidesjs['dirlist'] as $mod_sliderjs_slidesjs['optionval']) {
                                                $mod_sliderjs_slidesjs['selected_dir'] = (isset($content['br_sliderjs']['slidesjs']['jqs_theme']) && $mod_sliderjs_slidesjs['optionval'] == $content['br_sliderjs']['slidesjs']['jqs_theme']) ? ' selected="selected"' : '';
                                                $mod_sliderjs_slidesjs['optionval'] = html_specialchars($mod_sliderjs_slidesjs['optionval']);
                                                echo '	<option value="' . $mod_sliderjs_slidesjs['optionval'] . '"' . $mod_sliderjs_slidesjs['selected_dir'] . '>' . $mod_sliderjs_slidesjs['optionval'] . '</option>' . LF;
                                            }
                                        }
                ?></select>
            </div>
        </td>
    </tr>
    <tr><td></td><td><span><?php echo $phpwcms['modules'][$content["module"]]['dir'] . 'plugins/slidesjs/themes'; ?></span></td></tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- dimensions -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_dimensions']; ?>:</td>
        <td>
            <?php echo $BL['modules'][$content["module"]]['jqs_width'] ?>
            <input type="text" name="jqs_slidesjs_imgwidth" id="jqs_slidesjs_imgwidth" value="<?php echo $content['br_sliderjs']['slidesjs']['jqs_imgwidth']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
            px&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_height'] ?>
            <input type="text" name="jqs_slidesjs_imgheight" id="jqs_slidesjs_imgheight" value="<?php echo $content['br_sliderjs']['slidesjs']['jqs_imgheight']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
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
            <input type="radio" name="jqs_slidesjs_cssadv" id="jqs_slidesjs_cssadv_0" value="0"  <?php is_checked(0, $content['br_sliderjs']['slidesjs']['jqs_cssadv']); ?> /><label for="jqs_slidesjs_cssadv_0"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv0']; ?></label>
        </td>
    </tr>
    <tr>
        <td><span class="toggle" id="tslidesjs1"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td>
            <input type="radio" name="jqs_slidesjs_cssadv" id="jqs_slidesjs_cssadv_1" value="1"  <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_cssadv']); ?> /><label for="jqs_slidesjs_cssadv_1"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv1']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tslidesjs1-content" class="togglecontent"><?php echo $BL['modules'][$content["module"]]['jqs_dim2'] ?><br />
            See plugins/slidesjs/themes/[theme].css for specific settings.
            <br />SLIDESJS does not allow %-width. Above width must be the same as in the CSS theme file!</div></td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- options -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_options']; ?>:</td>
        <td>
            <input type="checkbox" name="jqs_slidesjs_imgrand" id="jqs_slidesjs_imgrand" value="1" <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_imgrand']); ?> />
            <label for="jqs_slidesjs_imgrand"><?php echo $BL['modules'][$content["module"]]['jqs_imgrand_listing'] ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_slidesjs_navigation" id="jqs_slidesjs_navigation" value="1" <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_navigation']); ?> />
            <label for="jqs_slidesjs_navigation"><?php echo $BL['modules'][$content["module"]]['jqs_navigation']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_navigation2'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_slidesjs_pagination" id="jqs_slidesjs_pagination" value="1" <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_pagination']); ?> />
            <label for="jqs_slidesjs_pagination"><?php echo $BL['modules'][$content["module"]]['jqs_pagination']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_pagination2'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_slidesjs_play" id="jqs_slidesjs_play" value="1" <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_play']); ?> />
            <label for="jqs_slidesjs_play"><?php echo $BL['modules'][$content["module"]]['jqs_play']; ?></label>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
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
                    <td>
                        <select name="jqs_slidesjs_effect" id="jqs_slidesjs_effect" class="f11">
                            <option value="slide"<?php is_selected($content['br_sliderjs']['slidesjs']['jqs_effect'], 'slide') ?>>slide</option>
                            <option value="fade"<?php is_selected($content['br_sliderjs']['slidesjs']['jqs_effect'], 'fade') ?>>fade</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="jqs_slidesjs_speed" id="jqs_slidesjs_speed" value="<?php echo $content['br_sliderjs']['slidesjs']['jqs_speed']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_slidesjs_autoplay" id="jqs_slidesjs_autoplay" value="1" <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_autoplay']); ?> />
            <label for="jqs_slidesjs_autoplay"><?php echo $BL['modules'][$content["module"]]['jqs_play_auto']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="text" name="jqs_slidesjs_interval" id="jqs_slidesjs_interval" value="<?php echo $content['br_sliderjs']['slidesjs']['jqs_interval']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="6" />
            &nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_interval']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_slidesjs_pauseOnHover" id="jqs_slidesjs_pauseOnHover" value="1" <?php is_checked(1, $content['br_sliderjs']['slidesjs']['jqs_pauseOnHover']); ?> />
            <label for="jqs_slidesjs_pauseOnHover"><?php echo $BL['modules'][$content["module"]]['jqs_pauseOnHover']; ?></label>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <tr>
        <td><span class="toggle" id="tslidesjs2"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_jscode1']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tslidesjs2-content" class="togglecontent">
             <?php echo $BL['modules'][$content["module"]]['jqs_jscode2']; ?><br />option:value,<br />
            <textarea name="jqs_slidesjs_jscode" id="jqs_slidesjs_jscode" class="" placeholder="JS Code" rows="4" cols="15"><?php echo $content['br_sliderjs']['slidesjs']['jqs_jscode']; ?></textarea>
        </div>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spacedot"></div></td></tr>
    <tr>
        <td>Script:</td>
        <td><a class="br_module_a" href="http://www.slidesjs.com/" target="_blank">www.slidesjs.com</a></td>
    </tr>
</table>