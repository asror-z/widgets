<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use yii\web\JsExpression;

/*
 * https://github.com/rmm5t/jquery-sieve
 * https://www.jqueryscript.net/demo/jQuery-Plugin-For-Interactive-Search-Filter-sieve/
 *
 * Created By: Bakhtiyor Alijanov
 * Refactored: Bakhtiyor Alijanov
 */
///instruction to use!!!//
///wrap your content with class="sieve" and write your search items in appropriate itemselector
class ZFilterWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'itemselector' => '',
        'selector' => ''
    ];

    public $layout = [];
    public $_layout = [
        'jsCode' => <<<JS
        var searchTemplate = `
            <div class="input-group md-form form-sm form-1 pl-0 w-100 border">
                <div class="input-group-prepend">
                    <span class="input-group-text cyan lighten-3" id="basic-text1"><i class="fas fa-search text-white"
                    aria-hidden="true"></i></span>
                </div>
                <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
            </div>`;
            $("{selector}").sieve({
                searchTemplate: searchTemplate,
                itemSelector: '{itemselector}',
            });
JS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/rmm5t/jquery-sieve/master/dist/jquery.sieve.min.js');
    }

    public function codes()
    {

        $this->js = strtr($this->_layout['jsCode'], [
            '{itemselector}' => $this->jsCode($this->_config['itemselector']),
            '{selector}' => $this->jsCode($this->_config['selector']),
        ]);
    }
}
