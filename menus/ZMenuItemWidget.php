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
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;

class ZMenuItemWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'menuItem' => '',
        'market_id'=>133
    ];

    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
     <div class="menu-container">
     {content}
    </div>
HTML,


        'list' => <<<HTML
        <ul class="ml-3 list-unstyled menulist ullist">
             {cont}
        </ul>
HTML,
        'li' => <<<HTML
            <li class="mode">
            <a class="{className}" style="color: #000" href="{url}">{name}</a>
                {main}
            </li>
            
              
HTML,


        'css' => <<<CSS
           
CSS,

    ];

    public function asset()
    {
        $this->fileCss('/render/menus/MenuItemWidget/asset/main.css');
    }

    /**
     *
     * Function  getContent
     * @param MenuItem $bobo
     */
    public function getContent($bobo)
    {
        if (empty($bobo))
            return false;
        $cont = $this->rekursiv($bobo);
        $li_code = strtr($this->_layout['li'], [
            '{name}' => $bobo->name,
            '{main}' => $cont,
            '{url}' => ZUrl::to([
                '/shop/user/filter-catalog/main',
                'catgory_id' => $bobo->id,
                'market_id'=>133]),
        ]);

        $result = strtr($this->_layout['list'], [
            '{cont}' => $li_code
        ]);

        return $li_code;
    }

    public function rekursiv($bobo)
    {
        $cont = '';
        if (empty($bobo))
            return false;
        foreach ($bobo->items as $obb) {
            $cont .= strtr($this->_layout['li'], [
                '{name}' => $obb->name,
                '{url}' => ZUrl::to([
                    '/shop/user/filter-catalog/main',
                    'category_id' => $obb->id,
                    'market_id'=>$this->_config['market_id']
                ]),
                '{className}' => $obb->class,
                '{main}' => strtr($this->_layout['list'], [
                    '{cont}' => $this->rekursiv($obb)
                ])
            ]);
        }

        $cont = strtr($this->_layout['list'], [
            '{cont}' => $cont,

        ]);

        return $cont;
    }

    public function codes()
    {
        //vdd($this->_config['menuItem']);
        if (is_array($this->_config['menuItem'])) {
            $a = new MenuItem();
            $a->items = $this->_config['menuItem'];

            $cont = $this->rekursiv($a);
        } else {
            $cont = $this->getContent($this->_config['menuItem']);
        }
         
        $menu = strtr($this->_layout['list'], [
            '{cont}' => $cont,
        ]);
        
        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $menu
        ]);
         //vdd($menu);
        $this->css = $this->_layout['css'];
    }
}
