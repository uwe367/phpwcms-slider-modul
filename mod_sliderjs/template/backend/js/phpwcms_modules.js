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
 * Self-Executing Anonymous Func
 * @param {PHPWCMS_MODULE} empty or the existing obj
 * @param {Object} jQuery
 * @param {undefined} undefined
 */
(function( PHPWCMS_MODULE, jQuery, undefined ) {

    //load JQuery if not loaded jet
    //and ability to bind it to $
		if (typeof jQuery === "undefined" || jQuery == null ) {

        AddScript("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js",
            function() {
				//$ = jQueryObj;
                //we're not shure what other libraries are loaded so we call noConflict and bind jQuery to 'jQuery' within the global namespace
                window.jQuery.noConflict();
            }
        );

		} else {

      //leave everything as it is
      //jQuery is loaded, but we still can't be sure if its the only one, to address later
		}

    //Private Properties
    //var abc = true;

    //Private Methods
    /**
     * Add script tag to head of document
     * @private
     * @param {string} url a string-based url of js-file
     * @param {function} callback reference to a user-defined method, which will be called when loading is finished
     */
    function AddScript(url, callback) {
        var script   = document.createElement('script');
        script.src   = url;
        script.type  = 'text/javascript';
        script.defer = false;

        if (typeof callback != "undefined" && callback != null) {

            // IE only, connect to event, which fires when JavaScript is loaded
            script.onreadystatechange = function() {
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                    this.onreadystatechange = this.onload = null; // prevent duplicate calls
                    callback();
                }
            }

            // FireFox and others, connect to event, which fires when JavaScript is loaded
            script.onload = function() {
                this.onreadystatechange = this.onload = null; // prevent duplicate calls
                callback();
            };
        }

        var head = document.getElementsByTagName('head').item(0);
        head.appendChild(script);
    }

    //Public Properties
    PHPWCMS_MODULE.myproperty = "Module for PHPWCMS";

    //Public Methods
    /**
     * Validate input value (on blur) allow only numbers
     * @public
     * @param {Object} elem the input field on blur
     */
    PHPWCMS_MODULE.validNumber = function (elem) {
        elem.value = elem.value.replace(/[^0-9]+/g,"");
    };

    /**
     * create a namespace
     * @param {string} ns the new namespace
     * @returns {PHPWCMS_MODULE} the object with the created namespace
     */
    PHPWCMS_MODULE.createNamespace = function (ns) {
        // First split the namespace string separating each level of the namespace object.
        var splitNs = ns.split(".");
        // Define a string, which will hold the name of the object we are currently working with.  Initialize to the first part.
        var builtNs = splitNs[0];
        var i, base = this;
        for (i = 0; i < splitNs.length; i++) {
          if (typeof(base[ splitNs[i] ]) == 'undefined') base[ splitNs[i] ] = {};
          base = base[ splitNs[i] ];
        }
        return base; // Return the namespace as an object.
    };

}( window.PHPWCMS_MODULE = window.PHPWCMS_MODULE || {}, jQuery = window.jQuery ));

//Create new namespace wherever
//PHPWCMS_MODULE.createNamespace("MyModule");