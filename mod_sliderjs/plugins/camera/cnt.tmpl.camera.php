<table class="br_module_table">
    <!-- themes -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_themes'] ?>:</td>
        <td>
            <div id="jqs_camera_theme_div"><select name="jqs_camera_theme" id="jqs_camera_theme">
                    <option value="amber"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'amber') ?>>amber</option>
                    <option value="ash"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'ash') ?>>ash</option>
                    <option value="azure"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'azure') ?>>azure</option>
                    <option value="beige"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'beige') ?>>beige</option>
                    <option value="black"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'black') ?>>black</option>
                    <option value="blue"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'blue') ?>>blue</option>
                    <option value="brown"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'brown') ?>>brown</option>
                    <option value="burgundy"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'burgundy') ?>>burgundy</option>
                    <option value="charcoal"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'charcoal') ?>>charcoal</option>
                    <option value="chocolate"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'chocolate') ?>>chocolate</option>
                    <option value="coffee"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'coffee') ?>>coffee</option>
                    <option value="cyan"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'cyan') ?>>cyan</option>
                    <option value="fuchsia"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'fuchsia') ?>>fuchsia</option>
                    <option value="gold"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'gold') ?>>gold</option>
                    <option value="green"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'green') ?>>green</option>
                    <option value="grey"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'grey') ?>>grey</option>
                    <option value="indigo"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'indigo') ?>>indigo</option>
                    <option value="khaki"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'khaki') ?>>khaki</option>
                    <option value="lime"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'lime') ?>>lime</option>
                    <option value="magenta"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'magenta') ?>>magenta</option>
                    <option value="maroon"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'maroon') ?>>maroon</option>
                    <option value="olive"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'olive') ?>>olive</option>
                    <option value="orange"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'orange') ?>>orange</option>
                    <option value="pink"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'pink') ?>>pink</option>
                    <option value="pistachio"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'pistachio') ?>>pistachio</option>
                    <option value="red"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'red') ?>>red</option>
                    <option value="tangerine"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'tangerine') ?>>tangerine</option>
                    <option value="turquoise"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'turquoise') ?>>turquoise</option>
                    <option value="violet"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'violet') ?>>violet</option>
                    <option value="white"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'white') ?>>white</option>
                    <option value="yellow"<?php is_selected($content['br_sliderjs']['camera']['jqs_theme'], 'yellow') ?>>yellow</option>
                </select>
            </div>
        </td>
    </tr>
    <tr><td></td><td><span><?php echo $phpwcms['modules'][$content["module"]]['dir'] . 'plugins/camera/themes'; ?></span></td></tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- dimensions -->
    <tr>
        <td style="padding-top:3px;"><?php echo $BL['modules'][$content["module"]]['jqs_dimensions']; ?>:&nbsp;</td>
        <td>
            <?php echo $BL['modules'][$content["module"]]['jqs_width'] ?>
            <input type="text" name="jqs_camera_imgwidth" id="jqs_camera_imgwidth" value="<?php echo $content['br_sliderjs']['camera']['jqs_imgwidth']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
            px&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_height'] ?>
            <input type="text" name="jqs_camera_imgheight" id="jqs_camera_imgheight" value="<?php echo $content['br_sliderjs']['camera']['jqs_imgheight']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
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
            <input type="radio" name="jqs_camera_cssadv" id="jqs_camera_cssadv_0" value="0"  <?php is_checked(0, $content['br_sliderjs']['camera']['jqs_cssadv']); ?> /><label for="jqs_camera_cssadv_0"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv0']; ?></label>
        </td>
    </tr>
    <tr>
        <td><span class="toggle" id="tcamera1"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td>
            <input type="radio" name="jqs_camera_cssadv" id="jqs_camera_cssadv_1" value="1"  <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_cssadv']); ?> /><label for="jqs_camera_cssadv_1"><?php echo $BL['modules'][$content["module"]]['jqs_cssadv1']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tcamera1-content" class="togglecontent"><?php echo $BL['modules'][$content["module"]]['jqs_dim2'] ?><br />
                See plugins/camera/nivo-slider.css for specific settings.
                <br />Nivo Slider allows width:100% but bear in mind that the images are rendered with the above dimensions.</div></td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <!-- options -->
    <tr>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_options']; ?>:</td>
        <td>
            <input type="checkbox" name="jqs_camera_imgrand" id="jqs_camera_imgrand" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_imgrand']); ?> />
            <label for="jqs_camera_imgrand"><?php echo $BL['modules'][$content["module"]]['jqs_imgrand_listing'] ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_camera_navigation" id="jqs_camera_navigation" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_navigation']); ?> />
            <label for="jqs_camera_navigation"><?php echo $BL['modules'][$content["module"]]['jqs_navigation']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_navigation2'] ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_camera_pagination" id="jqs_camera_pagination" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_pagination']); ?> />
            <label for="jqs_camera_pagination"><?php echo $BL['modules'][$content["module"]]['jqs_pagination']; ?></label>&nbsp;&nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_pagination2'] ?>
        </td>
    </tr>

    <tr>
    <td></td>
    <td><input type="checkbox" name="jqs_camera_play" id="jqs_camera_play" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_play']); ?> />
    <label for="jqs_camera_play"><?php echo $BL['modules'][$content["module"]]['jqs_play']; ?></label></td>
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
                    <td><select name="jqs_camera_effect" id="jqs_camera_effect">
                            <option value="random"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'random') ?>>random</option>
                            <option value="simpleFade"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'simpleFade') ?>>simpleFade</option>
                            <option value="curtainTopLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'curtainTopLeft') ?>>curtainTopLeft</option>
                            <option value="curtainTopRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'curtainTopRight') ?>>curtainTopRight</option>
                            <option value="curtainBottomLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'curtainBottomLeft') ?>>curtainBottomLeft</option>
                            <option value="curtainBottomRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'curtainBottomRight') ?>>curtainBottomRight</option>
                            <option value="curtainSliceLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'curtainSliceLeft') ?>>curtainSliceLeft</option>
                            <option value="curtainSliceRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'curtainSliceRight') ?>>curtainSliceRight</option>
                            <option value="blindCurtainTopLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'blindCurtainTopLeft') ?>>blindCurtainTopLeft</option>
                            <option value="blindCurtainTopRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'blindCurtainTopRight') ?>>blindCurtainTopRight</option>
                            <option value="blindCurtainBottomLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'blindCurtainBottomLeft') ?>>blindCurtainBottomLeft</option>
                            <option value="blindCurtainBottomRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'blindCurtainBottomRight') ?>>blindCurtainBottomRight</option>
                            <option value="blindCurtainSliceBottom"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'blindCurtainSliceBottom') ?>>blindCurtainSliceBottom</option>
                            <option value="blindCurtainSliceTop"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'blindCurtainSliceTop') ?>>blindCurtainSliceTop</option>
                            <option value="stampede"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'stampede') ?>>stampede</option>
                            <option value="mosaic"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'mosaic') ?>>mosaic</option>
                            <option value="mosaicReverse"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'mosaicReverse') ?>>mosaicReverse</option>
                            <option value="mosaicRandom"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'mosaicRandom') ?>>mosaicRandom</option>
                            <option value="mosaicSpiral"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'mosaicSpiral') ?>>mosaicSpiral</option>
                            <option value="mosaicSpiralReverse"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'mosaicSpiralReverse') ?>>mosaicSpiralReverse</option>
                            <option value="topLeftBottomRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'topLeftBottomRight') ?>>topLeftBottomRight</option>
                            <option value="bottomRightTopLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'bottomRightTopLeft') ?>>bottomRightTopLeft</option>
                            <option value="bottomLeftTopRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'bottomLeftTopRight') ?>>bottomLeftTopRight</option>
                            <option value="bottomLeftTopRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'bottomLeftTopRight') ?>>bottomLeftTopRight</option>
                            <option value="scrollLeft"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'scrollLeft') ?>>scrollLeft</option>
                            <option value="scrollRight"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'scrollRight') ?>>scrollRight</option>
                            <option value="scrollHorz"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'scrollHorz') ?>>scrollHorz</option>
                            <option value="scrollBottom"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'scrollBottom') ?>>scrollBottom</option>
                            <option value="scrollTop"<?php is_selected($content['br_sliderjs']['camera']['jqs_effect'], 'scrollTop') ?>>scrollTop</option>
                    </select></td>
                    <td>
                        <input type="text" name="jqs_camera_speed" id="jqs_camera_speed" value="<?php echo $content['br_sliderjs']['camera']['jqs_speed']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="4" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_camera_autoplay" id="jqs_camera_autoplay" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_autoplay']); ?> />
            <label for="jqs_camera_autoplay"><?php echo $BL['modules'][$content["module"]]['jqs_play_auto']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="text" name="jqs_camera_interval" id="jqs_camera_interval" value="<?php echo $content['br_sliderjs']['camera']['jqs_interval']; ?>" class="br_module_w40 br_module_number" size="4" maxlength="6" />
            &nbsp;<?php echo $BL['modules'][$content["module"]]['jqs_interval']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_camera_pauseOnHover" id="jqs_camera_pauseOnHover" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_pauseOnHover']); ?> />
            <label for="jqs_camera_pauseOnHover"><?php echo $BL['modules'][$content["module"]]['jqs_pauseOnHover']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_camera_caption" id="jqs_camera_caption" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_caption']); ?> />
            <label for="jqs_camera_caption"><?php echo $BL['modules'][$content["module"]]['jqs_caption']; ?></label>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="checkbox" name="jqs_camera_captionFadein" id="jqs_camera_captionFadein" value="1" <?php is_checked(1, $content['br_sliderjs']['camera']['jqs_captionFadein']); ?> />
            <label for="jqs_camera_captionFadein">Fade in Caption</label>
        </td>
    </tr>    <tr>
    <tr><td colspan="2"><div class="br_module_spaceh10"></div></td></tr>
    <tr>
        <td><span class="toggle" id="tcamera2"><img src="<?php echo $phpwcms['modules'][$content["module"]]['dir'] ?>img/icon_info.gif" border="0" alt="help" /></span></td>
        <td><?php echo $BL['modules'][$content["module"]]['jqs_jscode1']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td><div id="tcamera2-content" class="togglecontent">
                <?php echo $BL['modules'][$content["module"]]['jqs_jscode2']; ?><br />option:value,<br />
                <textarea name="jqs_camera_jscode" id="jqs_camera_jscode" class="" placeholder="JS Code" rows="4" cols="15"><?php echo $content['br_sliderjs']['camera']['jqs_jscode']; ?></textarea>
            </div>
        </td>
    </tr>
    <tr><td colspan="2"><div class="br_module_spacedot"></div></td></tr>
    </tr>
    <tr>
        <td>Script:</td>
        <td>
            <a class="br_module_a" href="http://www.pixedelic.com/plugins/camera/" target="_blank">Camera slideshow by pixedelic</a>
        </td>
    </tr>
</table>