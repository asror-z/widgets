<?php

/**
 *
 *
 * @author MurodovMirbosit
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZBreadcrumbsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => ZBreadcrumbsWidget::type['right'],
        'mode' => ZBreadcrumbsWidget::mode['category'],
        'category_id' => '',
        'begin' => false,
        'company_id' => null,
        'mainUrl' => '/shop/user/filter-common/main',
        'nameOn' => [
            'admin',
            'bozor',
            'moder',
            'needer',
            'user',
        ],
        'bg-class' => ''
    ];

    public const type = [
        'right' => 'right',
        'left' => 'left',
    ];

    public const mode = [
        'category' => 'category',
        'page' => 'page',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b>',
    ];

    public function asset()
    {
        /*CSS FILE*/
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-asBreadcrumbs@0.2.3/dist/css/asBreadcrumbs.css');

        /*JS FILE*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-asBreadcrumbs@0.2.3/dist/jquery-asBreadcrumbs.min.js');
        $this->fileJs('/render/navigat/ZBreadCrumbWidget/assets/toc.js');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

        <div class="example w-100">
          <ol class="breadcrumb breadcrumb-right bg-light {bg-class}" data-overflow="{type}">
                    {content}
          </ol>
        </div>
  
HTML,

        'items' => <<<HTML
     <li class="{class} BreadcrumbLi">
       <a href="{url}" class="linkBread text-dark {linkClass}" target="{target}">&nbsp{text}&nbsp</a>
     </li>
HTML,

        'css' => <<<CSS
            .caret:before {
                    content: '▼';
                }
            .linkBread:after {
                content: '/';
            }
            
            .BreadcrumbLi a:hover {
                text-decoration: none;  
            }
CSS,

        'js' => <<<JS
        $(document).ready(function() {
            $('.breadcrumb').asBreadcrumbs({
                namespace: 'breadcrumb',
            });
        });
JS,
    ];

    public function rekursiv($menuItem, $items = '')
    {
        $url = ZUrl::to([
            $this->_config['mainUrl'],
            'id' => $menuItem->id,
        ]);
        
        if ($this->_config['company_id'] !== null)
            $url = ZUrl::to([
                $this->_config['mainUrl'],
                'category_id' => $menuItem->id,
                'market_id' => $this->_config['company_id']
            ]);
            
        if (!empty($menuItem->name)) {
            $items .= strtr($this->_layout['items'], [
                '{url}' => $url,
                //'{linkClass}' => $class,
                '{class}' => $menuItem->class,
                '{target}' => $menuItem->target,
                '{text}' => $menuItem->name,
                //icon,tooltip qilinmagan xali
                '{icon}' => $menuItem->icon,
                //'{tooltip}' => $item->tooltip,
            ]);
        }

        if (\Dash\count($menuItem->items) != 0) {
            return $this->rekursiv($menuItem->items[0], $items);
        } else {
            return $items;
        }
    }

    public function all($menuItem)
    {
        /** @var MenuItem $item */
        if (is_array($menuItem))
            $menuItem = $menuItem[0];

        return $this->rekursiv($menuItem);
    }

    public function init()
    {
        parent::init();
        if ($this->_config['begin'])
            ob_start();
    }

    public function codes()
    {
        //CoreMenu
        $category_id = $this->_config['category_id'];

        $mode = $this->_config['mode'];
        if ($mode == ZBreadcrumbsWidget::mode['category'])
            $this->data = Az::$app->market->category->getMenuItem($category_id, false);
        else
            $this->data = Az::$app->cores->menus->create($this->_config['nameOn']);

        $content = '';
        if (!empty($this->data)) {
            $content = $this->all($this->data);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $this->_config['begin'] ? ob_get_clean() : $content,
            '{type}' => $this->_config['type'],
            '{url}' => '>',
            '{bg-class}' => $this->_config['bg-class']
        ]);


        $this->js = strtr($this->_layout['js'], [
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }
}
