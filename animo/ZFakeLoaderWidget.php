<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 * Created By:Zoxidjon Ergashev
 * Refactored: Zoxidjon Ergashev
 *
 */
class ZFakeLoaderWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'spinner' => ZFakeLoaderWidget::type['spinner2'],
        'bgColor' => ZFakeLoaderWidget::color['green'],
        'timeToHide' => ZFakeLoaderWidget::time['2000']
    ];
    
    /**
     *
     * Constants
     */
    public const color = [
        'red' => '#ff0000',
        'green' => '#10b410',
        'blue' => '#0000ff',
        'white' => '#ffffff',
        'black' => '#000000'
    ];
    public const time = [
        '200' => 200,
        '500' => 500,
        '1000' => 1000,
        '2000' => 2000,
        '3000' => 3000,
        '4000' => 4000,
        '5000' => 5000,
        '6000' => 6000,
        '7000' => 7000,
        '8000' => 8000,
        '9000' => 9000,
        '10000' => 10000
    ];

    public const type = [
        'spinner1' => 'spinner1',
        'spinner2' => 'spinner2',
        'spinner3' => 'spinner3',
        'spinner4' => 'spinner4',
        'spinner5' => 'spinner5',
        'spinner6' => 'spinner6',
        'spinner7' => 'spinner7'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="fakeLoader"></div>
HTML,
        'js' => <<<JS
    // $(document).ready(function() {
        $.fakeLoader({
            timeToHide: "{timeToHide}",
            bgColor: "{bgColor}",
            spinner: "{spinner}",
        })
    // })
JS,
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.statically.io/gh/joaopereirawd/fakeLoader.js/master/css/fakeLoader.css');
        $this->fileJs('/render/animo/ZFakeleLoaderWidget/asset/js/fakeloader.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], []);

        $this->js = strtr($this->_layout['js'], [
            '{bgColor}' => $this->_config['bgColor'],
            '{timeToHide}' => $this->_config['timeToHide'],
            '{spinner}' => $this->_config['spinner'],
        ]);
    }
}
