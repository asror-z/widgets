<?php


namespace zetsoft\widgets\blocks;

use zetsoft\dbitem\core\SessionItem;
use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\kernels\ZWidget;

/*
 *
 * Created By: Dilmurod Axmadov
 * Refactored: Ravshanov Xolmat,  Oybek Ikramov
 *
 * 
 */

class ZElfinderWidget extends ZWidget
{

    public const mainUrl = '/api/core/files/elfinder.aspx';

    public $config = [];
    public $_config = [

        'lang' => self::lang['ru'],
        'mode' => self::mode['view'],
        'height' => 800,
        'width' => 'auto',
        'type' => [],
        'handler' => "",
        'context' => [],
        // start Xolmat Ravshanov
        'isContext' => false,
        // end Xolmat Ravshanov
        'contextAll' => self::contextAll['mini'],
        'contextView' => self::contextView['mini'],
        'toolBar' => self::toolBarAll['max'],
        'toolBarView' => self::toolBarView['max'],
        'iconSize' => self::iconSize['viewMedium'],

    ];

    public const contextAll = [
        'view' => [
            'navbar' => ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

            'cwd' => ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

            'files' => [
                'getfile', '|', 'open', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
                'rm', '|', 'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info',
            ],
        ],

        'mini' => [
            'navbar' => ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

            'cwd' => ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

            'files' => [
                'getfile', '|', 'open', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|',
                'rm', '|', 'edit', 'rename', 'resize', '|', 'archive', 'extract', '|', 'info', '|', 'copyStatic'
            ],
        ],

        'maxMini' => [
            'navbar' => ['copy', 'paste', 'duplicate', '|', '|', 'info'],

            'cwd' => ['reload', 'back', '|', 'paste', '|', 'info'],

            'files' => [
                'getfile', '|', 'open', '|', '|', 'copy', 'paste', 'duplicate', '|',
                '|', 'rename', '|', 'info'
            ],
        ],


    ];
    public const contextView = [
        'view' => [
            'navbar' => ['open', '|', 'rm', '|', 'info', 'copy', 'paste'],

            'cwd' => ['reload', 'back', '|', 'info', 'copy', 'paste'],

            'files' => [
                'open', 'quicklook', '|', 'edit', '|', 'download', '|',
                '|', 'info', '|', 'copy', 'paste', '|',
            ],
        ],

        'mini' => [
            'navbar' => ['open', '|', 'rm', '|', 'info', 'copy', 'paste'],

            'cwd' => ['reload', 'back', '|', 'info', 'copy', 'paste'],

            'files' => [
                'open', 'quicklook', '|', 'edit', '|', 'download', '|',
                '|', 'info', '|', 'copy', 'paste', '|',
            ],
        ],


        'maxMini' => [
            'navbar' => ['info', 'copy', 'paste'],

            'cwd' => ['reload', 'back', '|', 'info', 'copy', 'paste'],

            'files' => [
                '|', 'info', '|', 'copy', 'paste', '|',
            ],
        ],

    ];

    public const toolBarAll = [
        'max' => [
            ['back', 'forward'],
            ['reload'],
            ['home', 'up'],
            ['mkdir', 'mkfile', 'upload'],
            ['open', 'download', 'getfile'],
            ['info'],
            ['quicklook'],
            ['copy', 'cut', 'paste',],
            ['rm'],
            ['duplicate', 'rename', 'edit', 'resize'],
            ['extract', 'archive'],
            ['search'],
            ['view'],
            ['help'],
            ['edit']
        ]
    ];
    public const toolBarView = [
        'max' => [
            ['back', 'forward'],
            ['reload'],
            ['home', 'up'],
            ['open', 'download', 'getfile'],
            ['info'],
            ['copy'],
            ['paste'],
            ['quicklook'],
            ['search'],
            ['view'],
            ['help'],
            ['edit']
        ],
    ];

    public const iconSize = [
        'viewSmall' => 0,
        'viewMedium' => 1,
        'viewLarge' => 2,
        'viewExtraLarge' => 3
    ];

