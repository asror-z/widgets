<?php

namespace zetsoft\widgets\inputes;

use yii\helpers\Url;
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
 * Class ZSelect2WidgetAjax
 * https://github.com/asror-z
 * https://github.com/select2/select2
 * https://select2.org/
 * https://select2.github.io/select2/
 *
 */
class ZSelect2WidgetAjax extends ZWidget
{

    public $dbType = dbTypeJsonb;

    public $config = [];
    public $_config = [
        'width' => '100%',
        'class' => '',
        'theme' => self::theme['bootstrap4'],
        'ajax.data' => null,
        'ajax.result' => null,
        'allowClear' => true,
        'inpLength' => 0,
        'url' => null,
        'tags' => true,
        'escapeMarkup' => null,
        'templateResult' => null,
        'templateSelection' => null,
        'multiple' => false,
        'addonPrependContent' => false,
        'addonAppendContent' => false,
        'contentBefore' => '',
        'contentAfter' => '',
        'readonly' => true,
        'grapes' => true,
        'parent' => null,
        'depend' => null,
        'target' => null,
        'type'   => ZSelect2WidgetAjax::types['select2'],

    ];

    public const types = [
        'default' => 1,
        'select2' => 2,
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];
    public const theme = [
        'bootstrap4' => 'bootstrap4',
        'krajee' => 'krajee',
        'classic' => 'classic',
        'krajee-bs4' => 'krajee-bs4',
        'material' => 'material',
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
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css');
        $this->fileCss('https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js');
    }

    public $layout = [];
    public $_layout = [
        'ajax' => [
            'url' => null,
            'dataType' => 'json',
            'delay' => 250,
            'processResults' => null,
            'cache' => true
        ],

        'main' => <<<HTML
<select id="{id}" class="form-control {class}" {multiple} name="{name}">
  {content}
</select>
HTML,

        'js' => <<<JS
      $(document).ready(function() {
          $('select').select2({
                theme: '{theme}',
                delimiter: ',',
                persist: true,
                create: true,
                createOnBlur: true,
                createFilter: null,
                highlight: true,
                maxItems: null,
                hideSelectedhideSelected: null,
                closeAfterSelect: false,
                loadThrottle: 300,
                scrollDuration: 60,
                loadingClass: 'loading',
                preload: false,
                dropdownParent: null,
                addPrecedence: false,
                selectOnTab: true,
                diacritics: true,
                dataAttr: 'data-data',
                valueField: 'value',
                optgroupValueField: 'value',
                labelField: 'text',
                optgroupLabelField: 'label',
                optgroupField: 'optgroup',
                disabledField: 'disabled',
                sortField: 'order',
                searchField: ['text'],
                searchConjunction: 'and',
                lockOptgroupOrder: false,
                copyClassesToDropdown: true, 
                allowClear: true,
                loadMorePadding: 100,
                closeOnSelect: true,
                openOnEnter: false,
                dropdownAutoWidth: true,
                selectOnBlur: false,
                width: '{width}',
                maximumInputLength: 20,
                placeholder: "{placeholder}",
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
      })
JS,

        'css' => <<<CSS
         .select2W{
         width: 100px;
        }
CSS,


        'option' => <<<HTML
             <option value="{value}" {selected} >{value}</option>
HTML,
        'icon' => <<<HTML
    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
HTML,
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
                '{id}'  => $this->id,
            ]);
        }


        $iconCode = strtr($this->_layout['icon'], [

        ]);
        
        if ($this->_config['url'] !== null) {
            $ajaxValue = 'ajax';
            $ajax = $this->_layout['ajax'];
        } else {
            $ajaxValue = '';
            $ajax = '';
        }

        $name = $this->name;
        if ($this->_config['multiple'])
            $name = $this->name . '[]';

        $this->htm = strtr($this->_layout['main'],['ajax'],[
            '{id}'  => $this->id,
            '{data}' => $this->data,
            'type' => $this->_config['type'],
            'model' => $this->model,
            'attribute' => $this->attribute,
            '{class}' => $this->_config['class'],
            '{name}' => $name,
            '{content}' => $option,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{multiple}' => $this->_config['multiple'] ? 'multiple="multiple"' : '',
            '{icon}' => $this->_config['hasIcon'] ? $iconCode : '',
            
        ]);

        $this->htm .= strtr($this->_layout['ajax'],[
           'url' => $this->_config['url'],
           'processResults' => $this->_config['ajax.result'],
            $ajaxValue => $ajax,

        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{width}' => $this->jscode($this->_config['width']),
            '{placeholder}' => $this->jscode($this->_config['placeholder']),
            '{theme}' => $this->jscode($this->_config['theme']),
            '{value}' => $this->value,
            '{select}' => $this->eventCode('select'),
            '{selecting}' => $this->eventCode('selecting'),
            '{clear}' => $this->eventCode('clear'),
            '{clearing}' => $this->eventCode('clearing'),
            '{open}' => $this->eventCode('open'),
            '{opening}' => $this->eventCode('opening'),
            '{close}' => $this->eventCode('close'),
            '{closing}' => $this->eventCode('closing'),
            '{unselect}' => $this->eventCode('unselect'),
            '{unselecting}' => $this->eventCode('unselecting'),
        ]);

        $this->css = strtr($this->_layout['css'],[

        ]);
    }
}


