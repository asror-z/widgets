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

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 * Created By: MurodovMirbosit
 *
 */
class ZImageCheckboxGroupWidgetX_18052020 extends ZWidget
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
        'type' => self::type['radio'],
        'canDeselect' => 'false',
        'items' => [],
        'label' => 'image',
        'display' => self::displayMode['flex']
    ];

    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const displayMode = [
        'block' => 'block',
        'flex' => 'flex'
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

    public $options = [];


    public $event = [];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           
           <div class="col-3">                                             
                <label class="image-checkbox">
                        <input type="hidden" name="{name}" value="0">
                        <input type="{type}" name="{name}[]" id="{id}" class="checkedImg"  value="{value}" />
                               <div class="d-{display}">
                                        {items}
                              </div>
                                                                                    
                </label>                                                                                
        </div> 
  
  
HTML,
        'item' => <<<HTML
        <div class="checkable">
              {item_content}
              {label} 
        </div>
HTML,

        'js' => <<<JS
   
var jaxon = {json};
var group={group};
var check=false;
if (jaxon[0]=="true")check=true;
        
 if (jaxon==null )jaxon=[];
    if (jaxon=="0") jaxon=[0]; else jaxon=jaxon.map(x => +x);
   if (jaxon){jaxon=jaxon.map(x=>+x);      
  jaxon=jaxon.map(function(val){return --val;}); 
  }
  
      $("img").imgCheckbox(  {
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
            if(el.hasClass('imgChked') && !group )
            {  $(".checkedImg").eq(0).attr('checked', 'checked'); $(".checkedImg").eq(0).attr('checked', 'checked');} 
            else 
            if (!group){ 
            $(".checkedImg").eq(0).removeAttr('checked'); 
            //$(".checkedImg").eq(0).attr('value', 'false');
              }
                   }}); 
   
    function getData() {
          if (check)if (!group) { 
          $(".checkedImg").eq(0).attr('checked', 'checked');
           $(".imgCheckbox0").eq(0).addClass( "imgChked" );
       // $(".checkedImg").attr('value', 'checked');
         console.log(jaxon); 
        }
        console.log(jaxon); 
        jaxon.forEach(function(i){
            console.log(i);
            $(".imgCheckbox0").eq(i).addClass( "imgChked" );
            $(".checkedImg").eq(i).attr('checked', 'checked');
            
        });
        
        
        
          
    };             
        
   window.onload = () => {
    getData();
   }
  
JS,

        'css' => <<<CSS
       .image-checkbox input[type="checkbox"]
        {
            display: none;
        
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

        $json = json_encode($this->value);

        /* $content = '<div class=" col-md-12 row">';
         $this->htm .= $content;
         if($this->_config['radio']=='true') $type='radio'; else $type='checkbox';
         if($this->_config['type']=='group') {
             foreach ($this->_config['data'] as $value) {
                 $this->htm .= strtr($this->_layout['main'], [
                     '{checkbox}'=>$type,
                     '{src}' => $value['image'],
                     '{label}' => $value['label'],
                     '{name}' => $this->name,
                     '{id}' => $this->id++ . random_int(1, 9999999),
                     '{value}' => $value['key'] ?? '0',
                 ]);
                 $this->_layout['js'] = strtr($this->_layout['js'], ['{group}' => 'true',   ]);
             }
         } else{ $value=$this->_config['data'];
             $this->htm .= strtr($this->_layout['main'], [
                 '{checkbox}'=>$type,
                 '{src}' => $value['image'],
                 '{label}' => $value['label'],
                 '{name}' => $this->name,
                 '{id}' => $this->id++ . random_int(1, 9999999),
                 '{value}' => $value['key'] ?? '0',
             ]);
             $this->_layout['js']= strtr($this->_layout['js'], ['{group}' => 'false',
             ]);
         }
         $this->htm .= '</div>';*/

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
        ]);
      $content = '';
       foreach ($this->data as $key => $value){
           $content = strtr($this->_layout['main'], [
               '{items}' => $value,
               '{display}' => $this->_config['display'],
               '{class}' => $this->_config['class'],
               '{type}' =>$this->_config['type'],
               '{value}' => $this->value,
               '{name}' =>$this->name,
               '{item_content}' => $this->value,
               '{label}' => $this->_config['label'],
               '{id}' =>$this->id
           ]);
           $this->htm = $content;
       }
        $this->css = strtr($this->_layout['css'], []);
    }
}
