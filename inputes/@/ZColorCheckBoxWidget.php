<?php

/**
 *
 *
 * Author: Umid Abdurakhmonov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZColorCheckboxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'src' => '/render/inputes/ZImageCheckboxWidget/demo/demo_files/image1.jpg',
        'checkMarkImage' => '',
        'graySelected' => 'true',
        'scaleSelected' => 'true',
        'fixedImageSize' => 'false',
        'checkMarkSize' => '5px',
        'checkMarkPosition' => 'top-left',
        'scaleCheckMark' => 'true',
        'fadeCheckMark' => 'false',
        'addToForm' => 'true',
        'preselect' => '[1,2,3]',
        'radio' => 'false',
        'canDeselect' => 'false',

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZImageCheckboxWidget/image/icon.png"/>',

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
    /*   */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center align-items-center border p-1 rounded-circle custom-control custom-{type} image-checkbox" style="width: 30px; height: 30px">
                            <div class="rounded-circle black checkable" style="width: 20px; height: 20px">
                              <input name="{name}" value="0" type="hidden" id="{id}-hidden"> 
                              <input type="checkbox" class="checkedImg" name="{name}" value="black">
                            </div>
                    </div>     
           </div>
          
HTML,
        'js' => <<<JS
      
      // let checkedImageValue = $('.checkedImg').val();
      // let checkedImage = $('.checkedImg');
      // let checked = $('.imgChked');
      //
      // $("img.checkable").imgCheckbox({
      //     onload: function(){   
      //         let image = $('.imgCheckbox0');
      //         if (checkedImageValue === '1')
      //             image.addClass('imgChked');
      //         else {
      //             image.removeClass('imgChked')
      //         }
      //     },
      //     onclick: function (event){
      //         let isChecked = el.hasClass('imgChked');
      //         if (isChecked){
      //             checkedImage.attr('checked', 'checked');
      //             checkedImage.attr('value', '1');
      //         }
      //         else {
      //            checkedImage.removeAttr('checked'); 
      //             checkedImage.attr('value', '0');
      //         }
      //            
      //         console.log( isChecked ? 'checked' : 'not-checked');
      //     }
      // }); 
            
JS,

        'css' => <<<CSS
        

CSS,


    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');

    }

    public function codes()
    {
        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->htm .= strtr($this->_layout['main'], [
            '{src}' => $this->_config['src'],
            '{name}' => $this->name,
            '{id}' => $this->id,
            '{value}' => $this->value,
            //'{\'{readonly}\' => $this->_config[\'readonly\'] ? \'readonly\' : \'\',type}' => $this->_config['type'],
            //'{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{icon}' => $this->modelCheck() ? $this->value : '',
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }
}
