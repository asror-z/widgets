<?php

namespace zetsoft\widgets\inputes;

use yii\helpers\Url;
use yii\web\UploadedFile;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use function Spatie\SslCertificate\length;

/**
 * Class ZFileInputWidget
 * @package zetsoft\widgets\inputes
 * /core/tester/asror/main.aspx?path=render/inputes/ZFileInputWidget/active.php
 *
 * i:\Develop\Interface\Inputs\File\CSSJS\s43 Simple-File-Input\github.com s43 Simple-File-Input.url
 * \ \github.com s43 Simple-File-Input.url
 */
class ZFileInputWidget_jamshid extends ZWidget
{

    public const fileSuffix = '_XFile';
    public const fileAttrSuffix = '_XName';
    public const pattern = [
        'edit' => '(\w+)\[(\d+)\]\[(\w+)\]\[(\d+)\]\[(\w+)\]', // for preview and 2 edit
        'create' => '(\w+)\[(\w+)\]\[(\d+)\]\[(\w+)\]', // for default create action
        'preview' => '(\w+)\[(\d+)\]\[(\w+)\]\[(\w+)\]', // for preview CBU url
        'update' => '(\w+)\[(\w+)\]\[(\w+)\]', // for preview CBU url (update page)
        'mix' => '\[([a-zA-Z]+)\]\[(\d+)\]', //  updating for ex. [file][0][file]
        'dir-mask' => '\[(\d+)\]\[(\w+)\]\[(\d+)\]',
        'dir-ptrn' => '\[(\d+)\](\w+)',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZFileInputWidget/image/icon.png',
        'name' => Azl . 'Select2',
        'title' => Azl . '<b>Title</b><img src="/render/inputes/ZFileInputWidget/image/icon.png"/>',

    ];
    public $dbType = dbTypeJsonb;
    public $config = [];
    public $_config = [
        'zMulti' => false,
        'maxFileCount' => 50,
        'uploadAsync' => false,
        'showCaption' => true,
        'showBrowse' => true,
        'showPreview' => true,
        'showRemove' => true,
        'showUpload' => true,
        'showCancel' => true,
        'showPause' => false,
        'showClose' => false,
        'browseOnZoneClick' => false,
        'autoOrientImageInitial' => true,
        'uploadUrlThumb' => null,
        'minFileCount' => 1,
        'overwriteInitial' => false,
        'allowedPreviewTypes' => ['image', 'html', 'text', 'video', 'audio', 'flash', 'object'],
        'initialPreview' => [],
        'isPluginLoading' => true,
        'allowedFileExtensions' => null,
//        'type' => 'text',
        'type' => 'hidden',
        'allowFileTypes' => [
            'image',
            'html',
            'text',
            'video',
            'audio',
            'flash',
            'object',
        ],
        'initialPreviewConfig' => [],
        'required' => false,
        'grapes' => true,


    ];
    public $branch = [];
    public $_branch = [
        'widget' => [
            'maxFileCount',
            'uploadAsync',
        ],
        'controls' => [
            'showCaption',
            'showBrowse',
            'showPreview',
            'showRemove',
            'showUpload',
            'showCancel',
            'showPause',
            'showClose',
        ]

    ];
    public $branchLabel = [];
    public $_branchLabel = [
        'controls' => Azl . 'Элементы управление'
    ];
    public $event = [];
    public $_event = [
        'filebatchuploadsuccess' => ' console.log("ZFileInput | $eventFilebatchuploadsuccess") ',
        'filedeleted' => ' console.log("ZFileInput | $eventFilebatchuploadsuccess") ',
        'filezoomshow' => ' console.log("ZFileInput | $eventFilebatchuploadsuccess") ',
        'filebatchselected' => ' console.log("ZFileInput | $eventFilebatchuploadsuccess") '
    ];
    /**
     * @inheritdoc
     */