    public const type = [
        'application/x-shockwave-flash' => 'application/x-shockwave-flash',  // swf
        'application/vnd.oasis.opendocument.text' => 'application/vnd.oasis.opendocument.text',  // odt
        'application/xml' => 'application/xml',      // xml
        'application/pdf' => 'application/pdf',     //pdf
        'application/vnd.ms-powerpoint' => 'application/vnd.ms-powerpoint',  // pps
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
        'application/vnd.ms-excel' => 'application/vnd.ms-excel',   // xls
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  // docx
        'application/vnd.ms-word' => 'application/vnd.ms-word', // doc
        'application/postscript' => 'application/postscript',  // ai
        'application/octet-stream' => 'application/octet-stream', //exe
        'application/flash-video' => 'application/flash-video',
        'application/x-bittorrent' => 'application/x-bittorrent',
        'application/javascript' => 'application/javascript',
        'application/rtf' => 'application/rtf',
        'application/rtfd' => 'application/rtfd',
        'application/x-font-ttf' => 'application/x-font-ttf',
        'application/x-font-otf' => 'application/x-font-otf',
        'application/x-rpm' => 'application/x-rpm',
        'application/x-web-config' => 'application/x-web-config',  //'TextPlain'
        'application/xhtml+xml' => 'application/xhtml+xml',
        'application/docbook+xml' => 'application/docbook+xml',
        'application/x-awk' => 'application/x-awk',
        'application/x-gzip' => 'application/x-gzip',
        'application/x-bzip2' => 'application/x-bzip2',
        'application/x-xz' => 'application/x-xz',
        'application/zip' => 'application/zip',
        'application/x-zip' => 'application/x-zip',
        'application/x-rar' => 'application/x-rar',
        'application/x-tar' => 'application/x-tar',
        'application/x-7z-compressed' => 'application/x-7z-compressed',
        'application/x-jar' => 'application/x-jar',
        'text/plain' => 'text/plain',
        'text/x-php' => 'text/x-php',
        'text/html' => 'text/html',
        'text/javascript' => 'text/javascript',
        'text/css' => 'text/css',
        'text/rtf' => 'text/rtf',
        'text/rtfd' => 'text/rtfd',
        'text/x-c' => 'text/x-c',
        'text/x-csrc' => 'text/x-csrc',
        'text/x-chdr' => 'text/x-chdr',
        'text/x-c++' => 'text/x-c++',
        'text/x-c++src' => 'text/x-c++src',
        'text/x-shellscript' => 'text/x-shellscript',
        'application/x-csh' => 'application/x-csh',
        'text/x-python' => 'text/x-python',
        'text/x-java' => 'text/x-java',
        'text/x-java-source' => 'text/x-java-source',
        'text/x-ruby' => 'text/x-ruby',
        'text/x-perl' => 'text/x-perl',
        'text/x-sql' => 'text/x-sql',
        'text/xml' => 'text/xml',
        'text/x-comma-separated-values' => 'text/x-comma-separated-values',
        'text/x-markdown' => 'text/x-markdown',
        'image/x-ms-bmp' => 'image/x-ms-bmp',
        'image/jpeg' => 'image/jpeg',
        'image/gif' => 'image/gif',
        'image/png' => 'image/png',
        'image/tiff' => 'image/tiff',
        'image/x-targa' => 'image/x-targa',
        'image/vnd.adobe.photoshop' => 'image/vnd.adobe.photoshop',
        'image/xbm' => 'image/xbm',
        'image/pxm' => 'image/pxm',
        'audio/mpeg' => 'audio/mpeg',
        'audio/midi' => 'audio/midi',
        'audio/ogg' => 'audio/ogg',
        'audio/mp4' => 'audio/mp4',
        'audio/x-m4a' => 'audio/x-m4a',
        'audio/wav' => 'audio/wav',
        'audio/x-mp3-playlist' => 'audio/x-mp3-playlist',

        'video/x-dv' => 'video/x-dv',
        'video/mp4' => 'video/mp4',
        'video/mpeg' => 'video/mpeg',
        'video/x-msvideo' => 'video/x-msvideo',
        'video/quicktime' => 'video/quicktime',
        'video/x-ms-wmv' => 'video/x-ms-wmv',
        'video/x-flv' => 'video/x-flv',
        'video/x-matroska' => 'video/x-matroska',
        'video/ogg' => 'video/ogg'
    ];

