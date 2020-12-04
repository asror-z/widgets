<?php

namespace zetsoft\widgets\blocks;

use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;
use function GuzzleHttp\Psr7\str;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 * Created By: Dilmurod Axmadov
 * Refactored:
 */
class ZElfinderTest extends ZWidget
{

    public $config = [];
    public $_config = [
        'lang' => self::Lang['ru'],
        'urls' => '/core/tester/asror/elfinder.aspx',
        'mode' => self::mode['view'],
        'height' => 400,
        'width' => 'auto'
    ];


    public const mode = [
        'edit' => 'edit',
        'view' => 'view',
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

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/css/elfinder.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/css/theme.min.css');

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/elfinder.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/extras/editors.default.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.54/js/i18n/elfinder.' . $this->_config['lang'] . '.min.js');
    }

    public $event = [];
    public $_event = [
        'upload' => 'function (event, instance) {
                            var uploadedFiles = event.data.added;
                            var archives = [\'application/zip\', \'application/x-gzip\', \'application/x-tar\', \'application/x-bzip2\'];
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
             <div id="{id}"></div>
HTML,

        'context' => [
            'navbar' => ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

            'cwd' => ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

            'files' => [
                'getfile', '|', 'open', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
                'rm', '|', 'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info'
            ],
        ],
        'contextView' => [
            'navbar' => ['open', '|', 'rm', '|', 'info'],

            'cwd' => ['reload', 'back', '|', 'info'],

            'files' => [
                'open', 'quicklook', '|', 'download', '|',
                'rm', '|', 'info'
            ],
        ],
        'toolbar' => [
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

        'toolbarView' => [
            ['back', 'forward'],
            ['reload'],
            ['home', 'up'],
            ['open', 'download', 'getfile'],
            ['info'],
            ['quicklook'],
            ['search'],
            ['view'],
            ['help']
        ],


        'js' => <<<JS
         // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $(document).ready(function () {
            $('#{id}').elfinder(
                // 1st Arg - options
                {
                    cssAutoLoad: false,               // Disable CSS auto loading
                    baseUrl: './',                    // Base URL to css/*, js/*
                    url: '{url}',  // connector URL (REQUIRED)
                    lang: '{lang}',                             // language (OPTIONAL)
                    customData: {},
                    cssClass: '',
                    rememberLastDir: true,
                    useBrowserHistory: true,
                    onlyMimes: ['{typeValue}'],
                    validName: false,
                    defaultView: 'icons',
                    sort: 'nameDirsFirst',
                    sortDirect: 'asc',
                    width: '{width}',
                    height: '{height}',
                    clientFormatDate: true,
                    UTCDate: false,
                    dateFormat: '',
                    fancyDateFormat: '',
                    commands: ['*'],
                    commandsOptions: {
                        // configure value for "getFileCallback" used for editor integration
                        getfile: {
                            // send only URL or URL+path if false
                            onlyURL: false,

                            // allow to return multiple files info
                            multiple: false,

                            // allow to return folders info
                            folders: false,

                            // action after callback (close/destroy)
                            oncomplete: ''
                        },

                        // "upload" command options.
                        upload: {
                            ui: 'uploadbutton'
                        },

                        // "quicklook" command options. For additional extensions
                        quicklook: {
                            autoplay: true,
                            jplayer: 'extensions/jplayer'
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
					getFileCallback: null,
					handlers : {
						// extract archive files on upload
						change : {change},
						upload : {upload},
						viewchange : {viewchange},
						hover : {hover},
						searchstart: {searchstart},
						download: {download},
						context: {context},
						resize: {resize},
						changeclipboard: {changeclipboard},
						duplicate: {duplicate},
						paste: {paste},
						enable: {enable},
						init: {init},
						load: {load},
						disable: {disable},
						select: {select},
						remove: {remove},
						add: {add},
						dblclick: {dblclick},
						sync: {sync},
						rename: {rename},
						extract: {extract},
						get: {get},
						sortchange: {sortchange},
						search: {search},
						searchend: {searchend},
						destroy: {destroy},
						api: {api},
						open : {open},
						archive : {archive},
					},
					ui: ['toolbar', 'tree', 'path', 'stat'],
					uiOptions : {
						// toolbar configuration
						toolbar : {toolbar},

						// directories tree options
						tree : {
							// expand current root on init
							openRootOnLoad : true,
							// auto load current dir parents
							syncTree : true
						},

						// navbar options
						navbar : {
							minWidth : 150,
							maxWidth : 500
						},

						// current working directory options
						cwd : {
							// display parent directory in listing as ".."
							oldSchool : false,
							iconsView : {
			                	// default icon size (0-3 in default CSS (cwd.css - elfinder-cwd-size[number]))
			                	size: 3,
			                	// number of maximum size (3 in default CSS (cwd.css - elfinder-cwd-size[number]))
			                	// uses in preference.js
			                	sizeMax: 3,
			                	// Name of each size    
			                	sizeNames: {
			                		0: 'viewSmall',
			                		1: 'viewMedium',
			                		2: 'viewLarge',
			                		3: 'viewExtraLarge',
			                	}
			                }
						}
					},
					contextmenu : {context},
					resizable: true,
					notifyDelay: 100,
					dragUploadAllow: 'auto',
					allowShortcuts: 'true',
					loadTmbs: 5,
					showFiles: 30,
					showThreshold: 50,
                    requestType: 'get',
                    urlUpload: '',
                    iframeTimeout: 0,
                    sync: 0,
                    cookie : {
                        expires : 30,
                        domain  : '',
                        path    : '/',
                        secure  : false
                    },
                    debug : ['error', 'warning', 'event-destroy'],
                    bootCallback: function (fm, extraObj) {
                        /* any bind functions etc. */
                        fm.bind('init', function () {
                            // any your code
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
                            var some = selectedFilesOf[0].hash;

                            $("#" + some).dblclick(function (event) {
                                if (!$("#" + some).hasClass('directory')) {
                                    event.stopPropagation();
                                    window.open('http://eyuf.zettest.uz/core/tester/asror/main.aspx?path=' + path, '_blank');

                                } else {
                                }
                                /*event.stopPropagation();
                                window.open('http://eyuf.zettest.uz/core/tester/asror/main.aspx?path='+path, '_blank');*/

                            });


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
                },

                // 2nd Arg - before boot up function
                function (fm, extraObj) {
                    // `init` event callback function
                    fm.bind('init', function () {
                        // Optional for Japanese decoder "encoding-japanese.js"
                        if (fm.lang === 'ja') {
                            fm.loadScript(
                                ['//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js'],
                                function () {
                                    if (window.Encoding && Encoding.convert) {
                                        fm.registRawStringDecoder(function (s) {
                                            return Encoding.convert(s, {to: 'UNICODE', type: 'string'});
                                        });
                                    }
                                },
                                {loadType: 'tag'}
                            );
                        }
                    });
                    // Optional for set document.title dynamically.
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
                }
            );
        });
JS,

    ];

    public function codes()
    {

        $toolbar = '';
        $context = '';

        $type = $this->httpGet('type');
        $typeValue = '';

            switch ($type){
                case 'php':
                $typeValue = 'text/x-php';
                    break;
                case 'html':
                    $typeValue = 'html';
                    break;
                default:
                $typeValue = '';
                break;
        }

        switch ($this->_config['mode']) {
            case self::mode['edit']:
                $toolbar = $this->jscode($this->_layout['toolbar']);
                $context = $this->jscode($this->_layout['context']);
                break;

            case self::mode['view']:
                $toolbar = $this->jscode($this->_layout['toolbarView']);
                $context = $this->jscode($this->_layout['contextView']);
                break;
        }


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{url}' => $this->_config['urls'],
            '{lang}' => $this->jscode($this->_config['lang']),
            '{height}' => $this->_config['height'],
            '{width}' => $this->_config['width'],
            '{typeValue}' => $typeValue,

            '{toolbar}' => $toolbar,
            '{context}' => $context,

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
