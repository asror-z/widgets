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


use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;



use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZMetisMenuWidget123 extends  ZWidget
{
    public $config = [];
    public $_config = [
        'grapes' => true,
        'main' => 'items1',
        'menu' => 'items2',
        'item' => 'items3',
        'navbarTitle' => '',
        'nameOn' => '',
        'isName' => true,
        'isAll' => true,
        'isApp' => true,
        'menu_ids' => [],
        'counters.count' => true,
        'pageScroll.scroll' => true,
        'content.img.width' => 300,
        'menu-effect-slide' => true,
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
       <div class="topbar-nav">
<ul id="{id}-menu">
    <li class="homeItem">
        <a href="#" class="has-arrow" aria-expanded="false">{home}</a>
        <ul>
            <li>
            <a href="#">{main}</a>
            </li>
            <li>
                <a href="#" class="has-arrow" aria-expanded="false">{menu}</a>
                <ul>
                    <li><a href="#">{item}</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</div>
HTML,

        'js' => <<<JS
  $(function () {
        $('#{id}-menu').metisMenu({
        });
    });
JS,

        'css' => <<<CSS
           .topbar-nav {
        background: #212529;
    }
    .topbar-nav #{id}-menu {
        padding: 0;
        margin: 0;
        list-style: none;
        background: #212529;
    }
    .topbar-nav .metismenu {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    .topbar-nav .metismenu > .homeItem {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 0%;
        flex: 1 1 0%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        position: relative;
    }

    .topbar-nav .metismenu a {
        position: relative;
        display: block;
        padding: 15px;
        color: #adb5bd;
        outline-width: 0;
        transition: all .3s ease-out;
    }


    .topbar-nav .metismenu a:hover,
    .topbar-nav .metismenu a:focus,
    .topbar-nav .metismenu a:active {
        color: #f8f9fa;
        text-decoration: none;
        background: #0b7285;
    }

    @media (min-width: 992px) {
        .topbar-nav .metismenu {
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
        }
        .topbar-nav .metismenu > li {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }
        .topbar-nav .metismenu > li > ul {
            position: absolute;
            top: 100%;
            min-width: 100%;
            z-index: 1001;
        }
        .topbar-nav.is-hoverable .metismenu > li > ul {
            height: auto !important;
        }
        .topbar-nav.is-hoverable .metismenu > li:hover > ul {
            display: block;
        }
        .topbar-nav.is-hoverable .metismenu > li:hover > a.has-arrow:after {
            -webkit-transform: rotate(-135deg);
            transform: rotate(-135deg);
        }
    }
CSS,

    ];

    public $event = [];

    public $_event = [
        /* 'openPanel:start' => 'function (event) { console.log("ZMetisMenuWidget | openPanel:start: " + panel.id) }',
         'openPanel:finish' => 'function (event) { console.log("ZMetisMenuWidget | openPanel:finish: " + panel.id) }',
         'closeAllPanels:before' => 'function (event) { console.log("ZMetisMenuWidget | closeAllPanels:before: " + panel.id) }',
         'closeAllPanels:after' => 'function (event) { console.log("ZMetisMenuWidget | closeAllPanels:after: " + panel.id) }',
         'closePanel:before' => 'function (event) { console.log("ZMetisMenuWidget | closePanel:before: " + panel.id) }',
         'closePanel:after' => 'function (event) { console.log("ZMetisMenuWidget | closePanel:after: " + panel.id) }',
         'openPanel:before' => 'function (event) { console.log("ZMetisMenuWidget | openPanel:before: " + panel.id) }',
         'openPanel:after' => 'function (event) { console.log("ZMetisMenuWidget | openPanel:after: " + panel.id) }',
         'setSelected:before' => 'function (event) { console.log("ZMetisMenuWidget | setSelected:before: " + panel.id) }',
         'setSelected:after' => 'function (event) { console.log("ZMetisMenuWidget | setSelected:after: " + panel.id) }',*/
    ];


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/metismenu@3.0.5/dist/metisMenu.min.js');
    }


    /**
     * Recursively renders the menu items (without the container tag).
     * @param MenuItem[] $items
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
                $menu .= strtr($this->_layout['main'], [
                    '{menu}' => $this->all($item->items),
                ]);
            }

            $lines[] = ZHTML::tag('li', $menu, []);
        }
        return implode("\n", $lines);
    }

    public function item($item)
    {
    }

    public function codes()
    {
        if (empty($this->_config['navbarTitle']))
            $this->_config['navbarTitle'] = Az::l('Главное меню');
        $this->data =  Az::$app->cores->menus->create($this->_config['nameOn']);


        if ($this->_config['isAll']) {
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new ALL())->run()
            );
        }


        $role = $this->userRole();
        $url = Az::$app->App->eyuf->user->getMainUrl();
        $url = ZUrl::to([$url]);






        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{home}' => Az::l('Главная страница'),
            /*'{content}' => $this->_config['content'],*/
            '{main}' => $this->_config['main'],
            '{menu}' => $this->_config['menu'],
            '{item}' => $this->_config['item'],



        ]);
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->jscode($this->id),
        ]);

        $this->css = strtr($this->_layout['css'], [
        ]);
    }

}

