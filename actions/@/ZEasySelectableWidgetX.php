<?php

namespace zetsoft\widgets\actions;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/mee4dy/easySelectable
 * https://www.jqueryscript.net/demo/DOM-Selection-jQuery-easySelectable/
 *
 * Created By:  Mirbosit Murodov
 * Refactored:  Mirbosit Murodov
 */
class ZEasySelectableWidgetX extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'container' => 'parent-div',
        'LiClass' => '',
        'cols' => self::cols['11']
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
        <li class="es-selectable col-md-{cols} {selected} {LiClass}" data-value="{value}">
             {src}
        </li>
HTML,


        'js' => <<<JS
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
JS,

        /*        'css' => <<<CSS
        #wrap {
            width: 960px;
            margin: 80px auto;
        }

        #wrap section {
            margin-top: 30px;
        }

        #wrap .wrap__title {
            margin-bottom: 15px;
            color: #444;
        }

        #wrap .wrap__title .small {
            font-size: 11px;
            color: #666;
            margin-left: 20px;
        }

        #wrap .wrap__table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }

        #wrap .wrap__table th {
            color: #222;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        #wrap .wrap__table th:nth-child(1) {
            width: 80px;
        }

        #wrap .wrap__table th:nth-child(2) {
            width: 80px;
        }

        #wrap .wrap__table th:nth-child(3) {
            width: 150px;
        }

        #wrap .wrap__table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        #easySelectable {
            display: flex;
            flex-wrap: wrap;

        }

        #easySelectable li {
            margin: 5px 2px;
            background: #ccc;
            transition: background 0.2s;
            width: 100px;
            height: 100px;
            color: #222;
            font-weight: bold;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0px 1px 1px #ccc;
        }

        li.es-selected {
            background: #ffffff;
            color: #00dd00;
            border: 2px solid #00dd00;
        }

        CSS,*/


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
                '{src}' => $value,
                '{selected}' => $selected,
                '{LiClass}' => $this->_config['LiClass'],
                '{cols}' => $this->_config['cols']
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{content}' => $content,
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{container}' => $this->_config['container']
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{container}' => $this->_config['container'],
            '{id}' => $this->id,

        ]);

        /*  $this->css .= strtr($this->_layout['css'], [

          ]);*/
    }
}

