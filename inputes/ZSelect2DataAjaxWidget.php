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
 * Created By: MurodovMirbosit
 * Refactored: AzimjonToirov
 *
 * Class ZSelect2Widget
 * https://github.com/asror-z
 * https://github.com/select2/select2
 * https://select2.org/
 * https://select2.github.io/select2/
 *
 */
class ZSelect2DataAjaxWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'theme' => ZKSelect2Widget::theme['bootstrap'],
        //true only in view page
        'ajax' => true,
        'url' => null,
        'dataType' => 'jsonb',
    ];
    
    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public const theme = [
        'bootstrap' => 'bootstrap',
        'classic' => 'classic',
        'material' => 'material',
        'krajee-bs4' => 'krajee-bs4',
    ];

    public $event = [];
    public $_event = [
        'opening' => "function() { console.log('select2:opening'); }",
        'open' => "function() { console.log('open'); }",
        'closing' => "function() { console.log('close'); }",
        'close' => "function() { console.log('close'); }",
        'selecting' => "function() { console.log('selecting'); }",
        'select' => "function() { console.log('select'); }",
        'unselecting' => "function() { console.log('unselecting'); }",
        'unselect' => "function() { console.log('unselect'); }",
        'clear' => "function() { console.log('select2:clear'); }",
        'clearing' => "function() { console.log('select2:clearing'); }",
    ];

    public function asset()
    {
        //CssFile
        $this->fileCss('/render/asrorz/css/select2.css');

        //Theme
        $this->fileCss('/render/inputes/ZSelect2Widget/assets/select2-bootstrap.css');

        //JsFile
        $this->fileJs('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        {label}
        <select id="{id}" class="select {class} selectM">
         <option value="">{placeholder}</option>
            {content}
        </select>
HTML,

        'option' => <<<HTML
             <option value="{key}" {selected}>{value}</option>
HTML,

        'label' => <<<HTML
            <label class="select2-label" for="{id}">
            {labels}   
</label>
HTML,
        'select2Options' => <<<JS
        
       $("#{id}").select2({
             ajax: {
                    url: '{url}',
                    type: "get",
                    dataType: '{dataType}',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        console.log(response)
                        return {
                            results: response
                        };
                    },
                    cache: true
            },
            cache:true
        })     
        .on("select2:closing", {closing})
        .on("select2:open", {open})
        .on("select2:close", {close})
        .on("select2:opening", {opening})
        .on("select2:selecting", {selecting})
        .on("select2:select", {select})
        .on("select2:unselecting", {unselecting})
        .on("select2:unselect", {unselect})
        .on("select2:clearing", {clearing})
        .on("select2:clear", {clear});
JS,

        'js' => <<<JS
      $(document).ready(function() {
      {select2Options}
      }); 
JS,

        'css' => <<<CSS
       .select2-container--bootstrap .select2-results__option[aria-selected=true]{
       background-color: {selectedColor};
       }
       .select2-container--bootstrap .select2-results__option--highlighted[aria-selected]{
       color: {Fontcolor};
       background-color: {selectColor};
       }    
CSS,

        'icon' => <<<HTML
    <i class="{icon} fa-2x"></i>
HTML,
    ];

    public function codes()
    {
        $option = '';

        foreach ($this->data as $key => $value) {

            $selected = '';
            if ($this->value === $key) {
                $selected = 'selected="selected"';
            }

            if (is_array($this->value)) {
                foreach ($this->value as $val) {
                    if ($key === $val) {
                        $selected = 'selected="selected"';
                    }
                }
            }

            $option .= strtr($this->_layout['option'], [
                '{value}' => $value,
                '{key}' => $key,
                '{selected}' => $selected,
                '{readonly}' => $this->_config['readonly'],
            ]);
        }
        
        $this->htm .= strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{data}' => $this->data,
            '{url}' => $this->_config['url'],
            '{dataType}' => $this->_config['dataType'],
        ]);
        
        $this->css = strtr($this->_layout['css'], [
           
        ]);
    }
}
