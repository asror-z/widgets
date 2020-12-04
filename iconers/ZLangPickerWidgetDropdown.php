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
class ZLangPickerWidgetDropdown extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'visible' => true,
        'grapes' => true,
        'text' => true,
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/flag-icon-css@3.4.6/css/flag-icon.css');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="dropdown">
        <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            LANGUAGE
        </button>
        <div class="dropdown-menu py-1 px-0" aria-labelledby="dropdownMenuButton" style="transition: .2s ease">   
              {lang}
        </div>
    </div>
HTML,

        'lang' => <<<HTML
     <a href="{url}" class="d-flex justify-content-start py-1 px-2 dropdown-hover" {readonly}>
        <span class="logosz flag-icon-{flag}"></span>
        <span class="text-right text-dark ml-3">{text}</span>
     </a>
HTML,





    ];

    public function codes()
    {
        global $boot;

        $text = [
            'ru' => 'РУССКИЙ ',
            'en' => 'ENGLISH ',
            'uz' => "O'ZBEKCHA",
            'uzk' => 'ЎЗБЕКЧА ',
            'lv' => 'LATVIA',
            'ro' => 'ROMANIA'
        ];

        $active = $boot->env('activelang');

        $pathInfo = Az::$app->request->pathInfo;
        $queryString = Az::$app->request->queryString;

        $currentLang = Az::$app->language;

        $lang = '';
        foreach ($active as $key) {

            $selectedLang = '/' . $key . '/';

            $url = $selectedLang . $pathInfo;

            if (!empty($queryString))
                $url .= '?' . $queryString;

            $lang .= strtr($this->_layout['lang'], [
                '{url}' => $url,
                '{title}' => Langs::lang[$key],
                '{flag}' => $key,
                '{text}' => $this->_config['text'] ? $text[$key] : '',
                '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

            ]);

        }

        $this->htm = strtr($this->_layout['main'],[
            '{lang}' => $lang
        ]);

        $this->css = <<<CSS
       .sz{
        box-shadow: 0 0 4px #000 ;
        font-size: 25px !important;
        margin-left: 5px !important;
        background-color:#0b71a6 !important; ;
       }     
       .logosz{
        display: block;
        text-indent: -9999px;
        width: 25px;
        height: 25px;
        background-size: 25px 25px;
       }
       .dropdown-hover {
       transition: .1s ease;
       }
       .dropdown-hover:hover {
       background: #f1f1f1
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
