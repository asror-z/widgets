<?php

/**
 *
 * Author:  Daho
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\themes;

use zetsoft\former\files\FilesClassForm;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\kernels\ZWidget;

class ZTabWidget2 extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => self::Type['classic'],
        'mdTabColor' => self::MdTabColor['indigo'],
        'classicTabColor' => self::ClassicTabColor['tabs-primary'],
        'mdPills' => false,
        'url' => '',
        'pushUrl' => false,
        'icTarget' => '',
        'tabPanelId' => 'tab-panel-id',
        'contentPanelId' => 'content-panel-id',
        'grapes' => true,
    ];

    public const Type = [
        'md' => 'md',
        'classic' => 'classic'
    ];

    public const ClassicTabColor = [
        'tabs-cyan' => 'tabs-cyan',
        'tabs-orange' => 'tabs-orange',
        'tabs-grey' => 'tabs-grey',
        'tabs-pink' => 'tabs-pink',
        'tabs-green' => 'tabs-green',
        'tabs-primary' => 'tabs-primary',
    ];

    public const MdTabColor = [
        'red' => 'red',
        'pink' => 'pink',
        'purple' => 'purple',
        'deep-purple' => 'deep-purple',
        'indigo' => 'indigo',
        'blue' => 'blue',
        'light-blue' => 'light-blue',
        'cyan' => 'cyan',
        'teal' => 'teal',
        'green' => 'green',
        'light-green' => 'light-green',
        'lime' => 'lime',
        'yellow' => 'yellow',
        'amber' => 'amber',
        'orange' => 'orange',
        'deep-orange' => 'deep-orange',
        'brown' => 'brown',
        'grey' => 'grey',
        'blue-grey' => 'blue-grey',
        'white' => 'white',
        'black' => 'black',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                <!-- Nav tabs -->
                    <ul class="nav {mdTabs} {classicTabColor} {MdTabColor}" id="{tabPanelId}" role="tablist">
                      {tabs}
                    </ul>
                <!-- Nav tabs -->
                <!-- Tab panels -->
                    <div class="tab-content {classicBorder} {card}" id="{contentPanelId}">
                      {content}
                    </div>
                <!-- Tab panels -->
HTML,
        'classic' => <<<HTML
             <div class="classic-tabs">
                {main}
             </div>
HTML,
        'tabItem' => <<<HTML
              <li class="nav-item">
                <a class="nav-link {wavesLight} {isActive} {disabled}"
                   data-toggle="tab"
                   id="{id}" 
                   ic-post-to="{url}"
                   ic-push-url="{pushUrl}"
                   ic-target="{icTarget}"
                   href="#{href}" 
                   role="tab" 
                   aria-controls="{ariaControls}" 
                   style="color: #fff!important;">{tab.name}</a>
              </li>
HTML,
        'contentItem' => <<<HTML
               <!-- Panel -->
                  <div class="tab-pane {isShow}" id="{id}" role="tabpanel" aria-labelledby="{ariaLabelledBy}">
                    {content.item}
                  </div>
              <!-- Panel -->
        
HTML,
    ];

    public $tabId = 'tabwidget12';
    public $contentId = 'tabwidget12';
    public function codes()
    {
        $tabs = '';
        $contents = '';
        $isActive = true;
        foreach ($this->data as $dataKey => $dataVal) {
            $tabs .= strtr($this->_layout['tabItem'], [
                '{tab.name}' => $dataVal->name,
                '{icTarget}' => $dataVal->icTarget ?? $this->_config['icTarget'],
                '{pushUrl}' => $dataVal->pushUrl ?? $this->_config['pushUrl'],
                '{url}' => $dataVal->url ?? $this->_config['url'],
                '{disabled}' => $dataVal->disabled ? 'disabled disColor' : '',
                '{ariaControls}' => $this->idGenerator($this->tabId),
                '{id}' => $this->ariaLabelledByGenerator($this->tabId),
                '{href}' => $this->idGenerator($this->tabId),
                '{isActive}' => $isActive ? 'active' : '',
                '{wavesLight}' => $this->_config['type'] === self::Type['classic'] ? 'waves-light' : '',
            ]);

            $contents .= strtr($this->_layout['contentItem'], [
                '{tab.name}' => $dataVal->name,
                '{content.item}' => $dataVal->content,
                '{ariaLabelledBy}' => $this->ariaLabelledByGenerator($this->contentId),
                '{id}' => $this->idGenerator($this->contentId),
                '{isShow}' => $isActive ? 'fade in show active' : '',
            ]);
            $this->tabId++;
            $this->contentId++;
            $isActive = false;
        }


        if ($this->_config['type'] === self::Type['classic']) {
            $this->htm =  strtr($this->_layout['classic'], [
                '{main}' => $this->mainCreator($tabs, $contents),
            ]);
        } else {
            $this->htm =  $this->mainCreator($tabs, $contents);
        }
        

        $this->css = <<<CSS
            @media (min-width: 62em) {
                .classic-tabs .nav li:first-child {
                     margin-left: 0px!important; 
                }
            }
CSS;
    }


    public function mainCreator($tabs, $content) {
        return strtr($this->_layout['main'], [
            '{tabs}' => $tabs,
            '{content}' => $content,
            '{tabPanelId}' => $this->_config['tabPanelId'],
            '{contentPanelId}' => $this->_config['contentPanelId'],
            '{MdTabColor}' => $this->mdTabColorGenerator(),
            '{classicTabColor}' => $this->classicTabColorGenerator(),
            '{card}' => $this->_config['type'] === self::Type['classic'] ? 'card' : '',
            '{classicBorder}' => $this->_config['type'] === self::Type['classic'] ? 'border-right border-bottom border-left rounded-bottom' : '',
            '{mdTabs}' => $this->_config['type'] === self::Type['md'] ? 'nav-tabs md-tabs' : '',
        ]);
    }

    public function mdTabColorGenerator() {
        return $this->_config['type'] === self::Type['md'] ? $this->_config['mdTabColor'] : '';
    }

    public function classicTabColorGenerator() {
        return $this->_config['type'] === self::Type['classic'] ? $this->_config['classicTabColor'] : '';
    }

    public function idGenerator($id) {
        return $id . '-' . $this->_config['type'];
    }

    public function ariaLabelledByGenerator($id) {
        return $this->idGenerator($id) . '-tab';
    }

}
