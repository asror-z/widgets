<?php

namespace zetsoft\widgets\incores;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://github.com/Fabianlindfors/multi.js
 * https://fabianlindfors.se/multijs/
 *
 * Created By: Sunnat Ermatov
 * Refactored: MurodovMirbosit
 */

class ZMultiJsWidget2 extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'placeholder' => '',
        'multiple' => false,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',

    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/multi.js@0.5.1/dist/multi.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/multi.js@0.5.1/dist/multi.min.js');
    }
    
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

    <div class="container {class}">
<select name="{name}[]"  id="your_select_element {id}" {multiple}>
		<option></option>
		 {content}
	</select>
  </div>


HTML,

        'option' => <<<HTML
        	<option value="{key}">{value}</option>
HTML,


        'js' => <<<JS
  
   var select_element = document.getElementById("#your_select_element");
    multi(select_element, {
        "enable_search": true,
        "search_placeholder": "Search...",
        "non_selected_header": null,
        "selected_header": null,
        "limit": -1,
        "limit_reached": function () {},
    });
    multi(select_element, {
        'non_selected_header': 'All options',
        'selected_header': 'Selected options'
    });
    multi(select_element, {
        'limit': 10
    });
    multi(select_element, {
        'limit': 10,
        'limit_reached': function () {
            alert('You have selected 10/10 elements.');
        }
    });
    $('#your_select_element').multi();
JS,


'css' => <<<CSS
     .container {
            box-sizing: border-box;;
            margin: 0 auto;
            max-width: 500px;
            padding: 0 20px;
            width: 100%;
            font-family: sans-serif;

        }
CSS,

    ];



    public function codes()
    {
       
        $option = '';
        foreach ($this->data as $key => $action) {
            $option .= strtr($this->_layout['option'], [
                '{value}' => $action,
                '{key}' => $key,
            ]);
        }


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{class}' => $this->className,
            '{content}' => $option,
            '{multiple}' => $this->_config['multiple'] ? 'multiple="multiple"' : '',
            '{value}' => $this->value,

        ]);
        

        $this->js = strtr($this->_layout['js'],[
         '{id}' => $this->id,
         '{placeholder}' => $this->jscode($this->_config['hasPlace'] ? $this->_config['placeholder'] : ''),

        ]);

        $this->css = strtr($this->_layout['css'],[

        ]);

    }

}
