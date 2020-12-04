<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 * Edited: Anvar Jabborov
 */

namespace zetsoft\widgets\navigat;


use phpDocumentor\Reflection\Types\Self_;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\themes\ZTabWidget;
use function Sodium\crypto_box_keypair_from_secretkey_and_publickey;

class ZPillWidgetAnvar extends ZTabWidget
{
    public $config = [];
    public $_config = [
        'type' => ZPillWidgetAnvar::type['md'],
        'mdTabColor' => ZPillWidgetAnvar::mdTabColor['pills-info'],
        'classicTabColor' => ZPillWidgetAnvar::classicTabColor['pills-orange-anm'],
        'tabPanelId' => 'tab-panel-id',
        'contentPanelId' => 'content-panel-id',
        'pushUrl' => false,
        'icTarget' => '',
        'url' => '',
        'disabled' => ZPillWidgetAnvar::disabled['true'],
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
        $items = $this->data[0];

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
                '{wavesLight}' => '', $this->_config['type'] === ZPillWidgetAnvar::type['classic-rounded'] ? 'waves-light' : '',
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

            '{card}' => $this->_config['type'] === ZPillWidgetAnvar::type['classic-rounded'] ? 'card' : '',
            '{classicBorder}' => $this->_config['type'] === ZPillWidgetAnvar::type['classic-rounded'] ? 'border-right border-bottom border-left rounded-bottom' : '',
            '{mdTabs}' => $this->_config['type'] === ZPillWidgetAnvar::type['md'] ? 'nav-tabs md-tabs' : '',
            '{type}' => $this->_config['type'] === ZPillWidgetAnvar::type['md'] ? '' : 'pills-rounded',
            '{color}' => $this->_config['type'] === ZPillWidgetAnvar::type['md'] ? $this->_config['mdTabColor'] : $this->_config['classicTabColor'],
        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);

    }

}


