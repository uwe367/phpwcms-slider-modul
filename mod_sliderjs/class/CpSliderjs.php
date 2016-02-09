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

class CpSliderjs {

    /**
     * @var string[] $plugins array gets all plugin dirs in alphabetical order
     */
    public $plugins = array();
    /**
     * @var string $_folderlist_html html for folderlist, without parent ul tag
     */
    private $_folderlist_html = "";
    /**
     * @var string $_pluginDir the path to the plugins dirint
     */
    private $_pluginDir;

    /**
     * get info to curr jslib in template
     * @param int $tmplid categoryID
     * @return mixed[] $templ array with values of template definitions
     */
    public function getJslibDirect($tmplid) {
        $templ = array();
        $sgl = "SELECT template_id, template_name, template_var";
        $sgl .= " FROM " . DB_PREPEND . "phpwcms_template";
        $sgl .= " WHERE template_trash!=9";
        $sgl .= " AND template_id=" . $tmplid;
        $data = _dbQuery($sgl);
        if (isset($data[0])) {
            $templ = $data[0];
            $templ['template_var'] = unserialize($data[0]['template_var']);
        }
        return $templ;
    }

    /**
     * get info to curr jslib in template of actual struct/category where this CP/Article is in
     * @param int $cid categoryID Note: 0=index!!!
     * @return mixed[] $templ array with values of template definitions
     */
    public function getJslib($cid) {
        $templ = array();
        $sgl = "SELECT t.template_id, t.template_name, t.template_var, a.acat_name";
        $sgl .= " FROM " . DB_PREPEND . "phpwcms_template AS t";
        $sgl .= " INNER JOIN " . DB_PREPEND . "phpwcms_articlecat As a ON  a.acat_template=t.template_id";
        $sgl .= " WHERE t.template_trash!=9";
        $sgl .= " AND a.acat_id=" . $cid;
        $data = _dbQuery($sgl);
        if (isset($data[0])) {
            $templ = $data[0];
            $templ['template_var'] = unserialize($data[0]['template_var']);
        }
        return $templ;
    }

    /**
     * @param int $pid current folder ID
     * @param int $img_list_width
     * @param int $img_list_height
     * @param int $img_list_sl sharpen level
     * @param int[] $folders array with active folders in cp
     * @param bool|string $active to pass the status to subfolders
     * @return string html for folderlist
     */
    public function getFolderList($pid, $img_list_width, $img_list_height, $img_list_sl, $folders, $active='true') {

        $pid = intval($pid);
        $userID = intval($_SESSION["wcs_user_id"]);
        $sql = "SELECT f_id, f_name, f_aktiv, f_public, f_uid FROM " . DB_PREPEND . "phpwcms_file WHERE " .
            //"f_pid=" . intval($pid) . " AND f_aktiv=1 AND f_kid=0 AND f_trash=0 AND (f_public=1 OR f_uid=" . $userID . ") ORDER BY f_sort, f_name";
            "f_pid=" . intval($pid) . " AND f_kid=0 AND f_trash=0 AND (f_public=1 OR f_uid=" . $userID . ") ORDER BY f_sort, f_name";
        $data = _dbQuery($sql);

        foreach ($data as $key => $val) {

            $dirname = html_specialchars($val["f_name"]);
            //check if depending files/dirs exist
            $sql2 = "SELECT COUNT(f_id) FROM " . DB_PREPEND . "phpwcms_file WHERE " .
                //"f_pid=" . $val["f_id"] . " AND f_kid=0 AND f_trash=0 AND f_aktiv=1 AND (f_public=1 OR f_uid=" . $userID . ") LIMIT 1";
                "f_pid=" . $val["f_id"] . " AND f_kid=0 AND f_trash=0 AND (f_public=1 OR f_uid=" . $userID . ") LIMIT 1";
            $data2 = _dbQuery($sql2, 'COUNT');
            $folders_act = "";

            //curr ID is in selectedFoldersList
            if (in_array($val["f_id"], $folders)) {
                $folders_act = 'checked="checked"';
            }

            //start outputfor the row
            $this->_folderlist_html .= '<li class="br_module_jqs_folderlist_li">';

            //if folder active and parent not inactive
            if($val["f_aktiv"]==1 && $active=='true') {
                $this->_folderlist_html .= '<span id="openlink' . $val["f_id"] . '" class="br_module_jqs_folderlist_openlink closed" onclick="PHPWCMS_MODULE.JQS.sendRequest(' . $val["f_id"] . ');">&nbsp;</span>';
            } else {
                $this->_folderlist_html .= '<span class="br_module_jqs_folderlist_openlink">&nbsp;</span>';
            }

            $this->_folderlist_html .= '<input type="checkbox" name="jqs_folders[]" value="' . $val["f_id"] . '" ' . $folders_act;

            //if folder active and parent not inactive
            if($val["f_aktiv"]==1 && $active=='true' ) {
                $this->_folderlist_html .= ' />' . $dirname;
                $this->_folderlist_html .= '<span id="arr' . $val["f_id"] . '"></span><div id="images' . $val["f_id"] . '" style="display:none;"></div>';
            } else {
                $this->_folderlist_html .= ' disabled="disabled" />' . $dirname;
                $this->_folderlist_html .= ' (';

                //if folder itself is inactive then show image
                if($val["f_aktiv"]==0){
                    $this->_folderlist_html .= '<img style="vertical-align: text-bottom;" src="include/inc_module/mod_sliderjs/img/active_11x11a_0.gif" />';
                }

                $this->_folderlist_html .= ')';
                //curr ID is in selectedFoldersList
                if (in_array($val["f_id"], $folders)) {
                    //hidden field to pass the ID just in case it's selcted
                    $this->_folderlist_html .= '<input type="hidden" name="jqs_folders[]" value="' . $val["f_id"] . '">';
                }
            }

            //deeper if subdir
            if ($data2) {

                //pass the inactive status to all subfolders
                if($val["f_aktiv"]==0) $active='false';
                $this->_folderlist_html .= "<ul>" . LF;
                $this->getFolderList($val["f_id"], $img_list_width, $img_list_height, $img_list_sl, $folders, $active);
                $this->_folderlist_html .= "</ul>" . LF;

                //reset the status for following folders (of same level)
                $active='true';
            }
            $this->_folderlist_html .= '</li>' . LF;
        }
        return $this->_folderlist_html;
    }

    /**
     * get all dirs in plugin dir
     * @return string[] array
     */
    public function getPlugins() {
        $handle = opendir($this->_pluginDir);
        $dirlist = array();
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                if (is_dir($this->_pluginDir . $file)) {
                    if ($file != "." && $file != "..") {
                        array_push($dirlist, $file);
                    }
                }
            }
        }
        //add result to public var
        $this->plugins = $dirlist;
        return $dirlist;
    }

    /**
     * set the plugin directory
     * @param string $dir path
     */
    public function setPluginDir($dir) {
        $this->_pluginDir = $dir;
    }

    /**
     * load the plugin inc.form files
     * @param mixed[] $mod_sliderjs call by reference to array in inc.form.php
     */
    public function loadPlugins(&$mod_sliderjs) {
        foreach ($this->plugins as $val) {
            if (file_exists($this->_pluginDir . $val . '/cnt.form.' . $val . '.php')) {
                include($this->_pluginDir . $val . '/cnt.form.' . $val . '.php');
            }
        }
    }

} 