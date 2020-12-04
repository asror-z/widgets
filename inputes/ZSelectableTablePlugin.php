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

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;


/**
 * https://github.com/Mobius1/Selectable-Table-Plugin
 * https://cdpn.io/Mobius1/debug/XxBQOa
 *
 */
class ZSelectableTablePlugin extends ZWidget
{

    public $data = [
        12 => 'Monday',
        13 => 'Thuesday',
        14 => 'Wednesday',
        15 => 'Thursday',
        16 => 'Friday',
        17 => 'Saturday',
        18 => 'Sunday',
    ];

    /**
     * Configuration
     */

    public $config = [];
    public $_config = [
        'toggleAll' => Azl . 'Выбрать все',
        'itemColumn' => 'asd',
    ];


    public $layout = [];
    public $_layout = [
        'js' => <<<JS
          id="rendered-js";
            const table = document.querySelector("table");
        
            const selectable = new Selectable({
              //appendTo: table,
                filter: table.querySelectorAll(".selectable"),
                toggle: true,
                saveState: 10
            });
            
            var array = [];
            
            selectable.on("selecteditem", function(item) {

                var mySelectable = item.node.innerText;
                
                array.push(mySelectable);
                
                console.log(mySelectable)
                
                console.log(array)
                
                //console.log(item.node.textContent);
            
             });
        
        
        selectable.on("deselecteditem", function(item) {
        
        var removeSelectedItems= item.node.innerText;
        
        console.log(item.node.innerText);
        
        for(var i = array.length - 1; i >= 0; i--) {
            if(array[i] === removeSelectedItems) {
            array.splice(i, 1);
            }
        }
        
console.log(array)

        });
            selectable.table();
        
            /*$(document).on('click', 'td.selectable', function (e) {
            var target = $( e.target );
                if (target.is('td')){
                    var range = document.createRange();
                        range.selectNodeContents(this);
                            var text = range['startContainer']['innerText'];
                                copyToClipboard(text);
                                    e.stopPropagation();
                                        console.log('Copied: ' + text);
       }
    });*/

JS,

        'all' => <<<HTML
<div class="container-fluid manage">
    <table>
        <thead>
            <tr>
                <th data-selectable="all">
                    Toggle All
                </th>
                    {columns}
            </tr>
        </thead>
        
            <tbody>
                {items}
            </tbody>
            
    </table>
</div>
HTML,

        'columns' => <<<HTML
<th data-selectable="column">
   {column}
</th> 
HTML,

        'items' => <<<HTML
<tr>
<td data-selectable="row" >
    {row}
</td>
    {itemsColumn}
</tr>
HTML,

        'itemsColumn' => <<<HTML
     <td class="selectable" id="{id}">
            {itemColumn}
     </td>
HTML,
    ];

    public function asset()
    {

        //CSS
        $this->fileCss('/render/inptest/ZSelectableTablePlugin/demo/assets/style.css');

        //JS
        $this->fileJs('https://unpkg.com/selectable.js@latest/selectable.min.js');
        $this->fileJs('https://unpkg.com/selectable-table-plugin@latest/selectable.table.min.js');
        $this->fileJs('/render/inptest/ZSelectableTablePlugin/demo/assets/main.js');
    }

    public function codes()
    {

        $itemColumn = '';

        foreach ($this->data as $key => $value) {
            $itemColumn .= strtr($this->_layout['itemsColumn'], [
                '{itemColumn}' => $value,
                '{id}' => $this->id++ . random_int(1,100000),
            ]);
        }

        //items in table 1
        $items = '';
        foreach ($this->data as $key => $value) {
            $items .= strtr($this->_layout['items'], [
                '{row}' => $key,
                '{itemsColumn}' => $itemColumn,
            ]);
        }

        //items in table 2
        $column = '';
        foreach ($this->data as $key => $value) {
            $column .= strtr($this->_layout['columns'], [
                '{column}' => $value,
                '{items}' => $items,
            ]);
        }

        //all select table
        $this->htm .= strtr($this->_layout['all'], [
            '{columns}' => $column,
            '{items}' => $items,
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);
    }
}

