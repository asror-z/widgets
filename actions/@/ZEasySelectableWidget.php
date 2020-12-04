<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;

//use zetsoft\widgets\inputes\ZSampleWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://github.com/mee4dy/easySelectable
 * https://www.jqueryscript.net/demo/DOM-Selection-jQuery-easySelectable/
 *
 * @author MurodovMirbosit
 */
class ZEasySelectableWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'container' => 'parent-div',
        'LiClass' => '',
        'cols' => self::cols['11'],
        'HasLabel' => false,
        'title' => 'Цвет:'
    ];


    public const cols = [
        '2' => '4',
        '3' => '3',
        '5' => '2',
        '11' => '1',
    ];

    /**
     *
     * Plugin Events
     */
    public $event = [];
    public $_event = [

        'checked' => "console.log('CHECKED');",
        'unchecked' => "console.log('UNCHECKED');"
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<div id="container-{id}" class="{container}-div MEasySelectable">
    <ul id="easySelectable" class="easySelectable flex justify-content-around parrentbody row">
            {content}
    </ul>
    <input id="{id}-hidden" type="hidden" name="{name}" >
</div>
HTML,

        'items' => <<<HTML
    <li class="es-selectable {selected} {LiClass}" data-value="{value}" id="{id}-easyselectable">
            {items}
    </li>
HTML,

        'js' => <<<JS
 function easySelectable() {
         var selecteds = $('.{container}-div').find('.es-selectable');
    
     $(document).on('mouseover', '.es-selectable', function() {
         var values = [];       
         selecteds.each(function(key, value) {
             if ($(value).hasClass('es-selected')) {
                 values.push($(value).attr('data-value'));
             }
         });
         $('#{id}-hidden').attr('value', JSON.stringify(values));
         console.log($('#{id}-hidden').val());
})
 }
    easySelectable();
    
    $(document).on('pjax:end', function () {
       easySelectable();
    });
    
    
     $('#easySelectable').easySelectable({
       item: 'li',
       state: true,
       onSelecting: function()
       {
         console.log('onSelecting');
       },
       onSelected: function()
       {
         console.log('onSelected');
       },
       onUnSelected: function()
       {
         console.log('onUnSelected');
       }
      });
JS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/mee4dy/easySelectable/master/src/js/easySelectable.js');
        $this->fileJs('https://cdn.statically.io/gh/mee4dy/easySelectable/master/index.js');
        $this->fileCss('https://cdn.statically.io/gh/mee4dy/easySelectable/master/src/css/easySelectable.css');
        $this->fileCss('/render/actions/ZEasySelectableWidget/demo/demo_files/style.css');
        $this->fileCss('https://cdn.statically.io/gh/mee4dy/easySelectable/master/sunburst.css');
    }

    public function codes()
    {
        $content = '';

        foreach ($this->data as $key => $value) {

            $selected = '';

            $dbValue = json_decode($this->value, true, 512);

            if (!empty($dbValue))
                foreach ($dbValue as $val)
                    if ($key == $val)
                        $selected = 'es-selected';

            $content .= strtr($this->_layout['items'], [
                '{value}' => $key,
                '{items}' => $value,
                '{selected}' => $selected,
                '{LiClass}' => $this->_config['LiClass'],
                '{cols}' => $this->_config['cols'],
                '{id}' => $this->id++ . random_int(1, 999999),
                //'{itemLabel}' => $label,
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{id}' => $this->id++ . random_int(1, 999999),
            '{name}' => $this->name,
            '{container}' => $this->_config['container'],
            '{title}' => $this->_config['title'],
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{container}' => $this->_config['container'],
            '{id}' => $this->id++ . random_int(1, 999999),
            '{change}' => $this->eventCode('change'),
            '{unchecked}' => $this->eventCode('unchecked'),
            '{checked}' => $this->eventCode('checked'),
        ]);
    }
}

