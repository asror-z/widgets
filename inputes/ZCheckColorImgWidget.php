<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 * Created By: Maxamadjonov Jaxongir
 *
 *
 */
class ZCheckColorImgWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'checkMarkImage' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Check_green_icon.svg/1200px-Check_green_icon.svg.png',
        'graySelected' => 'true',
        'scaleSelected' => 'true',
        'fixedImageSize' => 'false',
        'checkMarkSize' => '30px',
        'checkMarkPosition' => 'top-left',
        'scaleCheckMark' => 'true',
        'fadeCheckMark' => 'false',
        'addToForm' => 'false',
        'preselect' => '[]',
        'radio' => 'false',
        'checkbox' => 'hidden',
        'src' => '/render/inputes/ZImageCheckboxWidget/demo/demo_files/image1.jpg',
        'type' => 'group',
        'canDeselect' => 'false',
        'data' => [
        ],
        /*'url'=> ZCheckColorImgWidget::url['white'],*/

    ];

   /* public const url = [

    'transparent' => 'https://lh3.googleusercontent.com/proxy/kstLAe5Yo1b1-6J0aSed2n-OsdqcsV8_Qb5Hbt-hpKXdGuE5t6NmEZSmejN97V0HuHvS0yMVnE9BraZlyyaFXk7qSSTpITYIYoVk7UVnPXc-hqxu1Z7CJAsONKjnCB7vfq0nv7G9TFk-HLuL2hItULp_3eJYtvKUvV-c-slRKB1FCZqpxsLMxNbycK6mcAV6RA',

    'background' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Check_green_icon.svg/1200px-Check_green_icon.svg.png',
    'smart' => 'https://w7.pngwing.com/pngs/448/432/png-transparent-black-check-illustration-check-mark-symbol-computer-icons-mark-miscellaneous-hand-logo.png',
    'white'=> 'https://pngimage.net/wp-content/uploads/2018/06/white-tick-png-8.png'

    ];*/

    public $_event = [
        'click' => '
        
        function (event){
             query= $(".checkedImg").eq(0);
            if(el.hasClass(\'imgChked\') && !group ){  
                query.attr(\'value\', \'true\'); 
                query.attr(\'checked\', \'checked\');
            } else 
                if (!group){  
                   query.attr(\'value\', \'false\');
                   query.removeAttr(\'checked\');  
                }         
        }
        
        
        ',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . 'ZImageCheckbox',

    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'checkMarkImage',
            'graySelected',
            'scaleSelected',
            'fixedImageSize',
            'checkMarkPosition',
            'fixedImageSize',
            'scaleCheckMark',
            'fadeCheckMark',
            'addToForm',
            'preselect',
            'radio',
            'checkbox',
            'src',
            'type',
            'canDeselect',
            'data'
        ],
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="checkboxImageContainer border-none d-inline-block">                                             
            <label class="image-checkbox" >
                <input type="{checkbox}" name="{name}[]" id="{id}" class="checkedImg"  value="{value}"  />
                <div class="widgetContent">
                    {src}
                </div>
            </label>                                                                                
        </div>
HTML,

        'js' => <<<JS
   var vals = {json};
    var group = {group};
    var isjson={isjson};
    var query;
    if (isjson){
        vals = vals.map(x => +x);      
        vals = vals.map(function(val){
            return --val;
        }); 
    }  
  
    $("label.image-checkbox .widgetContent").imgCheckbox({
        graySelected: {graySelected},
        scaleSelected: {scaleSelected},
        fixedImageSize: {fixedImageSize},
        scaleCheckMark: {scaleCheckMark},
        fadeCheckMark: {fadeCheckMark},
        radio: {radio},
        addToForm: false,
        canDeselect: {canDeselect},
        onclick: {onclick}
    }); 
   
   function getData() {
        if (isjson)
        if (!group) { 
            query.attr('checked', 'checked');
            query.addClass( "imgChked" );
        }
        
        vals.forEach(function(i){
            $(".imgCheckbox0").eq(i).addClass( "imgChked" );
            $(".checkedImg").eq(i).attr('checked', 'checked');
            
        });
    }             
   window.onload = () => {
   
        getData();
       // alert("Hello");
       // setTimeout(function(){ alert("Hello"); }, 3000);
   }
   $( document ).ready(function() {
    console.log( "ready!" );
    getData();
});
        
         
  
JS,

        'css'=><<<CSS

             span.imgCheckbox0.imgChked::before{
                    font-size: 10px!important;
                     content: '';
                    /* mix-blend-mode: difference;*/
                    width: 15px;
                    height: 15px;
                    align-items: center;
                    display: flex;
                    justify-content: center;
                    /* margin: 0 auto; */
                    margin: 6px;
                    border: none;
    }
        
        span.imgCheckbox0.imgChked {
    border-color: transparent!important;
}
        
        span.imgCheckbox0.imgChked {
        
        border: none;
        
        }
        
        /*span.imgCheckbox0::before {
        
        background-image: url("{url}")!important;
        background-color: transparent!important;
        }*/
        

CSS,




    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
    }

    public function codes()
    {
        //vdd($this->value);

        $json = json_encode($this->value);
        $isjson = is_string($json) && is_array(json_decode($json, true)) ? true : false;


        $content = '<div class="">';
        $this->htm .= $content;
        if ($this->_config['radio'] === true)
            $type = 'radio';
        else
            $type = 'checkbox';


        if ($this->_config['type'] === 'group'){
            foreach ($this->data as $value => $image) {
                $this->htm .= strtr($this->_layout['main'], [
                    '{checkbox}' => $type,
                    '{src}' => $image,
                    '{name}' => $this->name,
                    '{id}' => $this->id++ . random_int(1, 9999999),
                    '{value}' => $value ?? '0',
                ]);

            }
            $this->_layout['js'] = strtr($this->_layout['js'], ['{group}' => 'true',]);
             }
        else {
            $value = $this->_config['data'];
            $this->htm .= strtr($this->_layout['main'], [
                '{checkbox}' => $type,
                '{src}' => $this->_config['src'],
                '{label}' => $this->_config['label'],
                '{name}' => $this->name,
                '{id}' => $this->id++ . random_int(1, 9999999),
                '{value}' => $value ?? '0',
            ]);

            $this->_layout['js'] = strtr($this->_layout['js'], ['{group}' => 'false',
            ]);
        }
        $this->htm .= '</div>';
        if (!$isjson){$json='[]'; }
        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{json}' => $json ?? '[]',
            '{checkMarkImage}' =>$this->jscode($this->_config['checkMarkImage']),
            '{graySelected}' => $this->jscode($this->_config['graySelected']),
            '{scaleSelected}' =>$this->jscode($this->_config['scaleSelected']),
            '{fixedImageSize}' =>$this->jscode($this->_config['fixedImageSize']),
            '{scaleCheckMark}' =>$this->jscode($this->_config['scaleCheckMark']),
            '{fadeCheckMark}' =>$this->jscode( $this->_config['fadeCheckMark']),
            '{isjson}' => $this->jscode($isjson),
            '{radio}' => $this->jscode($this->_config['radio']),
            '{canDeselect}' =>$this->jscode($this->_config['canDeselect']),
            '{onclick}' => $this->eventCode('click')
        ]);

     /*   $this->css = strtr($this->_layout['css'], [

        '{url}'=> $this->_config['url']
            
        ]);*/

        

    }
}
