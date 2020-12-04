<?php

namespace zetsoft\widgets\inputes;
use zetsoft\system\kernels\ZWidget;

/**
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 *
 * Created By: Sunnat Ermatov
 * Refactored: MurodovMirbosit
 *
 * Class ZMultiJsWidget
 * https://github.com/Fabianlindfors/multi.js
 * https://fabianlindfors.se/multijs/
 *
 */

class ZMultiJsWidget extends ZWidget
{
public $data = [
    'PHP' => 'PHP',
    'Phyton' => 'Phyton',
    'C#' => 'C#',
    'GoLang' => 'GoLang',
    'JavaScript' => 'JavaScript',
    'Vue.js' => 'Vue.js',
    'AngularJs' => 'AngularJs',
];
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
     'placeholderLeft' => '',
     'placeholderRight' => '',
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
        'sm' => 'sm',
    ];

    public function asset()
    {

        $this->fileCss('https://cdn.jsdelivr.net/npm/multi.js@0.5.1/dist/multi.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/multi.js@0.5.1/dist/multi.min.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML

     <div class="container">
      <select {multiple} name="{name}" id="{id}" >
       {content}
      </select>
     </div>


HTML,

        'option' => <<<HTML
         <option value="{value}" {selected}>{value}</option>
HTML,


        'js' => <<<JS
        $(document).ready(function () {
        var select_element = document.getElementById("{id}");
         multi(select_element, {
        'non_selected_header': '{placeholderLeft}',
        'selected_header': '{placeholderRight}',
        "enable_search": true,
        "search_placeholder": "Поиск...",
        "limit": 4,
        "limit_reached": function () {
        alert('Вы можете выбрать ограниченное колличество опций ');
        },
    });
    $('#{id}').multi();

});
       
JS,

'css' => <<<CSS
     .container {
            box-sizing: border-box;
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
        foreach ($this->data as $key => $value) {

            $selected = '';

            if ($this->value === $value)
                $selected = 'selected="selected"';

            if (is_array($this->value))
                foreach ($this->value as $val)
                    if ($val === $value)
                        $selected = 'selected="selected"';


            $option .= strtr($this->_layout['option'], [
                '{value}' => $value,
                '{selected}' => $selected,
            ]);
        }
        
        $name = $this->name;
        if ($this->_config['multiple'])
            $name = $this->name . '[]';


        $this->htm = strtr($this->_layout['main'], [
            '{data}' => $this->data,
            '{id}' => $this->id,
            '{name}' => $name,
            '{content}' => $option,
            '{multiple}' => $this->_config['multiple'] ? 'multiple="multiple"' : '',
            '{value}' => $this->value,
            
        ]);

        $this->js = strtr($this->_layout['js'],[
         '{id}' => $this->id,
         '{placeholderLeft}' => $this->jscode($this->_config['hasPlace'] ? $this->_config['placeholderLeft'] : ''),
         '{placeholderRight}' => $this->jscode($this->_config['hasPlace'] ? $this->_config['placeholderRight'] : ''),

        ]);

        $this->css = strtr($this->_layout['css'],[

        ]);

    }

}
