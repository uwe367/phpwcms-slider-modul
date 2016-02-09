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

/**
 * create the namespace for this module
 */
PHPWCMS_MODULE.createNamespace("JQS");

/**
 * @param {JQS} empty or the existing obj
 * @param {Object} jQuery
 * @param {undefined} undefined
 */
(function( JQS, jQuery, undefined ) {

//Private Property
    var isHot = true;

    /**
     * defined in JQS.sendRequest eventlistener of the call-link for the HTML dialog
     * @property {number} jqs_actid the ID of the textarea attached: folderID.imageID
     */
    var jqs_actid = 0;

//Public Property
    JQS.myproperty = "Modul SliderJS";

    /**
     * @public
     * @property {Number} aid the current article ID
     */
    JQS.aid = "";

    /**
     * @public
     * @property {Number} cpid the current contentpart ID
     */
    JQS.cpid = "";

//Private Method
    function jqs_is_valid(val) {
        var result = false;
        if( val==0 ) result = false;
        if( val==1 ) result = true;
        return result;
    }

//Public Methods
    /**
     * check for valid URL, if not add error class to calling input field
     * @public
     * @param {Object} elem the input field on blur to check for URL
     * @returns {boolean}
     */
    JQS.isValidURL = function (elem) {
        //Private Property
        var newClassName = "";
        var i;
        var remove = "errorInputText";
        var classes = elem.className.split(" ");
        for(i = 0; i < classes.length; i++) {
            if(classes[i] !== remove) {
                newClassName += classes[i] + " ";
            }
        }
        elem.className = newClassName;
        var url = elem.value;
        if (url=="") {
            return (true);
        }
        if (!/^https?:\/\//.test(url)) {
                url = "http://" + url;
                elem.value = url;
        }
        //var urlregex = new RegExp("^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
        var urlregex = new RegExp("^((ht|f)tp(s?))\\:\\/\\/([0-9a-zA-Z\\-]+\\.)+[a-zA-Z]{2,6}(\\:[0-9]+)?(\\/\\S*)?$");
        if (urlregex.test(url)) {
            return (true);
        }

        elem.className = elem.className + " " + remove;
        return (false);
    };

    /**
     * @public
     * @param {Object} elem input field on blur when empty add error class
     */
    JQS.requiredInput = function (elem) {
        if(jQuery(elem).val().length == 0) {
            jQuery(elem).addClass('errorInputText');
        } else {
            jQuery(elem).removeClass('errorInputText');
        }
    };

    /**
     * @public
     * @param {Number} elem the accordion panel ID to open
     */
    JQS.startTab = function (elem) {
        //jQuery( "#tabs" ).tabs( "select", elem );
        jQuery("#accordion").accordion( {active: elem} );
        //jQuery( "#accordion" ).accordion( "refresh" );
    };

    /**
     * send AJAX request to get all images within a folder
     * change classes to #openlink closed|opened and after first loading: loaded
     * no request to folders with class: loaded to preserve changes made in input fields
     * slide up|down the #images container
     * add eventlistener to .jqs_wysiwyg_opener to open jQuery UI Dialog, only open when CKEditor present
     * @param {Number} id the ID of the folder to open
     */
    JQS.sendRequest = function (id) {
        if(jQuery("#openlink" + id).hasClass("opened")) {
            jQuery("#images" + id).slideUp("slow", function() {
            });
            jQuery("#openlink" + id).removeClass("opened").addClass("closed");
        } else if(jQuery("#openlink" + id).hasClass("loaded")) {
            jQuery("#images" + id).slideDown("slow", function() {
            });
            jQuery("#openlink" + id).removeClass("closed").addClass("opened");
        } else {
            var ids = id;
            jQuery.ajax({
                type: "post",
                url: "include/inc_module/mod_sliderjs/inc/ajax.form.php",
                data: {action:"openfolder",value:ids,aid:JQS.aid,cid:JQS.cpid},
                dataType: "html",
                success:function(result){
                    jQuery("#images" + id).html(result).slideDown("slow", function() {
                    });
                    jQuery("#openlink" + id).removeClass("closed").addClass("opened");
                    jQuery("#openlink" + id).addClass("loaded");
                    jQuery( ".jqs_wysiwyg_opener" ).click(function() {
                        if (typeof(CKEDITOR) == 'undefined') {
                            alert("This feature only works with CKEditor");
                            return false;
                        } else {
                            jqs_actid = this.id;
                            jQuery( "#dialog" ).dialog( "open" );
                        }
                    });
                }
            });
        }
    }

    /**
     * self init function
     * @constructor
     */
    JQS.init = function () {

        /**
         * event listener to toggle element, slide up/down
         * @public
         * @param {Object} el HTML-element
         */
        jQuery(".toggle").click(function(el) {
            var cont = "#" + this.id + "-content";
            jQuery(cont).slideToggle("slow", function() {
            });
        });

//      jQuery("#tabs").tabs({
//          select: function(event, ui) {
//          // jQuery("#jqsseltab").val(ui.index);
//          jQuery("#jqsseltab").val( ui.panel.id.split('-')[1]);
//          }
//      });

        /**
         * jQuery UI accordion
         * auto height
         * on activate new tab add ID to #jqsseltab (hidden input)
         */
        jQuery("#accordion").accordion({
            heightStyle: "content",
            activate: function(event, ui) {
                     jQuery("#jqsseltab").val( ui.newHeader[0].id.split('-')[1] );
            }
        });

        /**
         * jQuery UI dialog
         * on open first set CKEditor presettings
         * on open load data from the #ta"+jqs_actid textarea
         * on click OK pass data to the #ta"+jqs_actid textarea
         */
        jQuery("#dialog").dialog({
            autoOpen: false,
            modal: false,
            minWidth: 700,
            maxHeight: 500,
            open: function( event, ui ) {
                CKEDITOR.config.ignoreEmptyParagraph = false;
                // CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
                CKEDITOR.instances["jqs_description"].resize( '100%', '350' );
                CKEDITOR.instances["jqs_description"].setData(jQuery("#ta"+jqs_actid).val());
            },
            close: function( event, ui ) {
                //console.log(actid);
            },
            buttons: [ {
                text: "Ok", click: function() {
                    jQuery("#ta"+jqs_actid).val(CKEDITOR.instances["jqs_description"].getData()) ;
                    jQuery( this ).dialog( "close" );
                }
            } ]
        });

    }();

}( window.PHPWCMS_MODULE.JQS = window.PHPWCMS_MODULE.JQS || {}, window.jQuery = window.jQuery || {} ));