<?php

/**
 *
 *
 * Author:  Anvar Jabborov
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use yii\console\ExitCode;
use yii\web\JsExpression;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZOrderStatusWidget1 extends ZWidget
{


    public $config = [];
    public $_config = [

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b>',

    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="wizard d-flex d-md-block flex-column pt-3 align-items-center">
            <div class="d-flex flex-wrap">
            <div class="container">
               <ul class="nav nav-tabs border-0 position-relative row" role="tablist">
                    <div class="border d-none d-md-block horizontal-line position-absolute"></div>
                    <div class="border h-75 d-block d-md-none vertical-line position-absolute"></div>
                                            
                    {content}
                    
                    
                    
                </ul>
                
</div>
                
            </div>
            <div class="d-flex btn-container">
              <button class="btn btn-success mx-auto ml-md-auto mr-md-0 mt-5 btn-md rounded">
                        <i class="fas fa-redo mr-2"></i>
                        Повторить заказ
                </button>
</div>
            
        </div>
HTML,

        'items' => <<<HTML
               
        <li role="presentation" class="{isActive} my-4 my-md-0 col-md-2 active  px-0">
            <a class="d-flex flex-row justify-content-between flex-md-column align-items-center text-decoration-none" href="#step1">
              
                  <i class="{icon} {isActive} fa-2x"></i>
                <span class="{isActive} my-2">{title}</span>
                
                <span class="{isActiveSpan} rounded-circle text-white text-center fp-18 step-number">{step}</span>
            </a>
        </li>
        
     
HTML,
    ];


    public function codes()
    {
        $content = '';
        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout['items'], [
                '{id}' => $value->id,
                '{step}' => $value->step,
                '{title}' => $value->label,
                '{icon}' => $value->icon,
                '{isActive}' => $value->active ? 'text-success' : 'text-muted',
                '{isActiveSpan}' => $value->active ? 'bg-success' : 'bg-light',
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
        ]);
    }
}
