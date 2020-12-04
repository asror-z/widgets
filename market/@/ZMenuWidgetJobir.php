<?php

namespace zetsoft\widgets\market;


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
class ZMenuWidgetJobir extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'isAll' => true,
        'grapes' => true,
        'open' => false,
        'mode' => ZMenuWidget::mode['shop'],
        'name' => "все категории",
        'col_number' => 4,
        'icon' => 'check-circle',
        'class_position' => '',
        'menu-widget' => 'menu-widget',
        'text' => 'text-center',
        'count' => 5
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
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
        $this->fileCss('/render/market/ZMenuWidget/asset/css/style2.css');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

            <section class="{slider-area}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 {class_position}">
                            <div class="{menu-widget}">
                                <p class="bg-white border p-2 text-success"><i class="fas fa-bars"></i>{name}</p>
                                <ul class="list-unstyled gt-menu">
                                   {menu_data}
                                </ul>
                            </div>
                        </div>
                    </div>
            </section>

HTML,
        'main_li' => <<<HTML
           
            <li class="menu-item items-menu border-0 d-flex">
             
            <div class="p-1 text-center text-muted" style="width: 50px"><i class="fas fa-{icon}"></i></div>
                <a target="{target}" class="text-dark text-decoration-none border-0" href="{url}">
                    
                    {label} 
                </a>
                {mega_menu_row}
            </li>
HTML,


        'mega_icon' => <<<HTML
            <i class="fa fa-angle-right"></i>
HTML,
        'mega_menu_raw' => <<<HTML
            <div class="mega-menu">
                <div class="row">
                    <div class="{coll} m-0 pr-0">
                        <div class="row">
                            {cols}
                        </div>
                        <div class="row mt-4 mr-2 d-flex justify-content-beetwen">
                            {bottom_partners}
                        </div>
                    </div>
                    <div class="{colr}">
                        <div class="row justify-content-beetwen">
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
            <a target="{target}" href="{url}">{label}</a>
HTML,
        'left_partners' => <<<HTML
            <div class="col-lg-5 mb-2 ml-1 p-0 border {text} menu-image-container">
                <a target="{target}" href='{url}' class="w-75 h-100 ml-auto mr-auto">
                    <img class='img-fluid image-size' src="{image}">
                </a>
            </div>
HTML,
        'bottom_partners' => <<<HTML
            <div class="col-lg-2 ml-2 d-flex menu-image-container--bottom text-center border p-0">
                <a  target="{target}"  class="w-100 h-100" href='{url}'>
                
                    <img class='img-fluid image-size-bottom ' src="{image}">
                   <p>{label}</p> 
                </a>
            </div>
HTML,
        'js' => <<<JS
      /*$('.mega-menu .row').slimscroll({
            railVisible: true,
            allowPageScroll: true,
            touchScrollStep: 1000,
            height: '500',
            width: '910'
        });*/  
JS,


    ];

    public function all($items)
    {
        $col_number = $this->_config['col_number'];
        $default_icon = $this->_config['icon'];


        foreach ($items as $item) {
            $icon = $this->_config['icon'];
            $label_maladoy = 'catalog';

            if (!empty($item->icon))
                $icon = $item->icon;

            if (!empty($item->title))
                $label_maladoy = $item->title;


            $headers = $item->items ?? [];
            $url = $item->url ?? '#';
            $target = $item->target ?? 'self';
            $label = $label_maladoy;

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
                            foreach ($header->items as $key => $barg) {
                                if ($key === $this->_config['count']) {
                                    $leafs .= strtr($this->_layout['leaf'], [
                                        '{url}' => $header->url,
                                        '{label}' => Az::l('еще..'),
                                        '{target}' => '_blank',
                                    ]);
                                    break;
                                }
                                $leafs .= strtr($this->_layout['leaf'], [
                                    '{url}' => $barg->url,
                                    '{label}' => $barg->label,
                                    '{target}' => $barg->target,
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
                $rights = array_filter($item->extra, function ($var) {
                    if ($var->location === MenuItem::location['right'])
                        return $var;
                });

                foreach ($rights as $extra) {
                    $left_partners .= strtr($this->_layout['left_partners'], [
                        '{url}' => $extra->url,
                        '{target}' => $extra->target,
                        '{image}' => $extra->image,
                        '{text}' => $this->_config['text']
                    ]);
                }

                $bottom_partners = '';
                $bottom = array_filter($item->extra, function ($var) {
                    if ($var->location == MenuItem::location['bottom'])
                        return $var;
                });

                foreach ($bottom as $extra) {
                    $bottom_partners .= strtr($this->_layout['bottom_partners'], [
                        '{url}' => $extra->url,
                        '{target}' => $extra->target,
                        '{image}' => $extra->image,
                        '{label}' => $extra->tooltip
                    ]);
                }

                $coll = 'col col-md-9';
                $colr = 'col col-md-3';

                if ($left_partners == '') {
                    $coll = 'col col-md-12';
                    $colr = 'd-none';
                }


                $mega_menu_row .= strtr($this->_layout['mega_menu_raw'], [
                    '{cols}' => $cols,
                    '{bottom_partners}' => $bottom_partners,
                    '{left_partners}' => $left_partners,
                    '{coll}' => $coll,
                    '{colr}' => $colr
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
              
                //$this->data = $this->cacheRedis('menu', fn() => Az::$app->market->category->generateDBMenuItems());
                //   $this->data = Az::$app->market->category->generateDBMenuItems();
                break;                          

            default:

                if (!empty($this->_config['nameOn']))
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
            '{menu_data}' => $this->menu_data,
            '{class_position}' => $this->_config['class_position'],
        ]);

        $this->js = $this->_layout['js'];

        if ($this->_config['open']) {
            $this->htm = strtr($this->htm, [
                '{slider-area}' => 'slider-area',
                '{menu-widget}' => $this->_config['menu-widget']
            ]);
        } else {
            $this->htm = strtr($this->htm, [
                '{slider-area}' => 'menu-area2',
                '{menu-widget}' => 'sidemenu'
            ]);
        }


    }
}
