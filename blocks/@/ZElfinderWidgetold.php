<?php

namespace zetsoft\widgets\blocks;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Oybek Ikromov
 * Refactored:
 */

class ZElfinderWidgetold extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'pluginId' => 'elfinder',
        'lang' => self::Lang['ru'],
        'urlConnector' => '/core/tester/asror/elfinder.aspx',
        'sortDirect' => 'asc',
        'width' => 'auto',
        'height' => 400,
        'clientFormatDate' => true,
        'UTCDate' => false,
        'dateFormat' => 'M d, Y h:i A',
        'fancyDateFormat' => '$1 H:m:i',
        'getFileOnlyURL' => false,
        'getFileMultiple' => false,
        'getFileFolders' => false,
        'getFileOnComplete' => '',

    ];

    public const Lang = [
        'ar' => 'ar',
        'bg' => 'bg',
        'ca' => 'ca',
        'cs' => 'cs',
        'da' => 'da',
        'de' => 'de',
        'el' => 'el',
        'es' => 'es',
        'fa' => 'fa',
        'fr' => 'fr',
        'he' => 'he',
        'hu' => 'hu',
        'id' => 'id',
        'it' => 'it',
        'jp' => 'jp',
        'ko' => 'ko',
        'nl' => 'nl',
        'no' => 'no',
        'pl' => 'pl',
        'pt_BR' => 'pt_BR',
        'ro' => 'ro',
        'ru' => 'ru',
        'sk' => 'sk',
        'sl' => 'sl',
        'sr' => 'sr',
        'sv' => 'sv',
        'tr' => 'tr',
        'uk' => 'uk',
        'vi' => 'vi',
        'zh_CN' => 'zh_CN',
        'zh_TW' => 'zh_TW',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'upload' => 'function (event, instance) {
                            var uploadedFiles = event.data.added;
                            var archives = [\'application/zip\', \'application/x-gzip\', \'application/x-tar\',     \'application/x-bzip2\'];
                            for (i in uploadedFiles) {
                                var file = uploadedFiles[i];
                                if (jQuery.inArray(file.mime, archives) >= 0) {
                                    instance.exec(\'extract\', file.hash);
                                }
                            }
                        }',
        'init' => 'function (event) { console.log(event) }',
        'load' => 'function (event) { console.log(event) }',
        'api' => 'function (event) { console.log(event) }',
        'enable' => 'function (event) { console.log(enable) }',
        'disable' => 'function (event) { console.log(disable) }',
        'open' => 'function (event) { console.log(event) }',
        'select' => 'function (event) { console.log(event) }',
        'dblclick' => 'function (event) {
                            event.stopPropagation();
                            window.open(\'http://eyuf.zettest.uz/core/tester/asror/main.aspx?path=\' + path, \'_blank\');
                            console.log(event)
                        }',
        'add' => 'function (event) { console.log(event) }',
        'remove' => 'function (event) { console.log(event) }',
        'change ' => 'function (event) { console.log(event) }',
        'sync' => 'function (event) { console.log(event) }',
        'changeclipboard' => 'function (event) { console.log(event) }',
        'paste' => 'function (event) { console.log(event) }',
        'rename' => 'function (event) { console.log(event) }',
        'duplicate' => 'function (event) { console.log(event) }',
        'download' => 'function (event) { console.log(event) }',
        'get' => 'function (event) { console.log(event) }',
        'resize' => 'function (event) { console.log(event) }',
        'archive' => 'function (event) { console.log(event) }',
        'extract' => 'function (event) { console.log(event) }',
        'contextmenu' => 'function (event) { console.log(event) }',
        'hover' => 'function (event) { console.log(event) }',
        'viewchange' => 'function (event) { console.log(event) }',
        'sortchange' => 'function (event) { console.log(event) }',
        'searchstart' => 'function (event) { console.log(event) }',
        'search' => 'function (event) { console.log(event) }',
        'searchend' => 'function (event) { console.log(event) }',
        'destroy' => 'function (event) { console.log(event) }',
    ];

    public $layout = [];
    public $_layout = [
          'main' => <<<HTML
            <div id="{pluginId}"></div>
HTML,
          'js' => <<<JS
            $(document).ready(function () {
                var myCommands = Object.keys(elFinder.prototype.commands);
                var disabled = ['extract', 'archive'];
                $.each(disabled, function (i, cmd) {
                    (idx = $.inArray(cmd, myCommands)) !== -1 && myCommands.splice(idx, 1);

                });
                var options = {
                    url: '{urlConnector}',
                    lang: '{lang}',
                    sortDirect: '{sortDirect}', // 'desc'
                    width: '{width}', // Can be the string 'auto' or any number measurement (in pixels)
                    height: {height}, // any number
                    clientFormatDate: {clientFormatDate}, // false
                    UTCDate: {UTCDate}, // true
                    dateFormat: '{dateFormat}', //
                    fancyDateFormat: '{fancyDateFormat}', //
                    	bootCallback : function(fm, extraObj) {
							/* any bind functions etc. */
							fm.bind('init', function() {
								// any your code
							});
							fm.bind('select', function(event) { // called on file(s) select/unselect

								var files= fm.selected();
								var hash =files[0];
								var encPath = hash.substr(hash.indexOf('_')+1);
								// full path of selected file
								// encFilePath
								var path ='render'+'/'+atob(encPath.replace(/\-/g, '+').replace(/_/g, '/').replace(/\./g, '=')) ;
								// search


								var selectedFilesOf = fm.selectedFiles();
								var	some = selectedFilesOf[0].hash;

								$("#"+ some).dblclick(function (event) {
									if (!$("#"+ some).hasClass('directory')){
										event.stopPropagation();
										window.open('http://eyuf.zettest.uz/core/tester/asror/main.aspx?path='+path, '_blank');

									}
									else {
									}
									/*event.stopPropagation();
                                    window.open('http://eyuf.zettest.uz/core/tester/asror/main.aspx?path='+path, '_blank');*/

								});


							});
							// for example set document.title dynamically.
							var title = document.title;
							fm.bind('open', function() {
								var path = '',
										cwd  = fm.cwd();
								if (cwd) {
									path = fm.path(cwd.hash) || null;
								}
								document.title = path? path + ':' + title : title;
							}).bind('destroy', function() {
								document.title = title;
							});
						},

                    commandsOptions: {
                        // configure value for "getFileCallback" used for editor integration
                        getfile: {
                            // send only URL or URL+path if false
                            onlyURL: {getFileOnlyURL},

                            // allow to return multiple files info
                            multiple: {getFileMultiple},

                            // allow to return folders info
                            folders: {getFileFolders},

                            // action after callback (close/destroy)
                            oncomplete: '{getFileOnComplete}'
                        },

                        // "upload" command options.
                        upload: {
                            ui: 'uploadbutton'
                        },

                        // "quicklook" command options. For additional extensions
                        quicklook: {
                            // to enable CAD-Files and 3D-Models preview with sharecad.org
                            sharecadMimes: ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
                            // to enable preview with Google Docs Viewer
                            googleDocsMimes: ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
                            // to enable preview with Microsoft Office Online Viewer
                            // these MIME types override "googleDocsMimes"
                            officeOnlineMimes: ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
                        },

                        // configure custom editor for file editing command
                        edit: {
                            // list of allowed mimetypes to edit
                            // if empty - any text files can be edited
                            mimes: [],

                            // edit files in wysisyg's
                            editors: [
                                // {
                                // 	/**
                                // 	 * files mimetypes allowed to edit in current wysisyg
                                // 	 * @type  Array
                                // 	 */
                                // 	mimes : ['text/html'],
                                // 	/**
                                // 	 * Called when "edit" dialog loaded.
                                // 	 * Place to init wysisyg.
                                // 	 * Can return wysisyg instance
                                // 	 *
                                // 	 * @param  DOMElement  textarea node
                                // 	 * @return Object
                                // 	 */
                                // 	load : function(textarea) { },
                                // 	/**
                                // 	 * Called before "edit" dialog closed.
                                // 	 * Place to destroy wysisyg instance.
                                // 	 *
                                // 	 * @param  DOMElement  textarea node
                                // 	 * @param  Object      wysisyg instance (if was returned by "load" callback)
                                // 	 * @return void
                                // 	 */
                                // 	close : function(textarea, instance) { },
                                // 	/**
                                // 	 * Called before file content send to backend.
                                // 	 * Place to update textarea content if needed.
                                // 	 *
                                // 	 * @param  DOMElement  textarea node
                                // 	 * @param  Object      wysisyg instance (if was returned by "load" callback)
                                // 	 * @return void
                                // 	 */
                                // 	save : function(textarea, editor) {}
                                //
                                // }
                            ]
                        },

                        // help dialog tabs
                        help: {view: ['about', 'shortcuts', 'help']}
                    },

                    bootCallback: function (fm, extraObj) {
                        /* any bind functions etc. */
                        console.log("abcd");
                        fm.bind('init', function () {


                        });
                        fm.bind('select', function (event) { // called on file(s) select/unselect

                            var files = fm.selected();
                            var hash = files[0];
                            var encPath = hash.substr(hash.indexOf('_') + 1);
                            // full path of selected file
                            // encFilePath
                            var path = 'render' + '/' + atob(encPath.replace(/\-/g, '+').replace(/_/g, '/').replace(/\./g, '='));
                            // search


                            var selectedFilesOf = fm.selectedFiles();
                            var fileMime = selectedFilesOf[0].mime;

                            var some = selectedFilesOf[0].hash;
                            if (fileMime === 'text/x-php') {
                                $("#" + some).dblclick(function (event) {
                                    event.stopPropagation();
                                    window.open('http://eyuf.zettest.uz/core/tester/asror/main.aspx?path=' + path, '_blank');

                                });
                            }


                        });
                        fm.bind('click', function (event) {

                        });

                        // for example set document.title dynamically.
                        var title = document.title;
                        fm.bind('open', function () {
                            var path = '',
                                cwd = fm.cwd();
                            if (cwd) {
                                path = fm.path(cwd.hash) || null;

                            }
                            document.title = path ? path + ':' + title : title;
                        }).bind('destroy', function () {
                            document.title = title;

                        });
                    },
                    handlers: {
                        // extract archive files on upload
                        upload: {upload},
                        init: {init},
                        load: {load},
                        api: {api},
                        enable: {enable},
                        disable: {disable},
                        open: {open},
                        select: {select},
                        dblclick: {dblclick},
                        add: {add},
                        remove: {remove},
                        change: {change},
                        sync: {sync},
                        changeclipboard: {changeclipboard},
                        paste: {paste},
                        rename: {rename},
                        duplicate: {duplicate},
                        download: {download},
                        get: {get},
                        resize: {resize},
                        archive: {archive},
                        extract: {extract},
                        contextmenu: {contextmenu},
                        hover: {hover},
                        viewchange: {viewchange},
                        sortchange: {sortchange},
                        searchstart: {searchstart},
                        search: {search},
                        searchend: {searchend},
                        destroy: {destroy}

                    },
                    ui: ['toolbar', 'tree', 'path', 'stat'], // ['toolbar', 'places', 'tree', 'path', 'stat']
                    uiOptions: {
                        // toolbar configuration
                        toolbar: [
                            ['back', 'forward'],
                            ['reload'],
                            ['home', 'up'],
                            ['mkdir', 'mkfile', 'upload'],
                            ['open', 'download', 'getfile'],
                            ['info'],
                            ['quicklook'],
                            ['copy', 'cut', 'paste'],
                            ['rm'],
                            ['duplicate', 'rename', 'edit', 'resize'],
                            ['extract', 'archive'],
                            ['search'],
                            ['view'],
                            ['help']
                        ],

                        // directories tree options
                        tree: {
                            // expand current root on init
                            openRootOnLoad: true,
                            // auto load current dir parents
                            syncTree: true
                        },

                        // navbar options
                        navbar: {
                            minWidth: 150,
                            maxWidth: 500
                        },

                        // current working directory options
                        cwd: {
                            // display parent directory in listing as ".."
                            oldSchool: false
                        }
                    },
                    
                    

                    cookie: {
                        expires: 30,
                        domain: '',
                        path: '/',
                        secure: false
                    },

                    debug: ['error', 'warning', 'event-destroy'],
                    commands: [
                        'open', 'custom', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
                        'download', 'rm', 'duplicate', 'rename', 'mkdir', 'mkfile', 'upload', 'copy',
                        'cut', 'paste', 'edit', 'extract', 'archive', 'search', 'info', 'view', 'help', 'resize', 'sort', 'netmount'
                    ],
                    contextmenu : {
                        // navbarfolder menu
                        navbar: ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],
                        // current directory menu
                        cwd: ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'sort', '|', 'info'],
                        // current directory file menu
                        files: ['getfile', '|', 'custom', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info']
                    },

                };
                $('#elfinder').elfinder(options).elfinder('instance');


                elFinder.prototype.commands.custom = function () {
                    this.exec = function (hashes) {
                        console.log(hashes)
                        //implement what the custom command should do here
                    }
                    this.getstate = function () {
                        //return 0 to enable, -1 to disable icon access
                        return 0;
                    }
                }
            }
        );
JS,
    ];

    /**
     * Constants
     */

    public function asset()
    {
       /* $this->fileCss('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
       */
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/elfinder.full.min.js');

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/css/elfinder.full.min.css');


        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/css/elfinder.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/css/theme.min.css');

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/elfinder.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/extras/editors.default.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/i18n/elfinder.'. $this->_config['lang'] . '.min.js');
    }

    public function     codes()
    {
         $this->htm = strtr($this->_layout['main'], [
            '{pluginId}' => $this->_config['pluginId']
         ]);

         $this->js = strtr($this->_layout['js'], [

            '{lang}' => $this->jscode($this->_config['lang']),
            '{urlConnector}' => $this->jscode($this->_config['urlConnector']),
            '{sortDirect}' => $this->jscode($this->_config['sortDirect']),
            '{width}' => $this->jscode($this->_config['width']),
            '{height}' => $this->jscode($this->_config['height']),
            '{clientFormatDate}' => $this->jscode($this->_config['clientFormatDate']),
            '{UTCDate}' => $this->jscode($this->_config['UTCDate']),
            '{dateFormat}' => $this->jscode($this->_config['dateFormat']),
            '{fancyDateFormat}' => $this->jscode($this->_config['fancyDateFormat']),

            /*
             * commandsOptions[getfile]
             */

            '{getFileOnlyURL}' => $this->jscode($this->_config['getFileOnlyURL']),
            '{getFileMultiple}' => $this->jscode($this->_config['getFileMultiple']),
            '{getFileFolders}' => $this->jscode($this->_config['getFileFolders']),
            '{getFileOnComplete}' => $this->jscode($this->_config['getFileOnComplete']),

            /*
             * handlers (events)
             */

            '{upload}' => $this->eventCode('upload'),
            '{init}' => $this->eventCode('init'),
            '{load}' => $this->eventCode('load'),
            '{api}' => $this->eventCode('api'),
            '{enable}' => $this->eventCode('enable'),
            '{disable}' => $this->eventCode('disable'),
            '{open}' => $this->eventCode('open'),
            '{select}' => $this->eventCode('select'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{add}' => $this->eventCode('add'),
            '{remove}' => $this->eventCode('remove'),
            '{change}' => $this->eventCode('change'),
            '{sync}' => $this->eventCode('sync'),
            '{changeclipboard}' => $this->eventCode('changeclipboard'),
            '{paste}' => $this->eventCode('paste'),
            '{rename}' => $this->eventCode('rename'),
            '{duplicate}' => $this->eventCode('duplicate'),
            '{download}' => $this->eventCode('download'),
            '{get}' => $this->eventCode('get'),
            '{resize}' => $this->eventCode('resize'),
            '{archive}' => $this->eventCode('archive'),
            '{extract}' => $this->eventCode('extract'),
            '{contextmenu}' => $this->eventCode('contextmenu'),
            '{hover}' => $this->eventCode('hover'),
            '{viewchange}' => $this->eventCode('viewchange'),
            '{sortchange}' => $this->eventCode('sortchange'),
            '{searchstart}' => $this->eventCode('searchstart'),
            '{search}' => $this->eventCode('search'),
            '{searchend}' => $this->eventCode('searchend'),
            '{destroy}' => $this->eventCode('destroy'),
            
         ]);

    }

}
