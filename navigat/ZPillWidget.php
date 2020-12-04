<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *   Edited: Anvar Jabborov
 */

namespace zetsoft\widgets\navigat;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\themes\ZTabWidget;
use function Sodium\crypto_box_keypair_from_secretkey_and_publickey;

class ZPillWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZPillWidget::type['md'],
        'mdTabColor' => ZPillWidget::mdTabColor['pills-success'],
        'classicTabColor' => ZPillWidget::classicTabColor['pills-orange-anm'],
        'tabPanelId' => 'tab-panel-id',
        'contentPanelId' => 'content-panel-id',
        'pushUrl' => false,
        'icTarget' => '',
        'url' => '',
        'disabled' => ZPillWidget::disabled['true'],
    ];

    public const type = [
        'md' => 'md',
        'classic-rounded' => 'classic-rounded'
    ];
    public const disabled = [
        'true' => 4,
        'false' => ''
    ];

    public const mdTabColor = [
        'pills-success' => 'pills-success',
        'pills-info' => 'pills-info',
        'pills-danger' => 'pills-danger',
        'pills-red' => 'pills-red',
        'pills-secondary' => 'pills-secondary',
        'pills-pink' => 'pills-pink',
        'pills-peach-gradient' => 'pills-peach-gradient',
        'pills-purple-gradient' => 'pills-purple-gradient',
        'pills-blue-teal' => 'pills-blue-teal',
    ];

    public const classicTabColor = [
        'pills-deep-purple' => 'pills-deep-purple',
        'pills-light-purple' => 'pills-light-purple',
        'pills-peach-gradient' => 'pills-peach-gradient',
        'pills-aqua-gradient' => 'pills-aqua-gradient',
        'pills-purple-gradient' => 'pills-purple-gradient',
        'pills-orange-anm' => 'pills-orange-anm',
        'pills-outline-red' => 'pills-outline-red',
        'pills-outline-green' => 'pills-outline-green',
        'pills-outline-purple-anm' => 'pills-outline-purple-anm',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <ul class="nav md-pills nav-justified {type} {color}" id="{tabPanelId}">
           {tabs}
        </ul>

        <div class="tab-content pt-0" id="{contentPanelId}">
           {content}
        </div>
HTML,
        'tabItem' => <<<HTML
          <li class="nav-item">
            <a 
            class="nav-link {isActive} {disabled}" 
            data-toggle="tab" 
            id="{id}" 
            href="#{href}" 
            role="tab" 
            aria-controls="{ariaControls}">
                {tab.name}
            </a>
          </li>
HTML,
        'contentItem' => <<<HTML
          <div class="tab-pane {isShow}" id="{id}" role="tabpanel" aria-labelledby="{ariaLabelledBy}">
             {content.item}
          </div>
HTML,
        'css' => <<<CSS

CSS,

    ];

    public $contentId = 'pill-id-aa';

    public function codes()
    {
        $items = $this->data;

        $li = '';
        $content = '';
        $i = 1;
        foreach ($items as $item) {
            $li .= strtr($this->_layout['tabItem'], [
                '{tab.name}' => $item->title,
                ///
                '{disabled}' => ($item->disabled == true) ? 'disabled disColor' : '',
                '{ariaControls}' => $this->contentId . '-' . $this->_config['type'],
                '{id}' => $this->contentId . '-' . $this->_config['type'] . '-tab',
                '{href}' => $this->contentId . '-' . $this->_config['type'],
                '{isActive}' => ($i == 1) ? 'active' : '',
                '{wavesLight}' => '', $this->_config['type'] === ZPillWidget::type['classic-rounded'] ? 'waves-light' : '',
            ]);
            $content .= strtr($this->_layout['contentItem'], [
                '{content.item}' => $item->content,
                ///
                '{isShow}' => ($i == 1) ? 'fade in show active' : '',
                '{ariaLabelledBy}' => $this->contentId . '-' . $this->_config['type'] . '-tab',
                '{id}' => $this->contentId . '-' . $this->_config['type'],
            ]);
            $i++;
            $this->contentId++;
        }
        $this->htm = strtr($this->_layout['main'], [
            '{tabs}' => $li,
            '{content}' => $content,
            ///
            '{tabPanelId}' => $this->_config['tabPanelId'],
            '{contentPanelId}' => $this->_config['contentPanelId'],

            '{card}' => $this->_config['type'] === ZPillWidget::type['classic-rounded'] ? 'card' : '',
            '{classicBorder}' => $this->_config['type'] === ZPillWidget::type['classic-rounded'] ? 'border-right border-bottom border-left rounded-bottom' : '',
            '{mdTabs}' => $this->_config['type'] === ZPillWidget::type['md'] ? 'nav-tabs md-tabs' : '',
            '{type}' => $this->_config['type'] === ZPillWidget::type['md'] ? '' : 'pills-rounded',
            '{color}' => $this->_config['type'] === ZPillWidget::type['md'] ? $this->_config['mdTabColor'] : $this->_config['classicTabColor'],
        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);

    }
// old code
    /*
     * public $config = [];
    public $_config = [
        'type' => self::Type['md'],
        'mdTabColor' => self::MdTabColor['pills-info'],
        'classicTabColor' => self::ClassicTabColor['pills-orange-anm'],
        'tabPanelId' => 'tab-panel-id',
        'contentPanelId' => 'content-panel-id',
        'pushUrl' => false,
        'icTarget' => '',
        'url' => ''
    ];

    public const Type = [
        'md' => 'md',
        'classic-rounded' => 'classic-rounded'
    ];

    public const MdTabColor = [
        'pills-success' => 'pills-success',
        'pills-info' => 'pills-info',
        'pills-danger' => 'pills-danger',
        'pills-red' => 'pills-red',
        'pills-secondary' => 'pills-secondary',
        'pills-pink' => 'pills-pink',
        'pills-peach-gradient' => 'pills-peach-gradient',
        'pills-purple-gradient' => 'pills-purple-gradient',
        'pills-blue-teal' => 'pills-blue-teal',
    ];

    public const ClassicTabColor = [
        'pills-deep-purple' => 'pills-deep-purple',
        'pills-light-purple' => 'pills-light-purple',
        'pills-peach-gradient' => 'pills-peach-gradient',
        'pills-aqua-gradient' => 'pills-aqua-gradient',
        'pills-purple-gradient' => 'pills-purple-gradient',
        'pills-orange-anm' => 'pills-orange-anm',
        'pills-outline-red' => 'pills-outline-red',
        'pills-outline-green' => 'pills-outline-green',
        'pills-outline-purple-anm' => 'pills-outline-purple-anm',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <ul class="nav md-pills nav-justified {type} {color}" id="{tabPanelId}">
           {tabs}
        </ul>

        <div class="tab-content pt-0" id="{contentPanelId}">
           {content}
        </div>
HTML,
        'tabItem' => <<<HTML
          <li class="nav-item">
            <a 
            class="nav-link {isActive} {disabled}" 
            data-toggle="tab" 
            id="{id}" 
            href="#{href}" 
            role="tab" 
            aria-controls="{ariaControls}">
                {tab.name}
            </a>
          </li>
HTML,
        'contentItem' => <<<HTML
          <div class="tab-pane {isShow}" id="{id}" role="tabpanel" aria-labelledby="{ariaLabelledBy}">
             {content.item}
          </div>
HTML,
    ];

    public $tabId = 'pill-id-aa';
    public $contentId = 'pill-id-aa';
     */
    /* public function codes()
     {

         $this->htm = $this->tabPanelCreator();

      /* $this->css = <<<CSS
         .pills-peach-gradient .nav-item .nav-link.active {
         background: linear-gradient(40deg, #FFD86F, #FC6262);
         }
         .pills-blue-gradient .nav-item .nav-link.active {
         background: linear-gradient(40deg, #45cafc, #303f9f);
         }
         .pills-purple-gradient .nav-item .nav-link.active {
         background: linear-gradient(40deg, #ff6ec4, #7873f5);
         }
         .pills-aqua-gradient .nav-item .nav-link.active {
         background: linear-gradient(40deg, #2096ff, #05ffa3);
         }
         .pills-rounded .nav-item .nav-link {
         border-radius: 10em;
         }
         .pills-light-purple .nav-item .nav-link.active {
         background-color: #ba68c8;
         }

         .pills-outline-red .nav-item .nav-link {
         border: 2px solid #fff;
         color: #666;
         background-color: transparent;
         }
         .pills-outline-red .nav-item .nav-link:hover {
         border: 2px solid #eee;
         }
         .pills-outline-red .nav-item .nav-link.active {
         border: 2px solid #f44336;
         color: #f44336;
         }
         .pills-outline-red .nav-item .nav-link.active:hover {
         border: 2px solid #f44336;
         color: #f44336;
         }

         .pills-outline-green .nav-item .nav-link {
         border: 2px solid #fff;
         color: #666;
         background-color: transparent;
         }
         .pills-outline-green .nav-item .nav-link:hover {
         border: 2px solid #eee;
         }
         .pills-outline-green .nav-item .nav-link.active {
         border: 2px solid #4caf50;
         color: #4caf50;
         }
         .pills-outline-green .nav-item .nav-link.active:hover {
         border: 2px solid #4caf50;
         color: #4caf50;
         }

         .pills-blue-teal .nav-item .nav-link.active {
         background-color: #4fc3f7;
         -webkit-animation-name: example; // Safari 4.0 - 8.0
         -webkit-animation-duration: 4s; // Safari 4.0 - 8.0
         animation-name: example;
         animation-duration: 4s;
         }
         // Safari 4.0 - 8.0
         @-webkit-keyframes example {
         from {background-color: #4fc3f7;}
         to {background-color: #009688;}
         }

         // Standard syntax
         @keyframes example {
         from {background-color: #4fc3f7;}
         to {background-color: #009688;}
         }

         .pills-outline-purple-anm .nav-item .nav-link.active {
         border: 2px solid #9c27b0;
         color: #9c27b0;
         background-color: transparent;
         -webkit-animation-name: outline; // Safari 4.0 - 8.0 //
         -webkit-animation-duration: 4s; //Safari 4.0 - 8.0 //
         animation-name: outline;
         animation-duration: 4s;
         }
         // Safari 4.0 - 8.0 //
         @-webkit-keyframes outline {
         from {border: 2px solid #9c27b0; color: #9c27b0;}
         to {border: 2px solid #f48fb1; color: #f48fb1;}
         }

         // Standard syntax //
         @keyframes outline {
         from {border: 2px solid #9c27b0; color: #9c27b0;}
         to {border: 2px solid #f48fb1; color: #f48fb1;}
         }

         .pills-orange-anm .nav-item .nav-link.active {
         background-color: #ffa000 ;
         -webkit-animation-name: orange; // Safari 4.0 - 8.0 //
         -webkit-animation-duration: 4s; // Safari 4.0 - 8.0 //
         animation-name: orange;
         animation-duration: 4s;
         }
         // Safari 4.0 - 8.0 //
         @-webkit-keyframes orange {
         from {background-color: #ffa000 ;}
         to {background-color: #f44336;}
         }

         // Standard syntax //
         @keyframes orange {
         from {background-color: #ffa000 ;}
         to {background-color: #f44336;}
         }
 CSS;



     }

     public function mainCreator($tabs, $content)
     {
         return strtr($this->_layout['main'], [
             '{tabs}' => $tabs,
             '{content}' => $content,
             '{tabPanelId}' => $this->_config['tabPanelId'],
             '{contentPanelId}' => $this->_config['contentPanelId'],
             '{type}' => $this->_config['type'] === self::Type['md'] ? '' : 'pills-rounded',
             '{color}' => $this->_config['type'] === self::Type['md'] ? $this->_config['mdTabColor'] : $this->_config['classicTabColor'],
         ]);
     }*/
    /*
    * Генерирует 1 таб-элемент

    public function tabCreator($itemName, $id, $disabled, $isActive, $icTarget = null, $pushUrl = null, $url = null)
    {
        return strtr($this->_layout['tabItem'], [
            '{tab.name}' => $itemName,
            '{icTarget}' => $icTarget ?? $this->_config['icTarget'],
            '{pushUrl}' => $pushUrl ?? $this->_config['pushUrl'],
            '{url}' => $url ?? $this->_config['url'],
            '{disabled}' => $disabled ? 'disabled disColor' : '',
            '{ariaControls}' => $this->idGenerator($id),
            '{id}' => $this->ariaLabelledByGenerator($id),
            '{href}' => $this->idGenerator($id),
            '{isActive}' => $isActive ? 'active' : '',
        ]);
    }
        */
}


