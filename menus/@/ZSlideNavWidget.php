<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Created By:ElnurController Suyunov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\menus;
use zetsoft\system\kernels\ZWidget;
class ZSlideNavWidget  extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' =>ZSlideNavWidget::type['slidenav'],
        'conc'=>'Калькулятор вкладов',
        'conc2'=>'Калькулятор кредита',
        'online'=>'Онлайн заявка на кредитование',
        'online2'=>'Онлайн заявка на открытие пластиковой карты',
        'filial'=>'Филиалы и мини-банки',
        'version'=>'Версия для слабовидящих',
        'voice'=>'Звуковое сопровождение',
        'gourment'=>'Государственная символика',
        'grapes' => true
    ];
    public const type = [
        'slidenav' => 'slidenav'
    ];

    public $layout=[];
    public $_layout=[

       'main'=><<<HTML
    <div class="sideNav"  {readonly}>
        <div class="sideButton">
            <span class=" fa fa-calculator fa-2x"></span>
            <a class="sideLink" href="#">{conc}</a>
        </div>
        <div class="sideButton">
            <span class="fa fa-calculator fa-2x"></span>
            <a class="sideLink" href="#">{conc2}</a>
        </div>
        <div class="sideButton">
            <span class="fa fa-credit-card fa-2x"></span>
            <a class="sideLink" href="#">{online}</a>
        </div>
        <div class="sideButton">
            <span class="fa fa-credit-card fa-2x"></span>
            <a class="sideLink" href="#">{online2}</a>
        </div>
        <div class="sideButton">
            <span class="fa fa-location-arrow fa-2x"></span>
            <a class="sideLink" href="#">{filial}</a>
        </div>
        <div class="sideButton">
            <span class="fa fa-eye fa-2x"></span>
            <a class="sideLink" href="#">{version}</a>
        </div>
        <div class="sideButton">
            <span class="fa fa-volume-up fa-2x"></span>
            <a class="sideLink" href="#">{voice}</a>
        </div>

        
        <div class="sideButton">
            <span class="fa fa-circle-notch fa-2x"></span>
            <a class="sideLink" href="#">{gourment}</a>
        </div>
    </div>
HTML,
      'css'=><<<CSS
.sideNav{
position:absolute !important;
z-index: 10 !important;
}
.sideNav.sideButton{
position:fixed !important;
}
CSS
    ];
    public function asset()
    {
        $this->fileCss('/render/menus/ZSlideNavWidget/asset/demo_files/all.min.css');
        $this->fileCss('/render/menus/ZSlideNavWidget/asset/demo_files/material.css');
                         /* <<<<<<<<<<< YARN >>>>>>>
        $this->fileCss('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
                            <<<<<<<<<<< YARN >>>>>>>*/

        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css');
      /*  $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js');*/

    }

    public function codes()
    {

        $this->htm = strtr($this->_layout["main"],[
            '{conc}'=>  $this->_config['conc'],
            '{conc2}'=>  $this->_config['conc2'],
            '{online}'=>  $this->_config['online'],
            '{online2}'=>  $this->_config['online2'],
            '{filial}'=>  $this->_config['filial'],
            '{version}'=>  $this->_config['version'],
            '{voice}'=>  $this->_config['voice'],
            '{gourment}'=>  $this->_config['gourment'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

        ]);
        $this->css = strtr($this->_layout["css"],[]);
    }

}

