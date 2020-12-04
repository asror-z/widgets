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
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;

class ZSidebarMenuWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'isAll' => true,
        'grapes' => true,
        'open' => true,
        'nameOn' => '',
        'mode' => ZSidebarMenuWidget::mode['menu'],
        'name' => "All Categories",
        'col_number' => 4,
        'position'=>'top'
    ];
    public const mode = [
        'menu' => 'menu',
        'shop' => 'shop',

    ];
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   <ul class="menu-left">
       {li}
    </ul>
   
     
HTML,

        'li' => <<<HTML
        <li>
          <div class="tooltip-menu">  {sub}
            <a class="hint--left hint--rounded hint--bounce" aria-label={label} href="{url}">
              <span class="fas {icon}"></span>
            </a>
          </div>
        </li>
         
HTML,
        'sub' => <<<HTML
  <ul class="tooltiptext" style="grid-template-columns: {grid};">
               {sub_li}
            </ul>
HTML,
        'sub_li' => <<<HTML
        <li class="tooltip-menu-link-container">
                    <a href="{url}" class="tooltip-menu-link">
                        <i class="fas {icon} clone"></i><span class="tooltip-menu-link-title">{label}</span>
                    </a>
                </li>
HTML,

    ];

    public $menu_data = '';
    public $defaul_image = "/render/market2/ZMenuWidget/asset/images/m-cloth.png";

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.6.0/hint.min.css');
        $this->fileCss('/render/menus/ZSidebarMenuWidget/assets/main.css');
        $this->fileJs('/render/menus/ZSidebarMenuWidget/assets/main.js');

    }

    public function all($items)
    {
        $col_number = $this->_config['col_number'];
        foreach ($items as $item) {
            $icon = $item->icon ?? 'fa-database';
            $url = $item->url ?? '#';
            $label = $item->title ?? 'default label';

            $sub = "";
            if (!empty($item->items)) {
                        $c=count($item->items);

                foreach ($item->items as $s) {
                    $sub .= strtr($this->_layout['sub_li'], [
                        '{url}' => $s->url ?? '#',
                        '{icon}' => $s->icon ?? '',
                        '{label}' => $s->label ?? 'default',
                    ]);
                }

                      if($c/4==0 || $c<4 )$c=1; else $c=$c/4;
                $sub = strtr($this->_layout['sub'], [
                    '{sub_li}' => $sub ?? '',
                    '{grid}'=>str_repeat("auto", $c)
                ]);
            }
            $this->menu_data .= strtr($this->_layout['li'], [
                '{url}' => $url,
                '{sub}' => $sub,
                '{icon}' => $icon,
                '{label}' => $label,

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
            '{li}' => $this->menu_data
        ]);


    }
}
