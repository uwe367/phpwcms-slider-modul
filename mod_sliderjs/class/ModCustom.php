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

class ModCustom {

    /**
     * @var string
     */
    private $_mod_img_path = "";
    /**
     * @var string
     */
    private $_mod_name = "";
    /**
     * @var string
     */
    private $_mod_version = "";
    /**
     * @var string
     */
    private $_mod_author = "";
    /**
     * @var string
     */
    private $_mod_start_cr = "";

    /**
     * @var string $_deep_link
     */
    private $_deep_link = "";

    /**
     * @param string $mod_author
     */
    public function setModAuthor($mod_author) {
        $this->_mod_author = $mod_author;
    }

    /**
     * @return string
     */
    public function getModAuthor() {
        return $this->_mod_author;
    }

    /**
     * @param string $mod_name
     */
    public function setModName($mod_name) {
        $this->_mod_name = $mod_name;
    }

    /**
     * @return string
     */
    public function getModName() {
        return $this->_mod_name;
    }

    /**
     * @param string $mod_start_cr
     */
    public function setModStartCr($mod_start_cr) {
        $this->_mod_start_cr = $mod_start_cr;
    }

    /**
     * @return string
     */
    public function getModStartCr() {
        return $this->_mod_start_cr;
    }

    /**
     * @param string $mod_version
     */
    public function setModVersion($mod_version) {
        $this->_mod_version = $mod_version;
    }

    /**
     * @return string
     */
    public function getModVersion() {
        return $this->_mod_version;
    }


    /**
     * @param string $mod_img_path
     */
    public function setModImgPath($mod_img_path) {
        $this->_mod_img_path = $mod_img_path;
    }

    /**
     * @return string
     */
    public function getModImgPath() {
        return $this->_mod_img_path;
    }

    /**
     * @param string $file "phpwcms.php"
     * @param string $do "articles"
     * @param int $p 2=edit article (1 would be new article)
     * @param int $s single article information
     * @internal param string $mod_img_path
     */
    public function setDeepLink($file,$do,$p=2,$s=1) {
        $this->_deep_link = $file."?do=".$do."&amp;p=".$p."&amp;s=".$s;
    }

    /**
     * @param int $aid article ID
     * @param int $action empty=listing | 1=articlesummary | 2=new CP (or if with acid load existing CP)
     * @param int $cpid CpID
     * @return string
     */
    public function getDeepLink($aid, $action=0,$cpid=0) {
        $output = "";
        if ( !empty($cpid) && !empty($action) ) {
            $output = $this->_deep_link."&amp;aktion=".$action."&amp;id=".$aid."&amp;acid=".$cpid;
        } elseif(!empty($aid)) {
            $output = $this->_deep_link."&amp;id=".$aid;
        }
        return $output;
    }

    /**
     * @var string $_mod_href backlink to the module
     */
    private $_mod_href = "";

    /**
     * @param string $mod_href
     */
    public function setModHref($mod_href) {
        $this->_mod_href = $mod_href;
    }

    /**
     * @param string $get
     * @param string $type
     * @return string
     */
    public function mapUrl($get='', $type='htmlentities') {
        $base = $this->_mod_href;
        if(is_array($get) && count($get)) {
            $get = implode('&', $get);
        } elseif(empty($get)) {
            $get = '';
        }
        if($get) $get = '&'.$get;
        if(empty($type) || $type != 'htmlentities') {
            $base = str_replace('&amp;', '&', $this->_mod_href);
        } else {
            $get = htmlentities($get);
        }
        return $base.$get;
    }

} 