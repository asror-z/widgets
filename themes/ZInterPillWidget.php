<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\themes;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;
use function Sodium\crypto_box_keypair_from_secretkey_and_publickey;
use zetsoft\widgets\themes\ZTabForDynaWidget;

class ZInterPillWidget extends ZTabWidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['rounded'],
        'classicTabColor' => self::ClassicTabColor['pills-outline-green'],
        'tabPanelId' => 'tab-panel-id',
        'contentPanelId' => 'content-panel-id',
        'pushUrl' => false,
        'icTarget' => '',
        'url' => ''
    ];

    public const type = [
        'rectangle' => 'rectangle',
        'rounded' => 'rounded'
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
        <ul class="nav md-pills nav-justified {type} {color} pb-3" id="{tabPanelId}">
           {tabs}
        </ul>

        <div class="tab-content" id="{contentPanelId}">
           {content}
        </div>
HTML,
        'tabItem' => <<<HTML
          <li class="nav-item {disabled}">
            <a 
            class="nav-linkS" 
            data-toggle="tab" 
            id="{id}" 
            role="tab" 
            aria-controls="{ariaControls}"
            ic-post-to="{url}"
            ic-target=".tab-content"
            ic-push-url="{pushUrl}"
            >
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

    public function codes()
    {

        $a2 = new ZTabForDynaWidget();

        $this->htm = $a2->tabPanelCreator();

        $this->css = <<<CSS
        .pills-peach-gradient .nav-item.active {
        background: linear-gradient(40deg, #FFD86F, #FC6262);
        }
        .pills-peach-gradient .nav-item.disabled {
        background: #8c8c8c;
        }
        .pills-blue-gradient .nav-item.active {
        background: linear-gradient(40deg, #45cafc, #303f9f);
        }
        .pills-purple-gradient .nav-item.active {
        background: linear-gradient(40deg, #ff6ec4, #7873f5);
        }
        .pills-aqua-gradient .nav-item.active {
        background: linear-gradient(40deg, #2096ff, #05ffa3);
        }
        .pills-rounded .nav-item {
        border-radius: 10em;
        }
        .pills-light-purple .nav-item.active {
        background-color: #ba68c8;
        }
        
        .pills-outline-red .nav-item {
        border: 2px solid #fff;
        color: #666;
        background-color: transparent;
        }
        .pills-outline-red .nav-item:hover {
        border: 2px solid #eee;
        }
        .pills-outline-red .nav-item.active {
        border: 2px solid #f44336;
        color: #f44336;
        }
        .pills-outline-red .nav-item.active:hover {
        border: 2px solid #f44336;
        color: #f44336;
        }
        
        .pills-outline-green .nav-item {
        border: 2px solid #fff;
        color: #666;
        background-color: transparent;
        }
        .pills-outline-green .nav-item:hover {
        border: 2px solid #eee;
        }
        .pills-outline-green .nav-item.active {
        border: 2px solid #4caf50;
        color: #4caf50;
        }
        .pills-outline-green .nav-item.active:hover {
        border: 2px solid #4caf50;
        color: #4caf50;
        }
        
        .pills-blue-teal .nav-item.active {
        background-color: #4fc3f7;
        -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
        animation-name: example;
        animation-duration: 4s;
        }
        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes example {
        from {background-color: #4fc3f7;}
        to {background-color: #009688;}
        }
        
        /* Standard syntax */
        @keyframes example {
        from {background-color: #4fc3f7;}
        to {background-color: #009688;}
        }
        
        .pills-outline-purple-anm .nav-item.active {
        border: 2px solid #9c27b0;
        color: #9c27b0;
        background-color: transparent;
        -webkit-animation-name: outline; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
        animation-name: outline;
        animation-duration: 4s;
        }
        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes outline {
        from {border: 2px solid #9c27b0; color: #9c27b0;}
        to {border: 2px solid #f48fb1; color: #f48fb1;}
        }
        
        /* Standard syntax */
        @keyframes outline {
        from {border: 2px solid #9c27b0; color: #9c27b0;}
        to {border: 2px solid #f48fb1; color: #f48fb1;}
        }
        
        .pills-orange-anm .nav-item.active {
        background-color: #ffa000 ;
        -webkit-animation-name: orange; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
        animation-name: orange;
        animation-duration: 4s;
        }
        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes orange {
        from {background-color: #ffa000 ;}
        to {background-color: #f44336;}
        }
        
        /* Standard syntax */
        @keyframes orange {
        from {background-color: #ffa000 ;}
        to {background-color: #f44336;}
        }
        
       /* .disColor{
            background-color: gray;
            cursor: pointer;
        }*/
CSS;

        $this->js = <<<JS
$('li.nav-item').click(function (event){
    e.preventDefault();
    $(this).addClass('active');
    $(this).siblings().each(function(){
        $(this).removeClass('active') ;
    });
});
$('.nav-item:first-child').addClass('active');

JS;


    }

    public function mainCreator($tabs, $content)
    {
        return strtr($this->_layout['main'], [
            '{tabs}' => $tabs,
            '{content}' => $content,
            '{tabPanelId}' => $this->_config['tabPanelId'],
            '{contentPanelId}' => $this->_config['contentPanelId'],
            '{type}' => $this->_config['type'] === 'rounded' ? 'pills-rounded' : '',
            '{color}' =>  $this->_config['classicTabColor'] ,
        ]);
    }

    /*
    * Генерирует 1 таб-элемент
    */
    public function tabCreator($itemName, $id, $disabled, $isActive, $icTarget = null, $pushUrl = null, $url = null)
    {
        return strtr($this->_layout['tabItem'], [
            '{tab.name}' => $itemName,
            '{pushUrl}' => $pushUrl ?? $this->_config['pushUrl'],
            '{disabled}' => $disabled ? 'disabled' : '',
            '{url}' => $url ?? $this->_config['url'],
            '{ariaControls}' => $this->idGenerator($id),
            '{id}' => $this->ariaLabelledByGenerator($id),
            '{href}' => $this->idGenerator($id),
        ]);
    }
}


