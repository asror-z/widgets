<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 * Refactored by: Sherzod Mangliyev
 */


namespace zetsoft\widgets\inputes;

use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


class ZJqueryTextareaLibraryWidget extends ZWidget
{

    public $config = [];
    public $_config = [

            ];

    public $event = [];
    public $_event = [
        'click' => "console.log('{className} | click')",
        'overCount' => "
            console.log('{className} | This is max count');"
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
             <div class="container mt-5" {readonly}>
                <div class="progress">
                    <div id="progress-percent" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        <span id="progPercentage" class="current-value"></span>
                    </div>
                </div>
                <form class="form-group">
                    <textarea id="{id}" class="form-control" rows="10" maxlength="100" name="{name}" placeholder="Enter a text">{value}</textarea>
                </form>
                <div class="count btn btn-primary"><span id="charCount"></span>Char</div>
                <div class="count btn btn-primary"><span id="lineCount"></span> Lines</div>
             </div>

HTML,
        'js' => <<<JS

    jQuery(document).ready(function () {

        $("#{id}").textareaCounter({
            txtElem: 'textarea',
            charElem: 'charCount',
            lineElem: 'lineCount',
            progElem: 'progress-percent',
            progPerc: 'progPercentage',
            txtCount: '100',
            lineCount: '10',
            charPerLine: '20',
        });
    });

JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/harisouras/jquery-textarea-library/master/jquery.textArea.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
              '{id}' => $this->id,
              '{name}' => $this->name,
              '{value}' => $this->value,
              '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',


            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);

        
    }
}

