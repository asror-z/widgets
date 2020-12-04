<?php

/**
 *
 *  class ZTitatoggleWidget1
 *
 *  https://github.com/kleinejan/titatoggle
 *  http://kleinejan.github.io/titatoggle/
 *
 *
 * Author: Jasurbek Normurodov
 * Refactored: Jasurbek Normurodov
 *
 */

namespace zetsoft\widgets\inptest;


use zetsoft\system\kernels\ZWidget;

class ZTitatoggleWidget2 extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZTitatoggleWidget2::Types['materiallike'],

        'size' => ZTitatoggleWidget2::Sizes['default'],
        'disabled' => ZTitatoggleWidget2::Accesses['false'],
    ];

    /**
     *
     * Constants
     */


    public const Types = [
        'main' => 'main',
        'withtext' => 'withtext',
        'ioslike' => 'ioslike',
        'materiallike' => 'materiallike',
    ];
    public const Sizes = [
        'large' => 'checkbox-slider-lg',
        'middle' => 'checkbox-slider-md',
        'small' => 'checkbox-slider-sm',
        'default' => 'checkbox-slider',

    ];
    public const Accesses = [
        'true' => 'disabled',
        'false' => '',
    ];
    /*@var  ZTitatoggleItem[] $item*/
    public $data;

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
            <div class="col-sm-3" id="{id}"  >
                <div class="form-check checkbox-slider--default {size} {access} ">
                    <label>
                      <input type="checkbox"  checked="{check}" name="{name}" value="{value}"> <span></span>
                    </label>
                </div>
            </div>

HTML,
        'withtext' => <<<HTML
          <div class="col-sm-3" id="{id}-withtext"  >
          <div class="form-check checkbox-slider--a {size} {access} ">
            <label>
              <input type="checkbox"  checked="{check}" name="{name}" value="{value}">{value}<span></span>
            </label>
          </div>
        </div>
        HTML,

        'ioslike' => <<<HTML
          <div class="col-sm-3" id="{id}-ioslike"  >
          <div class="form-check checkbox-slider--b {size} {access} ">
            <label>
              <input type="checkbox"  checked="{check}" name="{name}" value="{value}"><span></span>
            </label>
          </div>
        </div>

HTML,
        'materiallike' => <<<HTML
          <div class="col-sm-3  {class}">
                    {icon}
              <input type="checkbox" placeholder="{placeholder}" checked="{check}" name="{name}"
               id="{id}">
               <label class="form-check checkbox-slider--c  {size} {access}" id="{id}">{value}
               </label>
        </div>
 HTML,
        'icon' => <<<HTML
            <i class="{icon} fa-2x"></i>
HTML,
    ];

    public function asset()
    {
        /*$this->fileCss('https://cdn.statically.io/gh/kleinejan/titatoggle/master/docs/css/main.css');*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/titatoggle@2.1.2/dist/titatoggle-dist.css');
        $this->fileJs('https://cdn.statically.io/gh/kleinejan/titatoggle/master/docs/js/highlight.js');
    }

    /* public function process()
     {
      if(!empty ($this->data))
      return false;

      return true;

     }*/

    public function codes()
    {
        $iconCode = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon']
        ]);

        if ($this->value === 1)
            $checked = true;
        else
            $checked = false;

        $this->htm .= strtr($this->_layout['main'], [
                '{id}' => $this->id,
                '{name}' => $this->name,
                '{check}' => $checked,
                '{size}' => $this->_config['size'],
                '{access}' => $this->_config['disabled'],
                '{icon}' => $this->_config['hasIcon'] ? $iconCode : '',
                '{class}' => $this->_config['class']

            ]
        );


        /*        $this->css = $this->_layout['size'];*/

    }


}
