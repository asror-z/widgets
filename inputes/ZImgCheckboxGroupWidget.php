<?php

/**
 * @author MurodovMirbosit AzimjonToirov XakimjonErgashev
 */

namespace zetsoft\widgets\inputes;

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\system\kernels\ZWidget;
use function GuzzleHttp\Psr7\str;


/**
 * Class    ZImgCheckboxGroupWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZImgCheckboxGroupWidget extends ZWidget
{

    /**
     * Configuration
     */
    
    public $config = [];
    public $_config = [
        'grapes' => true,
        'title' => 'ZImage',
        'checkMarkImage' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAtMzQ2LjM4NCkiPjxwYXRoIGQ9Ik0zMiAzNDYuMzg0YTMyIDMyIDAgMCAwLTMyIDMyIDMyIDMyIDAgMCAwIDMyIDMyIDMyIDMyIDAgMCAwIDMyLTMyIDMyIDMyIDAgMCAwLTMyLTMyem0yMS4yNTYgMTAuMzI3bC0yNC40NiA0MC44OTNMOS41IDM3NS4yMTNsMTcuNjkzIDkuNjA1IDI2LjA2LTI4LjEwN3oiIGZpbGw9IiNjODAwMDAiIGZpbGwtb3BhY2l0eT0iLjc4NCIvPjxwYXRoIGQ9Ik05LjUwMiAzNzUuMjEzbDE5LjI5NCAyMi4zOSAyNC40Ni00MC44OTMtMjYuMDYgMjguMTA3eiIgZmlsbD0iI2ZmZiIvPjwvZz48L3N2Zz4=',
        'graySelected' => true,
        'scaleSelected' => true,
        'fixedImageSize' => false,
        'checkMarkSize' => '30px',
        'checkMarkPosition' => ZImgCheckboxGroupWidget::position['right'],
        'scaleCheckMark' => true,
        'fadeCheckMark' => true,
        'addToForm' => true,
        'radio' => '', // true if radio=true, '' if radio=false,
        'canDeselect' => false,
        'src' => 'http://townandcountryremovals.com/wp-content/uploads/2013/10/firefox-logo-200x200.png',
        'preselect' => true,
        'width' => '100px',
        'height' => '100px',

    ];

    public const position = [
        'top-left' => 'top-left',
        'top' => 'top',
        'left' => 'left',
        'center' => 'center',
        'right' => 'right',
        'bottom-left' => 'bottom-left',
        'bottom-right' => 'bottom-right',
        'bottom' => 'bottom',
        'top-right' => 'top-right',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZcheckboxWidget/image/icon.png',
        'name' => Azl . 'Zcheckbox',
        'title' => Azl . 'imagecheckbox',

    ];


    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
        'onload' => 'console.log("self | $eventOnLoad")',
        'onclick' => 'console.log("self | $eventOnClick")',
    ];

    public $layout = [];
    public $_layout = [
        'checkboxGroup' => <<<HTML
    <input type="checkbox" id="{id}" class="checkedImg" name="{name}[]" value="{value}"/>
    <label for="{id}">
    <img src="{src}" alt="checkedImg" class="checked"/>
    {title}
    </label>
HTML,

        'js' => <<<JS
		var f = $(".checked").imgCheckbox({
      checkMarkImage: '{checkMarkImage}',
      graySelected: {graySelected},
      preselect: '{preselect}',
      scaleSelected: {scaleSelected},
      fixedImageSize: {fixedImageSize},
      checkMarkSize: '{checkMarkSize}',
      checkMarkPosition: '{checkMarkPosition}',
      scaleCheckMark: {scaleCheckMark},
      fadeCheckMark: {fadeCheckMark},
      addToForm: {addToForm},
      canDeselect: '{canDeselect}',
      radio: '{radio}',
      onload: function(){
       },
      onclick: function (event){
           console.log(el)
       }
	})
	
    $.deselect = function (s) {
    $.deselect('.checkedImg')
    };

    $.select = function (s) {
	$.select('.checkedImg');
    };
JS,

        'css' => <<<CSS
        .checked
        {
          background-repeat: no-repeat;
          width: {width};
          height: {height};
        }
CSS,


    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');
    }

    public function codes()
    {
           $content = '';

           foreach ($this->data as $key => $value) {

               $content .= strtr($this->_layout['checkboxGroup'], [
                   '{id}' => $this->id++,
                   '{value}' => $key,
                   '{name}' => $this->name,
                   '{label}' => $this->_config['label'],
                   '{src}' => $value,
                   '{title}' => $this->_config['title'],

               ]);
           }

           $this->htm .= $content;

        $this->css = strtr($this->_layout['css'],[
           '{width}' => $this->_config['width'],
           '{height}' => $this->_config['height'],
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id++,
            '{checkMarkImage}' => $this->jscode($this->_config['checkMarkImage']),
            '{graySelected}' => $this->jscode($this->_config['graySelected']),
            '{scaleSelected}' => $this->jscode($this->_config['scaleSelected']),
            '{fixedImageSize}' => $this->jscode($this->_config['fixedImageSize']),
            '{checkMarkSize}' => $this->jscode($this->_config['checkMarkSize']),
            '{checkMarkPosition}' => $this->jscode($this->_config['checkMarkPosition']),
            '{scaleCheckMark}' => $this->jscode($this->_config['scaleCheckMark']),
            '{fadeCheckMark}' => $this->jscode($this->_config['fadeCheckMark']),
            '{addToForm}' => $this->jscode($this->_config['addToForm']),
            '{canDeselect}' => $this->jscode($this->_config['canDeselect']),
            '{radio}' => $this->jscode($this->_config['radio']),
            '{preselect}' => json_encode($this->value),


        ]);
    }
}
