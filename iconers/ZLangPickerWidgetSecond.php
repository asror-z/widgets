<?php

namespace zetsoft\widgets\iconers;

use zetsoft\service\cores\Langs;
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
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */
class ZLangPickerWidgetSecond extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'visible' => true,
        'grapes' => true,
        'text' => false,
        'hint' => Azl . 'languages',
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/flag-icon-css@3.4.6/css/flag-icon.css');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <a href="{url}" class="mx-1 hint--bottom" {readonly} aria-label="{hint}">
                <span class="logosz sz flag-icon-{flag}"></span>
            </a>
     
HTML,
    ];

    public function codes()
    {
        global $boot;

        $active = $boot->env('activelang');

        $pathInfo = Az::$app->request->pathInfo;
        $queryString = Az::$app->request->queryString;

        $currentLang = Az::$app->language;



        foreach ($active as $key) {

            $selectedLang = '/' . $key . '/';

            $url = $selectedLang . $pathInfo;

            if (!empty($queryString))
                $url .= '?' . $queryString;

            $this->htm .= strtr($this->_layout['main'], [
                '{url}' => $url,
                '{hint}' => Langs::lang[$key],
                '{flag}' => $key,
                '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            ]);

        }

        $this->css = <<<CSS
        
       .sz:hover{
  
        box-shadow: -3px 6px 26px 2px rgba(179,165,179,0.58);
        /*font-size: 25px !important;*/
        /*margin-left: 5px !important;*/
        /*background-color:#0b71a6 !important; */
       }     
       .logosz{
        display: block;
        text-indent: -9999px;
        width: 20px;
        height: 20px;
        background-size: 25px 25px;
        background-repeat: no-repeat;
        background-size: cover;
       }
.flag-icon-en {
  background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/us.svg);
}
.flag-icon-ru {
  background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/ru.svg);
}
.flag-icon-uzk{
  background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/uzk.svg);
}
.flag-icon-uz {
  background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/uz.svg);
}
CSS;

    }
}
