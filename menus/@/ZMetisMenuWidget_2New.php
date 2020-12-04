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


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\service\menu\ALL;
use zetsoft\service\menu\ALLNew;
use zetsoft\system\Az;

/*use zetsoft\system\helpers\ZJsonHelper;*/


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;

class ZMetisMenuWidget_2New extends ZWidget
{
    public $config = [];
    public $_config = [
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/metismenu@3.0.5/dist/metisMenu.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/metismenu');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js');
    }

   
    public function codes()
    {
        $url = Az::$app->App->eyuf->user->getMainUrl();
        $url = ZUrl::to([$url]);
        $this->layout = [

            'main' => <<<HTML
       <ul id="{id}-menu" class="items">
            <li class="active">
                <a href="#" class="has-arrow" aria-expanded="false">{home}</a>
        <ul class="items" aria-expanded="false">
            <li>
            <a class="has" href="{url}">{item}</a>
            </li>             
       </ul>    
            </li>
        </ul>
    
HTML,


            'css' => <<<CSS
     #w0-menu{
    max-width: 30%;
    }
    .has-arrow {
        background: #212529;
    }
      .items {
        padding: 0;
        margin: 0;
        list-style: none;
        background: #343a40;
    }

     .active {
        background: #212529;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    #w0-menu .has-arrow + .has-arrow {
        margin-top: 5px;
    }

    #w0-menu .has-arrow:first-child {
        margin-top: 5px;
    }
    #w0-menu .has-arrow:last-child {
        margin-bottom: 5px;
    }


    #w0-menu > .has-arrow {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 0%;
        flex: 1 1 0%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        position: relative;
    }
    #w0-menu .has-arrow {
        position: relative;
        display: block;
        padding: 13px 15px;
        color: #adb5bd;
        outline-width: 0;
        transition: all .3s ease-out;
    }
    .has{
        position: relative;
        display: block;
        padding: 13px 15px;
        color: #adb5bd;
        outline-width: 0;
        transition: all .3s ease-out;
    }

     .items .items .has-arrow {
        padding: 10px 15px 10px 45px;
    }

    .has-arrow:hover,
    .has-arrow:focus,
    .has-arrow:active {
        color: #f8f9fa;
        background: #0b7285;
    }
CSS,

            'js' => <<<JS
   $(function() {
  $('#{id}-menu').metisMenu({
  toggle: false, // disable the auto collapse. Default: true.
   preventDefault: false,
  });
});
JS,

        ];
        
        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{home}' => Az::l('Главная страница'),

        ]);


        $this->js = strtr($this->layout['js'], [
            '{id}' => $this->id,
        ]);

        $this->css = strtr($this->layout['css'], [
        ]);

    }

}