    public const mode = [
        'edit' => 'edit',
        'view' => 'view',
    ];

    public const lang = [
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
        'upload' => "function (event, instance) {
                            var uploadedFiles = event.data.added;
                            var archives = ['application/zip', 'application/x-gzip', 'application/x-tar', 'application/x-bzip2'];
                            for (i in uploadedFiles) {
                                var file = uploadedFiles[i];
                                if (jQuery.inArray(file.mime, archives) >= 0) {
                                    instance.exec('extract', file.hash);
                                }
                            }
                        }",
        'init' => 'function (event) { console.log(event) }',
        'load' => 'function (event) { console.log(event) }',
        'api' => 'function (event) { console.log(event) }',
        'enable' => 'function (event) { console.log(enable)}',
        'disable' => 'function (event) { console.log(disable)}',
        'open' => 'function (event) { console.log(event) }',

        'dblclick' => 'function (event) {
                            
                            console.log(event)
                        }',

        'dblclickOpen' => "function (event) { console.log(event) }",
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
        'edit' => 'function (event) { console.log(event) }',
    ];


    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
             <div id="{id}"></div>
HTML,


        'contextMenu' => <<<JS
          elFinder.prototype._options.commands.push('{contextName}');
          elFinder.prototype._options.contextmenu.files.push('{contextName}');
          elFinder.prototype.i18.en.messages.{contextName} = '{contextTitle}'; 
          
           function {contextName}(encPath) {
                            var fileNameFull = atob(encPath);
                            var mainString = '{contextUrl}';
                            if (mainString.includes("{fileNameNoExt}")){
                                fileNameFull = fileNameFull.substr(0, fileNameFull.lastIndexOf("."));
                                   var fullUrl =  mainString.replace("{fileNameNoExt}",  fileNameFull);
                                   
                           }else {
                            var fullUrl =  mainString.replace("{fileName}", fileNameFull);
                           }
                            return  fullUrl;
                         }    
        
           elFinder.prototype.commands.{contextName} = function() {
            this.exec = function(hashes) {
                
                    var file = hashes[0];
                    var encPath = file.substr(file.indexOf('_') + 1);
                    var fullPath=  {contextName}(encPath);   
                    window.open(fullPath, '_blank');               
                    return $.Deferred().resolve(); 
            
             } 
            this.getstate = function() {
                return 0;
            }
        }
        
