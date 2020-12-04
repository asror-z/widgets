<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use dosamigos\ckeditor\CKEditor;

/**
 * Class ZCKEditorWidget
 * https://github.com/ckeditor/ckeditor5
 * https://ckeditor.com/ckeditor-5/demo/
 * /core/tester/asror/main.aspx?path=render/inputes/ZCKEditorWidget/active.php
 *
 *
 * Javohir
 */

class ZCKEditor2Widget extends ZWidget
{

    public $dbType = dbTypeText;

    public $config = [];
    public $_config = [
        'preset'=> 'standart',
        /*'value'=>'',*/
        'isKcfinder'=> false,
        'disabled'=> false,
        'uploadURL'=> '@web/upload',
        'uploadDir'=> '@webroot/upload',
        'isDenyZipDownload'=> true,
        'isDenyUpdateCheck'=> true,
        'isDenyExtensionRename'=> true,
        'theme' => 'default',
        'aKcfOptions'=> [],
        'isFilesUpload'=> true,
        'isFilesDelete'=> true,
        'isFilesCopy'=> true,
        'isFilesMove'=> true,
        'isFilesRename'=> true,
        'isDirsCreate'=> true,
        'readonly' => false,
        'isDirsDelete'=> true,
        'isDirsRename'=> true,
        'types'=> ['files'=> [
            'type'=> '',
        ]],
        'thumbdir'=> 'thumbs',
        'thumbWidth'=> 100,
        'thumbHeight'=> 100,
        'extraPlugins'=> 'uploadimage',
        'clientUploadUrl'=> 'upload.aspx',
        'height' => '75%',

    ];


    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZCKEditorWidget/image/icon.png',
        'name' => Azl . 'KEditor',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZCKEditorWidget/image/icon.png"/>',

    ];


    public function codes()
    {

        $this->options = [
            'name' => $this->modelClassName,
            'model' => $this->model,
            'id' => $this->id,
            'attribute' => $this->attribute,
            'value' => $this->value,
            'preset' => $this->_config['preset'],

            //'disabled' => $this->_config['readonly'],
            'kcfinder' => $this->_config['isKcfinder'],
            'options' => [

            ],
            'kcfOptions' => [
                'disabled' => $this->_config['readonly'],
                //'readonly' => $this->_config['readonly'],
                'class' => 'container',


                'uploadURL' => $this->_config['uploadURL'],
                'uploadDir' => $this->_config['uploadDir'],
                'denyZipDownload' => $this->_config['isDenyZipDownload'],
                'denyUpdateCheck' => $this->_config['isDenyUpdateCheck'],
                'denyExtensionRename' => $this->_config['isDenyExtensionRename'],
                'theme' => $this->_config['theme'],
                'access' => [ // @link http://kcfinder.sunhater.com/install#_access
                    'files' => [
                        'upload' => $this->_config['isFilesUpload'],
                        'delete' => $this->_config['isFilesDelete'],
                        'copy' => $this->_config['isFilesCopy'],
                        'move' => $this->_config['isFilesMove'],
                        'rename' => $this->_config['isFilesRename'],
                    ],
                    'dirs' => [
                        'create' => $this->_config['isDirsCreate'],
                        'delete' => $this->_config['isDirsDelete'],
                        'rename' => $this->_config['isDirsRename'],
                    ],
                ],
                'types' => $this->_config['types'],   // @link http://kcfinder.sunhater.com/install#_types,
                'thumbdir' => $this->_config['thumbdir'],
                'thumbWidth' => $this->_config['thumbWidth'],
                'thumbHeight' => $this->_config['thumbHeight'],
            ],
            'clientOptions' => [
                'extraPlugins' => $this->_config['extraPlugins'],
                'uploadUrl' => $this->_config['clientUploadUrl']
            ]
        ];

        $editor = CKEditor::widget($this->options);
        $iconCode  = $this->_config['hasIcon'] ? $this->_config['icon'] : '';
        $placeholder = $this->_config['hasPlace'] ? $this->_config['placeholder'] : '';
        $this->htm = <<<HTML
        <span class="ml-3"><i class="{$iconCode}"></i></span>
        <div>{$editor}</div>
HTML;


    }


}
