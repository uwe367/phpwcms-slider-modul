<table class="br_module_table">
    <!-- themes -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_themes'] ?>:</td>
        <td>
            <div id="jqs_nivo_theme_div"><select name="jqs_nivo_theme" id="jqs_nivo_theme"><?php
                            $mod_sliderjs_nivo['dirlist'] = array();
                            $mod_sliderjs_nivo['full_path'] = $phpwcms["modules"][$content["module"]]['path'] . 'plugins/nivo/themes';
                            $mod_sliderjs_nivo['handle'] = opendir($mod_sliderjs_nivo['full_path']);
                            if ($mod_sliderjs_nivo['handle']) {
                                while (false !== ($mod_sliderjs_nivo['file'] = readdir($mod_sliderjs_nivo['handle']))) {
                                    if (is_dir($mod_sliderjs_nivo['full_path'] . "/" . $mod_sliderjs_nivo['file'])) {
                                        if ($mod_sliderjs_nivo['file'] != "." && $mod_sliderjs_nivo['file'] != "..") {
                                            array_push($mod_sliderjs_nivo['dirlist'], $mod_sliderjs_nivo['file']);
                                        }
                                    }
                                }
                            }

                            if (is_array($mod_sliderjs_nivo['dirlist']) && count($mod_sliderjs_nivo['dirlist'])) {
                                foreach ($mod_sliderjs_nivo['dirlist'] as $mod_sliderjs_nivo['optionval']) {
                                    $mod_sliderjs_nivo['selected_dir'] = (isset($content['br_sliderjs']['nivo']['jqs_theme']) && $mod_sliderjs_nivo['optionval'] == $content['br_sliderjs']['nivo']['jqs_theme']) ? ' selected="selected"' : '';
                                    $mod_sliderjs_nivo['optionval'] = html_specialchars($mod_sliderjs_nivo['optionval']);
                                    echo '	<option value="' . $mod_sliderjs_nivo['optionval'] . '"' . $mod_sliderjs_nivo['selected_dir'] . '>' . $mod_sliderjs_nivo['optionval'] . '</option>' . LF;
                }
                }
                ?></select>
            </div>
        </td>
    </tr>
    <tr><td></td><td><span><?php echo $phpwcms['modules'][$content["module"]]['dir'] . 'plugins/nivo/themes'; ?></span></td></tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- dimensions -->
    <tr>
        <td style="padding-top:3px;"><?php echo $BL['modules'][$content["module"]]['jqs_dimensions']; ?>:&nbsp;</td>
        <td>
            <?php echo $BL['modules'][$content["module"]]['jqs_width'] ?>
            <input type="text" name="jqs_nivo_imgwidth" id="jqs_nivo_imgwidth" value="<?php echo $content['br_sliderjs']['nivo']['jqs_imgwidth']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
            px&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_height'] ?>
            <input type="text" name="jqs_nivo_imgheight" id="jqs_nivo_imgheight" value="<?php echo $content['br_sliderjs']['nivo']['jqs_imgheight']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
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
            <input type="radio" name="jqs_nivo_cssadv" id="jqs_nivo_cssadv_0" value="0"  <?php is_checked(0, $content['br_sliderjs']['nivo']['jqs_cssadv']); ?> /><label for="jqs_nivo_cssadv_0"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv0']; ?></label>
        </td>
    </tr>
    <tr>
        <td><span class="toggle" id="tnivo1"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td>
            <input type="radio" name="jqs_nivo_cssadv" id="jqs_nivo_cssadv_1" value="1"  <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_cssadv']); ?> /><label for="jqs_nivo_cssadv_1"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv1']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tnivo1-content" class="togglecontent"><?php echo $BL['modules'][$content["module"]]['jqs_dim2'] ?><br />
                See plugins/nivo/nivo-slider.css for specific settings.
                <br />Nivo Slider allows width:100% but bear in mind that the images are rendered with the above dimensions.</div></td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- options -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_options']; ?>:</td>
        <td>
            <input type="checkbox" name="jqs_nivo_imgrand" id="jqs_nivo_imgrand" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_imgrand']); ?> />
            <label for="jqs_nivo_imgrand"><?php echo $BL['modules'][$content["module"]]['jqs_imgrand_listing'] ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_nivo_navigation" id="jqs_nivo_navigation" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_navigation']); ?> />
            <label for="jqs_nivo_navigation"><?php echo $BL['modules'][$content["module"]]['jqs_navigation']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_navigation2'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_nivo_pagination" id="jqs_nivo_pagination" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_pagination']); ?> />
            <label for="jqs_nivo_pagination"><?php echo $BL['modules'][$content["module"]]['jqs_pagination']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_pagination2'] ?>
        </td>
    </tr>