JS,


        'js' => <<<JS
         // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        
        
        
        $(document).ready(function () {
                  {contextMenu}    
                  
          elFinder.prototype._options.commands.push('copyStatic');
          elFinder.prototype._options.contextmenu.files.push('copyStatic');
          elFinder.prototype.i18.en.messages.copyStatic = 'Dublicate file'; 
        
            elFinder.prototype.commands.copyStatic = function() {
            this.exec = function(hashes) {
            
                    
                    var some = hashes[0].substr(hashes[0].indexOf('_') + 1);   
                    var path = atob(some.substr(some.indexOf('_') + 1));
                                        
                     $.ajax({
                          method: "POST",
                          url: "/api/core/files/elfinderCopy.aspx",
                          data:{
                           
                            path: path, 
                            dst: "D:/Develop/Projects/ALL/asrorz/zetsoft/webhtm/shop/admin/reports/App/", 
                          
                          }
                        })
                          .done(function( msg ) {
                            alert( "Data Saved: " + msg );
                          });
                   
                    return $.Deferred().resolve(); 
             }
              
            this.getstate = function() {
                return 0;
            }
            
        }
                  
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
                    onlyMimes: {onlyMimes},
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

                        edit: {
                            // list of allowed mimetypes to edit
                            // if empty - any text files can be edited
                            mimes: [],

                            editors: [
                              
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
			                	size: {iconSize},
			                	sizeMax: 3,
			                	sizeNames: {
			                		0: 'viewSmall',
			                		1: 'viewMedium',
			                		2: 'viewLarge',
			                		3: 'viewExtraLarge',
			                	}
			                },
						} ,
					
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
                        fm.bind('select', function (event) { // called on 
                            // file(s) select/unselect
                    var files = fm.selected();
                    var hash = files[0];
                    var encPath = hash.substr(hash.indexOf('_') + 1);
                    var selectedFilesOf = fm.selectedFiles();
                    var id = selectedFilesOf[0].hash;
                    var fileMime = selectedFilesOf[0].mime;
                    var localId = 'l1_';
                    var localTargetHash = localId + 'Lw'; 
                    var root = atob(localTargetHash.substr(localTargetHash.indexOf('_') + 1));
                    var allowed = ['text/htm', 'text/html', 'text/x-php'];
                    //var pathWithRoot =  fm.path(id);
                   
                   //var root = pathWithRoot.split('\\\');
                    
                         function str_replace_main(encPath) {
                            var baseurl = window.location.origin;
                            var fileNameFull = atob(encPath);
                            var mainString = '{handler}';
                            if (mainString.includes("{fileNameNoExt}")){
                                fileNameFull = fileNameFull.substr(0, fileNameFull.lastIndexOf("."));
                                   var fullUrl =  mainString.replace("{fileNameNoExt}",  fileNameFull);
                           }else {
                            var fullUrl =  mainString.replace("{fileName}", fileNameFull);
                           }
                            // "/{App}" +
                            return  baseurl + fullUrl;
                         }    
                       
                         
                           if (allowed.includes(fileMime)){
                             $("#" + id).dblclick(function(event){
                              if (!$("#"+id).hasClass('directory')){
                                  event.stopPropagation();
                                  window.open(str_replace_main(encPath), '_blank');
                              }
                              if(!this.started) {
                                  this.str_replace_main("click", allowed.includes(fileMime))
                                  this.started = true
                              }
                            });
                            
                            }
                         
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

        $this->css = <<<CSS
            .elfinder-button-icon-{contextName}{ 
                 background: url('{contextIconUrl}') no-repeat center top / cover;
            } 
                     
CSS;

        $contextMenuReplace = '';
        $contextMenu = $this->_layout['contextMenu'];
        $css = '';
        foreach ($this->_config['context'] as $contextItem) {

            $contextMenuReplace .= strtr($contextMenu,
                [
                    '{contextName}' => $contextItem->name,
                    '{contextTitle}' => $contextItem->title,
                    '{contextUrl}' => $contextItem->url,
                ]);


            if ($this->_config['mode'] === 'view')
                $this->_config['contextView']['files'][] = $contextItem->name;

            else
                $this->_config['contextAll']['files'][] = $contextItem->name;


            $css .= strtr($this->css, [
                '{contextName}' => $contextItem->name,
                '{contextIconUrl}' => $contextItem->iconUrl
            ]);

        }

        $this->css = $css;

        $toolbar = '';
        $context = '';

        $sessionItem = new SessionItem();
        $sessionItem->data = $this->data;
        $sessionItem->class = ElfinderItem::class;
        $sessionItem->array = true;

        $this->sessionSetObject('elfinder', $sessionItem);

        switch ($this->_config['mode']) {
            case self::mode['edit']:
                $toolbar = $this->jscode($this->_config['toolBar']);
                $context = $this->jscode($this->_config['contextAll']);
                break;
            case self::mode['view']:
                $toolbar = $this->jscode($this->_config['toolBarView']);
                $context = $this->jscode($this->_config['contextView']);
                break;
        }


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{url}' => self::mainUrl,
            '{lang}' => $this->jscode($this->_config['lang']),
            '{height}' => $this->_config['height'],
            '{width}' => $this->_config['width'],

            '{onlyMimes}' => $this->jscode($this->_config['type']),
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
            '{dblclickOpen}' => $this->eventCode('dblclickOpen'),
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
            '{handler}' => $this->jscode($this->_config['handler']),
            '{contextMenu}' => $contextMenuReplace,
            '{iconSize}' => $this->jscode($this->_config['iconSize']),
            //'{App}' => App,
        ]);


    }
}