    public $layout = [];
    public $_layout = [
        'htm' => <<<HTML
        
        <div class="file-loading" >
        <input id="{id}" name="{name}[]" type="file" multiple>
        </div>
        
        
        <div class="file-inputs" id="{id}-inputs">
         {inputs} 
        </div>
       

        
        
HTML,
    ];
    private $modelId;

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.8/css/fileinput.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.8/js/plugins/sortable.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.8/js/plugins/purify.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.8/js/plugins/piexif.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.8/js/fileinput.min.js');
    }

    /**
     * detects last directory if required
     * Function  parseDirByAttr
     * @return  mixed
     */

    public function codes()
    {
        if ($this->model instanceof ZActiveRecord) {
            $this->modelId = $this->model->id;
            Az::$app->params['modelId'] = $this->modelId;
        } else
            $this->modelId = $this->paramGet('modelId');
        $rand = rand(1, 100);
        $this->js = <<<JS
            $(document).ready(function() {
                $("#$this->id").fileinput({
                    language: 'en',
                    showCaption: {showCaption},
                    showBrowse: {showBrowse},
                    showPreview: {showPreview},
                    showRemove: {showRemove},
                    showUpload: {showUpload},
                    showUploadStats: true,
                    showCancel: {showCancel},
                    showPause: null,
                    showClose: null,
                    showUploadedThumbs: true,
                    showConsoleLogs: true,
                    browseOnZoneClick: {browseOnZoneClick},
                    autoReplace: false,
                    autoOrientImage: function () { // applicable for JPEG images only and non ios safari
                        var ua = window.navigator.userAgent, webkit = !!ua.match(/WebKit/i),
                            iOS = !!ua.match(/iP(od|ad|hone)/i), iOSSafari = iOS && webkit && !ua.match(/CriOS/i);
                        return !iOSSafari;
                    },
                    autoOrientImageInitial: {autoOrientImageInitial},
                    required: false,
                    rtl: false,
                    hideThumbnailContent: false,
                    encodeUrl: true,
                    generateFileId: null,
                    previewClass: '',
                    captionClass: '',
                    frameClass: 'krajee-default',
                    mainClass: 'file-caption-main d-flex align-items-center',
                    mainTemplate: null,
                    purifyHtml: true,
                    fileSizeGetter: null,
                    initialCaption: '{initialCaption}',
                    initialPreview: [].concat({initialPreview}),
                    initialPreviewDelimiter: '*$$*',
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [].concat({initialPreviewConfig}),
                    initialPreviewThumbTags: [],
                    previewThumbTags: {},
                    initialPreviewShowDelete: true,
                    initialPreviewDownloadUrl: '',
                    removeFromPreviewOnError: false,
                    deleteUrl: "{deleteUrl}",
                    deleteExtraData: {},
                    overwriteInitial: true,
                    previewZoomButtonIcons: {
                        prev: '<i class="glyphicon glyphicon-triangle-left"></i>',
                        next: '<i class="glyphicon glyphicon-triangle-right"></i>',
                        toggleheader: '<i class="glyphicon glyphicon-resize-vertical"></i>',
                        fullscreen: '<i class="glyphicon glyphicon-fullscreen"></i>',
                        borderless: '<i class="glyphicon glyphicon-resize-full"></i>',
                        close: '<i class="glyphicon glyphicon-remove"></i>'
                    },
                    previewZoomButtonClasses: {
                        prev: 'btn btn-navigate',
                        next: 'btn btn-navigate',
                        toggleheader: 'btn btn-sm btn-kv btn-default btn-outline-secondary',
                        fullscreen: 'btn btn-sm btn-kv btn-default btn-outline-secondary',
                        borderless: 'btn btn-sm btn-kv btn-default btn-outline-secondary',
                        close: 'btn btn-sm btn-kv btn-default btn-outline-secondary'
                    },
                    previewTemplates: {
                        
                    },
                    previewContentTemplates: {},
                    preferIconicPreview: false,
                    preferIconicZoomPreview: false,
                    allowedFileTypes: null,
                    allowedFileExtensions: {allowedFileExtensions},
                    allowedPreviewTypes: undefined,
                    allowedPreviewMimeTypes: null,
                    allowedPreviewExtensions: null,
                    disabledPreviewTypes: undefined,
                    disabledPreviewExtensions: ['msi', 'exe', 'com', 'zip', 'rar', 'app', 'vb', 'scr'],
                    disabledPreviewMimeTypes: null,
                    defaultPreviewContent: null,
                    customLayoutTags: {},
                    customPreviewTags: {},
                    previewFileIcon: '<i class="fas fa-file kv-caption-icon"></i>',
                    previewFileIconClass: 'file-other-icon',
                    previewFileIconSettings: {
                        'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                        'docx': '<i class="fa fa-file-word-o text-primary"></i>',
                        'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                        'xlsx': '<i class="fa fa-file-excel-o text-success"></i>',
                        'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                        'jpg': '<i class="fa fa-file-photo-o text-warning"></i>',
                        'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                        'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                    },
                    previewFileExtSettings: {},
                    buttonLabelClass: 'hidden-xs',
                    browseIcon: '<i class="fas fa-folder-open"></i>&nbsp;',
                    browseClass: 'btn btn-primary',
                    removeIcon: '<i class="fas fa-trash"></i>',
                    removeClass: 'btn btn-default btn-secondary',
                    cancelIcon: '<i class="fas fa-ban"></i>',
                    cancelClass: 'btn btn-default btn-secondary',
                    pauseIcon: '<i class="glyphicon glyphicon-pause"></i>',
                    pauseClass: 'btn btn-default btn-secondary',
                    uploadIcon: '<i class="fas fa-upload"></i>',
                    uploadClass: 'btn btn-default btn-secondary',
                    uploadUrl: "{uploadUrl}",
                    uploadUrlThumb: "{uploadUrlThumb}",
                    uploadAsync: {uploadAsync},
                    uploadParamNames: {
                        chunkCount: 'chunkCount',
                        chunkIndex: 'chunkIndex',
                        chunkSize: 'chunkSize',
                        chunkSizeStart: 'chunkSizeStart',
                        chunksUploaded: 'chunksUploaded',
                        fileBlob: 'fileBlob',
                        fileId: 'fileId',
                        fileName: 'fileName',
                        fileRelativePath: 'fileRelativePath',
                        fileSize: 'fileSize',
                        retryCount: 'retryCount'
                    },
                    maxAjaxThreads: 5,
                    processDelay: 100,
                    queueDelay: 10, // must be lesser than process delay
                    progressDelay: 0, // must be lesser than process delay
                    enableResumableUpload: false,   // if it is true upload slowly
                    resumableUploadOptions: {
                        fallback: null,
                        testUrl: null, // used for checking status of chunks/ files previously / partially uploaded
                        chunkSize: 2 * 1024, // in KB
                        maxThreads: 4,
                        maxRetries: 3,
                        showErrorLog: true
                    },
                    uploadExtraData: {},
                    zoomModalHeight: 480,
                    minImageWidth: null,
                    minImageHeight: null,
                    maxImageWidth: null,
                    maxImageHeight: null,
                    resizeImage: false,
                    resizePreference: 'width',
                    resizeQuality: 0.92,
                    resizeDefaultImageType: 'image/jpeg',
                    resizeIfSizeMoreThan: 0, // in KB
                    minFileSize: 0,
                    maxFileSize: 0,
                    maxFilePreviewSize: 25600, // 25 MB
                    minFileCount: {minFileCount},
                    maxFileCount: {maxFileCount},
                    validateInitialCount: false,
                    msgValidationErrorClass: 'text-danger',
                    msgValidationErrorIcon: '<i class="glyphicon glyphicon-exclamation-sign"></i> ',
                    msgErrorClass: 'file-error-message',
                    progressThumbClass: 'progress-bar progress-bar-striped active',
                    progressClass: 'progress-bar bg-success progress-bar-success progress-bar-striped active',
                    progressInfoClass: 'progress-bar bg-info progress-bar-info progress-bar-striped active',
                    progressCompleteClass: 'progress-bar bg-success progress-bar-success',
                    progressPauseClass: 'progress-bar bg-primary progress-bar-primary progress-bar-striped active',
                    progressErrorClass: 'progress-bar bg-danger progress-bar-danger',
                    progressUploadThreshold: 99,
                    previewFileType: 'image',
                    elCaptionContainer: null,
                    elCaptionText: null,
                    elPreviewContainer: null,
                    elPreviewImage: null,
                    elPreviewStatus: null,
                    elErrorContainer: null,
                    slugCallback: function(filename) { 
                        return filename;
                    },
                    dropZoneEnabled: true,
                    dropZoneTitleClass: 'file-drop-zone-title',
                    fileActionSettings: {},
                    otherActionButtons: '',
                    textEncoding: 'UTF-8',
                    actions: '',
                    ajaxSettings: {},
                    ajaxDeleteSettings: {},
                    showAjaxErrorDetails: true,
                    mergeAjaxCallbacks: false,
                    mergeAjaxDeleteCallbacks: false,
                    retryErrorUploads: true,
                    reversePreviewOrder: false,
                    usePdfRenderer: function () {
                        //noinspection JSUnresolvedVariable
                        var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;
                        return !!navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/i) || isIE11;
                    },
                    pdfRendererUrl: '',
                    pdfRendererTemplate: '<iframe class="kv-preview-data file-preview-pdf" src="{renderer}?file={data}" {style}></iframe>'
                }).on('filesorted', function(e, params) {
                    console.log('file sorted', e, params);
                }).on('fileuploaded', function(e, params) {
                    console.log('file uploaded', e, params);
                }).on('filebatchuploadsuccess', {filebatchuploadsuccess}).on('filedeleted', {filedeleted})
                .on('filezoomshow', {filezoomshow}).on('filebatchselected', {filebatchselected});
                
                $("#$this->id").on("filepredelete", function(jqXHR) {
                    var abort = true;
                    if (confirm("Are you sure you want to delete this image?")) {
                        abort = false;
                    }
                    return abort; // you can also send any data/object that you can receive on `filecustomerror` event
                });

                reformatIcons();
                function reformatIcons(){
                    $("[class='glyphicon glyphicon-trash']").attr('class', 'fas fa-trash');
                    $("[class='glyphicon glyphicon-zoom-in']").attr('class', 'fas fa-search-plus');
                    $("[class='glyphicon glyphicon-move']").attr('class', 'fas fa-arrows-alt');
                    $("[class='fas fa-file kv-caption-icon']").attr('class', 'fas fa-file kv-caption-icon');
                    $("[class='fas fa-upload']").attr('class', 'fas fa-upload');
                    $("[class='fas fa-ban']").attr('class', 'fas fa-ban');
                    $("[class='fas fa-folder-open']").attr('class', 'fas fa-folder-open');
                
                }
                var isUpload{$rand} = false;
                    
                if ({required}){
                    $('.field-{id}').find('.fileinput-upload-button').on('click', function() {
                        return isUpload{$rand} = true;         
                    });
                    
                    $(document).on('click', '.kv-file-upload', function() {
                        $('#{$this->id}').fileinput('upload');
                        return isUpload{$rand} = true;
                    });
                  
                } else {
                    $(document).on('click', '.kv-file-upload', function() {
                        $('#{$this->id}').fileinput('upload');
                    });
                    
                    return isUpload{$rand} = true;
                }
                
                // console.log('isUpload:', isUpload{$rand});
                
                $('.kv-form-horizontal').on('beforeValidate', function (e) {
                    if (isUpload{$rand}) {
                        return true;
                    } else {
                        $('#{$this->id}').fileinput('upload');
                        return false;
                    } 
                });
            });
