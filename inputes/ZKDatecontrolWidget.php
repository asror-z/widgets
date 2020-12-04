<?php


namespace zetsoft\widgets\inputes;

use zetsoft\service\cores\Date;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\datecontrol\DateControl;

/**
 * Class ZKDatecontrolWidget
 * @package widgets\inputes
 * http://demos.krajee.com/datecontrol
 *
 * Refactored: Doston Rakhmatov
 */

class ZKDatecontrolWidget extends ZWidget
{
    public const format = [
        'date' => 'date',
        'time' => 'time',
        'datetime' => 'datetime'
    ];
    
    public $config= [];
    public $_config = [
        'name' => 'begin_time',
        'type'=> ZKDatecontrolWidget::format['date'],
        'displayFormat'=> 'php:'.Date::date,
        'saveFormat'=> 'php:'.Date::date,
        'displayTimezone'=>'',
        'saveTimezone'=>'',
        'isAutoWidget'=> true,
        'widgetOptions'=>'',
        'disabled'=> false,
        'readonly'=> false,
        'saveOptions'=>'',
        'isAjaxConversion'=> true,
        'isAsyncRequest'=> true,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'php:d-F-Y'
        ],

    ];
    
    public function codes()
    {
        $this->options = [
            'name' => $this->name,
            'value' => $this->value,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'bsVersion' => $this->bsVersion,
            'language' => Az::$app->language,
            'type' => $this->_config['type'],
            'displayFormat' => $this->_config['displayFormat'],
            'saveFormat' => $this->_config['saveFormat'],
            'displayTimezone' => $this->_config['displayTimezone'],
            'saveTimezone' => $this->_config['saveTimezone'],
            'autoWidget' => $this->_config['isAutoWidget'],
            //   'widgetOptions' => $this->_config['widgetOptions'],
            'options' => [
                'id' => $this->id,
                'class' => $this->_config['class'],
                
                '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
                'name' => $this->_config['name'],
            ],
            'disabled' => $this->_config['disabled'],
            'readonly' => $this->_config['readonly'],
            //  'saveOptions' => $this->_config['saveOptions'],
            'ajaxConversion' => $this->_config['isAjaxConversion'],
            'asyncRequest' => $this->_config['isAsyncRequest'],
            'pluginOptions' => [
                'autoclose' => true,
/*                'dateSettings' => [
                    'longDays' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    'shortDays' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    'shortMonths' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'longMonths' => ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'],
                    'meridiem' => ['AM', 'PM']
                ]*/
            ],

        ];
        $this->htm = DateControl::widget($this->options);
    }

}
