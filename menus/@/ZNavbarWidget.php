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


use zetsoft\service\menu\ALL;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;

class ZNavbarWidget extends ZALLWidget
{
    public $config = [];
    public $_config = [
        'isAll' => true,
        'isApp' => true,
        'grapes' => true,
    ];

    public function _all()
    {
        foreach ($this->data as $item) {

            $url = ZUrl::to($item['url']);
            $link = strtr($this->layout['linkTemplate'], [
                '{url}' => $url,
                '{label}' => '<i class="' . $item['linkOptions']['icon'] . '"></i>' . Nbsp . Nbsp . $item['label'],
                '{dropdown}' => !empty($item['items']) ? $this->layout['dropdown'] : null,
                '{class}' => !empty($item['items']) ? $this->layout['class'] : null,
            ]);

            $element = strtr($this->layout['itemTemplate'], [
                '{link}' => $link,
                '{class}' => !empty($item['items']) ? $this->layout['class'] : null,
            ]);

            $childs = '';

            if (!empty($item['items'])) {
                $childs = strtr($this->layout['subMenuTemplate'], [
                    '{items}' => $this->childs($item['items']),
                ]);
            }

            $element = strtr($element, [
                '{dropdown}' => $childs
            ]);

//            if (isset($item['linkOptions']) && isset($item['linkOptions']['class'])) {
//                $liClasses[] = $item['linkOptions']['class'];
//            }

            $this->htm .= $element;

        }
    }


    public function childs($items)
    {

        $childs = [];

        foreach ($items as $item) {
            $url = ZUrl::to($item['url']);
            $childs[] = strtr($this->layout['dropdownItemTemplate'], [
                '{label}' => '<i class="' . $item['linkOptions']['icon'] . '"></i>' . Nbsp . Nbsp . $item['label'],
                '{url}' => $url,
                '{dropdown}' => !empty($item['items']) ? $this->layout['class'] : null,
                '{class}' => !empty($item['items']) ? $this->layout['dropdown'] : ' dropdown-item',
            ]);
            if (!empty($item['items'])) {
                $childs[] = strtr($this->layout['subMenuTemplate'], [
                    '{items}' => $this->childs($item['items']),
                ]);
            }
        }

        return implode("\n", $childs);
    }

    public function codes()
    {


        $this->layout = [
            'linkTemplate' => <<<HTML
                <a class="nav-link {class}" href="{url}" {dropdown}> {label}</a>
HTML,

            'linkTemplateBlank' => <<<HTML
                  <a {url} target="_blank">{icon} &nbsp;&nbsp; {label}</a>
HTML,

            'linkTemplateItem' => <<<HTML
                  <a class="nav-link  {class}" {url}>{icon}&nbsp;&nbsp; {label} </a>
HTML,
            'subMenuTemplate' => <<<HTML
                 <div class='dropdown-menu' aria-labelledby="navbarDropdown">{items}</div>
HTML,
            'defaultIcon' => <<<HTML
                 <i class="{icon}"></i>
HTML,


            'dropdownItemTemplate' => <<<HTML
                <a class="{class}" href="{url}" {dropdown}>{label}</a>
HTML,
            'linkTemplate2' => <<<HTML
<a class="nav-link dropdown-toggle" href="{url}" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"><i class="fa fa-credit-card"></i> {label}</a>
HTML,
            'itemTemplate' => <<<HTML
                <li class="nav-item dropdown">
                    {link}{dropdown}
                </li>
HTML,
            'itemTemplateCurrent' => <<<HTML
                <span class="sr-only">(current)</span>
HTML,

            'dropdown' => <<<HTML
aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
HTML,

            'class' => <<<HTML
dropdown-toggle
HTML,

        ];
        $this->itemOptions['class'] = 'nav-item';

        $menu = current(Az::$app->cores->menus->create($this->id));
        $this->data = $menu['items'] ?? [];

        $this->_all();


        $this->css = <<<CSS
            .popBtn{
                background: none!important;
            }
            .vd_mega-menu-content{
                margin-top: 7px;
            }
            .child-menu > .title{
                background: #347bf0!important;
            }
                
CSS;

    }
}