JS;

        $this->htm = strtr($this->_layout['htm'], [
            '{id}' => $this->id,

            '{name}' => $this->name,
        ]);

        $this->css = <<<CSS
            .file-caption-info{
                font-size: 12px;
            }
            .file-size-info{
                font-size: 12px;
            }
         
            .file-preview-other{
                /*display: flex;*/
                /*align-items: center;*/
               /* justify-content: center;*/
                /*margin-top: 4rem;*/
            }
            /*!!!!  css siz buzilib ketvotti  !!!!*/
CSS;

        if ($this->model instanceof ZActiveRecord) {
            $value = $this->model->getAttribute($this->attributeAll);
            $className = bname($this->modelClassName);
        } else {
            $value = $this->value;
            $className = $this->parseClassName();
            $this->parseAttribute();
        }

        $match = Az::$app->utility->pregs->pregMatchAll($this->name, '\[(.*?)\]');
        $match = ZArrayHelper::getValue($match, 1);

//        $sPrefix = "/{$this->moduleId}/{$this->controlId}";
        $sSuffix = "modelClassName={$className}&attribute={$this->name}";
        $uploadUrl = "/api/core/files/upload.aspx?{$sSuffix}&test=true";
        $deleteUrl = "/api/core/files/delete-file.aspx?{$sSuffix}&id={$this->modelId}";

        $required = $this->_config['required'];
        if (!empty($this->value)) {
            $required = 0;
        }

        $name = $this->name;
        $initialFileInputs = '';

        if (!empty($value) && is_array($value)) {

            $modelName = $className;
            $isDyno = is_numeric($match[0]);

            foreach ($value as $key => $file) {
                if (!is_array($file)) {
                    if ($isDyno)
                        switch (count($match)) {
                            case 4:
                                $this->_config['initialPreview'][] = Url::to("/uploaz/" . App . "/{$modelName}/{$match[1]}/$this->modelId/{$match[2]}/{$match[3]}/{$file}");
                                break;
                            case 3:
                                $this->_config['initialPreview'][] = Url::to("/uploaz/" . App . "/{$modelName}/{$match[1]}/$this->modelId/{$match[2]}/{$file}");
                                break;
                            default:
                                $this->_config['initialPreview'][] = Url::to("/uploaz/" . App . "/{$modelName}/{$match[1]}/$this->modelId/{$file}");
                                break;
                        }
                    else
                        switch (count($match)) {
                            case 3:
                                $this->_config['initialPreview'][] = Url::to("/uploaz/" . App . "/{$modelName}/{$match[0]}/$this->modelId/{$match[1]}/{$match[2]}/{$file}");
                                break;
                            case 2:
                                $this->_config['initialPreview'][] = Url::to("/uploaz/" . App . "/{$modelName}/{$match[0]}/$this->modelId/{$match[1]}/{$file}");
                                break;
                            default:
                                $this->_config['initialPreview'][] = Url::to("/uploaz/" . App . "/{$modelName}/{$match[0]}/$this->modelId/{$file}");
                                break;
                        }
                    $this->_config['initialPreviewConfig'][] = ['caption' => $file, 'key' => $file];
                    $initialFileInputs .= "<input type='" . $this->_config['type'] . "' name='$this->name[]' value='" . $file . "' />";
                }
            }
        }
        $this->htm = strtr($this->htm, ['{inputs}' => $initialFileInputs]);

        $this->_event['filedeleted'] = <<<JS
            function(event, id, index) {
                var el =  $("[name='$name']");
                var filesEl = el.val();
                var filesArr = [];
                $.each( JSON.stringify(filesEl), function( fileName, file ) {
                    if(id === file.name) return ;
                    fileName = file.name;
                    filesArr.push(fileName);
                });
                el.val(JSON.stringify(filesArr));
                
                var inputsBlock = $("#{id}-inputs input");
                
                inputsBlock.each(function(idx, inputField){
                    var imName = $(this).val();
                    if(imName == id) {
                        $(inputField).remove();
                    }
                })
            }
