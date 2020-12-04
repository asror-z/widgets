<?php

/**
 *
 * Author:  Daho
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *   Edited Anvar Jabborov
 */

namespace zetsoft\widgets\themes;

use zetsoft\former\files\FilesClassForm;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZTabWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZTabWidget::type['classic'],
        'mdTabColor' => ZTabWidget::mdTabColor['black'],
        'classicTabColor' => ZTabWidget::classicTabColor['tabs-light'],
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
        'tabs-light' => 'tabs-light',
        'tabs-white' => 'tabs-white',
        'tabs-lightgreen' => 'tabs-lightgreen',
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
             <div class="classic-tabs" style="width: 100%">
                {main}
             </div>
HTML,

        'tabItem' => <<<HTML
              <li class="nav-item">
                <a class="nav-link text-dark {wavesLight} {isActive} {disabled}" data-toggle="tab" id="{id}"  ic-get-from='{url}'
                   ic-push-url="{pushUrl}" ic-target="{icTarget}" href="#{href}" role="tab" aria-controls="{ariaControls}" style="color: #000!important">{tab.name}</a>
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
        'js' => <<<JS
        let hash = window.location.hash;
        let newHash = hash.replace(/[^0-9]/g, '');
        
JS,

    ];
    public $contentId = 'id-aa';

    public function codes()
    {
        
        $items = $this->data;
        $icTarget = null;
        $pushUrl = null;
        $url = null;
        $li = '';
        $content = '';
        $i = 1;
        foreach ($items as $item) {
            $li .= strtr($this->_layout['tabItem'], [
                '{tab.name}' => $item->title,
                '{icTarget}' => $icTarget ?? $this->_config['icTarget'],
                '{pushUrl}' => $item->pushUrl == true ? $this->_config['pushUrl'] : '',
                '{url}' => $url ?? $this->_config['url'],
                '{disabled}' => 'waves-light',
                '{ariaControls}' => $this->contentId . '-' . $this->_config['type'],
                '{id}' => $this->contentId . '-' . $this->_config['type'] . '-tab',
                '{href}' => $this->contentId . '-' . $this->_config['type'],
                '{isActive}' => ($i == 1) ? 'active' : '',
                '{wavesLight}' => '', $this->_config['type'] === ZTabWidget::type['classic'] ? 'waves-light' : '',
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
            '{tabPanelId}' => $this->_config['tabPanelId'],
            '{contentPanelId}' => $this->_config['contentPanelId'],
            '{MdTabColor}' => $this->mdTabColorGenerator(),
            '{classicTabColor}' => $this->classicTabColorGenerator(),
            '{card}' => $this->_config['type'] === ZTabWidget::type['classic'] ? 'card' : '',
            '{classicBorder}' => $this->_config['type'] === ZTabWidget::type['classic'] ? 'border-right border-bottom border-left rounded-bottom' : '',
            '{mdTabs}' => $this->_config['type'] === ZTabWidget::type['md'] ? 'nav-tabs md-tabs' : '',
        ]);
        $this->htm = strtr($this->_layout['classic'], [
            '{main}' => $main,
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'],[
            
        ]);
    }

    public function mdTabColorGenerator()
    {
        return $this->_config['type'] === ZTabWidget::type['md'] ? $this->_config['mdTabColor'] : '';
    }

    public function classicTabColorGenerator()
    {
        return $this->_config['type'] === ZTabWidget::type['classic'] ? $this->_config['classicTabColor'] : '';
    }
    // old codes
    /*  public $config = [];
      public $_config = [
          'type' => self::Type['classic'],
          'mdTabColor' => self::MdTabColor['white'],
          'classicTabColor' => self::ClassicTabColor['tabs-grey'],
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


      public $tabId = 'id-aa';
      public $contentId = 'id-aa';

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
          'pillContent' => <<<HTML
                  <div class="tab-pane fade {isShow}" id="{id}" role="tabpanel"  aria-labelledby="{ariaLabelledBy}">
                  <!-- Nav tabs -->
                          <div class="row" style="margin-left: 0; margin-right: 0">
                            <div class="col-md-3">
                              <ul class="nav nav-pills {mdPills} flex-column {classicTabColor} {MdTabColor}" role="tablist">
                                {tab.name}
                              </ul>
                            </div>
                            <div class="col-md-3">
                              <!-- Tab panels -->
                                  <div class="tab-content vertical">
                                    {content.item}
                                  </div>
                              <!-- Tab panels -->
                            </div>
                          </div>
                      <!-- Nav tabs -->
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
      ];

      public function codes()
      {
          $this->htm = $this->tabPanelCreator();


          $this->css = <<<CSS
              @media (min-width: 62em) {
                  .classic-tabs .nav li:first-child {
                       margin-left: 0px!important;
                  }
              }
             .pills-primary .nav-link.active, .pills-primary .show>.nav-link, .tabs-primary {
                  background-color: #10b410!important;
              }
              .classic-tabs .nav.tabs-primary li a.active {
                  border-color: #fff;
  }
  CSS;
      }
  */
    /*
     * Возвращает готовый таб-панель

    public function tabPanelCreator()
    {
        $tabs = '';
        $content = '';
        $isActive = true;
        $isShow = 'fade in show active';
        foreach ($this->data as $firstKey => $firstValue) {
            if (is_array($firstValue)) {
                if (array_key_exists('disabled', $firstValue) || array_key_exists('url', $firstValue) || array_key_exists('pushUrl', $firstValue) || array_key_exists('icTarget', $firstValue)) {

                    $tabs .= $this->tabCreator(
                        $firstKey,

                        $this->tabId++,
                        $firstValue['disabled'] ?? false,
                        $isActive,
                        $firstValue['icTarget'] ?? false,
                        $firstValue['pushUrl'] ?? false,
                        $firstValue['url'] ?? false,
                    );

                    $content .= $this->contentCreator($firstKey, $firstValue['content'] ?? '', $isShow, $this->contentId++);
                    $isShow = '';
                    $isActive = false;

                } else {
                    $tabs .= $this->tabCreator($firstKey, $this->tabId++, false, $isActive);
                    $content .= $this->contentCreator($firstKey, $firstValue['content'] ?? '', $isShow, $this->contentId++);
                    $isShow = '';
                    $isActive = false;
                }
            } else {
                $tabs .= $this->tabCreator($firstKey, $this->tabId++, false, $isActive);
                $content .= $this->contentCreator($firstKey, $firstValue, $isShow, $this->contentId++);
                $isShow = '';
                $isActive = false;
            }

        }

        if ($this->_config['type'] === self::Type['classic']) {
            return strtr($this->_layout['classic'], [
                '{main}' => $this->mainCreator($tabs, $content),

            ]);
        }

        return $this->mainCreator($tabs, $content);

    }
*/
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
            '{wavesLight}' => $this->_config['type'] === self::Type['classic'] ? 'waves-light' : '',
        ]);
    }
*/
    /*
     * Генерирует 1 контент-элемент

    public function contentCreator($tab, $content, $isShow, $id)
    {
        return strtr($this->_layout['contentItem'], [
            '{tab.name}' => $tab,
            '{content.item}' => ZArrayHelper::getValue($content, 0),
            '{isShow}' => $isShow,
            '{ariaLabelledBy}' => $this->ariaLabelledByGenerator($id),
            '{id}' => $this->idGenerator($id),
        ]);
    }

    public function mainCreator($tabs, $content)
    {
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

    public function mdTabColorGenerator()
    {
        return $this->_config['type'] === self::Type['md'] ? $this->_config['mdTabColor'] : '';
    }

    public function classicTabColorGenerator()
    {
        return $this->_config['type'] === self::Type['classic'] ? $this->_config['classicTabColor'] : '';
    }

    public function idGenerator($id)
    {
        return $id . '-' . $this->_config['type'];
    }

    public function ariaLabelledByGenerator($id)
    {
        return $this->idGenerator($id) . '-tab';
    }
*/
}
