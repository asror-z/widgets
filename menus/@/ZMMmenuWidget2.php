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


use PharIo\Manifest\Url;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use function Complex\rho;

/*use zetsoft\system\helpers\ZJsonHelper;*/


class ZMMmenuWidget2 extends ZWidget
{
    public $config = [];
    public $_config = [
        'name' => '',
        'isName' => true,
        'isAll' => true,
        'isApp' => true,
        'menu_ids' => [],
        'theme' => ZMmenuWidget::theme['eyuf'],
        'pagedim' => ZMmenuWidget::pagedim['pagedim-black'],
        'dividers.add' => false,
        'dropdowns.drop' => false,
        'counters.add' => true,
        'content' => '',
        'navbarTitle' => '',
        'home' => true,
        'counters.count' => true,
        'pageScroll.scroll' => true,
        'content.img.width' => 300,
        'menu-effect-slide' => true,
        //'grapes' => true,

        'iconbar.use' => false,
        'iconbar.top' =>[],
        'iconbar.bottom' => [
        ],

        'all.border' => ZMmenuWidget::border['border-none'],
        'position' => ZMmenuWidget::position['position-back'],
        'shadows' => ZMmenuWidget::shadows['shadow-page'],
        'fx-slides' => ZMmenuWidget::fx_slide['fx-panels-slide-0'],

        'tileview' => false,
        'listview-justify' => false,
        'multiline' => false,
        'fullscreen' => false,


        'p-left' => 'left',
        'p-right' => 'right',
        'p-top' => 'top',
        'p-bottom' => 'bottom',

        /*
         * Intercooler
         * */
        'cooler' => false,

    ];

    public const theme = [
        'white' => 'white',
        'dark' => 'dark',
        'light' => 'light',
        'black' => 'black',
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
        'item:click' => 'console.log("ZALLMmenuWidget | item:click");',
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

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
 <nav id="menu"  style="">
    <ul class="listview-icons">
        {home}
        {content}
	</ul>
</nav>
HTML,

        'homeItem' => <<<HTML
        <li>
            <a href='{url}'></i>{home}</a>
        </li>
HTML,

        'linkTemplate' => <<<HTML
                <a href="{url}" data-item="{data-item}" class="mmenu-item {class}">{icon}&nbsp;&nbsp; {label}</a>
HTML,

        'linkTemplateBlank' => <<<HTML
                  <a href="{url}" class="{class}" target="_blank">{icon}&nbsp;&nbsp; {label}</a>
HTML,

        'linkTemplateItem' => <<<HTML
                  <a {data-id} class="mmenu-item {class}" data-item="{data-item}" href="{url}">{icon}&nbsp;&nbsp; {label} </a>
HTML,

        'subMenuTemplate' => <<<HTML
       <ul class="treeview-menu">{items}</ul> 
HTML,

        'defaultIcon' => <<<HTML
                 <i class="{icon}"></i>
HTML,

        'cooler' => <<<HTML
                <a
                class="{class}"
                ic-post-to="{url}" 
                ic-target="#content"
                ic-push-url="true"
                >{icon}&nbsp;&nbsp; {label}</a>
HTML,

        'css' => <<<CSS


.home-mmenu{
    margin-right: 12px !important;
}

CSS,

    ];


