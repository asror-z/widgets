<?php

/**
 *
 *
 * Author:  Anvar Jabborov
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use yii\console\ExitCode;
use yii\web\JsExpression;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZYandexTabWidget extends ZWidget
{

    public $data = [
        /*'Описание' => 'render/navigat/ZSmartTabWidget/demo/companyCard.php',
        'Характеристика' => 'render/navigat/ZSmartTabWidget/demo/companyCard.php',
        'Ещё' => 'render/navigat/ZSmartTabWidget/demo/companyCard.php',*/
    ];

    public $config = [];
    public $_config = [
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b>',

    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
     <div class="container">
   <div class="classic-tab mt-5 px-2">
    <ul class="nav d-flex text-center row justify-content-between" id="{id}" role="tablist">
      {content}
    </ul>
   </div>
</div>
HTML,

        'items' => <<<HTML
     <li class="nav-item border border-dange  px-0 col-sm">
        <a class="nav-link  waves-light text-muted w-100 {id} fp-17 show {active}" id="href-{id}" href="{src}">{description}</a>
      </li>
HTML,

        'js' => <<<JS
        $('.{id}').on('click', function() {
            $(this).addClass('active');
        });
JS,


        'css' => <<<CSS
        .active{
            border-bottom: 3px solid #2db329;
        }
CSS,

    ];

    public function asset()
    {
    }

    public function codes()
    {

        $content = '';
        $active = false;

        $pathInfo = $this->urlGetBase() . '/' . Az::$app->request->pathInfo . Az::$app->request->queryString;

        foreach ($this->data as $key => $value) {
            if ($pathInfo === $value)
                $active = true;

            $content .= strtr($this->_layout['items'], [
                '{id}' => $this->id++,
                '{description}' => $key,
                '{src}' => $value,
                '{active}' => $active ? 'active' : '',
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id++,
            '{content}' => $content,
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id++
        ]);

        $this->css = $this->_layout['css'];


    }

}
