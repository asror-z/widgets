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

namespace zetsoft\widgets\menus;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;

/*use zetsoft\system\helpers\ZJsonHelper;*/


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZMMmenuWidget2_ extends ZWidget
{
    public $config = [];
    public $_config = [
        'name' => '',
        'isName' => true,
        'isAll' => true,
        'isApp' => true,
        'menu_ids' => [],
        'theme' => ZMMmenuWidget2::Theme['light'],
        'pagedim' => ZMMmenuWidget2::pagedim['pagedim-black'],
        'dividers.add' => false,
        'dropdowns.drop' => false,
        'counters.add' => true,
        'counters.count' => true,
        'pageScroll.scroll' => true,
        'content.img.width' => 300,
        'menu-effect-slide' => true,
        'iconbar.use' => false,
        'iconbar.top' => [

        ],
        'iconbar.bottom' => [
        ],

        'all.border' => ZMMmenuWidget2::border['border-none'],
        'position' => ZMMmenuWidget2::position['position-back'],
        'shadows' => ZMMmenuWidget2::shadows['shadow-page'],
        'fx-slides' => ZMMmenuWidget2::fx_slide['fx-panels-slide-0'],

        "tileview" => false,
        "listview-justify" => false,
        "multiline" => false,
        'fullscreen' => false,


        'p-left' => 'left',
        'p-right' => 'right',
        'p-top' => 'top',
        'p-bottom' => 'bottom'

    ];

    public const Theme = [
        'light' => 'light',
        'dark' => 'dark',
        'eyuf' => 'eyuf',
    ];

    public const border = [
        'border-full' => 'border-full',
        'border-none' => 'border-none',
    ];

    public const pagedim = [
        'pagedim-black' => 'pagedim-black',
        'pagedim-white' => 'pagedim-white',
        'pagedim' => 'pagedim'
    ];

    public const position = [
        'position-back' => 'position-back',
        'position-top' => 'position-top',
        'position-right' => 'position-right',
        'position-front' => 'position-front',
        'position-bottom' => 'position-bottom'
    ];

    public const shadows = [
        'shadow-page' => 'shadow-page',
        'shadow-panels' => 'shadow-panels',
        'shadow-menu' => 'shadow-menu'
    ];

    public const fx_slide = [
        'fx-panels-slide-100' => 'fx-panels-slide-100',
        'fx-panels-slide-0' => 'fx-panels-slide-0',
        'fx-panels-none' => 'fx-panels-none'
    ];

    public $event = [];

    public $_event = [
        'openPanel:start' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:start: " + panel.id) }',
        'openPanel:finish' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:finish: " + panel.id) }',
        'closeAllPanels:before' => 'function (event) { console.log("ZALLMmenuWidget | closeAllPanels:before: " + panel.id) }',
        'closeAllPanels:after' => 'function (event) { console.log("ZALLMmenuWidget | closeAllPanels:after: " + panel.id) }',
        'closePanel:before' => 'function (event) { console.log("ZALLMmenuWidget | closePanel:before: " + panel.id) }',
        'closePanel:after' => 'function (event) { console.log("ZALLMmenuWidget | closePanel:after: " + panel.id) }',
        'openPanel:before' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:before: " + panel.id) }',
        'openPanel:after' => 'function (event) { console.log("ZALLMmenuWidget | openPanel:after: " + panel.id) }',
        'setSelected:before' => 'function (event) { console.log("ZALLMmenuWidget | setSelected:before: " + panel.id) }',
        'setSelected:after' => 'function (event) { console.log("ZALLMmenuWidget | setSelected:after: " + panel.id) }',
    ];




    public function asset()
    {


        $this->fileCss('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/mburger-css@1.3.3/dist/mburger.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.polyfills.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.js');

        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/fix-modal.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/mmenuextension.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu-theme/theme_eyuf.css');



    }


    /**
     * Recursively renders the menu items (without the container tag).
     * @param $items
     * @return string the rendering result
     */
    public function all($items)
    {
        $lines = [];


        foreach ($items as $item) {

            if ($item->visible === false)
                continue;

            $menu = $this->item($item);

            if (!empty($item->items)) {
                $menu .= strtr($this->layout['subMenuTemplate'], [
                    '{items}' => $this->all($item->items),
                ]);
            }


            $lines[] = ZHTML::tag('li', $menu, []);
        }

        return implode("\n", $lines);
    }

    public function item($item)
    {
        $data_id = uniqid('', true);

        if (!empty($item->items))
            $linkTemplate = $this->layout['linkTemplateItem'];
        else {
            if ($item->target === '_blank')
                $linkTemplate = $this->layout['linkTemplateBlank'];
            else
                $linkTemplate = $this->layout['linkTemplate'];
        }

        if ($item->icon === 'empty' || empty($item->icon))
            $item->icon = Az::$app->utility->mains->icon(true);

        $icon = strtr($this->layout['defaultIcon'], [
            '{icon}' => $item->icon
        ]);

        $class = str_replace(',', ' ', $item->class);

        $replace = [
            '{data-id}' => 'data-id="' . $data_id . '"',
            '{class}' => $class,
            '{url}' => (!empty($item->url)) ? $item->url : '#',
            '{label}' => $item->title,
            '{icon}' => $icon
        ];

        return strtr($linkTemplate, $replace);

    }

    public function codes()
    {
        if ($this->_config['isAll']) {
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new ALL())->run()
            );
        }



        $role = $this->userRole();
        $url = Az::$app->App->eyuf->user->getMainUrl();
        //$url = ZUrl::to($url);
        $url = ZUrl::to([$url]);

        $this->layout = [

            'main' => <<<HTML
 <nav id="menu"  style="">
    <ul class="listview-icons">
        <li>
            <a href="{$url}"></i>{home}</a>
        </li>
        {content}
	</ul>
</nav>
HTML,

            'linkTemplate' => <<<HTML
                <a href="{url}" class="{class}">{icon}&nbsp;&nbsp; {label}</a>
HTML,
            'linkTemplateBlank' => <<<HTML
                  <a href="{url}" class="{class}" target="_blank">{icon}&nbsp;&nbsp; {label}</a>
HTML,
            'linkTemplateItem' => <<<HTML
                  <a {data-id} class="{class}" href="{url}">{icon}&nbsp;&nbsp; {label} </a>
HTML,
            'subMenuTemplate' => <<<HTML
       <ul class="treeview-menu">{items}</ul> 
HTML,

            'defaultIcon' => <<<HTML
                 <i class="{icon}"></i>
HTML,

        ];

        $this->js = <<<JS
 


