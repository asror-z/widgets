<?php
namespace zetsoft\widgets\market\AUWs;


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
class ZMenuWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'isAll' => true,
        'grapes' => true,
        'open' => true,
        'name' => "All Categories",
        'col_number' => 4,
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
        $this->fileCss("https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900");
        $this->fileCss("/render/market/ZMenuWidget/asset/css/material.css");
        $this->fileJs("/render/market/ZMenuWidget/asset/js/custom.js");
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

<section class="{slider-area}">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3 d-none d-md-block">
                <div class="{menu-widget}">
                    <p><i class="fa fa-bars"></i>{name}</p>
                    <ul class="list-unstyled gt-menu">
                       {menu_data}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

HTML,
        'main_li' => <<<HTML
            <li><a href="{url}"><img src="{icon}" alt="">{label}{mega_icon}</a>
                {mega_menu_row}
            </li>
HTML,

        'mega_icon' => <<<HTML
            <i class="fa fa-angle-right"></i>
HTML,
        'mega_menu_raw' => <<<HTML
            <div class="mega-menu">
                <div class="row">
                    <div class="col-md-9 m-0 pr-0">
                        <div class="row">
                            {cols}
                        </div>
                        <div class="row mt-4">
                            {bottom_partners}
                        </div>
                    </div>
                    <div class="col-md-3 m-0 p-0">
                        <div class="row m-0 p-0">
                            {left_partners}
                        </div>
                    </div>
                </div>
            </div>                             
HTML,
        'col' => <<<HTML
            <div class="col-md-{col_}">
                {blocks}
            </div>
HTML,
        'block' => <<<HTML
            <div class="smartphone">
                <h6>{block_head}</h6>
                {leafs}
            </div>
HTML,
        'leaf' => <<<HTML
            <a href="{url}">{label}</a>
HTML,
        'left_partners' => <<<HTML
            <div class="col-md-6 m-0 p-0 pl-1">
                <a class='p-0 m-0' href='{url}'><img class='card-img-top pb-1' src="{image}"></a>
            </div>
HTML,
        'bottom_partners' => <<<HTML
            <div class="col-4">
                <a class='p-0 m-0' href='{url}'><img class='card-img-top pb-1' src="{image}"></a>
            </div>
HTML,

        'css' => <<<CSS
    
CSS,

        'js' => <<<JS
       
JS,

    ];

    public function all($items)
    {
        $col_number = $this->_config['col_number'];
        foreach ($items as $item) {
            $icon = $item->icon ?? $this->defaul_image;
            $headers = $item->items ?? [];
            $url = $item->url ?? "#";
            $label = $item->title ?? 'default label';

            $mega_icon = '';
            $mega_menu_row = '';
            $col_ = 12;
            if (!empty($headers))
            {
                $mega_icon = $this->_layout['mega_icon'];
                $col_ = 12/$col_number;

                $cols = '';

                for ($index_col = 0; $index_col < $col_number; $index_col++) {
                    $blocks = '';
                    foreach ($headers as $index_header => $header) {
                        if($index_header % $col_number == $index_col)
                        {
                            $leafs = '';
                            foreach ($header->items as $barg) {
                                $leafs .= strtr($this->_layout['leaf'], [
                                    '{url}' => $barg->url,
                                    '{label}' => $barg->label
                                ]);
                            }

                            $blocks .= strtr($this->_layout['block'], [
                                '{block_head}' => $header->title,
                                '{leafs}' => $leafs
                            ]);
                        }
                    }
                    $cols .= strtr($this->_layout['col'], [
                        '{col_}' => $col_,
                        '{blocks}' => $blocks
                    ]);
                }

                $left_partners = '';
                $rights = array_filter($item->extra, function($var){
                    if($var->location == MenuItem::location['right'])
                        return $var;
                });
                foreach ($rights as $extra)
                {
                    $left_partners .= strtr($this->_layout['left_partners'], [
                        '{url}' => $extra->url,
                        '{image}' => $extra->image
                    ]);
                }

                $bottom_partners = '';
                $bottom = array_filter($item->extra, function($var){
                    if($var->location == MenuItem::location['bottom'])
                        return $var;
                });
                foreach ($bottom as $extra)
                {
                    $bottom_partners .= strtr($this->_layout['bottom_partners'], [
                        '{url}' => $extra->url,
                        '{image}' => $extra->image
                    ]);
                }

                $mega_menu_row .= strtr($this->_layout['mega_menu_raw'], [
                    '{cols}' => $cols,
                    '{bottom_partners}' => $bottom_partners,
                    '{left_partners}' => $left_partners
                ]);
            }

            $this->menu_data .= strtr($this->_layout['main_li'], [
                '{url}' => $url,
                '{icon}' => $icon,
                '{label}' => $label,
                '{mega_icon}' => $mega_icon,
                '{mega_menu_row}' => $mega_menu_row
            ]);
        }
    }

    public function codes()
    {
        $this->data =  Az::$app->cores->menus->create($this->_config['nameOn']);

        if ($this->_config['isAll']) {
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new ALL())->run()
            );
        }

        $this->all($this->data);

        $this->htm = strtr($this->_layout['main'], [
            '{name}' => $this->_config['name'],
            '{menu_data}' => $this->menu_data
        ]);

        if($this->_config['open']){
            $this->htm = strtr($this->htm, [
                '{slider-area}' => 'slider-area',
                '{menu-widget}' => 'menu-widget'
            ]);
        }else{
            $this->htm = strtr($this->htm, [
                '{slider-area}' => 'menu-area2',
                '{menu-widget}' => 'sidemenu'
            ]);
        }

        $this->css = strtr($this->_layout['css'], [

        ]);
//
//        $this->js = strtr($this->_layout['js'], [
//
//        ]);

    }

}
