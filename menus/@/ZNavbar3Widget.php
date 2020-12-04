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


use PHPUnit\Util\Log\JSON;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use zetsoft\models\menu\Menu;
use zetsoft\service\menu\ALL;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZNavbar3Widget extends ZWidget
{

    public $config = [];
    public $_config = [
        'isAll' => true,
        'isApp' => true,
    ];

    public $layout = [];
    public $_layout = [


        'linkTemplate' => <<<HTML
                <a class="nav-link {class}" href="{url}" {dropdown}> {label}</a>
HTML,

        'linkTemplateBlank' => <<<HTML
                  <a {url} target="_blank">{icon} &nbsp;&nbsp; {label}</a>
HTML,

        'linkTemplateItem' => <<<HTML
                  <a class="nav-link {class}" {url}>{icon}&nbsp;&nbsp; {label} </a>
HTML,
        'subMenuTemplate' => <<<HTML
                 <div class='dropdown-menu' aria-labelledby="navbarDropdown">{items}</div>
HTML,
        'defaultIcon' => <<<HTML
                 <i class="{icon}"></i>
HTML,


        'dropdownItemTemplate' => <<<HTML
                <a class="{class}" href="{url}" {dropdown}> {label}</a>
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

'css' => <<<CSS
            .popBtn{
                background: none!important;
            }
            .vd_mega-menu-content{
                margin-top: 7px;
            }
            .child-menu > .title{
                background: #347bf0!important;
            }
                
CSS,




    ];


    public function layout()
    {

        $this->itemOptions['class'] = 'nav-item';
    }



    public function active($item)
    {

        if ($boot->isCLI())
            return false;

        if (ArrayHelper::keyExists('url', $item)) {
            if (is_array($item['url'])) {
                return Az::$app->utility->urlApp->isActive($item['url']);
            }

            return $item['url'] === Az::$app->request->url;
        }

        return false;
    }

    public function normalize($items, &$active)
    {

        foreach ($items as $i => $item) {

            if (!empty($item['label']))
                $items[$i]['label'] = $item['label'];


            $encodeLabel = $this->encodeLabels;

            if ($encodeLabel)
                $items[$i]['label'] = Html::encode($item['label']);
            else
                $items[$i]['label'] = $item['label'];


            /*
             *
             * GENERATE ICONS
             */
            $randomIcon = Az::$app->utility->mains->icon();

            $items[$i]['linkOptions']['icon'] = ZArrayHelper::getValue($items[$i]['linkOptions'], $items[$i]['linkOptions']['icon'], $randomIcon);


            $hasActiveChild = false;

            if (!empty($item['items']))
                $items[$i]['items'] = $this->normalize($item['items'], $hasActiveChild);


            if ($hasActiveChild || $this->active($item))
                $active = $items[$i]['active'] = true;
            else
                $items[$i]['active'] = false;

        }

        return array_values($items);
    }


    public function menu($options)
    {
        $data = $this->normalize($options, $hasActiveChild);

        if (!empty($data)) {

            return $this->all($data);
        }
    }

    public function title($title)
    {

        return <<<HTML
         	<li class="Divider">{$title}</li>
HTML;
    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    public function all($items)
    {

        $lines = [];

        foreach ($items as $i => $item) {

            $options = ArrayHelper::merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];

            if (!empty($item['linkOptions']) && !empty($item['linkOptions']['class'])) {
                $class[] = $item['linkOptions']['class'];
            }

            if (!empty($class)) {
                if (empty($options['class']))
                    $options['class'] = implode(' ', $class);
                else
                    $options['class'] .= ' ' . implode(' ', $class);

            }


//            if (isset($item['linkOptions']) && isset($item['linkOptions']['class'])) {
//                $liClasses[] = $item['linkOptions']['class'];
//            }

            $menu = $this->item($item);

            if (!empty($item['items'])) {

                $menu .= strtr($this->_layout['subMenuTemplate'], [
                    '{show}' => !empty($item['active']) ? "style='display: block'" : '',
                    '{items}' => $this->all($item['items']),
                ]);
            }

            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }


    public function item($item)
    {

        $data_id = \uniqid('', true);

        if (!empty($item['items'])) {
            $linkTemplate = $this->_layout['linkTemplateItem'];

        } else {

            //$labelTemplate = $this->layout['linkTemplateItem'];
            if (!empty($item['target']))
                $linkTemplate = $this->_layout['linkTemplateBlank'];
            else
                $linkTemplate = $this->_layout['linkTemplate'];
        }

        $icon = strtr($this->_layout['defaultIcon'], [
            '{icon}' => $item['linkOptions']['icon']
        ]);


        if (!$boot->isCLI())
            $url = Url::to($item['url']);
        else
            $url = $item['url'];

        $replace = [
            '{data-id}' => 'data-id="' . $data_id . '"',
            '{url}' => $url,
            '{label}' => $item['label'],
            '{icon}' => $icon
        ];

        return strtr($linkTemplate, $replace);
    }



    public function process()
    {
        parent::process();

        $AppName = 'zetsoft\service\menu\\' . ucfirst(App);

        $this->data = Az::$app->cores->menus->create(1);

        if ($this->_config['isAll'])
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new ALL())->run()
            );

        if ($this->_config['isApp'])
            $this->data = ZArrayHelper::merge(
                $this->data,
                (new $AppName())->run()
            );


    }

    public function codes()
    {
        //$this->_all();


        /** @var array $item */
        if (!empty($this->data))
            foreach ($this->data as $item) {
                if (!empty($item['title']))
                    $this->htm .= $action->title = Azl . $item['title'];

                $this->htm .= Az::$app->menu($item['items']);

            }

      $this->css = strtr($this->_layout['css'],[]);
    }
}

