<?php

namespace zetsoft\widgets\menus;


use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\models\menu\MenuImage;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Maftuna Kodirova
 */
class ZMetisMenuWidget3 extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'isAll' => true,
        'grapes' => true,
        'open' => true,
        'mode' => ZMetisMenuWidget3::mode['shop'],
        'name' => "All Categories",
        'col_number' => 4,
    ];


    public const mode = [
        'menu' => 'menu',
        'shop' => 'shop',

    ];

    public $menu_data = '';
    public $defaul_image = "/render/market2/ZMenuWidget/asset/images/m-cloth.png";
    public $data = [];
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/metismenu@3.0.5/dist/metisMenu.min.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
 <div class="topbar-nav">
    {name}
<ul id="menu">
{menu_data}
</ul>
</div>
HTML,
        'main_li' => <<<HTML
    <li class="menu-item">
           <i class="fas fa-{icon} mr-2 align-middle"></i>
        <a class="has-arrow" aria-expanded="false" target="{target}" href="#">{label}</a>
        <ul>
            <li><a href="#">{mega_menu_row}</a></li> 
        </ul>
    </li>
HTML,

        'mega_icon' => <<<HTML
            <i class="fa fa-angle-right"></i>
HTML,
        'mega_menu_raw' => <<<HTML
             <li>
                <a target="{target}" href="{url}">{label}</a>
                <ul>
                    <li><a href="{url}">{cols}</a></li>
                </ul>
             </li>                            
HTML,

        'css' => <<<CSS
       .topbar-nav {
        background: #212529;
    }
    .topbar-nav ul {
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
    .topbar-nav .metismenu > li {
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

        'js' => <<<JS
       $(function () {
        $('#menu').metisMenu({
                   
        });
    }); 
JS,

    ];

    public function all($items)
    {
        $col_number = $this->_config['col_number'];
        foreach ($items as $item) {
            $icon = $item->icon ?? $this->defaul_image;
            $headers = $item->items ?? [];
            $url = $item->url ?? '#';
            $target = $item->target ?? 'self';
            $label = $item->title ?? 'default label';

            $mega_icon = '';
            $mega_menu_row = '';
            $col_ = 12;
            if (!empty($headers)) {
                $mega_icon = $this->_layout['mega_icon'];
                $col_ = 12 / $col_number;

                $cols = '';

                for ($index_col = 0; $index_col < $col_number; $index_col++) {
                    $blocks = '';
                    foreach ($headers as $index_header => $header) {
                        if ($index_header % $col_number == $index_col) {
                            $leafs = '';
                            foreach ($header->items as $barg) {
                                $leafs .= strtr($this->_layout['mega_menu_raw'], [
                                    '{url}' => $barg->url,
                                    '{label}' => $barg->label,
                                    '{target}' => $barg->target,
                                ]);
                            }
                        }
                    }
                }

                $left_partners = '';
                $rights = array_filter($item->extra, function ($var) {
                    if ($var->location === MenuItem::location['right'])
                        return $var;
                });

                $bottom = array_filter($item->extra, function ($var) {
                    if ($var->location === MenuItem::location['bottom'])
                        return $var;
                });


                $mega_menu_row .= strtr($this->_layout['mega_menu_raw'], [
                    '{cols}' => $cols,
                    '{left_partners}' => $left_partners,
                ]);
            }

            $this->menu_data .= strtr($this->_layout['main_li'], [
                '{url}' => $url,
                '{target}' => $target,
                '{icon}' => $icon,
                '{label}' => $label,
                '{mega_icon}' => $mega_icon,
                '{mega_menu_row}' => $mega_menu_row
            ]);
        }
    }

    public function codes()
    {
        switch ($this->_config['mode']) {
            case 'shop':

                $this->data = Az::$app->market->category->generateDBMenuItems();
                break;

            default:

                if(!empty($this->_config['nameOn']))
                    $this->data = Az::$app->cores->menus->create($this->_config['nameOn']);
                if ($this->_config['isAll'] or empty($this->_config['nameOn'])) {
                    $this->data = ZArrayHelper::merge(
                        $this->data,
                        (new ALL())->run()
                    );
                }
        }
        $this->all($this->data);

        $this->htm = strtr($this->_layout['main'], [
            '{name}' => $this->_config['name'],
            '{menu_data}' => $this->menu_data
        ]);

        if ($this->_config['open']) {
            $this->htm = strtr($this->htm, [
                '{slider-area}' => 'slider-area',
                '{menu-widget}' => 'menu-widget'
            ]);
        } else {
            $this->htm = strtr($this->htm, [
                '{slider-area}' => 'menu-area2',
                '{menu-widget}' => 'sidemenu'
            ]);
        }

        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);
    }
}