<!-- tr>
<td></td>
<td><input type="checkbox" name="jqs_nivo_play" id="jqs_nivo_play" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_play']); ?> />
<label for="jqs_nivo_play"><?php echo $BL['modules'][$content["module"]]['jqs_play']; ?></label></td>
</tr -->

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
                    <td><select name="jqs_nivo_effect" id="jqs_nivo_effect">
                        <option value="sliceDown"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'sliceDown') ?>>sliceDown</option>
                        <option value="sliceDownLeft"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'sliceDownLeft') ?>>sliceDownLeft</option>
                        <option value="sliceUp"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'sliceUp') ?>>sliceUp</option>
                        <option value="sliceUpLeft"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'sliceUpLeft') ?>>sliceUpLeft</option>
                        <option value="sliceUpDown"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'sliceUpDown') ?>>sliceUpDown</option>
                        <option value="sliceUpDownLeft"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'sliceUpDownLeft') ?>>sliceUpDownLeft</option>
                        <option value="fold"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'fold') ?>>fold</option>
                        <option value="fade"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'fade') ?>>fade</option>
                        <option value="random"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'random') ?>>random</option>
                        <option value="slideInRight"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'slideInRight') ?>>slideInRight</option>
                        <option value="slideInLeft"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'slideInLeft') ?>>slideInLeft</option>
                        <option value="boxRandom"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'boxRandom') ?>>boxRandom</option>
                        <option value="boxRain"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'boxRain') ?>>boxRain</option>
                        <option value="boxRainReverse"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'boxRainReverse') ?>>boxRainReverse</option>
                        <option value="boxRainGrow"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'boxRainGrow') ?>>boxRainGrow</option>
                        <option value="boxRainGrowReverse"<?php is_selected($content['br_sliderjs']['nivo']['jqs_effect'], 'boxRainGrowReverse') ?>>boxRainGrowReverse</option>
                    </select></td>
                    <td>
                        <input type="text" name="jqs_nivo_speed" id="jqs_nivo_speed" value="<?php echo $content['br_sliderjs']['nivo']['jqs_speed']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_nivo_autoplay" id="jqs_nivo_autoplay" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_autoplay']); ?> />
            <label for="jqs_nivo_autoplay"><?php echo $BL['modules'][$content["module"]]['jqs_play_auto']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="text" name="jqs_nivo_interval" id="jqs_nivo_interval" value="<?php echo $content['br_sliderjs']['nivo']['jqs_interval']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="6" />
            &nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_interval']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_nivo_pauseOnHover" id="jqs_nivo_pauseOnHover" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_pauseOnHover']); ?> />
            <label for="jqs_nivo_pauseOnHover"><?php echo $BL['modules'][$content["module"]]['jqs_pauseOnHover']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_nivo_caption" id="jqs_nivo_caption" value="1" <?php is_checked(1, $content['br_sliderjs']['nivo']['jqs_caption']); ?> />
            <label for="jqs_nivo_caption"><?php echo $BL['modules'][$content["module"]]['jqs_caption']; ?></label>
        </td>
    </tr>
    <tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <tr>
        <td><span class="toggle" id="tnivo2"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_jscode1']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tnivo2-content" class="togglecontent">
                <?php echo $BL['modules'][$content["module"]]['jqs_jscode2']; ?><br />option:value,<br />
                <textarea name="jqs_nivo_jscode" id="jqs_nivo_jscode" class="" placeholder="JS Code" rows="4" cols="15"><?php echo $content['br_sliderjs']['nivo']['jqs_jscode']; ?></textarea>
            </div>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spacedot"></div></td></tr>
    </tr>
    <tr>
        <td>Script:</td>
        <td>
            <a class="br_module_a" href="http://dev7studios.com/nivo-slider/" target="_blank">dev7studios.com/nivo-slider</a>
        </td>
    </tr>
</table>