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
class ZFlagIconWidget extends ZWidget
{

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'height' => '600px',
        'width' => '840px',
        'image' => '',
        'name' => Azl . 'FagIcon',
        'title' => Azl . '<b>flagicon</b>',
    ];
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => true,
        'visible' => true,
        'url' => '',
        'flag' => '',
    ];


    public $branch = [];
    public $_branch = [
        'widget' => [
            'visible',
            'url',
            'flag',
        ],
    ];
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */


    public function asset()
    {/*
       $this->fileCss("https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css");
        $this->fileCss('https://cdn.jsdelivr.net/npm/flag-icon-css@3.4.6/css/flag-icon.css');*/
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
             <a href="{url}"><i class="{flag}">{text}</i>
</a>
     
HTML,
        'js' => <<<JS
       jQuery(document).on('pjax:end', function () {

    console.warn('pjax:end | Before Check: ' + cookie.get('canRun'));

    if (cookie.get('canRun') === 'true') {
        console.warn('pjax:end | Executed: ' + cookie.get('canRun'));
        all();
        cookie.set('canRun', false, {expires: 30});
        console.warn('pjax:end | Executed End: ' + cookie.get('canRun'));
    } else {
        console.warn('pjax:end | Skipped: ' + cookie.get('canRun'));
        cookie.set('canRun', false, {expires: 30});
        console.warn('pjax:end | Skipped End: ' + cookie.get('canRun'));
    }
});    
JS,
        'css' => <<<CSS
               
CSS,
    ];

    public function codes()
    {
        global $boot;
        $text = [
            'ru' => 'РУССКИЙ ',
            'en' => 'ENGLISH ',
            'uz' => "O'ZBEKCHA",
            'uzk' => 'ЎЗБЕКЧА ',
        ];
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
                '{title}' => Langs::lang[$key],
                '{flag}' => $key,
                '{text}' => $text[$key],
            ]);
        }

        $this->js = strtr($this->_layout['js'], []);
        $this->css = strtr($this->_layout['css'], []);
        /* $this->htm .= strtr($this->_layout['main'], [
         '{flag}' => $this->_config['flag'],
         ]);*/

    }

}
