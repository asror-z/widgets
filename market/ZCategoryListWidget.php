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
class ZCategoryListWidget extends ZWidget
{
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '',
        'name' => Azl . 'Categorylist',
        'title' => Azl . '<b>categorylist</b>',
    ];
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'isAll' => true,
        'grapes' => true,
        'open' => true,
        'mode' => ZMenuWidget::mode['shop'],
        'name' => "All Categories",
        'col_number' => 4,
    ];

    public $colors = [
        'primary-color' => '#797979',
        'secondary-color' => '#10b410'
    ];

    public const mode = [
        'menu' => 'menu',
        'shop' => 'shop',

    ];

    public $menu_data = '';
    public $defaul_image = "/render/market2/ZMenuWidget/asset/images/m-cloth.png";
    public $default_icon = "check-circle ";
    public $data = [];
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'isAll',
            'open',
            'mode',
            'name',
            'col_number'
        ],
    ];


    public function asset()
    {
        $this->fileCss('/render/market/ZMenuWidget/asset/css/style.css');
        $this->fileCss('https://rawcdn.githack.com/IanLunn/Hover/5c9f92d2bcd6414f54b4f926fd4bb231e4ce9fd5/css/hover-min.css');
        //$this->fileJs("/render/market/ZMenuWidget/asset/js/custom.js");
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="category-list-menu my-2 text-center">
<ul class="list-inline category-list">
    <li class="nav-item hvr-grow">
        <a  data-to="{id}" class="nav-link linker" href="{url}">  
            {discount_string} 
        </a>
    </li>
    {menu_data}
</ul>
</div>
HTML,

        'main_li' => <<<HTML
            <li class="nav-item hvr-grow">
                <a href="{url}" target="{target}" class="nav-link linker"   data-to="{id}">
                 <!--   <i class="fas fa-{icon} mr-2 align-middle"></i>-->
                    {label} 
                </a>
            </li>
HTML,

        'css' => <<<CSS
       .category-list-menu{
            max-height: 36.2px;
            overflow: hidden;
         }
        .category-list li{
            display: inline-block;
         /*   border-right: 1px solid _primaryColor_;*/
        }    
        .category-list li:last-child{
            border: none!important;
        }
        .category-list li a{
            font-weight: 500;
            font-size: 1.0rem;
            text-space: 0px;              
            color: _primaryColor_!important;
            transition: 0.4s ease-in-out all;
        }
        .category-list li a:hover{
            color:_secondaryColor_!important;  
        }
        
        .rmrl-read-more, rmrl-read-less{
            margin-left: 2px!important;
        }
       
CSS,


        'js' => <<<JS
        $('.linker').on('click',function() {
            let id = $(this).attr('data-to');
            console.log(('#'+id))
            //$("body").scrollTo("#"+id);
            $("body,html").animate({
               scrollTop:$('#'+id).offset().top-80
            },500)
        })
JS,

    ];

    public function all($items)
    {
        $col_number = $this->_config['col_number'];
        foreach ($items as $item) {
            $url = $item->url ?? '#';
            $icon = $item->icon ?? $this->defaul_image;
            $target = $item->target ?? 'self';
            $label = $item->title ?? 'default label';
            $this->menu_data .= strtr($this->_layout['main_li'], [
                '{url}' => $url,
                '{target}' => $target,
                '{icon}' => $icon,
                '{label}' => $label,
            ]);
        }
    }

    public function codes()
    {
        if (empty($this->data)) {
            $item1 = new MenuItem();

            $item1->label = 'Популярные товары';
            $item1->tooltip = 'asdasd';
            $item1->name = 'asdsad';
            $item1->class = 'asdsa';
            $item1->url = '#popular';
            //           $item1->url = '/shop/user/market-index/main.aspx';
            $item1->id = 'popular';
            $item1->icon = '';

            $this->data[] = $item1;

            $item1 = new MenuItem();

            $item1->label = 'Новинки ';
            $item1->tooltip = 'asdasd';
            $item1->name = 'asdsad';
            $item1->class = 'asdsa';
            $item1->url = '#new';
            $item1->id = 'new';
            $item1->icon = '';

            $this->data[] = $item1;

            $item1 = new MenuItem();

            $item1->label = 'Все бренды';
            $item1->tooltip = 'asdasd';
            $item1->name = 'asdsad';
            $item1->class = 'asdsa';
            $item1->url = '/shop/user/brand-index/main.aspx';
            $item1->id = 2;
            $item1->icon = '';

            $this->data[] = $item1;

            $item1 = new MenuItem();

            $item1->label = Az::l('Все магазины');
            $item1->tooltip = Az::l('Все магазины');
            $item1->name = '';
            $item1->class = '';
            $item1->url = '/shop/user/market-index/index.aspx';
            $item1->id = 2;
            $item1->icon = '';

            $this->data[] = $item1;

            $item1 = new MenuItem();

            $item1->label = 'Все категории';
            $item1->tooltip = 'asdasd';
            $item1->name = '';
            $item1->class = '';
            $item1->url = '/shop/user/category-index/main.aspx';
            $item1->id = 2;
            $item1->icon = '';

            $this->data[] = $item1;
        }


        switch ($this->_config['mode']) {
            case 'shop':
                //$this->data = Az::$app->market->category->generateDBMenuItems();
                $new_data = [];
                foreach ($this->data as $key => $a) {
                    $new_data[] = $a;
                    if ($key > 3)
                        break;
                }
                $this->data = $new_data;
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

        $col_number = $this->_config['col_number'];

        $code = '';
        foreach ($this->data as $item) {
            $code .= strtr($this->_layout['main_li'], [
                '{url}' => $item->url ?? '#',
                '{target}' => $item->target ?? 'self',
                '{icon}' => $item->icon !== '' ? $item->icon : $this->default_icon,
                '{label}' => $item->title ?? 'default label',
                '{id}' => $item->id
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{name}' => $this->_config['name'],
            '{menu_data}' => $code,
            '{discount_string}' => Az::l('Скидки'),
            '{id}' => 'sale',
            '{url}' => '#sale',
        ]);

        $this->css = strtr($this->_layout['css'], [
            '_primaryColor_' => $this->colors['primary-color'],
            '_secondaryColor_' => $this->colors['secondary-color'],
        ]);

        $this->js = $this->_layout['js'];
    }
}
