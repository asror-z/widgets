<?php

namespace zetsoft\widgets\navigat;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov;
 * Refactored By: Xakimjon Ergashov;
 */
class ZDownloadWidgetOld extends ZWidget
{

    /**
     * Configuration
     */
    public $grapesWrap = false;

    public $config = [];
    public $_config = [
        'grapes' => false,
        'icon' => 'fal fa-download',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */
    //public const icons = [];
    public const icons = [
        '.pptx' => 'fiv-viv fiv-icon-image',
        '.jpg' => 'fiv-viv fiv-icon-image',
        '.jpeg' => 'fiv-viv fiv-icon-image',
        '.env' => 'fiv-viv fiv-icon-image',
        '.png' => 'fiv-viv fiv-icon-image',
        '.PNG' => 'fiv-viv fiv-icon-image',
        '.docx' => 'fiv-viv fiv-icon-doc',
        '.doc' => 'fiv-viv fiv-icon-doc',
        '.txt' => 'fiv-viv fiv-icon-word',
        '.pdf' => 'fiv-viv fiv-icon-pdf',
        '.xlsx' => 'fiv-viv fiv-icon-xls',
        '.xls' => 'fiv-viv fiv-icon-xls',
        '.ppt' => 'fiv-viv fiv-icon-ppt',
        '.mp3' => 'fiv-viv fiv-icon-3ga',
        '.WAV' => 'fiv-viv fiv-icon-3ga',
        '.mp4' => 'fiv-viv fiv-icon-avi',
        '.3GP' => 'fiv-viv fiv-icon-avi',
        '.OGG' => 'fiv-viv fiv-icon-avi',
        '.AVI' => 'fiv-viv fiv-icon-avi',
        '.HDV' => 'fiv-viv fiv-icon-avi',
        '.zip' => 'fiv-viv fiv-icon-zip',
        '.html' => 'fiv-viv fiv-icon-html5',
        '.css' => 'fiv-viv fiv-icon-css3',
        '.js' => 'fiv-viv fiv-icon-js',
        '.php' => 'fiv-viv fiv-icon-php',

        '.fb2' => 'fiv-viv fiv-icon-archive',
        '.epub' => 'fiv-viv fiv-icon-book',
        '.mobi' => 'fiv-viv fiv-icon-book',
        '.djvu' => 'fiv-viv fiv-icon-image',
        '.torrent' => 'fiv-viv fiv-icon-torrent',
        '.cdr' => 'fiv-viv fiv-icon-cdr',
        '.iso' => 'fiv-viv fiv-icon-iso',
        '.mdb' => 'fiv-viv fiv-icon-mdb',
        '.accdb' => 'fiv-viv fiv-icon-accdb',
        '.htm' => 'fiv-viv fiv-icon-htm',
        '.mht' => 'fiv-viv fiv-icon-mht',
        '.wmv' => 'fiv-viv fiv-icon-wmv',
        '.flv' => 'fiv-viv fiv-icon-flv',
        '.mpeg' => 'fiv-viv fiv-icon-mpeg',
        '.wav' => 'fiv-viv fiv-icon-wav',
        '.midi' => 'fiv-viv fiv-icon-midi',
        '.aac' => 'fiv-viv fiv-icon-aac',
        '.bmp' => 'fiv-viv fiv-icon-bmp',
        '.gif' => 'fiv-viv fiv-icon-gif',
        '.tif' => 'fiv-viv fiv-icon-tif',

    ];


    public function asset()
    {

        //  $this->fileJs('<link rel="stylesheet" href="//cdn.jsdelivr.net/combine/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css,npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css" />');
        // $this->fileJs('<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css" />');
        //   $this->fileJs('<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css" />');
        //  $this->fileJs('<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css" />');
        //  $this->fileJs('<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vectors.min.css" />');

        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css");
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css");
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css");
        $this->fileCss("https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vectors.min.css");
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <table class="table-download w-100" id="table-download">

       {content}

        </table>

              
HTML,
        'value' => <<<HTML
        <tr class="bg-transparent w-100 d-flex justify-content-center">
            <!--<td class="border-0 w-50">{fileName}</td>-->
            <td class="border-0 download-icon w-50">{downloadButton}</td>
        </tr>
        
        
HTML,

    ];


    public function codes()
    {

        /*vdd($this->_config['icon']);*/

        if (empty($this->value))
            return null;

        if (!is_array($this->value))
            return null;/*$this->alertDanger(Az::l('Неправильный формат файла'),
                [
                    $this->modelClassName,
                    $this->attributeAll
                ]);*/
        $modelId = ZArrayHelper::getValue($this->modelAttrs, 'id');
        $iconExtension = '';

        foreach ($this->value as $key => $val) {
            $pos = strrpos($val, '.');
            $iconExtension = substr($val, $pos);
        }

        $path = "/api/core/files/play.aspx?file=/upload/uploaz/" . App . "/{$this->modelClassName}/{$this->attribute}/$modelId/";


        $values = '';
        //vdd();


        if (!empty($this->value))
            foreach ($this->value as $key => $val) {

                if (empty($val))
                    continue;

                $icon = ZArrayHelper::getValue(ZDownloadWidget::icons, $iconExtension);

                if ($icon !== null && !$this->_config['icon'])
                    $icon = "$icon";
                else
                    $icon = "fal fa-download";


                $values .= strtr($this->_layout['value'], [
                    '{downloadButton}' => ZButtonWidget::widget([
                        'config' => [
                            'hasIcon' => true,
                            'download' => true,
                            'url' => $path . $val,
                            'pjax' => false,
                            'target' => ZButtonWidget::target['_blank'],
                            'btn' => false,
                            'icon' => $icon,
                            'iconSize' => ZButtonWidget::iconSize['2x'],
                        ],


                        'event' => [
                            'click' => <<<JS
                    function (event){
                        window.open(this.href, '_blank');
                        event.preventDefault();}
JS,
                        ]

                    ]),
                    '{fileName}' => $val,


                ]);
            }


        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $values,
            '{widget}' => $this->dataWidget,
            '{config}' => json_encode($this->_config),

        ]);


        $this->css = <<<CSS

                .tr-table-download{
                  background-color: transparent!important;
                 
                }
                .td-table-download{
                 border: none!important;
                }
                
                .download-icon{
                 width: 10%;
                }
                
                
                
                
CSS;


    }

}
