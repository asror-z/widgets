<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * author: Soliyev Aziz
 * Class    ZHDropDownListWidget
 * @package widgets\inputes
 *
 * https://lokesh-coder.github.io/pretty-checkbox/
 *
 */
class ZPrettyCheckboxWidgetOLd extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZPrettyCheckboxWidgetOLd::type['default'],
        'plain' => ZPrettyCheckboxWidgetOLd::border['curve'],
        'style' => ZPrettyCheckboxWidgetOLd::style['fill'],
        'color' => ZPrettyCheckboxWidgetOLd::color['info'],
        'color2' => ZPrettyCheckboxWidgetOLd::color['primary'],
        'border' => ZPrettyCheckboxWidgetOLd::border['plain'],
        'animation' => ZPrettyCheckboxWidgetOLd::animation['pulse'],
        'switchType' => ZPrettyCheckboxWidgetOLd::switchType['outline'],
        'text' => 'Label',
        'textToggle' => 'togglelabel',
        'icon1' => "fa fa-bell-o",
        'icon2' => "fa fa-bell",


    ];


    public const type = [
        'default' => 'default',
        'switch' => 'switch',
        'icon' => 'icon',
        'def-toggle' => 'def-toggle',
        'icon-toggle' => 'icon-toggle',
        'def-radio' => 'def-radio',
        'icon-radio' => 'icon-radio',
    ];

    public const color = [
        'default' => '',  /*//default*/
        'primary' => 'p-primary',  /*//blue*/
        'success' => 'p-success',  /*//green*/
        'warning' => 'p-warning',  /*//yellow*/
        'danger' => 'p-danger',  /*//Red*/
        'info' => 'p-info', /*//blue*/
        'primary-o' => 'p-primary-o',  /*//blue*/
        'success-o' => 'p-success-o',  /*//green*/
        'warning-o' => 'p-warning-o',  /*//yellow*/
        'danger-o' => 'p-danger-o',  /*//Red*/
        'info-o' => 'p-info-o', /*//blue*/
    ];

    public const animation = [
        'default' => '',
        'smooth' => 'p-smooth',
        'jelly' => 'p-jelly',
        'tada' => 'p-tada',
        'rotate' => 'p-rotate',
        'pulse' => 'p-pulse',
    ];

    public const style = [
        'default' => '',
        'thick' => 'p-thick', /*bold*/
        'fill' => 'p-fill',   /*full*/
    ];

    public const border = [
        'default' => '',
        'round' => 'p-round', /*circle*/
        'curve' => 'p-curve',   /*border radius*/
        'plain' => 'p-plain',
    ];

    public const switchType = [
        'outline' => 'p-outline', /*circle*/
        'fill' => 'p-fill',   /*border radius*/
        'slim' => 'p-slim',
    ];


    public function asset()
    {
        //   $this->fileCss('/publish/yarner/pretty-checkbox/dist/pretty-checkbox.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0.3/dist/pretty-checkbox.css');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
          <div class="md-form"> 
            <div class="form-control border-0 {class} m-0">
                 <span>{getIcon}</span>
               &ensp;<span> {placeholder}</span> 
                 
</div> 
               <div class="ml-5">{content}</div>

</div>
      

HTML,
        'default' => <<<HTML
     
    <div class="pretty p-default {plain} mb-2 {style} {border} {animation}" style="display: block">
        <input type="checkbox" name="{modelClass}[{attribute}][{key}]" id="{id}"  >
        <div class="state {color}">
            <label style="font-size: 20px">{text}</label>
        </div>
    </div>           
   
HTML,
        'switch' => <<<HTML
                <div class="pretty p-switch {switchType}">
                    <input type="checkbox" name="{modelClass}[{attribute}][{key}]" id="{id}"/>
                    <div class="state {color}">
                        <label>{text}</label>
                    </div>
                </div>
HTML,
        'icon' => <<<HTML
                <div class="pretty p-icon {plain} {style} {border} {animation}">
                    <input type="checkbox" name="{modelClass}[{attribute}][{key}]" id="{id}">
                    <div class="state {color}">
                        <i class="icon {icon}"></i>
                        <label>{text}</label>
                    </div>
                </div>
HTML,
        'def-toggle' => <<<HTML
                <div class="pretty p-default p-toggle {plain} {style} {border} {animation}">
                    <input type="checkbox" name="{modelClass}[{attribute}][{key}]" id="{id}">
                    <div class="state {color} p-on">
                        <label>{text}</label>
                    </div>
                    <div class="state {color2} p-off">
                        <label>{textToggle} </label>
                    </div>
                </div>
HTML,
        'icon-toggle' => <<<HTML
                <div class="pretty p-icon p-toggle {plain} {style} {border} {animation}">
                    <input type="checkbox" name="{modelClass}[{attribute}][{key}]" id="{id}">
                    <div class="state p-on {color}">
                        <i class="icon {icon1}" aria-hidden="true"></i>
                        <label>{text}</label>
                    </div>
                    <div class="state p-off {color}">
                        <i class="icon {icon2}" aria-hidden="true"></i>
                        <label>{textToggle}</label>
                    </div>
                </div>
HTML,
        'def-radio' => <<<HTML
                <div class="pretty p-default {plain} {style} {border} {animation}">
                    <input type="radio" name="{modelClass}[{attribute}][{key}]" id="{id}">
                    <div class="state">
                        <label>{text}</label>
                    </div>
                </div>
HTML,
        'icon-radio' => <<<HTML
                <div class="pretty p-icon {plain} {style} {border} {animation} ">
                    <input type="radio" name="{modelClass}[{attribute}][{key}]" id="{id}">
                    <div class="state {color}">
                        <i class="icon fa fa-eye" aria-hidden="true"></i>
                        <label>{text}</label>
                    </div>
                </div>
HTML,
        'icons' => <<<HTML
          <i class="icon-prefix prefix {icon}" style="top:2.5rem !important;"></i>
HTML,
        'css' => <<<CSS
            [type=checkbox]:checked, [type=checkbox]:not(:checked){
                pointer-events: inherit;
            }
            [type=radio]:checked, [type=radio]:not(:checked){
                pointer-events: inherit; 
            }
CSS,

    ];

    public function codes()
    {


        $getIcon = '';
        if ($this->_config['hasIcon']) {
            $getIcon = $this->htm .= strtr($this->_layout['icons'], [

                '{icon}' => $this->_config['icon'],

            ]);
        }


        $code = '';

        $vals = $this->value;
        foreach ($this->data as $key => $data) {
            $check = '';
            if ($vals > 0) {
                foreach ($vals as $key1 => $items) {
                    if ($key === $key1) $check = 'checked';
                }
            }

            $code .= strtr($this->_layout[$this->_config['type']], [
                '{plain}' => $this->_config['plain'],
                '{style}' => $this->_config['style'],
                '{color}' => $this->_config['color'],
                '{color2}' => $this->_config['color2'],
                '{border}' => $this->_config['border'],
                '{animation}' => $this->_config['animation'],
                '{switchType}' => $this->_config['switchType'],
                '{text}' => $this->_config['text'],
                '{textToggle}' => $this->_config['textToggle'],
                '{icon1}' => $this->_config['icon1'],
                '{icon2}' => $this->_config['icon2'],
                '{modelClass}' => $this->modelClassName,
                '{id}' => $this->id . $key,
                '{attribute}' => $this->attribute,
                '{key}' => $key,
                '{checked1}' => $check,
                '{value}' => $this->jscode($this->value)
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $code,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{getIcon}' => $getIcon,
            '{name}' => $this->name,
            '{class}' => $this->_config['class']

        ]);

        $this->css = strtr($this->_layout['css'], []);

    }
}