JS;

        $this->_event['filebatchuploadsuccess'] = <<<JS
        function(event, files) {
            var el =  $("[name='$this->name']");

            var filesEl = el.val();
            var filesArr = [];
            
            $.each(files.files, function( fileName, file ) {
                fileName = file.name;
                filesArr.push({name: fileName});
                
            });
            
            $.each(filesArr, function(fileName, file){
                fileName =  file.name;
               var inputs = "<input type='{type}' name='{name}[]' value='"+fileName+"' />";
               
               $('#{$this->id}-inputs').append(inputs);
            
            $('.file-caption-name').attr('title', fileName);
            
            
            });
            
            el.val(JSON.stringify(filesArr));
        }
JS;
        $this->_event['filebatchuploadsuccess'] = strtr($this->_event['filebatchuploadsuccess'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{type}' => $this->_config['type'],
        ]);

        $this->_event['filedeleted'] = strtr($this->_event['filedeleted'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
        ]);


        $this->_event['filezoomshow'] = <<<JS
        function(event, files) {
            $("[class='modal-header']").attr('style', 'background: white');
            $("[class='glyphicon glyphicon-resize-vertical']").attr('class', 'fas fa-fw fa-arrows-alt-v');
            $("[class='glyphicon glyphicon-fullscreen']").attr('class', 'fas fa-fw fa-arrows-alt');
            $("[class='glyphicon glyphicon-resize-full']").attr('class', 'fas fa-fw fa-external-link-alt');
            $("[class='glyphicon glyphicon-remove']").attr('class', 'fas fa-fw fa-times');
        }
