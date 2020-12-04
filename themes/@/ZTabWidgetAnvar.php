<?php

/**
 *
 * Author:  Daho
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 * Edited: Anvar Jabborov
 */

namespace zetsoft\widgets\themes;

use zetsoft\former\files\FilesClassForm;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZTabWidgetAnvar extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZTabWidgetAnvar::type['classic'],
        'mdTabColor' => ZTabWidgetAnvar::mdTabColor['white'],
        'classicTabColor' => ZTabWidgetAnvar::classicTabColor['tabs-orange'],
        'mdPills' => false,
        'url' => '',
        'pushUrl' => false,
        'icTarget' => '',
        'tabPanelId' => 'tab-panel-id',
        'contentPanelId' => 'content-panel-id',
        'grapes' => true,
        'disabled' => true,
    ];

    public const type = [
        'md' => 'md',
        'classic' => 'classic'
    ];

    public const classicTabColor = [
        'tabs-cyan' => 'tabs-cyan',
        'tabs-orange' => 'tabs-orange',
        'tabs-grey' => 'tabs-grey',
        'tabs-pink' => 'tabs-pink',
        'tabs-green' => 'tabs-green',
        'tabs-primary' => 'tabs-primary',
    ];

    public const mdTabColor = [
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
                    <ul class="nav {mdTabs}{classicTabColor}{MdTabColor}" id="{tabPanelId}" role="tablist">
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
                <a class="nav-link {wavesLight} {isActive} {disabled}" data-toggle="tab" id="{id}"  ic-get-from='{url}'
                   ic-push-url="{pushUrl}" ic-target="{icTarget}" href="#{href}" role="tab" aria-controls="{ariaControls}" style="color: #fff!important;">{tab.name}</a>
              </li>
              
HTML,
        'contentItem' => <<<HTML
               <!-- Panel -->
                  <div class="tab-pane fade {isShow}" id="{id}" role="tabpanel" aria-labelledby="{ariaLabelledBy}">
                    {content.item}
                  </div>
              <!-- Panel -->
        
HTML,
        'css' => <<<CSS

CSS,
    ];
    public $contentId = 'id-aa';

    public function codes()
    {
        $items = $this->data[0];
        $icTarget = null;
        $pushUrl = null;
        $url = null;
        $li = '';
        $content = '';
        $i = 1;
        foreach ($items as $item) {
            $li .= strtr($this->_layout['tabItem'], [
                '{tab.name}' => $item->title,
                ///
                '{icTarget}' => $icTarget ?? $this->_config['icTarget'],
                '{pushUrl}' => $item->pushUrl == true ? $this->_config['pushUrl'] : '',
                '{url}' => $url ?? $this->_config['url'],
                '{disabled}' => 'waves-light',
                '{ariaControls}' => $this->contentId . '-' . $this->_config['type'],
                '{id}' => $this->contentId . '-' . $this->_config['type'] . '-tab',
                '{href}' => $this->contentId . '-' . $this->_config['type'],
                '{isActive}' => ($i == 1) ? 'active' : '',
                '{wavesLight}' => '', $this->_config['type'] === ZTabWidgetAnvar::type['classic'] ? 'waves-light' : '',
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
        $main = strtr($this->_layout['main'], [
            '{tabs}' => $li,
            '{content}' => $content,
            ///
            '{tabPanelId}' => $this->_config['tabPanelId'],
            '{contentPanelId}' => $this->_config['contentPanelId'],
            '{MdTabColor}' => $this->mdTabColorGenerator(),
            '{classicTabColor}' => $this->classicTabColorGenerator(),
            '{card}' => $this->_config['type'] === ZTabWidgetAnvar::type['classic'] ? 'card' : '',
            '{classicBorder}' => $this->_config['type'] === ZTabWidgetAnvar::type['classic'] ? 'border-right border-bottom border-left rounded-bottom' : '',
            '{mdTabs}' => $this->_config['type'] === ZTabWidgetAnvar::type['md'] ? 'nav-tabs md-tabs' : '',
        ]);
        $this->htm = strtr($this->_layout['classic'], [
            '{main}' => $main,
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
    }

    public function mdTabColorGenerator()
    {
        return $this->_config['type'] === ZTabWidgetAnvar::type['md'] ? $this->_config['mdTabColor'] : '';
    }

    public function classicTabColorGenerator()
    {
        return $this->_config['type'] === ZTabWidgetAnvar::type['classic'] ? $this->_config['classicTabColor'] : '';
    }

}
