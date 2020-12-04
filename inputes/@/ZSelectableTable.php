<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inptest\ZSelectable2Widget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 * Created By: Maxamadjonov Jaxongir
 *
 *
 */
class ZSelectableTable extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'container-fluid manage' => [],
        'containerClass' => 'div',
        'container-fluid manageTag' => 'li',
        'itemClass' => 'ui-selectable',
        'selectableVar' => 'selectable',
        'appendTo' => 'selectable-container',
    ];

  

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
     
<div class="container-fluid manage">

    <table>
        <thead>
        <tr>
            <th data-selectable="all">
                Toggle All
            </th>
            <th data-selectable="column">
                Sunday
            </th>
            <th data-selectable="column">
                Monday
            </th>
            <th data-selectable="column">
                Tuesday
            </th>
            <th data-selectable="column">
                Wednesday
            </th>
            <th data-selectable="column">
                Thursday
            </th>
            <th data-selectable="column">
                Friday
            </th>
            <th data-selectable="column">
                Saturday
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-selectable="row">
                1 - 2
            </td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
        </tr>
        <tr>
            <td data-selectable="row">
                2 - 3
            </td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
        </tr>
        <tr>
            <td data-selectable="row">
                3 - 4
            </td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
        </tr>
        <tr>
            <td data-selectable="row">
                4 - 5
            </td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
            <td class="selectable"></td>
        </tr>
        
        </tbody>
    </table>
</div>  
HTML,

        'js' => <<<JS
           id="rendered-js";
         const table = document.querySelector("table");
    const selectable = new Selectable({
        appendTo: document.body,
        filter: table.querySelectorAll(".selectable"),
        autoRefresh:true,
        ignore: false,
        toggle: false,
        saveState: false,
        throttle: 50,
        maxSelectable: 10,
        autoscroll:true,   
    });
    selectable.table();
JS,

        'css' => <<<CSS
         .manage {
        margin: 0;
        width: 100vw;
        height: 100vh;
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        background-color: #FFF;
        color: #fff;
        font-family: "Inconsolata";
        line-height: 26px;
    }

    .container {
        width: 80vw;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
    table th, table td {
        padding: 5px 15px;
        text-align: center;
        width: 12%;
    }
    table th, table td {
        background-color: #414040;
        border-bottom: solid 1px #1c1c1c;
        border-right: solid 1px #1c1c1c;
    }
    table th, table td:nth-child(1) {
        cursor: pointer;
        background-color: #292929;
        vertical-align: middle;
        font-weight: 700;
    }
    table th:hover, table td:nth-child(1):hover {
        background-color: #363636;
    }
    table td:hover, table td.hover {
        background-color: #5b5959;
    }
    table td.ui-selecting {
        background-color: #7f8c8d;
    }
    table td.ui-selecting.ui-selected {
        background-color: #7f8c8d;
    }
    table td.ui-selected {
        background-color: blue;
    }

    .ui-lasso {
        display: none;
    }
CSS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@0.17.6/selectable.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@0.17.6/selectable.js');
    }

    public function codes()
    {
        $this->options = [
            'appendTo' => "#{$this->_config['appendTo']}",
            'autoRefresh' => true,
            'autoScroll' => [
                'threshold' => 0,
                'increment' => 10
            ],
            'classes' => [
                'lasso' => "ui-lasso",
                'selected' => "ui-selected",
                'container' => "ui-container",
                'selecting' => "ui-selecting",
                'selectable' => "ui-selectable",
                'deselecting' => "ui-deselecting"
            ],
            'filter' => ".{$this->_config['itemClass']}",
            'ignore' => false,
            'lasso' => [
                'border' => '1px dotted #000',
                'backgroundColor' => 'rgba(52, 152, 219, 0.2)',
            ],
        ];
            
            $this->htm = strtr($this->_layout['main'], [
            '{name}'=>$this->name,
            '{id}'=>$this->id,
            '{value}'=>$this->value,
            ]);

            $this->js = strtr($this->_layout['js'], [
                '{id}'=>$this->id,
            ]);

            $this->css = strtr($this->_layout['css'], []);
    }
}
