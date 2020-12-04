<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZTextareaWidget
 * @package zetsoft\widgets\inputes
 *
 *
 * Refactored: ELnur Suyunov
 */
class ZTextAreaWidget extends ZWidget
{
    public $dbType = dbTypeText;
    public $config = [];
    public $_config = [
        'rows' => 1,
        'size' => '',
        'readonly' => false,
        'class' => '',
        'style' => ''


    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZTextAreaWidget/image/icon.png',
        'name' => Azl . 'TextArea',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZTextAreaWidget/image/icon.png"/>',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
      
          <div class="md-form" >  
                 {icon}
              <textarea
              class="md-textarea form-control {class}" 
              style="{style}"
              rows="{rows}"
              id="{id}"
              name="{name}" value="{value}" placeholder="{placeholder}">{value}</textarea>
            </div>
            
HTML,
        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon} mt-6"></i>
HTML,

    ];


    public function codes()
    {
        $iconCode = '';
        if ($this->_config['hasIcon']) {
            $iconCode = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => $this->value,
            '{size}' => $this->_config['size'],
            '{class}' => $this->_config['class'],
            '{rows}' => $this->_config['rows'],
            '{placeholder}' => $this->_config['placeholder'],
            '{icon}' => $iconCode,
            '{style}'=> $this->_config['style']
        ]);


    }
}