JS;

        $this->js = strtr($this->js, [

            '{dividers.add}' => $this->jscode($this->_config['dividers.add']),
            '{dropdowns.drop}' => $this->jscode($this->_config['dropdowns.drop']),
            '{counters.add}' => $this->jscode($this->_config['counters.add']),
            '{counters.count}' => $this->jscode($this->_config['counters.count']),
            '{pageScroll.scroll}' => $this->jscode($this->_config['pageScroll.scroll']),
            '{navbar.title}' => $this->jscode(Az::l('Главное меню')),
            '{content.img.width}' => $this->jscode($this->_config['content.img.width']),

            '{all.theme}' => $this->jscode($this->_config['theme']),
            '{pagedim}' => $this->jscode($this->_config['pagedim']),

            '{iconbar.use}' => $this->jscode($this->_config['iconbar.use']),
            '{iconbar.top}' => $this->jscode($this->_config['iconbar.top']),
            '{iconbar.bottom}' => $this->jscode($this->_config['iconbar.bottom']),

            '{all.border}' => $this->jscode($this->_config['all.border']),
            '{position}' => $this->jscode($this->_config['position']),
            '{shadows}' => $this->jscode($this->_config['shadows']),
            '{fx-slides}' => $this->jscode($this->_config['fx-slides']),

            '{tileview}' => ($this->_config['tileview']) ? ($this->jscode('tileview')) : '',
            '{menu-effect-slide}' => ($this->_config['menu-effect-slide']) ? ($this->jscode('fx-menu-slide')) : '',
            '{listview-justify}' => ($this->_config['listview-justify']) ? ($this->jscode('listview-justify')) : '',
            '{multiline}' => ($this->_config['multiline']) ? ($this->jscode('multiline')) : '',
            '{fullscreen}' => ($this->_config['fullscreen']) ? ($this->jscode('fullscreen')) : '',

            '{p-right}' => $this->jscode($this->_config['p-right']),
            '{p-left}' => $this->jscode($this->_config['p-left']),
            '{p-top}' => $this->jscode($this->_config['p-top']),
            '{p-bottom}' => $this->jscode($this->_config['p-bottom']),

            /**
             *
             * Events
             */
            //  '{openPanel:start}' => $this->eventCode('openPanel:start'),
            '{openPanel:start}' => $this->eventCode('openPanel:start'),


        ]);


        $content = '';

        /** @var array $item */
        if (!empty($this->data))
            $content .= $this->all($this->data);

        $this->htm = strtr($this->layout['main'], [
            '{home}' => Az::l('Главная страница'),
            '{content}' => $content
        ]);


        $this->css = <<<CSS


.home-mmenu{
    margin-right: 12px !important;
}

CSS;

    }

}
