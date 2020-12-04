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

namespace zetsoft\widgets\images;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 * Created By: Maxamadjonov Jaxongir
 *
 *
 */
class ZLazyloadImgWidget2 extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'checkMarkImage' => '',
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
    ];

    public const size = [
        '300' => '600 300'
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZImageCheckboxWidget/image/icon.png"/>',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="lazyload" data-expand="-1">
        <div class="lazyload" data-srcset="{src}">

    </div>
HTML,

/*'src' => <<<HTML

    <div class="lazyload" data-expand="-1">
        <div data-srcset="{src}" class="lazyload" />

    </div>

HTML,*/


        'js' => <<<JS
    var jaxon = {json};
    var group = {group};
    var check = false;
    if (jaxon == null )
        jaxon = [];
    
    if (jaxon[0] === "true")
        check=true;
        
    if (jaxon === "0") 
        jaxon=[0]; 
    else 
        jaxon = jaxon.map(x => +x);
        
    if (jaxon !== null){
        
        jaxon = jaxon.map(x => +x);      
        jaxon = jaxon.map(function(val){
            return --val;
        }); 
    }
  
    $("label.image-checkbox .widgetContent").imgCheckbox({
        graySelected: {graySelected},
        scaleSelected: {scaleSelected},
        fixedImageSize: {fixedImageSize},
        //checkMarkSize: {checkMarkSize},
        //checkMarkPosition: {checkMarkPosition},
        scaleCheckMark: {scaleCheckMark},
        fadeCheckMark: {fadeCheckMark},
        addToForm: {addToForm},
        //preselect:{preselect}, // { preselect: [0,1,2] }, { preselect: true }
        radio: {radio},
        canDeselect: {canDeselect}, 
        onclick: function (event){
            console.log(el);
            if(el.hasClass('imgChked') && !group ){  
                $(".checkedImg").eq(0).attr('value', 'true'); 
                $(".checkedImg").eq(0).attr('checked', 'checked');
            } else 
                if (!group){  
                    $(".checkedImg").eq(0).attr('value', 'false');
                    $(".checkedImg").eq(0).removeAttr('checked');  
                }
        }
    }); 
   
    function getData() {
        if (check)
        if (!group) { 
            $(".checkedImg").eq(0).attr('checked', 'checked');
            $(".imgCheckbox0").eq(0).addClass( "imgChked" );
        //  $(".checkedImg").attr('value', 'checked');
            console.log(jaxon); 
        }
        
        console.log(jaxon);
         
        jaxon.forEach(function(i){
            console.log(i);
            $(".imgCheckbox0").eq(i).addClass( "imgChked" );
            $(".checkedImg").eq(i).attr('checked', 'checked');
            
        });
    }             
   window.onload = () => {
        getData();
   }
   
     /*switch(jaxon) {
  case null:jaxon=[]; 
    break;

  case "0":  
    jaxon=[0];
     break;
  case ["true"]:  
    jaxon=[0];
     break;
  case ["false"]:  
    jaxon=[];
     break;
  default:
   jaxon=jaxon.map(x => +x);
    break;
}*/                           
  
JS,

        'css' => <<<CSS
       /*
            hidden checkboxla korinishi uchun
       .image-checkbox input[type="checkbox"]
        {
            display: block;
            opacity: 1;
           
        }
        .image-checkbox input[type="radio"]
        {
            opacity: 1;
        }*/
CSS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
        $this->fileJs('https://cdn.statically.io/gh/aFarkas/lazysizes/gh-pages/plugins/unveilhooks/ls.unveilhooks.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/lazysizes@5.2.1-rc1/lazysizes.min.js');
    }

    public function codes()
    {
        //vdd($this->value);

        $json = json_encode($this->value);

        $content = '<div class="">';
        $this->htm .= $content;
        if ($this->_config['radio'] === true)
            $type = 'radio';
        else
            $type = 'checkbox';


        if ($this->_config['type'] === 'group')
            foreach ($this->data as $value => $image) {
                $this->htm .= strtr($this->_layout['main'], [
                    '{checkbox}' => $type,
                    '{src}' => $image,
                    '{name}' => $this->name,
                    '{id}' => $this->id++ . random_int(1, 9999999),
                    '{value}' => $value ?? '0',
                ]);
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

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{json}' => $json ?? '[]',
            '{checkMarkImage}' => $this->_config['checkMarkImage'],
            '{graySelected}' => $this->_config['graySelected'],
            '{scaleSelected}' => $this->_config['scaleSelected'],
            '{fixedImageSize}' => $this->_config['fixedImageSize'],
            '{checkMarkSize}' => $this->_config['checkMarkSize'],
            '{checkMarkPosition}' => $this->_config['checkMarkPosition'],
            '{scaleCheckMark}' => $this->_config['scaleCheckMark'],
            '{fadeCheckMark}' => $this->_config['fadeCheckMark'],
            '{addToForm}' => $this->_config['addToForm'],
            '{preselect}' => $this->_config['preselect'],
            '{radio}' => $this->_config['radio'],
            '{canDeselect}' => $this->_config['canDeselect'],
            //'{widgetFirstClass}' => $this->_config['widgetFirstClass'],
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }
}
