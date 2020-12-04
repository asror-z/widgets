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
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZMetisMenuWidget
 * https://cdnjs.com/libraries/metisMenu //cdn assets
 * https://github.com/onokumus/metismenu //GitHub
 * Created By: MurodovMirbosit, Ravshan Davlatov, Yosin Obidov
 */
class ZMetisMenuWidgetA extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZMetisMenuWidget::type['Menu'],
        'bgcolor' => '',
        'nameOn' => [ ],
        'mode' => ZMetisMenuWidget::mode['shop'],
        'name' => "All Categories",
        'theme' => ZMetisMenuWidget::theme['bozorboy'],
        'MenuOpen' => false,
        //'isAll' => true,
        //'grapes' => true,
        //'open' => true,
        //'col_number' => 4,
    ];

    public const theme = [
        'bozorboy' => 'bozorboy',
        'bozor2' => 'bozor2',
        'grey' => 'grey',
        'originalBlack' => 'originalBlack',
        'verticaly' => 'verticaly',
    ];

    public const type = [
      'Category' => 'Category',
      'Menu' => 'Menu',

    ];

    public const mode = [
        'menu' => 'menu',
        'shop' => 'shop',
    ];

    public const bgcolor = [
        'green' => 'green',
        'blue' => 'blue',
    ];

    /**
     *
     * Plugin Events
     */
    public $event = [];
    public $_event = [

    ];


    public function asset()
    {
        $theme = $this->_config['theme'];

        $this->fileCss("/render/menus/ZMetisMenuWidget/assets/$theme.css");
       if ($this->_config['MenuOpen'])
       {
           $this->fileCss('https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css');
       }
        $this->fileJs('https://cdn.jsdelivr.net/npm/metismenu@3.0.5/dist/metisMenu.min.js');
    }



    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
          <div class="topbar-nav">
             <ul id="metismenu" class="metismenu verticalmenu">
               {items}
             </ul>
          </div>
HTML,

        'items' => <<<HTML
           <li class="homeItem border ">
              <a href="{url}" target="{target}" class="childrenM {linkClass}" aria-expanded="false">
                  {text}
              </a>
              {children}
           </li>
HTML,

        'children' => <<<HTML
           <ul class="children-item">
             {items}
           </ul>
HTML,

        'js' => <<<JS
       $(function () {
        $('#metismenu').metisMenu({         
        });
    });
         
JS,

    ];


    public function all($data)
    {


        /** @var MenuItem $item */

        $items = '';
        foreach ($data as $item) {

           /* if ($item->visible)
                continue;*/

            $class = '';
            $url = $item->url;
            $children = '';

            if (!empty($item->items)) {

                $url = "#";

                $class = 'has-arrow';
                $children = strtr($this->_layout['children'], [
                    '{items}' => $this->all($item->items)
                ]);

            }

            $items .= strtr($this->_layout['items'], [
                '{url}' => $url,
                '{linkClass}' => $class,
                '{class}' => $item->class,
                '{target}' => $item->target,
                '{text}' => $item->title,
                '{children}' => $children,

                //icon,tooltip qilinmagan xali
                '{icon}' => $item->icon,
                '{tooltip}' => $item->tooltip,
            ]);


        }

        return $items;

    }

    public function codes()
    {
        //CoreMenu

            if ($this->_config['type'] === 'Category')
            {

                $items = [];

                $item = new MenuItem();
                $item->title = 'Menu 1';
                $items[] = $item;

                $item = new MenuItem();
                $item->title = 'Menu 1';
                $items[] = $item;

                $item = new MenuItem();
                $item->title = 'Menu 1';
                $items[] = $item;

                $item = new MenuItem();
                $item->title = 'Menu 1';
                $items[] = $item;

                $item = new MenuItem();
                $item->title = 'Menu 1';
                $items[] = $item;

                $item = new MenuItem();
                $item->title = 'Menu 1';
                $items[] = $item;

                $this->data = $items;
            }

            if ($this->_config['type'] === 'Menu')
            {
                $this->data = Az::$app->cores->menus->create($this->_config['nameOn']);
            }

        $content = '';
        if (!empty($this->data))
            $content = $this->all($this->data);

        $this->htm = strtr($this->_layout['main'], [
            '{items}' => $content,
            '{bgcolor}' => $this->_config['bgcolor'],
        ]);

        $this->js = strtr($this->_layout['js'],[]);

    }
}

