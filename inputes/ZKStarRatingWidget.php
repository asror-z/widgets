<?php

namespace zetsoft\widgets\inputes;

use kartik\widgets\SwitchInput;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\rating\StarRating;
use yii\web\JsExpression;

/**
 * Class ZKStarRatingWidget
 * @package widgets\inputes
 * http://demos.krajee.com/widget-details/star-rating
 *
 * Refactored: Doston Rakhmatov
 * Labeled:  Asror Zakirov
 */
class ZKStarRatingWidget extends ZWidget
{

    /**
     * Configuration
     */

    public $config = [];
    public $_config = [
        'disabled' => false,
        'language' => false,
        'iStars' => 5,
        'fMin' => 0,
        'fMax' => 5,
        'fStep' => 0.5,
        'readonly' => false,
        'clearButtonClass' => 'fas fa-minus-sign',
        'placeholder' => '',
        'icon' => '<i class="fa fa-star"></i>',
        'class' => '',
        'show' => false,
        'size' => '',
        'value' => 3,
        'myID' => ''
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZKStarRatingWidget/image/icon.png',
        'name' => Azl . 'StarRating',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZKStarRatingWidget/image/icon.png"/>',

    ];

    public $label = [];
    public $_label = [
        'disabled' => Azl . 'Отключен',
        'language' => Azl . 'Язык',
        'iStars' => 5,
        'fMin' => 0,
        'fMax' => 5,
        'fStep' => 0.5,
        'readonly' => false,
        'clearButtonClass' => 'fas fa-minus-sign',
        'placeholder' => '',
        'icon' => 'fas fa-star'
    ];


    public $layout = [];
    public $_layout = [

        'htm' => <<<HTML
       <div class=" border-0 d-flex" id="{id}"></div> 
    HTML,

        'css' => <<<CSS
        .rating-container .filled-stars{
            -webkit-text-stroke: 1px #fde16d!important;
            text-shadow:none!important;
        }
        .rating-container{
            text-align: center!important;
        }

CSS,

        'js' => <<<JS
      
        setTimeout(function() {
            let options = {min: 1, max: 5, step: 2, size: 'md', emptyStar: '<i class="fa fa-star"></i>', filledStar: '<i class="fas fa-star"></i>', 'starCaptions': '', 'starCaptionClasses': 'text-primary'}
            $('.rating-loading').rating(options)
            $('.rating-input')
            {eventItem}
        }, 1000)

JS,


    ];
    /**
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKStarRatingWidget  | $eventChange") ',
        'clear' => ' console.log("ZKStarRatingWidget | $eventClear") ',
        'reset' => ' console.log("ZKStarRatingWidget | $eventReset") ',
        'hover' => ' console.log("ZKStarRatingWidget | $eventHover") ',
    ];


    /**
     * Plugin Events
     * http://plugins.krajee.com/star-rating#events
     */


    //http://demos.krajee.com/widget-details/star-rating#settings


    public function codes()
    {


        $this->options = [
            'name' => $this->name,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'bsVersion' => $this->bsVersion,
            'language' => Az::$app->language,
            'value' => $this->_config['value'],
            'readonly' => false,
            'options' => [
                'id' => $this->id . random_int(1, 99999),
                'class' => $this->_config['class'],
                'placeholder' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            ],
            'pluginOptions' => [
                'size' => $this->_config['size'],
                'containerClass' => '',
                'theme' => '',
                'emptyStar' => $this->_config['icon'],
                'filledStar' => $this->_config['icon'],
                'stars' => $this->_config['iStars'],
                'min' => $this->_config['fMin'],
                'max' => $this->_config['fMax'],
                'step' => $this->_config['fStep'],
                'disabled' => $this->_config['disabled'],
                'readOnly' => $this->_config['readonly'],
                'displayOnly' => $this->_config['readonly'],
                'rtl' => false,
                'animate' => true,
                'showClear' => true,
                'showCaption' => $this->_config['show'],
                'defaultCaption' => Az::l("{rating} Stars"),
                'starCaptions' => [
                    '0.5' => 'Half Star',
                    '1' => 'One Star',
                    '1.5' => 'One & Half Star',
                    '2' => 'Two Stars',
                    '2.5' => 'Two & Half Stars',
                    '3' => 'Three Stars',
                    '3.5' => 'Three & Half Stars',
                    '4' => 'Four Stars',
                    '4.5' => 'Four & Half Stars',
                    '5' => 'Five Stars'
                ],
                'starCaptionClasses' => [
                    '0.5' => 'badge badge-danger',
                    '1' => 'badge badge-danger',
                    '1.5' => 'badge badge-warning',
                    '2' => 'badge badge-warning',
                    '2.5' => 'badge badge-info',
                    '3' => 'badge badge-info',
                    '3.5' => 'badge badge-primary',
                    '4' => 'badge badge-primary',
                    '4.5' => 'badge badge-success',
                    '5' => 'badge badge-success'
                ],
                'showCaptionAtitle' => true,
                'clearButton' => "<i class='{$this->_config['clearButtonClass']}'></i>",
                'clearButtonTitle' => Az::l('Clear'),
                'clearButtonBaseClass' => 'clear-rating',
                'clearButtonActiveClass' => 'clear-rating-active',
                'clearValue' => '',
                'clearCaption' => Az::l('Not Rated'),
                'clearCaptionClass' => 'badge badge-default',
                'captionElement' => '',
                'clearElement' => '',
                'hoverEnabled' => true,
                'hoverChangeCaption' => true,
                'hoverChangeStars' => true,
                'hoverOnClear' => true,
            ],
            'pluginEvents' => $this->eventsAll([
                'change' => 'change',
                'clear' => 'clear',
                'reset' => 'reset',
                'hover' => 'hover',
            ]),
        ];


        $this->htm .= StarRating::widget($this->options);


        $this->htm = strtr($this->htm, [
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            /*'{getIcon}' => $getIcon*/
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->_config['myID'] = random_int(1, 9999);

        $eventsAll = $this->eventsAll([
            'rating:change' => 'change',
            'rating:reset' => 'reset',
            'rating:hover' => 'hover',
            'rating:hoverleave' => 'hoverleave',
            'rating:clear' => 'clear',
        ]);

        $eventItem = $this->eventsOn($eventsAll);

        $this->js = strtr($this->_layout['js'], [
            '{myId}' => $this->jscode($this->_config['myID']),
            '{eventItem}' => $eventItem
        ]);

    }

}
