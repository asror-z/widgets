<?php

namespace zetsoft\widgets\navigat;

use zetsoft\models\news\News;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;


/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: AzimjonToirov
 * 
 */
class ZNewsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
         'src' => 'https://files.glotr.uz/pages/000/000/005/000/000/112/2020-04-15-12-00-02-812757-98ebf74b7b4f3d7ab5ee6c3d889dbf20.jpg?_=ozafp',
         'title' => 'Три по цене одного!',
         'text' => 'Уважаемы партнеры! Администрация торгового центра GLOTR.UZ выражает ...',
         'date' => '15.04.2020',
         'more' => 'Подробно',
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZNewsCardWidget/image/icon.png',
        'name' => Azl . 'NewsCard',
        'title' => Azl . '<b>safasfsa</b>',

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
     <div class="row">
    <div class="col-md-4">
        <div class="d-flex p-2">
            <div class="image-card d-flex p-2">
                <img src="{src}">
            </div>
            <div class="ml-1">
                <div>
                    <h5 class="fp-30">{title}</h5>
                    <h6 class="fp-20 mt-0 content">{text}</h6>
                </div>
                <div class="icon">
                    <a>
                        <i class="fa fa-clock fp-20"></i>
                        <span class="text-primary">{date}</span>
                        <span class="text-primary ml-2">{more}</span>
                        <i class="fa fa-chevron-right text-primary fp-10"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
HTML,

        /*'js' => <<<JS
          (function() {
        function logElementEvent(eventName, element) {
            console.log(
                Date.now(),
                eventName,
                element.getAttribute("src")
            );
        }
        });
JS,*/

    ];

    public function asset()
    {
    }


    public function codes()
    {
    
      /* $this->js = strtr($this->_layout['js'],[]);*/

        $this->htm = strtr($this->_layout['main'], [
            '{src}' => $this->_config['src'],
            '{title}' => $this->_config['title'],
            '{text}' => $this->_config['text'],
            '{date}' => $this->_config['date'],
            '{more}' => $this->_config['more'],
        ]);
    }
}
