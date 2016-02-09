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

class ModSliderjsSpec extends ModCustom {

    public $plugin_cplist = array();
    public $plugin_jslib = array();
    private $_struc_icon = "";

    /**
     * @return string
     */
    public function getStrucIcon() {
        return $this->_struc_icon;
    }

    /**
     * sets the structure icon name like: page_1_locked.gif, images see dir /img
     *
     * @param string $acat_hidden structure hidden?
     * @param string $acat_regonly structure only for registered users
     * @param string $ext the file extension
     */
    public function setStrucIcon($acat_hidden, $acat_regonly, $ext = ".gif") {
        $this->_struc_icon = 'page_';
        if (!$acat_hidden) {
            $this->_struc_icon .= '1';
        } else {
            $this->_struc_icon .= '7';
        }
        if ($acat_regonly) {
            $this->_struc_icon .= '_locked';
        }
        $this->_struc_icon .= $ext;
    }

    //get the catalogs(ID) of catalogs selected in any contentparts in any articles
    //and set the $plugin_jqs_active
    //it's not super perfect cause more or less the same thing is done in the standard search yet

    public function jqs_get_articles() {

        $sql = "SELECT article_id, article_cid, article_uid, article_title, article_username, ";
        $sql .= "article_aktiv, article_public, UNIX_TIMESTAMP(article_tstamp) AS article_date, ac.acat_id, ac.acat_name, ac.acat_aktiv, ac.acat_public, ac.acat_hidden, ac.acat_regonly  ";
        $sql .= "FROM " . DB_PREPEND . "phpwcms_article ar ";
        $sql .= "LEFT JOIN " . DB_PREPEND . "phpwcms_articlecat ac ON ";
        $sql .= "(ar.article_cid = ac.acat_id OR ar.article_cid = 0)";
        $sql .= " WHERE ";
        $sql .= "ar.article_deleted=0 AND ";
        $sql .= "IF((ar.article_begin < NOW() AND ar.article_end > NOW()) OR (ar.article_archive_status=1 AND ac.acat_archive=1), 1, 0) ";
        $sql .= "GROUP BY ar.article_id";
        $getart_data = _dbQuery($sql);
        foreach ($getart_data as $row) {
            // read article content for update
            $sql = "SELECT * FROM ";
            $sql .= DB_PREPEND . "phpwcms_articlecontent WHERE acontent_aid=" . $row["article_id"] . " ";
            $sql .= "AND acontent_module='br_sliderjs' ";
            $sql .= "AND acontent_trash=0 AND ";
            $sql .= "acontent_type = 30";
            $getacontent_data = _dbQuery($sql);

            foreach ($getacontent_data as $artrow) {
                $artrow["artdata"] = $row;
                $artrow['acontent_form'] = @unserialize($artrow['acontent_form']);
                $this->plugin_cplist[$artrow['acontent_id']] = $artrow;

                //get info to curr jslib in template of actual struct where this CP is in
                $sql = "SELECT template_id, template_name, template_var, " . DB_PREPEND . "phpwcms_articlecat.acat_name ";
                $sql .= " FROM " . DB_PREPEND . "phpwcms_template";
                $sql .= " INNER JOIN " . DB_PREPEND . "phpwcms_articlecat ON  " . DB_PREPEND . "phpwcms_articlecat.acat_template=" . DB_PREPEND . "phpwcms_template.template_id";
                $sql .= " and " . DB_PREPEND . "phpwcms_template.template_trash!=9";
                $sql .= " and " . DB_PREPEND . "phpwcms_articlecat.acat_id=" . $artrow["artdata"]["acat_id"];
                $getjslib_data = _dbQuery($sql);
                if (isset($getjslib_data[0])) {
                    $jslib = unserialize($getjslib_data[0]['template_var']);
                    $this->plugin_jslib[$artrow['acontent_id']] = $jslib['jslib'];
                }

            }
        }
    }

    public function maxStrlen($n, $l = 10) {
        $m = substr($n, 0, $l);
        if (strlen($n) > $l) {
            $m .= '&hellip;';
        }
        return $m;
    }

    public function jqs_roundAll($a) {
        $a = floatval($a);
        return round($a, 2);
    }

}