JS;

        $this->_event['filebatchselected'] = <<<JS
        function(event, files) {
            reformatIcons();
        }
JS;

        if (empty($this->_config['initialPreview'])) $this->_config['initialPreview'] = [];
        if (empty($this->_config['initialPreviewConfig'])) $this->_config['initialPreviewConfig'] = [];
        $this->js = strtr($this->js, [
            '{showCaption}' => $this->jscode($this->_config['showCaption']),
            '{showBrowse}' => $this->jscode($this->_config['showBrowse']),
            '{showPreview}' => $this->jscode($this->_config['showPreview']),
            '{showRemove}' => $this->jscode($this->_config['showRemove']),
            '{showUpload}' => $this->jscode($this->_config['showUpload']),
            '{showCancel}' => $this->jscode($this->_config['showCancel']),
            '{showPause}' => $this->jscode($this->_config['showPause']),
            '{showClose}' => $this->jscode($this->_config['showClose']),
            '{browseOnZoneClick}' => $this->jscode($this->_config['browseOnZoneClick']),
            '{autoOrientImageInitial}' => $this->jscode($this->_config['autoOrientImageInitial']),
            '{initialPreview}' => $this->jscode($this->_config['initialPreview']),
            '{initialPreviewConfig}' => $this->jscode($this->_config['initialPreviewConfig']),
            '{deleteUrl}' => $deleteUrl,
            '{allowedFileTypes}' => null,
            '{allowedFileExtensions}' => $this->_config['allowedFileExtensions'] ? $this->jscode($this->_config['allowedFileExtensions']) : 'null',
            '{uploadUrl}' => $uploadUrl,
            '{uploadAsync}' => $this->jscode($this->_config['uploadAsync']),
            '{uploadUrlThumb}' => $this->jscode($this->_config['uploadUrlThumb']),
            '{maxFileCount}' => $this->jscode($this->_config['maxFileCount']),
            '{minFileCount}' => $this->jscode($this->_config['minFileCount']),
            '{filebatchuploadsuccess}' => $this->eventCode('filebatchuploadsuccess'),
            '{filedeleted}' => $this->eventCode('filedeleted'),
            '{filezoomshow}' => $this->eventCode('filezoomshow'),
            '{filebatchselected}' => $this->eventCode('filebatchselected'),
            '{initialCaption}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{required}' => $this->jscode($required),
            '{id}' => $this->jscode($this->id)
        ]);
    }

    /**
     *
     * Function  parseClassName
     * @return  string
     */
    private function parseClassName()
    {
        // $cn - className;
        $cn = Az::$app->utility->pregs->pregReplace($this->name, self::pattern['edit'], '$1[$3][$4][$5]');
        $cn = Az::$app->utility->pregs->pregReplace($cn, self::pattern['create'], '$1');
        $cn = Az::$app->utility->pregs->pregReplace($cn, self::pattern['preview'], '$1');
        $cn = Az::$app->utility->pregs->pregReplace($cn, self::pattern['update'], '$1');

        return $cn;
    }

    /**
     * Function  parseAttribute
     */
    private function parseAttribute()
    {
        $this->attribute = Az::$app->utility->pregs->pregReplace($this->name, self::pattern['edit'], '[$2][$3][$4]');

        $this->attribute = Az::$app->utility->pregs->pregReplace($this->attribute, self::pattern['preview'], '[$2][$3][$4]');

        $this->attribute = Az::$app->utility->pregs->pregReplace($this->attribute, self::pattern['create'], '[$4][$3]');

        $this->attribute = Az::$app->utility->pregs->pregReplace($this->attribute, self::pattern['update'], '[$2][$3]');
    }


}
