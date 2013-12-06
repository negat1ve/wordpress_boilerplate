(function () {
    "use strict";

    var defaultCDN = 'google', // yandex || google || local
        baseDefault = '/mysuite/wp-content/themes/my-suite-103/js/',

        libVersion = {
            jQuery: (window.isMsIe !== 'undefined' && window.isMsIe < 9) ? '1.10.2' : '2.0.3',
            jQueryUi: '1.10.3',
            jQueryMigrate: '1.2.1',
        };

    var projectScript = 'main.js';

    // other scripts
    var otherScripts = [ 
            //getCdnPath('local', 'jQueryUi'),
            'plugins.js',
            projectScript
        ];

    /*============================================================================================*/

    // jQuery path
    var jQueryCdn = getCdnPath( defaultCDN, 'jQuery' ),
        jQueryLocal = [ getCdnPath( 'local', 'jQuery' ) ];

    var modernizrPath = baseDefault + '/vendor/modernizr.js';

    /*============================================================================================*/

    (function () {
        getOtherScripts();   
    }());

    function getOtherScripts() {
        var scripts,
        	key;

        for (key in otherScripts) {
        	otherScripts[key] = baseDefault + otherScripts[key];
        }

        Modernizr.load( otherScripts );

        /* Modernizr.load( [
            {
                //load: otherScripts
                //load: jQueryCdn,
                //complete: function () {
                    //scripts = ( !window.jQuery) ? jQueryLocal.concat( otherScripts ) : otherScripts;
                    //Modernizr.load( scripts );
                //}
                //Modernizr.load( otherScripts );
            }
        ] ); */
    }

    function getCdnPath( cdn, lib ) {
        cdn = cdn || 'local';

        var version = libVersion[lib],

            cdnJs = {
                google: { // avg. ping = 24 ms
                    jQuery: '//ajax.googleapis.com/ajax/libs/jquery/' + version + '/jquery.min.js',
                    jQueryUI: '//ajax.googleapis.com/ajax/libs/jqueryui/' + version + '/jquery-ui.min.js'
                },

                local: {
                    jQuery: baseDefault + '/vendor/jquery-' + version + '.min.js',
                    jQueryUI: baseDefault + '/vendor/jquery-ui.min.js'
                }
            };

        return cdnJs[cdn][lib];
    }

}());