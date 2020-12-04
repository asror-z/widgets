<?php


namespace zetsoft\widgets\inputes;


use kartik\typeahead\Typeahead;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Url;
use yii\web\JsExpression;
use zetsoft\system\kernels\ZWidget;

/**
 * Refactored: Davlatmurod Jumaboyev
 * Class ZKTypeaheadWidget
 * http://demos.krajee.com/widget-details/typeahead
 *
 * Created by: Doston Rakhmatov
 */
class ZKTypeaheadWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'namespace' => 'inputs',
        'service' => 'typeaheads',
        'method' => 'ajax',
        'args' => '',

        'bVersion' => '',
        'useHandleBars' => true,
        'defaultSuggestions' => [],
        'scrollable' => false,
        'rtl' => false,
        'hint' => true,
        'local' => [],
        'prefetch' => [],
        'minLength' => 4,
        'display' => '',
        'limit' => 5,
        'async' => true,
        'templates' => [],
        'highlight' => false,
        'disabled' => false,
        'options' => [],
        'container' => [],
        //If true send query to typeaheads service
        'remote' => false,

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKTypeaheadWidget/image/icon.png',
        'name' => Azl . 'Typeahead',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKTypeaheadWidget/image/icon.png"/>',

    ];

    public const type = [

        'main' => 'main',
        'icon' => 'icon'

    ];


    public $event = [];
    public $_event = [
        "active" => "function() { log('typeahead:active'); }",
        "idle" => "function() { log('typeahead:idle'); }",
        "open" => "function() { log('typeahead:open'); }",
        "close" => "function() { log('typeahead:close'); }",
        //"change" => "function() { log('typeahead:change'); }",
        "render" => "function() { log('typeahead:render'); }",
        "select" => "function() { log('typeahead:select'); }",
        "autocomplete" => "function() { log('typeahead:autocomplete'); }",
        "cursorchange" => "function() { log('typeahead:cursorchange'); }",
        "asyncrequest" => "function() { log('typeahead:asyncrequest'); }",
        "asynccancel" => "function() { log('typeahead:asynccancel'); }",
        "asyncreceive" => "function() { log('typeahead:asyncreceive'); }",
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                    <div class="md-form">
                        {icon} 
                            <div class="{margin}" >&ensp;{typeAhead} </div> 
                    </div>
    HTML,
        'icon' => <<<HTML
            <i class="{icon} prefix icon-prefix mt-4"></i>
    HTML,
    ];

    public function codes()
    {

        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'bsVersion' => $this->bsVersion,
            'useHandleBars' => $this->_config['useHandleBars'],
            'defaultSuggestions' => [],
            'scrollable' => $this->_config['scrollable'],
            
            'dataset' => [
                [
                    'local' => $this->_config['local'],
                    'display' => $this->_config['display'],
                    'limit' => $this->_config['limit'],
                ]
            ],
            'disabled' => $this->_config['disabled'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'id' => $this->id,
                'class' =>'form-control '.$this->_config['class'],
               // 'placeholder' =>$this->_config['hasPlace'] ? $this->_config['placeholder'] : '',

            ],
            'container' => [],
            'pluginOptions' => [
                'highlight' => $this->_config['highlight'],
                'hint' => $this->_config['hint'],
                'minLength' => $this->_config['minLength'],

            ],
            'pluginEvents' => $this->eventsAll([
                'active' => 'active',
                'idle' => 'idle',
                'open' => 'open',
                'close' => 'close',
                'change' => 'change',
                'render' => 'render',
                'select' => 'select',
                'autocomplete' => 'autocomplete',
                'cursorchange' => 'cursorchange',
                'asyncrequest' => 'asyncrequest',
                'asynccancel' => 'asynccancel',
                'asyncreceive' => 'asyncreceive',
            ]),
        ];

        if(isset($this->config['remote'])) {
            $this->options['dataset'][0]['remote'] = [
                'url' => Url::to([
                    '/api/core/app/service',
                    'namespace' => $this->_config['namespace'],
                    'service' => $this->_config['service'],
                    'method' => $this->_config['method'],
                    'args' => $this->_config['args'].'|',
                ]).'%QUERY',
                'wildcard' => '%QUERY'
            ];
        }

        $typeAhead = Typeahead::widget($this->options);

        $iconCode = strtr($this->_layout['icon'],[
            '{icon}' => $this->_config['icon'],

        ]);

        $this->htm = strtr($this->_layout['main'],[
            '{typeAhead}' => $typeAhead,
            '{icon}' => $this->_config['hasIcon'] ? $iconCode : '',
            '{margin}' => $this->_config['hasIcon'] ? 'ml-5' : '',

        ]);


    }

}