    public function asset()
    {

        $this->fileCss('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/mburger-css@1.3.3/dist/mburger.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/fix-modal.css');
        $this->fileCss('/render/menus/ZMMmenuWidget/assets/mmenu/mmenuextension.css');

        $theme = $this->_config['theme'];
        $this->fileCss("/render/menus/ZMMmenuWidget/assets/mmenu-theme/$theme.css");

        $this->fileJs('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.polyfills.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mmenu-js@8.5.0/dist/mmenu.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.js');

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
                $menu .= strtr($this->_layout['subMenuTemplate'], [
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
            $linkTemplate = $this->_layout['linkTemplateItem'];
        else {
            if ($item->target === '_blank')
                $linkTemplate = $this->_layout['linkTemplateBlank'];
            else {
                if ($this->_config['cooler'])
                    $linkTemplate = $this->_layout['cooler'];
                else
                    $linkTemplate = $this->_layout['linkTemplate'];
            }
        }

        if ($item->icon === 'empty' || empty($item->icon))
            $item->icon = Az::$app->utility->mains->icon(true);

        $icon = strtr($this->_layout['defaultIcon'], [
            '{icon}' => $item->icon
        ]);

        $class = str_replace(',', ' ', $item->class);

        /*removing /ru/ and adding index.aspx*/
        $urls = ZStringHelper::explode($item->url, '/ru', false);
        $url = '';
        foreach ($urls as $url) {
            if (ZStringHelper::startsWith($url, '/admin'))
                $url = str_replace('.aspx', '/index.aspx', $url);
        }

        $replace = [
            '{data-id}' => 'data-id="' . $data_id . '"',
            '{class}' => $class,
            '{data-item}' => $item->dataItem,
            '{url}' => (!empty($item->url)) ? $url : '#',
            '{label}' => $item->title,
            '{icon}' => $icon
        ];

        return strtr($linkTemplate, $replace);

    }

    public function codes()
    {

        if (empty($this->_config['navbarTitle']))
            $this->_config['navbarTitle'] = Az::l('Главное меню');


        if ($this->_config['isAll']) {
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new ALL())->run()
            );
        }

        if (empty($this->_config['content']))
            $this->_config['content'] = "<div class=\"zlogo\"><img src=\"/imagez/eyuf/logo.jpg\" width=\"{$this->_config['content.img.width']}\"></div>";



        $role = $this->userRole();
        $url = Az::$app->App->eyuf->user->getMainUrl();
        //$url = ZUrl::to($url);
        $url = ZUrl::to([$url]);


        $mainJs = <<<JS
 
 
$(function () {
    var e, t, n = $(window), i = ($("html"),
        $("body")), a = $("body, html");
    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1)
    },

        function () {
          
        }()
});


        $(document).ready(function() {

            {optionsConfigs}

            var menu = new Mmenu("#menu", options, configs);
            var api = menu.API;
            var t = $("#hamburger").children(".mburger");
            api.bind("close:finish", function () {
                setTimeout(function () {
                    t.attr("href", "#menu");
                }, 100)
            }),
                api.bind("open:finish", function () {
                    setTimeout(function () {
                        t.attr("href", "#page");
                    }, 100)
                });


            $(function () {
                $('.mm-listitem').each(function () {
                    var firstchild = $(this).children('.mm-listitem__text');
                    var secondchild = $(this).children('.mm-btn');
                    var myhref = secondchild.attr("href");

                    firstchild.attr("href", myhref);
                    firstchild.addClass("mm-listitem__btn");

                });
            });
            
            $(document).on('click', '.mmenu-item', {item:click});
});

JS;

        $options = file_get_contents(Root . './render/menus/ZMMmenuWidget/assets/mmenu/optionsConfigs.js');

        $configs = strtr($options, [
            '{dividers.add}' => $this->jscode($this->_config['dividers.add']),
            '{dropdowns.drop}' => $this->jscode($this->_config['dropdowns.drop']),
            '{counters.add}' => $this->jscode($this->_config['counters.add']),
            '{counters.count}' => $this->jscode($this->_config['counters.count']),
            '{pageScroll.scroll}' => $this->jscode($this->_config['pageScroll.scroll']),
            '{navbar.title}' => $this->jscode($this->_config['navbarTitle']),
            '{content.img.width}' => $this->jscode($this->_config['content.img.width']),
            '{content}' => $this->jscode($this->_config['content']),
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
            '{item:click}' => $this->eventCode('item:click'),


        ]);

        $this->js = strtr($mainJs, [
           '{optionsConfigs}' => $configs
        ]);

        $content = '';

        /** @var array $item */
        if (!empty($this->data))
            $content .= $this->all($this->data);

        $home = Az::l('Главная страница');
        $homeItem = strtr($this->_layout['homeItem'], [
            '{url}' => '/',
            '{home}' => $home,
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{home}' => $this->_config['home'] ? $homeItem : '',
            '{content}' => $content,

        ]);

        $this->css = strtr($this->_layout['css'], [

        ]);

    }

}
